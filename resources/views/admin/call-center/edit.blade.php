@extends('admin.layouts.app')

@section('breadcrumb', 'Call Center')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Create New Call Center
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('admin.call-center.update', $call->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col gap-4">
                                        <x-form-input
                                            name="callcenter"
                                            label="Call Center Name"
                                            value="{{ $call->name }}"
                                        />
                                        <hr class="my-3 border-t">
                                        <div id="form">
                                            @foreach ($call->details as $item)
                                                <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                <div class="flex gap-3 items-end mb-3">
                                                    <x-form-input
                                                        name="type[]"
                                                        label="Number Type"
                                                        placeholder="ex: whatsapp, telephone"
                                                        value="{{ $item->type }}"
                                                    />
                                                    <x-form-input
                                                        name="name[]"
                                                        label="Nama Penerima"
                                                        :required="false"
                                                        value="{{ $item->name }}"
                                                    />
                                                    <div class="flex gap-3 items-end">
                                                        <x-form-input
                                                            name="number[]"
                                                            label="Number Call"
                                                            type="number"
                                                            value="{{ $item->number }}"
                                                        />
                                                        @if ($count >= 2)
                                                            <a class="px-5 py-2 shadow rounded text-white bg-red-700 hover:bg-red-500 transition-all duration-300 cursor-pointer"
                                                                data-tw-toggle="modal" data-tw-target="#modalDetail{{ $item->id }}"><i data-lucide='trash' width='18'></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                                <div class="flex justify-end mt-5">
                                    <x-button-light
                                        attr="form=analyst"
                                        color="blue" text="submit"
                                    />
                                </div>

                                @foreach ($call->details as $item)
                                <div id="modalDetail{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body p-5 text-center">
                                                <h2 class="text-lg font-medium truncate mt-3">Hapus Nomor?</h2>
                                                <div class="flex gap-3 justify-center mt-5">
                                                    <form action="{{ route('admin.call-center.delete.detail', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger w-24">Hapus</button>
                                                    </form>
                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
