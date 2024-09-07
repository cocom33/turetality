@extends('admin.layouts.app')

@section('breadcrumb', 'Kesehatan Pekerja')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Kesehatan Pekerja
                </h2>
                <x-button-light color="blue" text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i>Tambah' :link="route('admin.worker-health.create')" />
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="flex justify-between items-center mb-5">
                        <form action="{{ route('admin.imt') }}">
                            {{-- <div class="input-group mt-2">
                                <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}" placeholder="search" aria-describedby="input-group-price">
                                <button id="input-group-price" class="input-group-text">
                                    <i data-lucide="search" width="18"></i>
                                </button>
                            </div> --}}
                        </form>

                        <div class="flex gap-3">
                            <x-button-light color="blue" text="export pilih tanggal"
                                attr="data-tw-toggle=modal data-tw-target=#export-date"
                            />

                            <form method="POST" action="{{ route('admin.worker-health.export') }}">
                                @csrf
                                <input type="hidden" name="date" value="now">
                                <x-button-light color="blue" text="export hari ini" />
                            </form>
                        </div>
                    </div>
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
                                    <form id="submit" action="{{ route('admin.worker-health.export') }}" method="post">
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
                    @if (session('success'))
                        <div class="px-6 py-3 mb-3 text-white bg-green-600 rounded-lg mt-5">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
                                    <th class="whitespace-nowrap">Nama</th>
                                    <th class="whitespace-nowrap">Keluhan</th>
                                    <th class="whitespace-nowrap">Tanggal Pemeriksaan</th>
                                    <th class="whitespace-nowrap">Catatan</th>
                                    <th class="whitespace-nowrap">Rekomendasi</th>
                                    <th class="whitespace-nowrap">Bukti Keluhan</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">{{ $item->user->name }}</td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->keluhan" /></td>
                                        <td class="whitespace-nowrap">{{ $item->hasil_pemeriksaan }}</td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->catatan" /></td>
                                        <td class="whitespace-nowrap">
                                            <x-long-text :text="$item->recomendation ?? 'tidak ada rekomendasi'" />
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <x-button-light color="blue" text="show"
                                                attr="data-tw-toggle=modal data-tw-target=#modal{{ $item->id }}"
                                            />
                                            <div id="modal{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5">
                                                            <h2 class="text-lg font-medium truncate mt-3">Photo Bukti Keluhan</h2>
                                                            <div class="mt-5 rounded overflow-hidden">
                                                                <img src="{{ asset('storage' . $item->photo) }}" alt="" class="w-full">
                                                            </div>

                                                            <div class="flex gap-3 justify-end mt-5">
                                                                <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-2">
                                                <x-button-light color="green" text="<i data-lucide='pencil' width='18'></i>"
                                                    class="bg-green-700 hover:bg-green-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalRec{{ $item->id }}"
                                                />
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    class="bg-red-700 hover:bg-red-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalDel{{ $item->id }}"
                                                />
                                                <x-button-modal type="modal-xl" id="modalwh{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Nama</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->user->name }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Keluhan</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->keluhan }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Tanggal Pemeriksaan</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->hasil_pemeriksaan }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Catatan</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->catatan }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Rekomendasi</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->recomendation ?? '-' }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Photo</h2>
                                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="w-full mt-2">
                                                    </div>
                                                    <div class="mt-5 flex justify-end">
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                    </div>
                                                </x-button-modal>
                                            </div>
                                            <div id="modalRec{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5 text-center">
                                                            <h2 class="text-lg font-medium truncate mt-3">Tambahkan Rekomendasi</h2>
                                                            <form id="rec{{ $item->id }}" action="{{ route('admin.worker-health.recomendation', $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mt-3">
                                                                    <textarea name="recomendation" class="w-full form-control" rows="10" >{{ $item->recomendation ?? '' }}</textarea>
                                                                </div>
                                                            </form>
                                                            <div class="flex gap-3 justify-center mt-5">
                                                                <button type="submit" form="rec{{ $item->id }}" class="btn btn-danger w-24">Submit</button>
                                                                <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="modalDel{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5 text-center">
                                                            <h2 class="text-lg font-medium truncate mt-3">Hapus Keluhan?</h2>
                                                            <div class="flex gap-3 justify-center mt-5">
                                                                <form action="{{ route('admin.worker-health.delete', $item->id) }}" method="POST">
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
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="flex link-paginate mt-5 justify-end">
                            {{ $user->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
