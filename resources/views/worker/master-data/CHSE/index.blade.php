@extends('worker.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Report History
                </h2>
            </div>
            <a href="{{ route('history.chse.clean') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="home"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Kebersihan</div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($clean + $cusclean) }} ({{ $cusclean }} Laporan Custom)</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastC ? $lastC->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.health') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="cross"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Kesehatan</div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($health + $cushealth) }} ({{ $cushealth }} Laporan Custom)</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastH ? $lastH->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.safety') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Keselamatan</div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($safety + $cussafety) }} ({{ $cussafety }} Laporan Custom)</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastS ? $lastS->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.environment') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-1 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="archive"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Laporan Lingkungan</div>
                        <div class="text-base text-slate-900 mt-1">Total Laporan : {{ number_format($environment + $cusenvironment) }} ({{ $cusenvironment }} Laporan Custom)</div>
                        <div class="text-base text-slate-900 mt-1">Laporan Terakhir: {{ $lastE ? $lastE->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
