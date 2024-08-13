<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class Controller
{
    public static function file_upload($path, $request_file, $file_old = '')
    {
        if ($request_file) {
            $initial_path = 'public/';

            if ($file_old && Storage::exists($initial_path . $file_old)) {
                Storage::delete($initial_path . $file_old);
            }

            $file_extension = $request_file->getClientOriginalExtension();
            $name           = time() . Str::random(10) . '.' . $file_extension;

            Storage::putFileAs($initial_path. $path, $request_file, $name);

            return $path . '/' . $name;
        }
    }

    public static function file_delete($file_name)
    {
        $initial_path = 'public/';

        if ($file_name && Storage::exists($initial_path . $file_name)) {
            Storage::delete($initial_path . $file_name);
        }
    }
}
