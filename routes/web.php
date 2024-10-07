<?php

use App\Http\Controllers\Admin\PagesController as AdminPagesController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\User\PagesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('event:clear');
    return redirect()->back();
});
Route::controller(PlanController::class)->group(function () {
    Route::get('plans_getting/{value}', 'plans_getting')->name('plans_getting/{value}');
});
Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/login', 'login')->name('authentication.login');
    Route::get('/register', 'register')->name('authentication.register');
    Route::get('/forget', 'forget')->name('authentication.forget');
});
Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/registration-submit', 'registationSubmit')->name('authentication.register.submit');
    Route::post('/login-check', 'loginCheck')->name('authentication.check');
});
Route::group(["middleware" => ["authlogin"]], function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/authentication-logout', 'logout')->name('authentication.logout');
    });
    Route::controller(PagesController::class)->group(function () {
        Route::get('/online/tutor', 'onlineTutor')->name('online.tutor');
        Route::get('/profile', 'profile')->name('dashboard.profile');
        Route::put('/profile_update/{id}', 'updateProfile')->name('updateProfile');
        Route::get('/users', 'getAllUsers')->name('users');
        Route::get('change_status/{id}', 'changeStatus')->name('change_status/{id}');
        Route::delete('delete_user/{id}', 'deleteUser')->name('deleteUser/{id}');
    });
    Route::controller(AdminPagesController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::controller(PlanController::class)->group(function () {
        Route::get('/plans', 'view')->name('plan.view');
        Route::get('/plans/create', 'add')->name('plans.add');
        Route::get('/plans/details/{id}', 'planDetails')->name('plans.details');
        Route::get('/plans/checkout/{plan_id}', 'plansCheckout')->name('plans.checkout');
        Route::post('/plans/store', 'store')->name('plans.store');
        Route::delete('/plans/delete/{id}', 'delete')->name('plans.delete');
        Route::get('/plans/edit/{id}', 'edit')->name('plans.edit/{id}');
        Route::put('/plans/update/{id}', 'planUpdate')->name('/plans/update/{id}');
        Route::post('/plans/process', 'process')->name('plans.process');
        Route::get('plans_filteration/{value}', 'plans_filteration')->name('plans_filteration/{value}');
        Route::get('/subscription/success', 'success')->name('/subscription/success');
        Route::get('subscriptions', 'subscriptions')->name('subscriptions');
        Route::delete('subscription/delete/{id}', 'subscriptionDelete')->name('subscription/delete/{id}');
        Route::get('subscription/details/{id}', 'subscriptionDetails')->name('subscription/details/{id}');
        Route::post('subscription/renew/{id}', 'subscriptionRenew')->name('subscription/renew/{id}');
    });
});
