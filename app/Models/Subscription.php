<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'id',
        'userId',
        'name',
        'description',
        'fee',
        'created_at',
        'updated_at',
    ];

     public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

}
