<?php

namespace App\Models;

use App\Models\Subscription;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory,Billable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];
    protected $hidden = ['password'];

    public function activeSubscription(){
        return $this->hasMany(Subscription::class)->whereNull('ends_at');
    }
}
