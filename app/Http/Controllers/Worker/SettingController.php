<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    public function index()
    {
        return view('worker.settings.index');
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|numeric|min_digits:10|max_digits:16',
            'photo' => 'sometimes|max:2048',
            'gender' => 'required',
            'ttd' => 'sometimes|max:2048',
            'umur' => 'sometimes',
            'tanggal_lahir' => 'sometimes',
            'alamat' => 'sometimes',
        ]);

        if ($request->photo) {
            if ($user->photo) {
                $validate['photo'] = $this->file_upload('/user/photo', $validate['photo'], $user->photo);
            } else {
                $validate['photo'] = $this->file_upload('/user/photo', $validate['photo']);
            }
        }

        if ($request->ttd) {
            if ($user->ttd) {
                $validate['ttd'] = $this->file_upload('/user/ttd', $validate['ttd'], $user->ttd);
            } else {
                $validate['ttd'] = $this->file_upload('/user/ttd', $validate['ttd']);
            }
        }

        $user->update($validate);

        return redirect()->back()->with('success', 'updated success');
    }

    public function password(Request $request, $id)
    {
        $validate = $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(auth()->user()->id);
        $check = Hash::check($validate['old_password'], $user->password);

        if (!$check) {
            return redirect()->back()->with('error', 'Password anda salah, silahkan coba lagi');
        }

        $user->update([
            'password' => Hash::make($validate['password'])
        ]);

        return redirect()->back()->with('success', 'Password berhasil di update');
    }
}