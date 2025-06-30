<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{

    protected $fillable = [
        'id',
        'userId',
        'month',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function dailyReports(){
        return $this->hasMany(DailyReport::class, 'monthlyReportId', 'id');
    }

    public function logBathHygienes(){
        return $this->hasMany(LogBathHygiene::class, 'monthlyReportId', 'id');
    }

    public function logBloodGlucoses(){
        return $this->hasMany(LogBloodGlucose::class, 'monthlyReportId', 'id');
    }

    public function logBloodPressures(){
        return $this->hasMany(LogBloodPressure::class, 'monthlyReportId', 'id');
    }

    public function logExerciseActivities(){
        return $this->hasMany(LogExerciseActivity::class, 'monthlyReportId', 'id');
    }

    public function logHomeTests(){
        return $this->hasMany(LogHomeTest::class, 'monthlyReportId', 'id');
    }

    public function logMedications(){
        return $this->hasMany(LogMedication::class, 'monthlyReportId', 'id');
    }

    public function logNutritions(){
        return $this->hasMany(LogNutrition::class, 'monthlyReportId', 'id');
    }

    public function logSleeps(){
        return $this->hasMany(LogSleep::class, 'monthlyReportId', 'id');
    }

    public function logSorePrevention(){
        return $this->hasMany(LogSorePrevention::class, 'monthlyReportId', 'id');
    }

    public function logTemperature(){
        return $this->hasMany(LogTemperature::class, 'monthlyReportId', 'id');
    }

    public function logUrinationDefecation(){
        return $this->hasMany(LogUrinationDefecation::class, 'monthlyReportId', 'id');
    }

    public function logVisitor(){
        return $this->hasMany(LogVisitor::class, 'monthlyReportId', 'id');
    }

    public function logWake(){
        return $this->hasMany(LogWake::class, 'monthlyReportId', 'id');
    }


}
