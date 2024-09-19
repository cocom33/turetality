@extends('worker.layouts.app')

@section('breadcrumb', "History Laporan Tambahan")

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    {{ $title }}
                </h2>
                <div class="flex gap-3 ml-auto mt-5 md:mt-0">
                    <x-button-light color="blue" text='list laporan custom' :link="route('analisis-chse.question-list', 'clean')" />
                </div>
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    @if (session('error'))
                        <div class="px-5 py-3 rounded-lg bg-red-500 mb-5 text-white">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
                                    <th class="whitespace-nowrap">Nama Pertanyaan</th>
                                    <th class="whitespace-nowrap">Total Pertanyaan</th>
                                    <th class="whitespace-nowrap">Tanggal</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">{{ $item->question->name }}</td>
                                        <td class="whitespace-nowrap">{{ $item->question->form->count() }}</td>
                                        <td class="whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-2">
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    attr="data-tw-toggle=modal data-tw-target=#delete-data-{{ $item->id }}"
                                                />
                                                <x-button-modal type="modal-xl" id="modalc{{ $item->id }}" text="<i data-lucide='eye' width='18'></i>" color="blue">
                                                    <div class="mt-5">
                                                        <h2 class="text-lg font-medium truncate mt-3">Pelapor</h2>
                                                        <h4 class="mt-2 text-base">{{ $item->user_id ? $item->user->name : 'Admin' }}</h4>
                                                    </div>
                                                    @foreach ($item->question->form as $ee)
                                                        @if ($ee->type == 'checklist')
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3 mb-2">Checklist</h2>
                                                                <div class="text-base">Pertanyaan : {{ $ee->question }}</div>
                                                                <h4 class="mt-2 text-base">{{ $item->answer->where('question_form_id', $ee->id)->first()->answer ? 'Ada' : 'Tidak Ada' }}</h4>
                                                            </div>
                                                        @elseif ($ee->type == 'image')
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">Photo</h2>
                                                                @if ($item->answer->where('question_form_id', $ee->id)->first()->answer)
                                                                <img src="{{ asset('storage/' . $item->answer->where('question_form_id', $ee->id)->first()->answer) }}" alt="" class="w-full mt-2">
                                                                @else
                                                                <div class="mt-2 text-base">Tidak ada photo</div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="mt-5">
                                                                <h2 class="text-lg font-medium truncate mt-3">{{ $ee->question }}</h2>
                                                                <h4 class="mt-2 text-base">{{ $item->answer->where('question_form_id', $ee->id)->first()->answer }}</h4>
                                                            </div>
                                                        @endif
                                                    @endforeach
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
                                                        <form id="delete-{{ $item->id }}" action="{{ route('history.chse.custom-delete', $item->id) }}" method="post">
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
                                        <td colspan="8" class="text-center">Tidak ada data</td>
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
