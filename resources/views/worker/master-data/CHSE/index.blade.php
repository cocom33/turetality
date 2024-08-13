@extends('worker.layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Report History
                </h2>
            </div>
            <a href="{{ route('history.chse.clean') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="home"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Cleanliness Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($clean) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastC ? $lastC->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.health') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="cross"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Health Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($health) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastH ? $lastH->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.safety') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="shield"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Safety Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($safety) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastS ? $lastS->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
            <a href="{{ route('history.chse.environment') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                <div class="flex gap-5 items-center">
                    <i data-lucide="archive"></i>
                    <div>
                        <div class="text-xl font-semibold leading-8">Environment Report</div>
                        <div class="text-base text-slate-900 mt-1">Total report : {{ number_format($environment) }}</div>
                        <div class="text-base text-slate-900 mt-1">Last report : {{ $lastE ? $lastE->created_at->format('d / M / Y') : '-' }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
