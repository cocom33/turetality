<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallCenter;
use App\Models\CallCenterDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallCenterController extends Controller
{
    public function index()
    {
        $data['call'] = CallCenter::paginate(20);

        return view('admin.call-center.index', $data);
    }

    public function create()
    {
        return view('admin.call-center.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'name' => 'sometimes',
        ]);

        CallCenter::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.call-center')->with('success', 'berhasil membuat data panggilan');
    }

    public function edit($id)
    {
        $data['call'] = CallCenter::find($id);
        $data['count'] = $data['call']->details->count();

        return view('admin.call-center.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'name' => 'required',
        ]);

        $call = CallCenter::find($id);

        $call->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.call-center')->with('success', 'berhasil memperbarui panggilan');
    }

    public function delete($id)
    {
        $data = CallCenter::find($id);
        $detail = CallCenterDetail::where('call_center_id', $data->id)->get();

        foreach ($detail as $item) {
            $item->delete();
        }
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data panggilan');
    }

    public function deleteDetail($id)
    {
        $data = CallCenterDetail::find($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data panggilan');
    }
}