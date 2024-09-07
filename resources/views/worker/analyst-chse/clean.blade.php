@extends('worker.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Form Analisis Kebersihan
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('analisis-chse.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4" id="tab1">
                                        <input type="hidden" name="number0" value="1">
                                        <input type="hidden" name="type0" value="clean">
                                        <div>
                                            <label class="form-label">Apakah pihak Hotel menyediakan SOP kebersihan lingkungan kerja</label>
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
                                            label="Lokasi SOP"
                                        />
                                        <x-form-input
                                            name="catatan0"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo0"
                                            label="Photo SOP"
                                            type="file"
                                            :required="false"
                                        />
                                    </div>

                                    <div class="flex flex-col gap-4 hidden" id="tab2">
                                        <input type="hidden" name="number1" value="2">
                                        <input type="hidden" name="type1" value="clean">
                                        <div>
                                            <label class="form-label">Adanya penggolongan tempat sampah</label>
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
                                            label="Lokasi Tempat Sampah"
                                        />
                                        <x-form-input
                                            name="catatan1"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo1"
                                            label="Photo Tempat Sampah"
                                            type="file"
                                            :required="false"
                                        />
                                    </div>
                                </form>
                                <div class="w-full mt-5">
                                    <div class="flex justify-end items-center hidden" id="last">
                                        <a onclick="prev()" class="mr-3 px-5 py-2 shadow rounded text-white bg-green-700 hover:bg-green-500 transition-all duration-300 cursor-pointer">Prev</a>
                                        <x-button-light
                                            attr="form=analyst"
                                            color="blue" text="Submit"
                                        />
                                    </div>
                                    <div class="flex justify-end items-center" id="first">
                                        <a onclick="next()" class="ml-auto px-5 py-2 shadow rounded text-white bg-blue-700 hover:bg-blue-500 transition-all duration-300 cursor-pointer">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Form Analisis Kebersihan Type 1
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('analisis-chse.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <input type="hidden" name="number" value="1">
                                        <input type="hidden" name="type" value="clean">
                                        <div>
                                            <label class="form-label">Apakah pihak Hotel menyediakan SOP kebersihan lingkungan kerja</label>
                                            <div class="form-check mt-2">
                                                <input checked id="yes" class="form-check-input" type="radio" name="check" value="1">
                                                <label class="form-check-label" for="yes">iya</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input id="no" class="form-check-input" type="radio" name="check" value="">
                                                <label class="form-check-label" for="no">tidak</label>
                                            </div>
                                        </div>
                                        <x-form-input
                                            name="place"
                                            label="Lokasi SOP"
                                        />
                                        <x-form-input
                                            name="catatan"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo"
                                            label="Photo SOP"
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
    </div> --}}
@endsection

@push('addon-script')
    <script>
        var currentForm = 1;
        var tab1 = document.getElementById('tab1')
        var tab2 = document.getElementById('tab2')

        function next() {
            currentForm++
            console.log(currentForm)
            tab1.classList.add("hidden")
            tab2.classList.remove("hidden")
            document.getElementById('last').classList.toggle("hidden")
            document.getElementById('first').classList.toggle("hidden")
        }

        function prev() {
            currentForm--
            console.log(currentForm)
            tab2.classList.add("hidden")
            tab1.classList.remove("hidden")
            document.getElementById('last').classList.toggle("hidden")
            document.getElementById('first').classList.toggle("hidden")
        }
    </script>
@endpush
