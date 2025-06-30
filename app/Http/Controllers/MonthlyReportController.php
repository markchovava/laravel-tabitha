<?php

namespace App\Http\Controllers;

use App\Http\Resources\MonthlyReportResource;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthlyReportController extends Controller
{
    
    public function indexByUser(){
        if(Auth::check()) {
            $userId = Auth::user()->id;
            $data = MonthlyReport::with([
                'user', 
                'dailyReports',
                'logBathHygienes', 
                'logBloodGlucoses', 
                'logBloodPressures', 
                'logExerciseActivities',
                'logHomeTests',
                'logMedications',
                'logNutritions',
                'logSleeps',
                'logSorePreventions',
                'logTemperatures',
                'logUrinationDefecations',
                'logVisitors',
                'logWakes',
            ])
            ->where('userId', $userId)
            ->orderBy('updated_at', 'DESC')
            ->paginate(24);
            return MonthlyReportResource::collection($data);           
        }
        return response()->json([
            'data' => []
        ]);

    }

    public function index(){
        $data = MonthlyReport::with([
                'user', 
                'dailyReports',
                'logBathHygienes', 
                'logBloodGlucoses', 
                'logBloodPressures', 
                'logExerciseActivities',
                'logHomeTests',
                'logMedications',
                'logNutritions',
                'logSleeps',
                'logSorePreventions',
                'logTemperatures',
                'logUrinationDefecations',
                'logVisitors',
                'logWakes',
            ])
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);
        return MonthlyReportResource::collection($data);
    }

    public function view($id) {
        $data = MonthlyReport::with([
                'user', 
                'dailyReports',
                'logBathHygienes', 
                'logBloodGlucoses', 
                'logBloodPressures', 
                'logExerciseActivities',
                'logHomeTests',
                'logMedications',
                'logNutritions',
                'logSleeps',
                'logSorePreventions',
                'logTemperatures',
                'logUrinationDefecations',
                'logVisitors',
                'logWakes',
            ])
            ->orderBy('updated_at', 'DESC')
            ->find($id);
        return MonthlyReportResource::collection($data);
    }

    
}
