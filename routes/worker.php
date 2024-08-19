<?php

use App\Http\Controllers\Worker\AnalisisChseController;
use App\Http\Controllers\Worker\AnalisisGiziController;
use App\Http\Controllers\Worker\AuthController;
use App\Http\Controllers\Worker\CallCenterController;
use App\Http\Controllers\Worker\DashboardController;
use App\Http\Controllers\Worker\HistoryChseController;
use App\Http\Controllers\Worker\HistoryGiziController;
use App\Http\Controllers\Worker\ImtController;
use App\Http\Controllers\Worker\ReportController;
use App\Http\Controllers\Worker\SettingController;
use App\Http\Controllers\Worker\WorkerHealthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->middleware('guest')->name('login.process');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/analisis-chse')->name('analisis-chse.')->group(function() {
        Route::get('/', [AnalisisChseController::class, 'index'])->name('index');
        Route::get('/clean-1', [AnalisisChseController::class, 'clean1'])->name('clean1');
        Route::get('/clean-2', [AnalisisChseController::class, 'clean2'])->name('clean2');
        Route::get('/health-1', [AnalisisChseController::class, 'health1'])->name('health1');
        Route::get('/health-2', [AnalisisChseController::class, 'health2'])->name('health2');
        Route::get('/safety-1', [AnalisisChseController::class, 'safety1'])->name('safety1');
        Route::get('/safety-2', [AnalisisChseController::class, 'safety2'])->name('safety2');
        Route::get('/environment-1', [AnalisisChseController::class, 'environment1'])->name('environment1');
        Route::get('/environment-2', [AnalisisChseController::class, 'environment2'])->name('environment2');

        Route::post('/store', [AnalisisChseController::class, 'store'])->name('store');
    });

    Route::prefix('/analisis-gizi')->name('analisis-gizi.')->group(function() {
        Route::get('/', [AnalisisGiziController::class, 'index'])->name('index');
        Route::get('/breakfast', [AnalisisGiziController::class, 'breakfast'])->name('breakfast');
        Route::get('/launch', [AnalisisGiziController::class, 'launch'])->name('launch');
        Route::get('/dinner', [AnalisisGiziController::class, 'dinner'])->name('dinner');
        Route::get('/snack', [AnalisisGiziController::class, 'snack'])->name('snack');

        Route::post('/store', [AnalisisGiziController::class, 'store'])->name('store');
    });

    Route::get('/call-center', [CallCenterController::class, 'index'])->name('call-center');

    Route::get('/pengukuran-imt', [ImtController::class, 'index'])->name('imt');
    Route::post('/pengukuran-imt', [ImtController::class, 'store'])->name('imt.store');
    Route::delete('/pengukuran-imt/{id}', [ImtController::class, 'delete'])->name('imt.delete');

    Route::get('/worker-health', [WorkerHealthController::class, 'index'])->name('worker-health');
    Route::get('/worker-health/create', [WorkerHealthController::class, 'create'])->name('worker-health.create');
    Route::post('/worker-health', [WorkerHealthController::class, 'store'])->name('worker-health.store');
    Route::delete('/worker-health/{id}', [WorkerHealthController::class, 'delete'])->name('worker-health.delete');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::put('/reports/{id}', [ReportController::class, 'change'])->name('reports.change');
    Route::delete('/reports/{id}', [ReportController::class, 'delete'])->name('reports.delete');

    Route::prefix('/history')->name('history.')->group(function(){
        Route::get('/analisis-chse', [HistoryChseController::class, 'index'])->name('chse');
        Route::get('/analisis-chse/clean', [HistoryChseController::class, 'clean'])->name('chse.clean');
        Route::get('/analisis-chse/health', [HistoryChseController::class, 'health'])->name('chse.health');
        Route::get('/analisis-chse/safety', [HistoryChseController::class, 'safety'])->name('chse.safety');
        Route::get('/analisis-chse/environment', [HistoryChseController::class, 'environment'])->name('chse.environment');
        Route::post('/analisis-chse/export', [HistoryChseController::class, 'export'])->name('chse.export');
        Route::delete('/analisis-chse/delete/{id}', [HistoryChseController::class, 'delete'])->name('chse.delete');

        Route::get('/analisis-gizi', [HistoryGiziController::class, 'index'])->name('gizi');
        Route::get('/analisis-gizi/breakfast', [HistoryGiziController::class, 'breakfast'])->name('gizi.breakfast');
        Route::get('/analisis-gizi/launch', [HistoryGiziController::class, 'launch'])->name('gizi.launch');
        Route::get('/analisis-gizi/dinner', [HistoryGiziController::class, 'dinner'])->name('gizi.dinner');
        Route::get('/analisis-gizi/snack', [HistoryGiziController::class, 'snack'])->name('gizi.snack');
        Route::post('/analisis-gizi/export', [HistoryGiziController::class, 'export'])->name('gizi.export');
        Route::delete('/analisis-gizi/delete/{id}', [HistoryGiziController::class, 'delete'])->name('gizi.delete');
    });

    Route::get('/settings', [SettingController::class, 'index'])->name('setting');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('setting.update');
    Route::put('/settings/password', [SettingController::class, 'password'])->name('setting.password');
});