@extends('admin.layouts.app')

@section('breadcrumb', 'Report Temuan')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Report Temuan
                </h2>
                <x-button-light color="blue" text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i> Add' :link="route('admin.reports.create')" />
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="flex justify-between items-center mb-5">
                        <div></div>

                        <div class="flex gap-3">
                            <x-button-light color="blue" text="export pilih tanggal"
                                attr="data-tw-toggle=modal data-tw-target=#export-date"
                            />

                            <form method="POST" action="{{ route('admin.reports.export') }}">
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
                                    <form id="submit" action="{{ route('admin.reports.export') }}" method="post">
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
                                    <th class="whitespace-nowrap">Deskripsi</th>
                                    <th class="whitespace-nowrap">Photo</th>
                                    <th class="whitespace-nowrap">Tanggal Kejadian</th>
                                    <th class="whitespace-nowrap">Unit Kerja</th>
                                    <th class="whitespace-nowrap">Catatan</th>
                                    <th class="whitespace-nowrap">Status</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($report as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->description" /></td>
                                        <td class="whitespace-nowrap">
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
                                        </td>
                                        <td class="whitespace-nowrap">{{ $item->date }}</td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->unit_kerja" /></td>
                                        <td class="whitespace-nowrap"><x-long-text :text="$item->catatan" /></td>
                                        <td class="whitespace-nowrap flex">
                                            @if ($item->status)
                                                <div class="px-4 py-2 rounded bg-green-700 text-white">
                                                    <i data-lucide='check' width='18'></i>
                                                </div>
                                            @else
                                                <div class="px-4 py-2 rounded bg-red-600 text-white">
                                                    <i data-lucide='x' width='18'></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-2">
                                                <x-button-light color="green" text="<i data-lucide='key' width='18'></i>"
                                                    attr="data-tw-toggle=modal data-tw-target=#change-status-{{ $item->id }}"
                                                />
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    class="bg-red-700 hover:bg-red-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalDel{{ $item->id }}"
                                                />
                                                <x-button-modal type="modal-xl" id="modal{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Deskripsi</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->description }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Tanggal Kejadian</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->date }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Unit Kerja</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->unit_kerja }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Catatan</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->catatan }}</h4>
                                                    </div>
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Status</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->status ? 'Selesai' : 'Belum Selesai' }}</h4>
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
                                        </td>
                                        <div id="modalDel{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-5 text-center">
                                                        <h2 class="text-lg font-medium truncate mt-3">Hapus Report Temuan?</h2>
                                                        <div class="flex gap-3 justify-center mt-5">
                                                            <form action="{{ route('admin.reports.delete', $item->id) }}" method="POST">
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
                                         <div id="change-status-{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                             <div class="modal-dialog">
                                                 <div class="modal-content">
                                                     <div class="modal-body p-0">
                                                         <div class="p-5 text-center">
                                                            <i data-lucide="check-circle" class="w-16 h-16 text-success mx-auto mt-3"></i>
                                                             <div class="text-3xl mt-5">Change Status</div>
                                                             <div class="text-slate-500 mt-2">Change status report to selesai</div>
                                                         </div>
                                                         <div class="px-5 pb-8 text-center gap-2">
                                                            <form action="{{ route('admin.reports.change', $item->id) }}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-primary w-24">Ok</button>
                                                            </form>
                                                            <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Cancel</button>
                                                        </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="flex link-paginate mt-5 justify-end">
                            {{ $report->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
