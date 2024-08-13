@extends('worker.layouts.app')

@section('breadcrumb', 'Call Center')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-12">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    List Call Center
                </h2>
            </div>
            @forelse ($call as $item)
                <div class="p-6 rounded-lg bg-white shadow-md flex mt-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full">
                        <div class="flex items-center gap-5 mr-auto">
                            {{-- <i data-lucide="home"></i> --}}
                            <div>
                                <div class="text-sm text-slate-900">testing</div>
                                <div class="text-xl font-semibold leading-8">{{ $item->name }}</div>
                            </div>
                        </div>
                        <div class="flex gap-3 items-center ml-auto mt-5 md:mt-0">
                            <x-button-modal type="modal-lg" id="modalcc{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                <div class="mt-5">
                                    <h2 class="text-lg font-medium truncate mt-3">Name</h2>
                                    <h4 class="mt-2 text-base">{{ $item->name }}</h4>
                                </div>
                                <hr class="my-3 border-t">
                                @foreach ($item->details as $detail)
                                    <div class="mt-5">
                                        <h2 class="text-lg font-medium truncate mt-3 mb-2">Type Panggilan</h2>
                                        <h4 class="mt-2 text-base">{{ $detail->type }}</h4>
                                    </div>
                                    <div class="mt-5">
                                        <h2 class="text-lg font-medium truncate mt-3">Nama Penerima</h2>
                                        <h4 class="mt-2 text-base">{{ $detail->name ?? '-' }}</h4>
                                    </div>
                                    <div class="mt-5">
                                        <h2 class="text-lg font-medium truncate mt-3">Nomor</h2>
                                        <div class="flex gap-5">
                                            <h4 class="mt-2 text-base" id="div{{ $detail->id }}" class="copyable">{{ $detail->number }}</h4>
                                            <button onclick="copyText('div{{ $detail->id }}')">Copy</button>
                                        </div>
                                    </div>
                                    <hr class="my-3 border-t">
                                @endforeach
                                <div class="mt-5 flex justify-end">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-primary w-24">Kembali</button>
                                </div>
                            </x-button-modal>
                        </div>
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
                    </div>
                </div>
            @empty
                <div class="p-6 rounded-lg bg-white shadow-md flex mt-4">
                    <div class="flex gap-5 items-center w-full">
                        <div class="text-center w-full text-lg">Tidak ada data</div>
                    </div>
                </div>
            @endforelse
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
                alert('Text berhasil dicopy');
            } catch (err) {
                // console.error('Failed to copy text', err);
            }

            document.body.removeChild(textarea);
        }
    </script>
@endpush

