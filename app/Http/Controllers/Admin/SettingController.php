<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'phone' => 'nullable|numeric|min_digits:10|max_digits:16',
            'photo' => 'sometimes|max:2048',
        ]);

        if ($request->photo) {
            if ($admin->photo) {
                $validate['photo'] = $this->file_upload('/admin', $validate['photo'], $admin->photo);
            } else {
                $validate['photo'] = $this->file_upload('/admin', $validate['photo']);
            }
        }

        $admin->update($validate);

        return redirect()->back()->with('success', 'updated success');
    }

    public function password(Request $request, $id)
    {
        $validate = $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        $admin = Admin::find($id);
        $check = Hash::check($validate['old_password'], $admin->password);

        if (!$check) {
            return redirect()->back()->with('error', 'Password anda salah, silahkan coba lagi');
        }

        $admin->update([
            'password' => Hash::make($validate['password'])
        ]);

        return redirect()->back()->with('success', 'Password berhasil di update');
    }
}