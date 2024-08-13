<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Imt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImtController extends Controller
{
    public function index()
    {
        $data['imt'] = Imt::where('user_id', auth()->user()->id)->paginate(20);

        return view('worker.imt.index', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'umur' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'hasil' => 'required',
        ]);

        $validate['user_id'] = auth()->user()->id;

        Imt::create($validate);

        return redirect()->back()->with('success', 'berhasil menyimpan data');
    }

    public function delete($id)
    {
        $data = Imt::find($id);
        $data->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data imt');
    }
}