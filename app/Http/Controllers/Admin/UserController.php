<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['user'] = User::paginate(20);

        return view('admin.user.index', $data);
    }

    public function create()
    {
        return view('admin.user.form');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:pria,wanita',
            'umur' => 'nullable|numeric',
            'phone' => 'nullable|numeric|min:10|max:16',
            'tanggal_lahir' => 'sometimes',
            'alamat' => 'sometimes',
            'photo' => 'sometimes|max:2048',
            'ttd' => 'sometimes|max:2048',
        ]);

        if ($request->ttd) {
            $validate['ttd'] = $this->file_upload('/users/ttd', $request->ttd);
        }

        if ($request->photo) {
            $validate['photo'] = $this->file_upload('/users/photo', $request->photo);
        }

        $validate['password'] = Hash::make('secret123');

        User::create($validate);

        return redirect()->route('admin.users');
    }

    public function show($id)
    {
        $data['user'] = User::find($id);

        return view('admin.user.form', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'gender' => 'required|in:pria,wanita',
            'umur' => 'nullable|numeric',
            'phone' => 'nullable|numeric|min_digits:10|max_digits:16',
            'tanggal_lahir' => 'sometimes',
            'alamat' => 'sometimes',
            'photo' => 'sometimes|max:2048',
            'ttd' => 'sometimes|max:2048',
        ]);

        if ($request->ttd) {
            $validate['ttd'] = $this->file_upload('/users/ttd', $request->ttd, $user->ttd);
        }

        if ($request->photo) {
            $validate['photo'] = $this->file_upload('/users/photo', $request->photo, $user->photo);
        }

        $user->update($validate);

        return redirect()->route('admin.users');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->ttd) {
            $this->file_delete($user->ttd);
        }
        if ($user->photo) {
            $this->file_delete($user->photo);
        }

        $user->delete();

        return redirect()->back();
    }
}