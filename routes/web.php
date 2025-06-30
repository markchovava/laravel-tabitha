<?php

use App\Http\Controllers\AppInfoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\LogBathHygieneController;
use App\Http\Controllers\LogBloodGlucoseController;
use App\Http\Controllers\LogBloodPressureController;
use App\Http\Controllers\LogHomeTestController;
use App\Http\Controllers\LogMedicationController;
use App\Http\Controllers\LogNutritionController;
use App\Http\Controllers\LogSorePreventionController;
use App\Http\Controllers\LogTemperatureController;
use App\Http\Controllers\LogUrinationDefecationController;
use App\Http\Controllers\LogVisitorController;
use App\Http\Controllers\LogWakeController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});




/* PROFILE */
Route::prefix('profile')->group(function() {
    Route::get('/', [AuthController::class, 'view']);
    Route::post('/', [AuthController::class, 'update']);
});
Route::post('/password', [AuthController::class, 'password']);
Route::post('/email', [AuthController::class, 'email']);
Route::get('/logout', [AuthController::class, 'logout']);

/* APPINFO */
Route::prefix('app-info')->group(function() {
    Route::get('/', [AppInfoController::class, 'view']);
    Route::post('/', [AppInfoController::class, 'store']);
});

/* DAILYREPORT */
Route::prefix('daily-report')->group(function() {
    Route::get('/', [DailyReportController::class, 'index']);
    Route::view('/{id}', [DailyReportController::class, 'view']);
});
Route::get('daily-report-by-user', [DailyReportController::class, 'indexByUser']);
Route::post('daily-report-all', [DailyReportController::class, 'storeAll']);

/* MONTHLYREPORT */
Route::prefix('monthly-report')->group(function() {
    Route::get('/', [MonthlyReportController::class, 'index']);
    Route::view('/{id}', [MonthlyReportController::class, 'view']);
});
Route::post('monthly-report-by-user', [DailyReportController::class, 'indexByUser']);

/* SUBSCRIPTION */
Route::prefix('subscription')->group(function() {
    Route::get('/', [SubscriptionController::class, 'index']);
    Route::post('/', [SubscriptionController::class, 'store']);
    Route::get('/{id}', [SubscriptionController::class, 'view']);
    Route::post('/{id}', [SubscriptionController::class, 'update']);
    Route::delete('/{id}', [SubscriptionController::class, 'delete']);
});
Route::get('/user-search/{search}', [SubscriptionController::class, 'search']);
Route::get('/user-all', [SubscriptionController::class, 'indexAll']);

