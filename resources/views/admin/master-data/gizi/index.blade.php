@extends('admin.layouts.app')

@section('breadcrumb', 'History Analisis Gizi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-12">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    History Laporan
                </h2>
            </div>
            <a href="{{ route('admin.history.gizi.breakfast') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Sarapan </div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($morning) }}</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastM ? $lastM->created_at->format('d / M / Y') . ($lastM->user_id ? ' - ' . $lastM->user->name : ' - Admin') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.history.gizi.launch') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Makan Siang </div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($launch) }}</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastL ? $lastL->created_at->format('d / M / Y') . ($lastL->user_id ? ' - ' . $lastL->user->name : ' - Admin') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.history.gizi.dinner') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Makan Malam </div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($dinner) }}</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastD ? $lastD->created_at->format('d / M / Y') . ($lastD->user_id ? ' - ' . $lastD->user->name : ' - Admin') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.history.gizi.snack') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Snack </div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($snack) }}</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastS ? $lastS->created_at->format('d / M / Y') . ($lastS->user_id ? ' - ' . $lastS->user->name : ' - Admin') : '-' }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
