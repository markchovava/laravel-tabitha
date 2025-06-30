<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    
    protected $fillable = [
        'id',
        'userId',
        'monthlyReportId',
        'date',
        'month',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function monthlyReport(){
        return $this->belongsTo(MonthlyReport::class, 'monthlyReportId', 'id');
    }

    public function logBathHygienes(){
        return $this->hasMany(LogBathHygiene::class, 'dailyReportId', 'id');
    }

    public function logBloodGlucoses(){
        return $this->hasMany(LogBloodGlucose::class, 'dailyReportId', 'id');
    }

    public function logBloodPressures(){
        return $this->hasMany(LogBloodPressure::class, 'dailyReportId', 'id');
    }

    public function logExerciseActivities(){
        return $this->hasMany(LogExerciseActivity::class, 'dailyReportId', 'id');
    }

    public function logHomeTests(){
        return $this->hasMany(LogHomeTest::class, 'dailyReportId', 'id');
    }

    public function logMedications(){
        return $this->hasMany(LogMedication::class, 'dailyReportId', 'id');
    }

    public function logNutritions(){
        return $this->hasMany(LogNutrition::class, 'dailyReportId', 'id');
    }

    public function logSleeps(){
        return $this->hasMany(LogSleep::class, 'dailyReportId', 'id');
    }

    public function logSorePreventions(){
        return $this->hasMany(LogSorePrevention::class, 'dailyReportId', 'id');
    }

    public function logTemperatures(){
        return $this->hasMany(LogTemperature::class, 'dailyReportId', 'id');
    }

    public function logUrinationDefecations(){
        return $this->hasMany(LogUrinationDefecation::class, 'dailyReportId', 'id');
    }

    public function logVisitors(){
        return $this->hasMany(LogVisitor::class, 'dailyReportId', 'id');
    }

    public function logWakes(){
        return $this->hasMany(LogWake::class, 'dailyReportId', 'id');
    }

}
