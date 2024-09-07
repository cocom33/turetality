@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Form Analisis Kesehatan
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('admin.analisis-chse.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <input type="hidden" name="number0" value="1">
                                        <input type="hidden" name="type0" value="health">
                                        <div>
                                            <label class="form-label">Adanya Jaminan Kesehatan Bagi Pekerja</label>
                                            <div class="form-check mt-2">
                                                <input checked id="yes0" class="form-check-input" type="radio" name="check0" value="1">
                                                <label class="form-check-label" for="yes0">iya</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input id="no0" class="form-check-input" type="radio" name="check0" value="0">
                                                <label class="form-check-label" for="no0">tidak</label>
                                            </div>
                                        </div>
                                        <x-form-input
                                            name="place0"
                                            label="Lokasi Hotel"
                                        />
                                        <x-form-input
                                            name="catatan0"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo0"
                                            label="Photo Iuran BPJS"
                                            type="file"
                                            :required="false"
                                        />
                                    </div>
                                    <hr class="my-12 border border-b border-t-8">
                                    <div class="flex flex-col gap-4">
                                        <input type="hidden" name="number1" value="2">
                                        <input type="hidden" name="type1" value="health">
                                        <div>
                                            <label class="form-label">Fasilitas Pemeriksaan Kesehatan bagi Pekerja</label>
                                            <div class="form-check mt-2">
                                                <input checked id="yes1" class="form-check-input" type="radio" name="check1" value="1">
                                                <label class="form-check-label" for="yes1">iya</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input id="no1" class="form-check-input" type="radio" name="check1" value="0">
                                                <label class="form-check-label" for="no1">tidak</label>
                                            </div>
                                        </div>
                                        <x-form-input
                                            name="place1"
                                            label="Lokasi Fasilitas"
                                        />
                                        <x-form-input
                                            name="catatan1"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo1"
                                            label="Photo Fasilitas"
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
