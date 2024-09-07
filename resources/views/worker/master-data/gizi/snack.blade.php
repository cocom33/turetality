@extends('worker.layouts.app')

@section('breadcrumb', 'History Analisis Gizi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    History Analisis Gizi Snack
                </h2>
                <x-button-light color="blue" text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i>Tambah' :link="route('analisis-gizi.snack')" />
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="flex justify-between items-center mb-5">
                        <div></div>

                        {{-- <div class="flex gap-3">
                            <x-button-light color="blue" text="export pilih tanggal"
                                attr="data-tw-toggle=modal data-tw-target=#export-date"
                            />

                            <form method="POST" action="{{ route('admin.history.gizi.export') }}">
                                @csrf
                                <input type="hidden" name="date" value="now">
                                <input type="hidden" name="type" value="snack">
                                <input type="hidden" name="name" value="snack">
                                <x-button-light color="blue" text="export hari ini" />
                            </form>
                        </div> --}}
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
                                    <form id="submit" action="{{ route('admin.history.gizi.export') }}" method="post">
                                        @csrf
                                        <input type="text" name="date" data-daterange="true" class="datepicker form-control w-full block">
                                        <input type="hidden" name="type" value="snack">
                                        <input type="hidden" name="name" value="snack">
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
                                    <th class="whitespace-nowrap">Menu</th>
                                    <th class="whitespace-nowrap">Asal</th>
                                    <th class="whitespace-nowrap">Makanan Datang</th>
                                    <th class="whitespace-nowrap">Photo</th>
                                    <th class="whitespace-nowrap">Catatan</th>
                                    <th class="whitespace-nowrap">Tanggal</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">{{ $item->menu }}</td>
                                        <td class="whitespace-nowrap">{{ $item->asal }}</td>
                                        <td class="whitespace-nowrap">{{ \Carbon\Carbon::create($item->date)->format('d/m/Y H:i:s') }}</td>
                                        <td class="whitespace-nowrap">
                                            @if ($item->photo)
                                                <x-button-light color="blue" text="show"
                                                    attr="data-tw-toggle=modal data-tw-target=#show-photo-{{ $item->id }}"
                                                />
                                                <div id="show-photo-{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-body p-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Photo Pelaporan</h2>
                                                                <div class="mt-5">
                                                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="w-full">
                                                                </div>

                                                                <div class="flex gap-3 justify-end mt-5">
                                                                    <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Back</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-center mx-auto font-bold ps-8">
                                                    --
                                                </span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap">{{ $item->catatan }}</td>
                                        <td class="whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-2">
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    attr="data-tw-toggle=modal data-tw-target=#delete-data-{{ $item->id }}"
                                                />

                                                <x-button-modal type="modal-xl" id="modals{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Menu</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->menu }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Asal</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->asal }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Jam & Tanggal Makanan Datang</h2>
                                                        <h4 class="mt-2 text-base">{{ \Carbon\Carbon::create($item->date)->format('d/m/Y H:i:s') }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Catatan</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->catatan }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Photo</h2>
                                                        @if ($item->photo)
                                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="" class="w-full mt-2">
                                                        @else
                                                        <div class="mt-2 text-base">Tidak ada photo</div>
                                                        @endif
                                                    </div>
                                                    <div class="mt-5 flex justify-end">
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                    </div>
                                                </x-button-modal>
                                            </div>
                                        </td>
                                        <div id="delete-data-{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-5 text-center">
                                                        <h2 class="text-lg font-medium truncate my-3">Hapus Data Ini?</h2>
                                                        <form id="delete-{{ $item->id }}" action="{{ route('admin.history.gizi.delete', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <div class="flex gap-3 justify-center mt-5">
                                                            <button class="btn btn-danger w-24" form="delete-{{ $item->id }}">Hapus</button>
                                                            <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="flex link-paginate mt-5 justify-end">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
