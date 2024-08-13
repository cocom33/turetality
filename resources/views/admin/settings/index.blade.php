@extends('admin.layouts.app')

@section('breadcrumb', 'Update Data & Password')

@section('content')
    <div class="intro-y box mt-5">
        <div id="boxed-tab" class="p-5">
            <div class="preview">
                <ul class="nav nav-boxed-tabs" role="tablist">
                    <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true" > Change Data </button>
                    </li>
                    <li id="example-4-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false" > Change Password </button>
                    </li>
                </ul>

                @if (session('success'))
                    <div class="px-6 py-3 text-white bg-green-600 rounded-lg mt-5">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->all())
                    <div class="px-6 py-3 bg-red-500 text-white rounded-lg mt-5">
                        @foreach ($errors->all() as $item)
                            {{ $item }} <br>
                        @endforeach
                    </div>
                @endif

                <div class="tab-content mt-5">
                    <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">
                        <form id="worker-health" action="{{ route('admin.setting.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="flex flex-col gap-4">
                                <x-form-input
                                    name="name"
                                    label="Nama"
                                    value="{{ auth()->user()->name ?? '' }}"
                                />
                                <x-form-input
                                    name="email"
                                    label="Email"
                                    value="{{ auth()->user()->email ?? '' }}"
                                />
                                <x-form-input
                                    name="phone"
                                    label="Phone"
                                    type="number"
                                    :required="false"
                                    value="{{ auth()->user()->phone ?? '' }}"
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
                    <div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">
                        <form id="worker-health" action="{{ route('admin.setting.password', auth()->user()->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="flex flex-col gap-4">

                                <x-form-input
                                    name="old_password"
                                    label="Password Lama"
                                    type="password"
                                />
                                <x-form-input
                                    name="password"
                                    label="Password Baru"
                                    type="password"
                                />
                                <x-form-input
                                    name="password_confirmation"
                                    label="Konfirmasi Password"
                                    type="password"
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