/* USER */
Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'view']);
    Route::post('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});
Route::get('/user-search/{search}', [UserController::class, 'search']);
Route::get('/user-all', [UserController::class, 'indexAll']);


/* --------------------------------------------- */
Route::prefix('log-bath-hygiene')->group(function() {
    Route::get('/', [LogBathHygieneController::class, 'index']);
    Route::post('/', [LogBathHygieneController::class, 'store']);
    Route::get('/{id}', [LogBathHygieneController::class, 'view']);
    Route::post('/{id}', [LogBathHygieneController::class, 'update']);
    Route::delete('/{id}', [LogBathHygieneController::class, 'delete']);
});
Route::get('/log-bath-hygiene-search/{search}', [LogBathHygieneController::class, 'search']);
Route::get('/log-bath-hygiene-all', [LogBathHygieneController::class, 'indexAll']);
Route::get('/log-bath-hygiene-by-user/{id}', [LogBathHygieneController::class, 'indexByUser']);
Route::get('/log-bath-hygiene-by-monthly-user/{userId}/{monthlyReportId}', [LogBathHygieneController::class, 'indexByMonthlyUser']);
Route::get('/log-bath-hygiene-by-monthly/{monthlyReportId}', [LogBathHygieneController::class, 'indexByMonthy']);


Route::prefix('log-blood-glucose')->group(function() {
    Route::get('/', [LogBloodGlucoseController::class, 'index']);
    Route::post('/', [LogBloodGlucoseController::class, 'store']);
    Route::get('/{id}', [LogBloodGlucoseController::class, 'view']);
    Route::post('/{id}', [LogBloodGlucoseController::class, 'update']);
    Route::delete('/{id}', [LogBloodGlucoseController::class, 'delete']);
});
Route::get('/log-blood-glucose-search/{search}', [LogBloodGlucoseController::class, 'search']);
Route::get('/log-blood-glucose-all', [LogBloodGlucoseController::class, 'indexAll']);
Route::get('/log-blood-glucose-by-user/{id}', [LogBloodGlucoseController::class, 'indexByUser']);
Route::get('/log-blood-glucose-by-monthly-user/{userId}/{monthlyReportId}', [LogBloodGlucoseController::class, 'indexByMonthlyUser']);
Route::get('/log-blood-glucose-by-monthly/{monthlyReportId}', [LogBloodGlucoseController::class, 'indexByMonthy']);


Route::prefix('log-blood-pressure')->group(function() {
    Route::get('/', [LogBloodPressureController::class, 'index']);
    Route::post('/', [LogBloodPressureController::class, 'store']);
    Route::get('/{id}', [LogBloodPressureController::class, 'view']);
    Route::post('/{id}', [LogBloodPressureController::class, 'update']);
    Route::delete('/{id}', [LogBloodPressureController::class, 'delete']);
});
Route::get('/log-blood-pressure-search/{search}', [LogBloodPressureController::class, 'search']);
Route::get('/log-blood-pressure-all', [LogBloodPressureController::class, 'indexAll']);
Route::get('/log-blood-pressure-by-user/{id}', [LogBloodPressureController::class, 'indexByUser']);
Route::get('/log-blood-pressure-by-monthly-user/{userId}/{monthlyReportId}', [LogBloodPressureController::class, 'indexByMonthlyUser']);
Route::get('/log-blood-pressure-by-monthly/{monthlyReportId}', [LogBloodPressureController::class, 'indexByMonthy']);



Route::prefix('log-home-test')->group(function() {
    Route::get('/', [LogHomeTestController::class, 'index']);
    Route::post('/', [LogHomeTestController::class, 'store']);
    Route::get('/{id}', [LogHomeTestController::class, 'view']);
    Route::post('/{id}', [LogHomeTestController::class, 'update']);
    Route::delete('/{id}', [LogHomeTestController::class, 'delete']);
});
Route::get('/log-home-test-search/{search}', [LogHomeTestController::class, 'search']);
Route::get('/log-home-test-all', [LogHomeTestController::class, 'indexAll']);
Route::get('/log-home-test-by-user/{id}', [LogHomeTestController::class, 'indexByUser']);
Route::get('/log-home-test-by-monthly-user/{userId}/{monthlyReportId}', [LogHomeTestController::class, 'indexByMonthlyUser']);
Route::get('/log-home-test-by-monthly/{monthlyReportId}', [LogHomeTestController::class, 'indexByMonthy']);



Route::prefix('log-medication')->group(function() {
    Route::get('/', [LogMedicationController::class, 'index']);
    Route::post('/', [LogMedicationController::class, 'store']);
    Route::get('/{id}', [LogMedicationController::class, 'view']);
    Route::post('/{id}', [LogMedicationController::class, 'update']);
    Route::delete('/{id}', [LogMedicationController::class, 'delete']);
});
Route::get('/log-medication-search/{search}', [LogMedicationController::class, 'search']);
Route::get('/log-medication-all', [LogMedicationController::class, 'indexAll']);
Route::get('/log-medication-by-user/{id}', [LogMedicationController::class, 'indexByUser']);
Route::get('/log-medication-by-monthly-user/{userId}/{monthlyReportId}', [LogMedicationController::class, 'indexByMonthlyUser']);
Route::get('/log-medication-by-monthly/{monthlyReportId}', [LogMedicationController::class, 'indexByMonthy']);


Route::prefix('log-nutrition')->group(function() {
    Route::get('/', [LogNutritionController::class, 'index']);
    Route::post('/', [LogNutritionController::class, 'store']);
    Route::get('/{id}', [LogMedicationController::class, 'view']);
    Route::post('/{id}', [LogNutritionController::class, 'update']);
    Route::delete('/{id}', [LogNutritionController::class, 'delete']);
});
Route::get('/log-nutrition-search/{search}', [LogNutritionController::class, 'search']);
Route::get('/log-nutrition-all', [LogNutritionController::class, 'indexAll']);
Route::get('/log-nutrition-by-user/{id}', [LogNutritionController::class, 'indexByUser']);
Route::get('/log-nutrition-by-monthly-user/{userId}/{monthlyReportId}', [LogNutritionController::class, 'indexByMonthlyUser']);
Route::get('/log-nutrition-by-monthly/{monthlyReportId}', [LogNutritionController::class, 'indexByMonthy']);


Route::prefix('log-sore-prevention')->group(function() {
    Route::get('/', [LogSorePreventionController::class, 'index']);
    Route::post('/', [LogSorePreventionController::class, 'store']);
    Route::get('/{id}', [LogSorePreventionController::class, 'view']);
    Route::post('/{id}', [LogSorePreventionController::class, 'update']);
    Route::delete('/{id}', [LogSorePreventionController::class, 'delete']);
});
Route::get('/log-sore-prevention/{search}', [LogSorePreventionController::class, 'search']);
Route::get('/log-sore-prevention-all', [LogSorePreventionController::class, 'indexAll']);
Route::get('/log-sore-prevention-by-user/{id}', [LogSorePreventionController::class, 'indexByUser']);
Route::get('/log-sore-prevention-by-monthly-user/{userId}/{monthlyReportId}', [LogSorePreventionController::class, 'indexByMonthlyUser']);
Route::get('/log-sore-prevention-by-monthly/{monthlyReportId}', [LogSorePreventionController::class, 'indexByMonthy']);


Route::prefix('log-temperature')->group(function() {
    Route::get('/', [LogTemperatureController::class, 'index']);
    Route::post('/', [LogTemperatureController::class, 'store']);
    Route::get('/{id}', [LogTemperatureController::class, 'view']);
    Route::post('/{id}', [LogTemperatureController::class, 'update']);
    Route::delete('/{id}', [LogTemperatureController::class, 'delete']);
});
Route::get('/log-temperature/{search}', [LogTemperatureController::class, 'search']);
Route::get('/log-temperature-all', [LogTemperatureController::class, 'indexAll']);
Route::get('/log-temperature-by-user/{id}', [LogTemperatureController::class, 'indexByUser']);
Route::get('/log-temperature-by-monthly-user/{userId}/{monthlyReportId}', [LogTemperatureController::class, 'indexByMonthlyUser']);
Route::get('/log-temperature-by-monthly/{monthlyReportId}', [LogTemperatureController::class, 'indexByMonthy']);


Route::prefix('log-urination-defecation')->group(function() {
    Route::get('/', [LogUrinationDefecationController::class, 'index']);
    Route::post('/', [LogUrinationDefecationController::class, 'store']);
    Route::get('/{id}', [LogUrinationDefecationController::class, 'view']);
    Route::post('/{id}', [LogUrinationDefecationController::class, 'update']);
    Route::delete('/{id}', [LogUrinationDefecationController::class, 'delete']);
});
Route::get('/log-urination-defecation/{search}', [LogUrinationDefecationController::class, 'search']);
Route::get('/log-urination-defecation-all', [LogUrinationDefecationController::class, 'indexAll']);
Route::get('/log-urination-defecation-by-user/{id}', [LogUrinationDefecationController::class, 'indexByUser']);
Route::get('/log-urination-defecation-by-monthly-user/{userId}/{monthlyReportId}', [LogUrinationDefecationController::class, 'indexByMonthlyUser']);
Route::get('/log-urination-defecation-by-monthly/{monthlyReportId}', [LogUrinationDefecationController::class, 'indexByMonthy']);


Route::prefix('log-visitor')->group(function() {
    Route::get('/', [LogVisitorController::class, 'index']);
    Route::post('/', [LogVisitorController::class, 'store']);
    Route::get('/{id}', [LogVisitorController::class, 'view']);
    Route::post('/{id}', [LogVisitorController::class, 'update']);
    Route::delete('/{id}', [LogVisitorController::class, 'delete']);
});
Route::get('/log-visitor/{search}', [LogVisitorController::class, 'search']);
Route::get('/log-visitor-all', [LogVisitorController::class, 'indexAll']);
Route::get('/log-visitor-by-user/{id}', [LogVisitorController::class, 'indexByUser']);
Route::get('/log-visitor-by-monthly-user/{userId}/{monthlyReportId}', [LogVisitorController::class, 'indexByMonthlyUser']);
Route::get('/log-visitor-by-monthly/{monthlyReportId}', [LogVisitorController::class, 'indexByMonthy']);


Route::prefix('log-wake')->group(function() {
    Route::get('/', [LogWakeController::class, 'index']);
    Route::post('/', [LogWakeController::class, 'store']);
    Route::get('/{id}', [LogWakeController::class, 'view']);
    Route::post('/{id}', [LogWakeController::class, 'update']);
    Route::delete('/{id}', [LogWakeController::class, 'delete']);
});
Route::get('/log-wake/{search}', [LogWakeController::class, 'search']);
Route::get('/log-wake-all', [LogWakeController::class, 'indexAll']);
Route::get('/log-wake-by-user/{id}', [LogWakeController::class, 'indexByUser']);
Route::get('/log-wake-by-monthly-user/{userId}/{monthlyReportId}', [LogWakeController::class, 'indexByMonthlyUser']);
Route::get('/log-wake-by-monthly/{monthlyReportId}', [LogWakeController::class, 'indexByMonthy']);






