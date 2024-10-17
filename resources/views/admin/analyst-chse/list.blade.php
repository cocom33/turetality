@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-12">
                    <div class="intro-y flex items-center justify-between h-10 mb-5">
                        <h2 class="text-lg font-medium truncate mr-5">
                            {{ $title }}
                        </h2>
                    </div>

                    @if (session('success'))
                        <div class="px-6 py-3 text-white bg-green-600 rounded-lg mt-5">
                            {{ session('success') }}
                        </div>
                    @endif
                    @forelse ($chse as $item)
                        <a href="{{ route('admin.analisis-chse.question-form', [$item->type, $item->id]) }}" class="p-6 rounded-lg bg-white shadow-md flex justify-between items-center mt-4 hover:-translate-y-1 transition-transform duration-300">
                            <div class="flex gap-5 items-center">
                                <div>
                                    <div class="text-xl font-semibold leading-8">{{ $item->name }}</div>
                                    <div class="text-base text-slate-900 mt-1">Pertanyaan dibuat {{ $item->created_at->format('d-m-Y') }} </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 rounded-lg bg-white shadow-md text-center text-lg">
                            Tidak template tambahan laporan
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
