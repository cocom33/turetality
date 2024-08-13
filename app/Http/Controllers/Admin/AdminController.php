<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['admin'] = Admin::paginate(20);

        return view('admin.admin.admin', $data);
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'nullable|numeric|min_digits:10|max_digits:16',
            'photo' => 'sometimes|max:2048',
        ]);

        if ($request->photo) {
            $validate['photo'] = $this->file_upload('/admin', $request->photo);
        }

        Admin::create($validate);

        return redirect()->route('admin.admin');
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        if ($admin->photo) {
            $this->file_delete($admin->photo);
        }
        $admin->delete();

        return redirect()->back()->with('success', 'success delete admin account');
    }
}