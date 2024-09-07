@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Total Laporan
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
                <div class="col-span-12 mt-12">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Tambah Laporan
                        </h2>
                    </div>
                    <a href="{{ route('admin.analisis-chse.clean') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="home"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Tambah Laporan Kebersihan</div>
                                <div class="text-base text-slate-900 mt-1">Laporan Terakhir : {{ $lastC ? $lastC->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.analisis-chse.health') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="cross"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Tambah Laporan Kesehatan</div>
                                <div class="text-base text-slate-900 mt-1">Laporan Terakhir : {{ $lastH ? $lastH->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.analisis-chse.safety') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="shield"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Tambah Laporan Keselamatan</div>
                                <div class="text-base text-slate-900 mt-1">Laporan Terakhir : {{ $lastS ? $lastS->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.analisis-chse.environment') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="archive"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Tambah Laporan Lingkungan</div>
                                <div class="text-base text-slate-900 mt-1">Laporan Terakhir : {{ $lastE ? $lastE->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
