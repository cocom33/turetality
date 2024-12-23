@extends('admin.layouts.app')

@section('breadcrumb', 'Tambah Kesehatan Pekerja')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Tambah Data Kesehatan Pekerja
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="worker-health" action="{{ route('admin.worker-health.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <div class="col">
                                            <label class="form-label">Pilih <spam class="text-danger">*</spam> </label>
                                            <select name="user_id" data-placeholder="" class="tom-select w-full">
                                                @forelse ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @empty
                                                    <option disabled>Tidak ada user</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <x-form-input
                                            name="keluhan"
                                            label="Keluhan"
                                        />
                                        <x-form-input
                                            name="hasil_pemeriksaan"
                                            label="Hasil Pemeriksaan"
                                            type="datetime-local"
                                        />
                                        <x-form-input
                                            name="catatan"
                                            label="Catatan"
                                        />
                                        <x-form-input
                                            name="photo"
                                            label="Bukti Keluhan"
                                            type="file"
                                        />
                                        <div class="col">
                                            <label for="recomendation" class="form-label">Tulis Rekomendasi</label>
                                            <textarea id="recomendation" name="recomendation" class="w-full form-control" rows="6" >{{ $item->recomendation ?? '' }}</textarea>
                                        </div>
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
      var now = new Date("{{ date('d F Y H:i') . ' UTC' }}").toISOString().slice(0, 16);


      // Set the minimum date and time for the datetime input to the current date and time
    //   document.getElementById('hasil_pemeriksaan').setAttribute('min', now);
      document.getElementById('hasil_pemeriksaan').setAttribute('value', now);
    </script>
@endpush
