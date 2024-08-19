@extends('worker.layouts.app')

@section('breadcrumb', 'Kesehatan Pekerja')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Worker Health
                </h2>
                <x-button-light color="blue" text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i> Add' :link="route('worker-health.create')" />
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
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
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->keluhan" /></td>
                                        <td class="whitespace-nowrap">{{ $item->hasil_pemeriksaan }}</td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->catatan" /></td>
                                        <td class="whitespace-nowrap">
                                            @if ($item->recomendation)
                                                <x-button-light color="blue" text="<i data-lucide='check' width='18'></i>" />
                                            @else
                                                <x-button-light color="red" text="<i data-lucide='x' width='18'></i>" />
                                            @endif
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
                                                        <h4 class="mt-2 text-base">{{ $item->tanggal_pemeriksaan }}</h4>
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
                                            <div id="modalDel{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5 text-center">
                                                            <h2 class="text-lg font-medium truncate mt-3">Hapus Keluhan?</h2>
                                                            <div class="flex gap-3 justify-center mt-5">
                                                                <form action="{{ route('worker-health.delete', $item->id) }}" method="POST">
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
