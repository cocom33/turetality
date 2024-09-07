@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis Gizi')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Laporan Snack
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('admin.analisis-gizi.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <input type="hidden" name="type" value="snack">
                                        <x-form-input
                                            name="menu"
                                            label="Menu Makanan"
                                        />
                                        <x-form-input
                                            name="asal"
                                            label="Asal Makanan (dapur sendiri / vendor / lainnya)"
                                        />
                                        <x-form-input
                                            name="photo"
                                            label="Photo Makanan"
                                            type="file"
                                            :required="false"
                                        />
                                        <x-form-input
                                            name="date"
                                            label="Jam & Tanggal Makanan Datang"
                                            type="datetime-local"
                                        />
                                        <x-form-input
                                            name="catatan"
                                            label="Catatan"
                                        />
                                    </div>
                                </form>
                                <div class="flex justify-end mt-5">
                                    <x-button-light
                                        attr="form=analyst"
                                        color="blue" text="submit"
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
    //   document.getElementById('date').setAttribute('min', now);
      document.getElementById('date').setAttribute('value', now);
    </script>
@endpush
