<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnalystChseController;
use App\Http\Controllers\Admin\AnalystGiziController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CallCenterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HistoryChseController;
use App\Http\Controllers\Admin\HistoryGiziController;
use App\Http\Controllers\Admin\ImtController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkerHealthController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")->name("admin.")->group(function () {
    Route::group(["middleware" => ["guest:admin"]], function () {
        Route::get("/login", [AuthController::class, "login"])->name("login");
        Route::post("/login", [AuthController::class, "loginProcess"])->name("login.process");
    });

    Route::group(["middleware" => ["auth:admin", "admin"]], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix("/analisis-chse")->name("analisis-chse.")->group(function () {
            Route::get('/', [AnalystChseController::class, 'index'])->name('index');

            Route::get('/cleanliness', [AnalystChseController::class, 'clean'])->name('clean');
            Route::get('/health', [AnalystChseController::class, 'health'])->name('health');
            Route::get('/safety', [AnalystChseController::class, 'safety'])->name('safety');
            Route::get('/environment', [AnalystChseController::class, 'environment'])->name('environment');

            Route::post('/cleanliness', [AnalystChseController::class, 'chseStore'])->name('store');
        });

        Route::prefix("/analisis-gizi")->name("analisis-gizi.")->group(function () {
            Route::get('/', [AnalystGiziController::class, 'index'])->name('index');

            Route::get('/breakfast', [AnalystGiziController::class, 'morning'])->name('morning');
            Route::get('/launch', [AnalystGiziController::class, 'noon'])->name('launch');
            Route::get('/dinner', [AnalystGiziController::class, 'night'])->name('dinner');
            Route::get('/snack', [AnalystGiziController::class, 'snack'])->name('snack');

            Route::post('/store', [AnalystGiziController::class, 'store'])->name('store');
        });

        Route::get('/pengukuran-imt', [ImtController::class, 'index'])->name('imt');
        Route::post('/pengukuran-imt', [ImtController::class, 'store'])->name('imt.store');
        Route::post('/pengukuran-imt/export', [ImtController::class, 'export'])->name('imt.export');
        Route::delete('/pengukuran-imt/{id}', [ImtController::class, 'delete'])->name('imt.delete');

        Route::get('/reports', [ReportController::class, 'index'])->name('report');
        Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
        Route::post('/reports/store', [ReportController::class, 'store'])->name('reports.store');
        Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');
        Route::post('/reports/change/{id}', [ReportController::class, 'change'])->name('reports.change');
        Route::delete('/reports/{id}', [ReportController::class, 'delete'])->name('reports.delete');

        Route::get('/worker-health', [WorkerHealthController::class, 'index'])->name('worker-health');
        Route::get('/worker-health/create', [WorkerHealthController::class, 'create'])->name('worker-health.create');
        Route::post('/worker-health/store', [WorkerHealthController::class, 'store'])->name('worker-health.store');
        Route::delete('/worker-health/{id}', [WorkerHealthController::class, 'delete'])->name('worker-health.delete');
        Route::put('/worker-health/{id}', [WorkerHealthController::class, 'recomendation'])->name('worker-health.recomendation');

        Route::get('/call-center', [CallCenterController::class, 'index'])->name('call-center');
        Route::get('/call-center/create', [CallCenterController::class, 'create'])->name('call-center.create');
        Route::post('/call-center/store', [CallCenterController::class, 'store'])->name('call-center.store');
        Route::get('/call-center/edit/{id}', [CallCenterController::class, 'edit'])->name('call-center.edit');
        Route::put('/call-center/update/{id}', [CallCenterController::class, 'update'])->name('call-center.update');
        Route::delete('/call-center/{id}', [CallCenterController::class, 'delete'])->name('call-center.delete');
        Route::delete('/call-center/detail/{id}', [CallCenterController::class, 'deleteDetail'])->name('call-center.delete.detail');

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

        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::put('/setting/update/{id}', [SettingController::class, 'update'])->name('setting.update');
        Route::put('/setting/update-password/{id}', [SettingController::class, 'password'])->name('setting.password');
    });
});