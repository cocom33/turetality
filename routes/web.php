<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/worker.php';