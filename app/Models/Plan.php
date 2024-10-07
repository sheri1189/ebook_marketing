<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'name',
        'slug',
        'currency',
        'billing_method',
        'billing_period',
        'price',
        'status',
        'image',
        'added_from',
        'description',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
