@extends('admin.layouts.app')

@section('breadcrumb', 'Call Center')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-12">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    List Call Center
                </h2>
                <x-button-light text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i>Tambah'
                    class="bg-blue-700 hover:bg-blue-500"
                    attr="data-tw-toggle=modal data-tw-target=#tambahdata"
                />
            </div>
            <div id="tambahdata" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-5">
                            <h2 class="text-lg font-medium text-center truncate mt-3">Tambah Panggilan Baru</h2>
                            <form id="submit" action="{{ route('admin.call-center.store') }}" class="my-5" method="POST">
                                @csrf
                                <x-form-input
                                    name="name"
                                    label="Name"
                                />
                                <br >
                                <x-form-input
                                    name="phone"
                                    label="Phone"
                                />
                            </form>
                            <div class="flex gap-3 justify-center">
                                <button form="submit" class="btn btn-primary w-24">Submit</button>
                                <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="px-6 py-3 text-white bg-green-600 rounded-lg mt-5">
                    {{ session('success') }}
                </div>
            @endif
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
                                    <th class="whitespace-nowrap">Nama</th>
                                    <th class="whitespace-nowrap">Phone</th>
                                    <th class="whitespace-nowrap">Tanggal Ditambahkan</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($call as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">{{ $item->name }}</td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-3">
                                                <span class="copyable" id="div{{ $item->id }}">{{ $item->phone }}</span>
                                                <button onclick="copyText('div{{ $item->id }}')">Copy</button>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap">{{ $item->created_at }}</td>
                                        <td>
                                            <div class="flex gap-3 items-center ml-auto mt-5 md:mt-0">
                                                <x-button-light color="green" text="<i data-lucide='pencil' width='18'></i>"
                                                    class="bg-green-700 hover:bg-green-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalEdit{{ $item->id }}"
                                                />
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    class="bg-red-700 hover:bg-red-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalDel{{ $item->id }}"
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                    <div id="modalDel{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-5 text-center">
                                                    <h2 class="text-lg font-medium truncate mt-3">Hapus Data Panggilan?</h2>
                                                    <div class="flex gap-3 justify-center mt-5">
                                                        <form action="{{ route('admin.call-center.delete', $item->id) }}" method="POST">
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
                                    <div id="modalEdit{{ $item->id }}" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body p-5">
                                                    <h2 class="text-lg font-medium text-center truncate mt-3">Edit Panggilan</h2>
                                                    <form id="edit{{ $item->id }}" action="{{ route('admin.call-center.update', $item->id) }}" class="my-5" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-form-input
                                                            name="name"
                                                            label="Name"
                                                            value="{{ $item->name }}"
                                                        />
                                                        <br >
                                                        <x-form-input
                                                            name="phone"
                                                            label="Phone"
                                                            value="{{ $item->phone }}"
                                                        />
                                                    </form>
                                                    <div class="flex gap-3 justify-center">
                                                        <button form="edit{{ $item->id }}" class="btn btn-primary w-24">Submit</button>
                                                        <button type="button" data-tw-dismiss="modal" class="btn btn-danger w-24">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        function copyText(divId) {
            var textToCopy = document.getElementById(divId).innerText;

            var textarea = document.createElement('textarea');
            textarea.value = textToCopy;
            document.body.appendChild(textarea);

            textarea.select();
            textarea.setSelectionRange(0, 99999);

            try {
                document.execCommand('copy');
                alert('nomor berhasil disalin');
            } catch (err) {
                // console.error('Failed to copy text', err);
            }

            document.body.removeChild(textarea);
        }
    </script>
@endpush
