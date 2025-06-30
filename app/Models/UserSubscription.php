<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    
    protected $fillable = [
        'id',
        'userId',
        'subscriptionId',
        'startDate',
        'endDate',
        'subscriptionToken',
        'status',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscriptionId', 'id');
    }

}
