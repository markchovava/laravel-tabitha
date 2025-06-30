<?php

namespace App\Http\Controllers;

use App\Http\Resources\DailyReportResource;
use App\Models\DailyReport;
use App\Models\LogBathHygiene;
use App\Models\LogBloodGlucose;
use App\Models\LogBloodPressure;
use App\Models\LogExerciseActivity;
use App\Models\LogHomeTest;
use App\Models\LogMedication;
use App\Models\LogNutrition;
use App\Models\LogSleep;
use App\Models\LogTemperature;
use App\Models\LogVisitor;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{

    public $upload_location = 'assets/img/log/';
    
    //public function store(Request $request){}

    public function indexByUser(){
        if(Auth::check()) {
            $userId = Auth::user()->id;
            $data = DailyReport::with([
                'user', 
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
            ->paginate(20);
            return DailyReportResource::collection($data);           
        }
        return response()->json([
            'data' => []
        ]);

    }

    public function index(){
        $data = DailyReport::with([
                'user', 
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
        return DailyReportResource::collection($data);
    }

    public function view($id) {
        $data = DailyReport::with([
                'user', 
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
        return DailyReportResource::collection($data);
    }

    public function storeAll(Request $request){
        $userId = Auth::user()->id ?? null;
        if(MonthlyReport::where('month', $request->month)->exist()) {
            $mData = MonthlyReport::where('month', $request->month)->first();
        } else {
            $mData = new MonthlyReport();
            $mData->month = $request->month;
            $mData->created_at = now();
        }
        $mData->userId = $userId ?? $request->userId;
        $mData->updated_at = now();
        $mData->save();

        if(DailyReport::where('date', $request->date)->exist()) {
            $dailyReport = DailyReport::where('date', $request->date)->first();
        } else {
            $dailyReport = new DailyReport();
            $dailyReport->date = $request->date;
            $dailyReport->monthlyReportId = $mData->monthlyReportId;
            $dailyReport->created_at = now();
        }
        $dailyReport->userId = $userId ?? $request->userId;
        $dailyReport->date = $request->date;
        $dailyReport->month = $request->month;
        $dailyReport->updated_at = now();
        $dailyReport->save();


         try {
                        // Process Bath & Hygiene Logs
            if ($request->has('bathHygieneLogs') && is_array($request->bathHygieneLogs)) {
                foreach ($request->bathHygieneLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("bathHygieneLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'bath_hygiene_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogBathHygiene::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process Blood Glucose Logs
            if ($request->has('bloodGlucoseLogs') && is_array($request->bloodGlucoseLogs)) {
                foreach ($request->bloodGlucoseLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("bloodGlucoseLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'blood_glucose_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogBloodGlucose::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process Blood PRESSURE Logs
            if ($request->has('bloodPressureLogs') && is_array($request->bloodPressureLogs)) {
                foreach ($request->bloodPressureLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("bloodPressureLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'blood_pressure_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogBloodPressure::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process EXERCISE ACTIVITY Logs
            if ($request->has('exerciseActivityLogs') && is_array($request->exerciseActivityLogs)) {
                foreach ($request->exerciseActivityLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("exerciseActivityLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'exercise_activity_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogExerciseActivity::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process HOME TEST Logs
            if ($request->has('homeTestLogs') && is_array($request->homeTestLogs)) {
                foreach ($request->homeTestLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("homeTestLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'home_test_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogHomeTest::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process Nutrition Logs
            if ($request->has('nutritionLogs') && is_array($request->nutritionLogs)) {
                foreach ($request->nutritionLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("nutritionLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'nutrition_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogNutrition::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process MEDICATION Logs
            if ($request->has('medicationLogs') && is_array($request->medicationLogs)) {
                foreach ($request->medicationLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("medicationLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'medication_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogMedication::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process SLEEP LOGS
            if ($request->has('sleepLogs') && is_array($request->sleepLogs)) {
                foreach ($request->sleepLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("sleepLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'sleep_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogSleep::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process SORE PREVENTION LOGS
            if ($request->has('sorePreventionLogs') && is_array($request->sorePreventionLogs)) {
                foreach ($request->sorePreventionLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("sorePreventionLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'sore_prevention_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogSleep::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process TEMPERATURE LOGS
            if ($request->has('temperatureLogs') && is_array($request->temperatureLogs)) {
                foreach ($request->temperatureLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("temperatureLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'temperature_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogTemperature::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process URINATION DEFECATION
            if ($request->has('urinationDefecationLogs') && is_array($request->urinationDefecationLogs)) {
                foreach ($request->urinationDefecationLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("urinationDefecationLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'urination_defecation_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogTemperature::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                    ]);
                }
            }

            // Process VISITOR
            if ($request->has('visitorLogs') && is_array($request->visitorLogs)) {
                foreach ($request->visitorLogs as $index => $logData) {
                    $imagePath = null;
                    if( $request->hasFile("visitorLogs.{$index}.image") ) {
                        $image = $request->file('image');
                        $image_extension = strtolower($image->getClientOriginalExtension());
                        $image_name = 'visitor_' . date('Ymd') . rand(0, 10000) . '.' . $image_extension;
                        $image->move($this->upload_location, $image_name);
                        $imagePath = $this->upload_location . $image_name;                        
                    }
                    LogVisitor::create([
                        'userId' => $userId ?? $request->userId,
                        'monthlyReportId' => $mData->id,
                        'dailyReportId' => $dailyReport->id,
                        'details' => $logData['details'],
                        'patient' => $logData['patient'],
                        'assistant' => $logData['assistant'],
                        'date' => $logData['date'],
                        'time' => $logData['time'],
                        'image' => $imagePath,
                        'mask' => $logData['mask'],
                        'temperature' => $logData['temperature'],
                        'sanitization' => $logData['sanitization'],
                        'socialDistance' => $logData['socialDistance'],
                    ]);
                }
            }

            DB::commit();

            // Load the created daily report with its relationships
            $dailyReport->load(['logBathHygienes', 'logNutritions']);

            return response()->json([
                'success' => true,
                'message' => 'Daily report created successfully',
                'data' => $dailyReport
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create daily report',
                'error' => $e->getMessage()
            ], 500);
        }


        
    }

}
