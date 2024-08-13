@extends('worker.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Form Analisis Keselamatan Type 2
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('analisis-chse.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <input type="hidden" name="number" value="2">
                                        <input type="hidden" name="type" value="safety">
                                        <div>
                                            <label class="form-label">Adanya APAR di tempat kerja</label>
                                            <div class="form-check mt-2">
                                                <input checked id="yes" class="form-check-input" type="radio" name="check" value="1">
                                                <label class="form-check-label" for="yes">Iya Ada</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input id="no" class="form-check-input" type="radio" name="check" value="0">
                                                <label class="form-check-label" for="no">Tidak Ada</label>
                                            </div>
                                        </div>
                                        <x-form-input
                                            name="place"
                                            label="Lokasi APAR"
                                        />
                                        <x-form-input
                                            name="catatan"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo"
                                            label="Photo APAR"
                                            type="file"
                                            :required="false"
                                        />
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
