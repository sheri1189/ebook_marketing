<?php

namespace App\Http\Controllers;

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

use App\Mail\SubscriptionTemplate;
use App\Models\{User};
use App\Models\Plan as ModelsPlan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, File, Mail};
use Stripe\Plan;
use Stripe\Stripe;
use Symfony\Component\Uid\NilUlid;

class PlanController extends Controller
{
    public function view()
    {
        $allplans = ModelsPlan::where('billing_period', 'month')->latest()->get();
        return view('Admin.Subscription.Plan.view', compact("allplans"));
    }
    public function add()
    {
        return view('Admin.Subscription.Plan.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'unique:plans,name',
        ]);
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $Plan = Plan::create([
            'amount' => $request->amount * 100,
            'currency' => $request->currency,
            'interval' => $request->billing_period,
            'product' => [
                'name' => $request->name
            ]
        ]);
        $msg = 200;
        if ($msg == 200) {
            $array_slugs = [];
            if ($request->prompt_queries >= 0) {
                $array_slugs[] = 'Prompt Queries-' . $request->prompt_queries;
            }
            ModelsPlan::create([
                'plan_id' => $Plan->id,
                'name' => strtolower($request->name),
                'slug' => serialize($array_slugs),
                'currency' => $request->currency,
                'price' => $request->amount,
                'billing_method' => $Plan->billing_scheme,
                'billing_period' => $request->billing_period,
                'description' => $request->description,
                'status' => 'Active',
                'added_from' => Auth::user()->id,
            ]);
            return response()->json([
                "message" => 200,
                "module" => "plan",
            ]);
        }
    }
    public function delete($id)
    {
        $data = ModelsPlan::where("id", $id)->first();

        if ($data) {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            try {
                $stripe->plans->delete($data->plan_id);
            } catch (\Exception $e) {
                return response()->json([
                    "message" => "Failed to delete the plan from Stripe: " . $e->getMessage(),
                ], 500);
            }
            if (File::exists($data->image)) {
                File::delete($data->image);
            }
            ModelsPlan::where('id', $id)->delete();
            return response()->json([
                "message" => 200,
            ], 200);
        } else {
            return response()->json([
                "message" => "Plan not found",
            ], 404);
        }
    }
    public function plansCheckout($plan_id)
    {
        $plan = DB::table("plans")->where("plan_id", $plan_id)->first();
        return view('User.Subscription.Plan.checkout', [
            'plan' => $plan,
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }
    public function process(Request $request)
    {
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        $paymentMethod = $request->payment_method;
        if ($paymentMethod != null) {
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }
        $plan = $request->plan_id;
        if (empty($plan)) {
            return back()->withErrors(['error' => 'Plan ID is required']);
        }
        try {
            $subscription = $user->newSubscription('default', $plan)
                ->create($paymentMethod != null ? $paymentMethod->id : '');
            date_default_timezone_set('Asia/Karachi');
            $plan = ModelsPlan::where('plan_id', $plan)->first();
            if ($plan->billing_period == "month") {
                $timeStamp = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
            } else {
                $timeStamp = Carbon::now()->addDays(365)->format('Y-m-d H:i:s');
            }
            $subscription->update(['trial_ends_at' => $timeStamp, 'customer_id' => $subscription['owner']['stripe_id']]);
            // Mail::to($user->email)->send(new SubscriptionTemplate($user->email, 'Subscription'));
            return redirect('/subscription/success');
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => 'Unable to create subscription: ' . $exception->getMessage()]);
        }
        // $msg = 200;

        // // try {
        // //     if (!empty($user->stripe_id)) {
        // //         $subscription = DB::table('subscriptions as s')
        // //             ->join('users as u', 'u.id', '=', 's.user_id')
        // //             ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
        // //             ->where('s.user_id', $user->id)
        // //             ->first();
        // //         if ($subscription) {
        // //             if (is_null($subscription->ends_at)) {
        // //                 $user->subscription($subscription->type)->cancel();
        // //             }
        // //             DB::table('subscription_items')->where('subscription_id', $subscription->id)->delete();
        // //             DB::table('subscriptions')->where('id', $subscription->id)->delete();
        // //         }
        // //     }
        // //     \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        // //     $user->createOrGetStripeCustomer();
        // //     $paymentMethodId = $request->payment_method;
        // //     $paymentMethod = null;
        // //     if ($paymentMethodId) {
        // //         $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
        // //         if ($paymentMethod->customer && $paymentMethod->customer != $user->stripe_id) {
        // //             \Stripe\PaymentMethod::detach($paymentMethodId);
        // //         }
        // //         $paymentMethod = $user->addPaymentMethod($paymentMethodId);
        // //     }

        // //     $plan = $request->plan_id;

        // //     if (empty($plan)) {
        // //         throw new \Exception('Plan ID is required');
        // //     }
        // //     $user->newSubscription('default', $plan)
        // //         ->create($paymentMethod ? $paymentMethod->id : null);
        // //     $user->update([
        // //         "stripe_id" => $user->stripe_id,
        // //         "pm_type" => $paymentMethod->type ?? null,
        // //         "pm_last_four" => $paymentMethod->card->last4 ?? null,
        // //         "trial_ends_at" => null,
        // //     ]);
        // //     Mail::to($user->email)->send(new SubscriptionTemplate($user->email, 'Subscription'));
        // //     return redirect('/subscription/success');
        // // } catch (\Exception $exception) {
        // //     return back()->withErrors([
        // //         'error' => 'Unable to create subscription: ' . $exception->getMessage(),
        // //     ]);
        // // }
    }



    public function plans_filteration($value)
    {
        $allplans = ModelsPlan::where('billing_period', $value)->latest()->get();
        $array_slugs = [];
        foreach ($allplans as $plans) {
            if ($plans) {
                $array_slugs[$plans->id] = unserialize($plans->slug);
            } else {
                $array_slugs[$plans->id] = "";
            }
        }
        return response()->json([
            "allplans" => $allplans,
            "plan_slugs" => $array_slugs,
            "is_admin" => Auth::user()->is_admin,
        ]);
    }
    public function plans_getting($value)
    {
        $allplans = ModelsPlan::where('billing_period', $value)->latest()->get();
        $array_slugs = [];
        foreach ($allplans as $plans) {
            if ($plans) {
                $array_slugs[$plans->id] = unserialize($plans->slug);
            } else {
                $array_slugs[$plans->id] = "";
            }
        }
        return response()->json([
            "allplans" => $allplans,
            "plan_slugs" => $array_slugs,
        ]);
    }
    public function success()
    {
        return view('Admin.Subscription.Plan.success');
    }
    public function subscriptions()
    {
        if (Auth::user()->is_admin != 1) {
            $allsubscriptions = DB::table('subscriptions as s')
                ->join('users as u', 'u.id', '=', 's.user_id')
                ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
                ->where('s.user_id', Auth::user()->id)
                ->get();
        } else {
            $allsubscriptions = DB::table('subscriptions as s')
                ->join('users as u', 'u.id', '=', 's.user_id')
                ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
                ->orderBy('s.updated_at')->get();
        }
        return view('Admin.Subscription.Plan.subscriptions', compact("allsubscriptions"));
    }
    public function subscriptionDelete($id)
    {
        $subscription = DB::table('subscriptions as s')
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
            ->where('s.user_id', $id)
            ->first();
        if (!$subscription) {
            return response()->json([
                "message" => 404,
            ]);
        }
        if ($subscription->ends_at == "") {
            $user = User::findorfail($id);
            $user->subscription($subscription->type)->cancel();
            return response()->json([
                "message" => 200,
                "data" => "Cancle",
            ]);
        } else {
            $user = User::findorfail($id);
            $user->subscription($subscription->type)->resume();
            return response()->json([
                "message" => 200,
                "data" => "Resume",
            ]);
        }
    }
    public function subscriptionDetails($id)
    {
        $subscription = DB::table('subscriptions as s')
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
            ->where('s.user_id', $id)
            ->first();
        return view('Admin.Subscription.details', compact("subscription"));
    }
    public function edit($id)
    {
        $plan = ModelsPlan::where('id', $id)->first() ?? "";
        return view('Admin.Subscription.Plan.edit', compact("plan"));
    }
    public function planDetails($id)
    {
        $plans = ModelsPlan::where('plan_id', $id)->first() ?? "";
        return view('Admin.Subscription.Plan.plan_details', compact("plans"));
    }
    public function planUpdate(Request $request, $id)
    {
        $request->validate([
            "name" => "unique:plans,name,$id",
        ]);
        $plan = ModelsPlan::find($id);
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $Plan = Plan::create([
            'amount' => $request->amount * 100,
            'currency' => $request->currency,
            'interval' => $request->billing_period,
            'product' => [
                'name' => $request->name
            ]
        ]);
        $msg = 200;
        if ($msg == 200) {
            $array_slugs = [];
            if ($request->prompt_queries >= 0) {
                $array_slugs[] = 'Prompt Queries-' . $request->prompt_queries;
            }
            ModelsPlan::where('plan_id', $plan->plan_id)->update([
                'plan_id' => $Plan->id,
                'name' => strtolower($request->name),
                'slug' => serialize($array_slugs),
                'currency' => $request->currency,
                'price' => $request->amount,
                'billing_method' => $Plan->billing_scheme,
                'billing_period' => $request->billing_period,
                'description' => $request->description,
                'status' => 'Active',
                'added_from' => Auth::user()->id,
            ]);
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            try {
                $stripe->plans->delete($plan->plan_id);
            } catch (\Exception $e) {
                return response()->json([
                    "message" => "Failed to delete the plan from Stripe: " . $e->getMessage(),
                ], 500);
            }
            return response()->json([
                // "message" => 200,
                "module" => "plan",
            ]);
        }
    }
    public function subscriptionRenew(Request $request)
    {
        $subscription = DB::table('subscriptions as s')
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->join('plans as p', 'p.plan_id', '=', 's.stripe_price')
            ->where('s.trial_ends_at', $request->trial_ends_at)
            ->first();
        if (!$subscription) {
            return response()->json(['error' => 'Subscription not found.']);
        }
        Stripe::setApiKey(config('services.stripe.secret'));
        $stripeCustomerId = $subscription->customer_id;
        $paymentMethods = \Stripe\PaymentMethod::all([
            'customer' => $stripeCustomerId,
            'type' => 'card',
        ]);
        if (empty($paymentMethods->data)) {
            return response()->json(['error' => 'No payment methods found for the customer.']);
        }
        $paymentMethod = $paymentMethods->data[0]->id;
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        if ($paymentMethod != null) {
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }
        $plan = $subscription->plan_id;
        if (empty($plan)) {
            return back()->withErrors(['error' => 'Plan ID is required']);
        }
        try {
            $subscription = $user->newSubscription('default', $plan)
                ->create($paymentMethod != null ? $paymentMethod->id : '');
            date_default_timezone_set('Asia/Karachi');
            $plan = ModelsPlan::where('plan_id', $plan)->first();
            if ($plan->billing_period == "month") {
                $timeStamp = Carbon::now()->addDays(30)->format('Y-m-d H:i:s');
            } else {
                $timeStamp = Carbon::now()->addDays(365)->format('Y-m-d H:i:s');
            }
            $subscription->update([
                'trial_ends_at' => $timeStamp,
                'customer_id' => $subscription['owner']['stripe_id']
            ]);
            // Mail::to($user->email)->send(new SubscriptionTemplate($user->email, 'Subscription'));
            return response()->json([
                "message" => 200,
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Unable to create subscription: ' . $exception->getMessage()]);
        }
    }
}
