@extends('worker.layouts.app')

@section('breadcrumb', 'IMT')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Perhitungan IMT
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form action="{{ route('imt.store') }}" method="POST" id="submitimt" class="grid md:grid-cols-2 gap-3">
                                    @csrf
                                    <x-form-input
                                        name="name"
                                        label="Nama"
                                        attr="onkeyup=enableSubmit()"
                                    />
                                    <x-form-input
                                        name="umur"
                                        label="Umur"
                                        type="number"
                                        attr="onkeyup=enableSubmit() min=1"
                                    />
                                    <x-form-input
                                        name="berat_badan"
                                        label="Berat Badan"
                                        type="number"
                                        attr="onkeyup=enableSubmit() min=1"
                                    />
                                    <x-form-input
                                        name="tinggi_badan"
                                        label="Tinggi Badan"
                                        type="number"
                                        attr="onkeyup=enableSubmit() min=1"
                                    />
                                    <input type="hidden" name="hasil" id="hasil">
                                </form>
                                <div class="flex justify-end mt-5">
                                    <x-button-light
                                        attr="id=button disabled=true onclick=submit()
                                        data-tw-toggle=modal data-tw-target=#input-imt"
                                        color="blue" text="submit"
                                    />
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
                            History Pengukuran IMT
                        </h2>
                    </div>
                    <div class="intro-y col-span-12 mt-5">
                        <div class="intro-y box p-5">
                            {{-- <div class="flex justify-between items-center mb-5">
                                <form action="{{ route('admin.imt') }}">
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}" placeholder="search" aria-describedby="input-group-price">
                                        <button id="input-group-price" class="input-group-text">
                                            <i data-lucide="search" width="18"></i>
                                        </button>
                                    </div>
                                </form>

                                <div class="flex gap-3">
                                    <x-button-light color="blue" text="export pilih tanggal"
                                        attr="data-tw-toggle=modal data-tw-target=#export-date"
                                    />

                                    <form method="POST" action="{{ route('admin.imt.export') }}">
                                        @csrf
                                        <input type="hidden" name="date" value="now">
                                        <x-button-light color="blue" text="export hari ini" />
                                    </form>
                                </div>
                            </div> --}}
                            @if (session('error'))
                                <div class="px-5 py-3 rounded-lg bg-red-500 mb-5 text-white">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div id="export-date" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-5">
                                            <h2 class="text-lg font-medium truncate my-3">Masukkan Tanggal Untuk di Export</h2>
                                            <form id="submit" action="{{ route('admin.imt.export') }}" method="post">
                                                @csrf
                                                <input type="text" name="date" data-daterange="true" class="datepicker form-control w-full block">
                                            </form>

                                            <div class="flex gap-3 justify-center mt-5">
                                                <button class="btn btn-danger w-24" form="submit">Download</button>
                                                <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">No</th>
                                            <th class="whitespace-nowrap">Name</th>
                                            <th class="whitespace-nowrap">Umur</th>
                                            <th class="whitespace-nowrap">Berat Badan</th>
                                            <th class="whitespace-nowrap">Tinggi Badan</th>
                                            <th class="whitespace-nowrap">Tanggal Pengukuran</th>
                                            <th class="whitespace-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($imt as $item)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="whitespace-nowrap">{{ $item->name }}</td>
                                                <td class="whitespace-nowrap">{{ $item->umur }}</td>
                                                <td class="whitespace-nowrap">{{ $item->berat_badan }} KG</td>
                                                <td class="whitespace-nowrap">{{ $item->tinggi_badan }} CM</td>
                                                <td class="whitespace-nowrap">{{ $item->created_at->format('d / m / Y') }}</td>
                                                <td class="whitespace-nowrap">
                                                    <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                        class="bg-red-700 hover:bg-red-500"
                                                        attr="data-tw-toggle=modal data-tw-target=#modalDelImt{{ $item->id }}"
                                                    />
                                                    <div id="modalDelImt{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-5 text-center">
                                                                    <h2 class="text-lg font-medium truncate mt-3">Hapus Rekap Pengukuran?</h2>
                                                                    <div class="flex gap-3 justify-center mt-5">
                                                                        <form action="{{ route('imt.delete', $item->id) }}" method="POST">
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
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="flex link-paginate mt-5 justify-end">
                                    {{ $imt->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="input-imt" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <h2 class="text-lg font-medium truncate mt-3">Skor IMT kamu adalah : <span id="resa"></span></h2>
                    <h2 class="text-base font-medium truncate">Catatan : <span id="resb"></span></h2>

                    <p class="mt-8">Simpan pengukuran IMT?</p>
                    <div class="flex gap-3 justify-center mt-5">
                        <button class="btn btn-danger w-24" type="submit" form="submitimt">Simpan</button>
                        <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        function enableSubmit() {
            let inputs = document.getElementsByClassName('form-control');
            let btn = document.querySelector('#button');
            let isValid = true;

            for (var i = 0; i < inputs.length; i++) {
                let changedInput = inputs[i];
                if (changedInput.value.trim() === "" || changedInput.value === null) {
                    isValid = false;
                    break;
                }
            }
            btn.disabled = !isValid;
        }

        function submit() {
            let hasil = document.getElementById('hasil')
            let resa = document.getElementById('resa')
            let resb = document.getElementById('resb')
            let berat_badan = document.getElementById('berat_badan')
            let tinggi_badan = document.getElementById('tinggi_badan')

            hasil.value = berat_badan.value / ((tinggi_badan.value / 100)*(tinggi_badan.value / 100))
            console.log(Math.round(hasil.value))
            if (hasil.value <= 18.5) {
                resa.innerHTML = Math.round(hasil.value)
                resb.innerHTML = 'Berat Badan Kurang'
            } else if (hasil.value <= 22.9) {
                resa.innerHTML = Math.round(hasil.value)
                resb.innerHTML = 'Berat Badan Normal'
            }  else if (hasil.value <= 29.9) {
                resa.innerHTML = Math.round(hasil.value)
                resb.innerHTML = 'Berat Badan Berlebihan'
            } else {
                resa.innerHTML = Math.round(hasil.value)
                resb.innerHTML = 'Obesitas'
            }
        }
    </script>
@endpush
