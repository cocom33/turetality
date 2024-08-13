@extends('worker.layouts.app')

@section('breadcrumb', 'Analisis Gizi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Report Summary
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Breakfast</div>
                                        <a href="{{ route('history.gizi.breakfast') }}" class="text-blue-500">see all</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($morning) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Report</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Launch</div>
                                        <a href="{{ route('history.gizi.launch') }}" class="text-blue-500">see all</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($launch) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Report</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Dinner</div>
                                        <a href="{{ route('history.gizi.dinner') }}" class="text-blue-500">see all</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($dinner) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Report</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex justify-between items-center">
                                        <div class="text-xl font-medium leading-8">Snack</div>
                                        <a href="{{ route('history.gizi.snack') }}" class="text-blue-500">see all</a>
                                    </div>
                                    <div class="flex items-end gap-3">
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($snack) }}</div>
                                        <div class="text-base text-slate-500 mt-1">Report</div>
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
                            Add Report
                        </h2>
                    </div>
                    <a href="{{ route('analisis-gizi.breakfast') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="shield"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Add Breakfast Report</div>
                                <div class="text-base text-slate-900 mt-1">Last report : {{ $lastM ? $lastM->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('analisis-gizi.launch') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="shield"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Add Launch Report</div>
                                <div class="text-base text-slate-900 mt-1">Last report : {{ $lastL ? $lastL->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('analisis-gizi.dinner') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="shield"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Add Dinner Report</div>
                                <div class="text-base text-slate-900 mt-1">Last report : {{ $lastD ? $lastD->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('analisis-gizi.snack') }}" class="p-6 rounded-lg bg-white shadow-md flex mt-4 hover:-translate-y-3 transition-transform duration-300">
                        <div class="flex gap-5 items-center">
                            <i data-lucide="shield"></i>
                            <div>
                                <div class="text-xl font-semibold leading-8">Add Snack Report</div>
                                <div class="text-base text-slate-900 mt-1">Last report : {{ $lastS ? $lastS->created_at->format('d - M - Y') : '-' }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
