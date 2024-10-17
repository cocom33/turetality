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

            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
                                    <th class="whitespace-nowrap">Nama</th>
                                    <th class="whitespace-nowrap">Nomor</th>
                                    <th class="whitespace-nowrap">Tanggal Ditambahkan</th>
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
                                    </tr>
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

