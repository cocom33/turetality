@extends('admin.layouts.app')

@section('breadcrumb', 'Admin List')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    List Admin
                </h2>
                <x-button-light color="blue" text='<i data-lucide="x" class="w-18 inline mr-3 rotate-45"></i>Tambah' :link="route('admin.admin.create')" />
            </div>
            <div class="intro-y col-span-12 mt-5">
                <div class="intro-y box p-5">
                    <div class="overflow-x-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No</th>
                                    <th class="whitespace-nowrap">Name</th>
                                    <th class="whitespace-nowrap">Email</th>
                                    <th class="whitespace-nowrap">Phone</th>
                                    <th class="whitespace-nowrap">Photo</th>
                                    <th class="whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admin as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">{{ $item->name }}</td>
                                        <td class="whitespace-nowrap">{{ $item->email }}</td>
                                        <td class="whitespace-nowrap">{{ $item->phone ?? '-' }}</td>
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
                                                <span class="">
                                                    -
                                                </span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <div class="flex gap-2">
                                                <x-button-light color="red" text="<i data-lucide='trash' width='18'></i>"
                                                    class="bg-red-700 hover:bg-red-500"
                                                    attr="data-tw-toggle=modal data-tw-target=#modalDel{{ $item->id }}"
                                                />
                                            </div>
                                            <div id="modalDel{{ $item->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-5 text-center">
                                                            <h2 class="text-lg font-medium truncate mt-3">Hapus Akun Admin?</h2>
                                                            <div class="flex gap-3 justify-center mt-5">
                                                                <form action="{{ route('admin.admin.delete', $item->id) }}" method="POST">
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
                            {{ $admin->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
