@extends('admin.layouts.app')

@section('breadcrumb', 'Admin Create')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center justify-between h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Add Admin
                </h2>
            </div>
            <div class="intro-y box mt-5">
                <div id="boxed-tab" class="p-5">

                        @if (session('success'))
                            <div class="px-6 py-3 text-white bg-green-600 rounded-lg mb-5">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->all())
                            <div class="px-6 py-3 bg-red-500 text-white rounded-lg mb-5">
                                @foreach ($errors->all() as $item)
                                    {{ $item }} <br>
                                @endforeach
                            </div>
                        @endif

                        <div>
                            <form id="worker-health" action="{{ route('admin.admin.store') }}" method="POST">
                                @csrf
                                <div class="flex flex-col gap-4">

                                    <x-form-input
                                        name="name"
                                        label="Nama"
                                    />
                                    <x-form-input
                                        name="email"
                                        label="Email"
                                    />
                                    <x-form-input
                                        name="phone"
                                        label="Phone"
                                        type="number"
                                        :required="false"
                                    />
                                    <x-form-input
                                        name="photo"
                                        label="Photo User"
                                        type="file"
                                        :required="false"
                                    />
                                </div>
                                <div class="flex justify-end mt-5">
                                    <x-button-light text="submit" color="blue" />
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
