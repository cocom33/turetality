@extends('worker.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-12">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Report History
                </h2>
            </div>
            <a href="{{ route('history.gizi.breakfast') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Breakfast Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($morning) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastM ? $lastM->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.gizi.launch') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Launch Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($launch) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastL ? $lastL->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.gizi.dinner') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Dinner Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($dinner) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastD ? $lastD->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.gizi.snack') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Snack Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($snack) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastS ? $lastS->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
