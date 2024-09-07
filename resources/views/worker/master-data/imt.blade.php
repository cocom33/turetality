@extends('worker.layouts.app')

@section('breadcrumb', 'IMT')

@push('addon-style')
    <style>
        .hasil:hover .detail {
            opacity: 100;
        }
    </style>
@endpush

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-12">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            History Pengukuran IMT
                        </h2>
                    </div>
                    <div class="intro-y col-span-12 mt-5">
                        <div class="intro-y box p-5">
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
                                            <th class="whitespace-nowrap">Skor</th>
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
                                                    <div class="flex items-center gap-3">
                                                        {{ $item->hasil }}
                                                        <div class="hasil border border-black w-4 h-4 text-center rounded-full relative">
                                                            <span class="test absolute text-xs right-1/2 translate-x-1/2">i</span>
                                                            <span class="detail transition-all opacity-0 absolute right-1/2 translate-x-1/2 -top-9 bg-slate-500 px-3 py-1 rounded-md text-white">
                                                                @if ($item->hasil <= 18.5)
                                                                    Berat Badan Kurang
                                                                @elseif ($item->hasil <= 22.9)
                                                                    Berat Badan Normal
                                                                @elseif ($item->hasil <= 29.9)
                                                                    Berat Badan Berlebihan
                                                                @else
                                                                    Obesitas
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
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
