@extends('admin.layouts.app')

@section('breadcrumb', 'User Create')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Tambah Data Pekerja
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                @php
                                    $route = route('admin.users.store');
                                    if (isset($user)) {
                                        $route = route('admin.users.update', $user->id);
                                    }
                                @endphp
                                <form id="worker-health" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($user))
                                        @method('PUT')
                                    @endif
                                    <div class="flex flex-col gap-4">
                                        @if ($errors->all())
                                            <div class="px-5 py-3 bg-red-500 text-white rounded-lg">
                                                @foreach ($errors->all() as $item)
                                                    {{ $item }} <br>
                                                @endforeach
                                            </div>
                                        @endif
                                        <x-form-input
                                            name="name"
                                            label="Nama"
                                            value="{{ $user->name ?? '' }}"
                                        />
                                        <x-form-input
                                            name="email"
                                            label="Email"
                                            value="{{ $user->email ?? '' }}"
                                        />
                                        @if (!isset($user))
                                        <span>default password adalah : secret123</span>
                                        @endif
                                        <div class="">
                                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender" class="form-select">
                                                <option value="{{ $user->gender ?? '' }}" class="hidden">{{ $user->gender ?? '' }}</option>
                                                <option value="pria">Pria</option>
                                                <option value="wanita">Wanita</option>
                                            </select>
                                        </div>
                                        <x-form-input
                                            name="umur"
                                            label="Umur"
                                            type="number"
                                            :required="false"
                                            value="{{ $user->umur ?? '' }}"
                                        />
                                        <x-form-input
                                            name="phone"
                                            label="Phone"
                                            type="number"
                                            :required="false"
                                            value="{{ $user->phone ?? '' }}"
                                        />
                                        <x-form-input
                                            name="tanggal_lahir"
                                            label="Tanggal Lahir"
                                            type="date"
                                            :required="false"
                                            value="{{ $user->tanggal_lahir ?? '' }}"
                                        />
                                        <x-form-input
                                            name="alamat"
                                            label="Alamat"
                                            :required="false"
                                            value="{{ $user->alamat ?? '' }}"
                                        />
                                        <x-form-input
                                            name="ttd"
                                            label="Photo Tanda Tangan"
                                            type="file"
                                            :required="false"
                                        />
                                        <x-form-input
                                            name="photo"
                                            label="Photo User"
                                            type="file"
                                            :required="false"
                                        />
                                    </div>
                                </form>
                                <div class="flex justify-end mt-5">
                                    <x-button-light color="blue" text="submit"
                                        attr="form=worker-health"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
      // Get the current date and time in the format YYYY-MM-DDThh:mm (local time)
      var now = new Date().toISOString().slice(0, 16);

      // Set the minimum date and time for the datetime input to the current date and time
      document.getElementById('hasil_pemeriksaan').setAttribute('min', now);
      document.getElementById('hasil_pemeriksaan').setAttribute('value', now);
    </script>
@endpush
