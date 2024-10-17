@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Form {{ $title }}
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('admin.analisis-chse.question-form.store', [$chse->type, $chse->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        @foreach ($chse->form as $item)
                                            @if ($item->type == 'checklist')
                                                <div>
                                                    <label class="form-label">{{ $item->question }}</label>
                                                    <div class="form-check mt-2">
                                                        <input checked id="yes0" class="form-check-input" type="radio" name="{{ $item->id }}" value="1">
                                                        <label class="form-check-label" for="yes0">iya</label>
                                                    </div>
                                                    <div class="form-check mt-2">
                                                        <input id="no0" class="form-check-input" type="radio" name="{{ $item->id }}" value="0">
                                                        <label class="form-check-label" for="no0">tidak</label>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->type == 'text')
                                                <x-form-input
                                                    name="{{ $item->id }}"
                                                    label="{{ $item->question }}"
                                                />
                                            @endif
                                            @if ($item->type == 'image')
                                                <x-form-input
                                                    name="{{ $item->id }}"
                                                    label="{{ $item->question }}"
                                                    type="file"
                                                />
                                            @endif
                                            @if ($item->type == 'long_text')
                                                <div class="col">
                                                    <label for="{{ $item->id }}" class="form-label">{{ $item->question }} <span class="text-red-500">*</span></label>
                                                    <div class="mt-2">
                                                        <textarea name="{{ $item->id }}" class="w-full form-control" rows="8" ></textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($item->type == 'date')
                                                <x-form-input
                                                    name="{{ $item->id }}"
                                                    label="{{ $item->question }}"
                                                    type="date"
                                                />
                                            @endif
                                        @endforeach
                                    </div>
                                </form>
                                <div class="flex justify-end mt-5">
                                    <x-button-light
                                        attr="form=analyst"
                                        color="blue" text="submit"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
