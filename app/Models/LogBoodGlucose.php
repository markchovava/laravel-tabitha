<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogBoodGlucose extends Model
{
    protected $fillable = [
        'id',
        'userId',
        'dailyReportId',
        'monthlyReportId',
        'details',
        'patient',
        'assistant',
        'date',
        'time',
        'image',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function monthlyReport(){
        return $this->belongsTo(MonthlyReport::class, 'monthlyReportId', 'id');
    }

    public function dailyReport(){
        return $this->belongsTo(DailyReport::class, 'dailyReportId', 'id');
    }
    
}
