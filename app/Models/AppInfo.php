<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppInfo extends Model
{
    protected $fillable = [
        'id',
        'userId',
        'name',
        'description',
        'phone',
        'email',
        'address',
        'website',
        'whatsapp',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'twitter',
        'created_at',
        'updated_at',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    
}
