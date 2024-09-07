@extends('admin.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Report Summary Analisis CHSE
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Kebersihan</div>
                                        <a href="{{ route('admin.history.chse.clean') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($clean) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Kesehatan</div>
                                        <a href="{{ route('admin.history.chse.clean') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($health) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Keselamatan</div>
                                        <a href="{{ route('admin.history.chse.safety') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($safety) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Lingkungan</div>
                                        <a href="{{ route('admin.history.chse.environment') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($environment) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Report Summary Analisis Gizi
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Sarapan</div>
                                        <a href="{{ route('admin.history.gizi.breakfast') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($morning) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Makan Siang</div>
                                        <a href="{{ route('admin.history.gizi.launch') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($launch) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Makan Malam</div>
                                        <a href="{{ route('admin.history.gizi.dinner') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($dinner) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Snack</div>
                                        <a href="{{ route('admin.history.gizi.snack') }}" class="text-blue-500">lihat semua</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($snack) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Laporan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-12">
                    <div class="intro-y flex items-center justify-between h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            History Pengukuran IMT
                        </h2>
                        <x-button-light text="lihat semua" color="blue" :link="route('admin.imt')" />
                    </div>
                    <div class="intro-y col-span-12 mt-5">
                        <div class="intro-y box p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">No</th>
                                            <th class="whitespace-nowrap">Name</th>
                                            <th class="whitespace-nowrap">Umur</th>
                                            <th class="whitespace-nowrap">Berat Badan</th>
                                            <th class="whitespace-nowrap">Tinggi Badan</th>
                                            <th class="whitespace-nowrap">Tanggal Pengukuran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($imt as $item)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="whitespace-nowrap">{{ $item->name }}</td>
                                                <td class="whitespace-nowrap">{{ $item->umur }}</td>
                                                <td class="whitespace-nowrap">{{ $item->berat_badan }} KG</td>
                                                <td class="whitespace-nowrap">{{ $item->tinggi_badan }} CM</td>
                                                <td class="whitespace-nowrap">{{ $item->created_at->format('d / m / Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center justify-between h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Report Temuan
                        </h2>
                        <x-button-light color="blue" text='lihat semua' :link="route('admin.report')" />
                    </div>
                    <div class="intro-y col-span-12 mt-5">
                        <div class="intro-y box p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">No</th>
                                            <th class="whitespace-nowrap">Deskripsi</th>
                                            <th class="whitespace-nowrap">Photo</th>
                                            <th class="whitespace-nowrap">Tanggal Kejadian</th>
                                            <th class="whitespace-nowrap">Unit Kerja</th>
                                            <th class="whitespace-nowrap">Catatan</th>
                                            <th class="whitespace-nowrap">Status</th>
                                            <th class="whitespace-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($report as $item)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="whitespace-nowrap"><x-long-text :text="$item->description" /></td>
                                                <td class="whitespace-nowrap">
                                                    <x-button-light color="blue" text="show"
                                                        attr="data-tw-toggle=modal data-tw-target=#show-photo-{{ $item->id }}"
                                                    />
                                                    <div id="show-photo-{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-5">
                                                                    <h2 class="text-lg font-medium truncate mt-3">Photo Pelaporan</h2>
                                                                    <div class="mt-5">
                                                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="w-full">
                                                                    </div>

                                                                    <div class="flex gap-3 justify-end mt-5">
                                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Back</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap">{{ $item->date }}</td>
                                                <td class="whitespace-nowrap"><x-long-text :text="$item->unit_kerja" /></td>
                                                <td class="whitespace-nowrap"><x-long-text :text="$item->catatan" /></td>
                                                <td class="whitespace-nowrap flex">
                                                    @if ($item->status)
                                                        <div class="px-4 py-2 rounded bg-green-700 text-white">
                                                            <i data-lucide='check' width='18'></i>
                                                        </div>
                                                    @else
                                                        <div class="px-4 py-2 rounded bg-red-600 text-white">
                                                            <i data-lucide='x' width='18'></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    <div class="flex gap-2">
                                                        <x-button-modal type="modal-xl" id="modal{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Deskripsi</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->description }}</h4>
                                                            </div>
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Tanggal Kejadian</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->date }}</h4>
                                                            </div>
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Unit Kerja</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->unit_kerja }}</h4>
                                                            </div>
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Catatan</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->catatan }}</h4>
                                                            </div>
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Status</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->status ? 'Selesai' : 'Belum Selesai' }}</h4>
                                                            </div>
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Photo</h2>
                                                                <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="w-full mt-2">
                                                            </div>
                                                            <div class="mt-5 flex justify-end">
                                                                <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                            </div>
                                                        </x-button-modal>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
