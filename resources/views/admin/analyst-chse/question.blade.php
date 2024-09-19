@extends('admin.layouts.app')

@section('breadcrumb', 'Analisis CHSE')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Tambah Pertanyaan
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12">
                            <div class="intro-y box p-5 ">
                                <form id="analyst" action="{{ route('admin.analisis-chse.store-question') }}" method="POST">
                                    @csrf
                                    <div class="flex flex-col gap-4">
                                        <x-form-input
                                            name="name"
                                            label="Nama"
                                            type="text"
                                        />
                                        <div class="mb-2">
                                            <label for="chse" class="form-label">Tipe Analisis <span class="text-danger">*</span></label>
                                            <select class="form-control" name="chse" id="chse">
                                                <option class="hidden"></option>
                                                @foreach (['clean', 'safety', 'health', 'environment'] as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr class="my-3 border-t">
                                        <div id="form">
                                            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-3 items-end mb-3">
                                                <div class="">
                                                    <label for="name" class="form-label">Tipe Pertanyaan <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="type[]" id="type">
                                                        <option class="hidden"></option>
                                                        @foreach (['text', 'long_text', 'date', 'checklist', 'image'] as $item)
                                                            <option value="{{ $item }}">{{ str_replace('_', ' ', $item) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex gap-3 items-end col-span-1 sm:col-span-2 md:col-span-2" id="first">
                                                    <div class="w-full">
                                                        <x-form-input
                                                            name="question[]"
                                                            label="Pertanyaan"
                                                            type="text"
                                                        />
                                                    </div>
                                                    <a onclick="addform()" id="addbutton" class="ml-auto px-5 py-2 shadow rounded text-white bg-blue-700 hover:bg-blue-500 transition-all duration-300 cursor-pointer">Add</a>
                                                </div>
                                            </div>
                                        </div>
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
        var number = 1;
        var parent = document.getElementById('form')
        var button = document.getElementById('addbutton')

        function addform() {
            var para = document.createElement("div")
            para.classList.add("grid", "gap-3", "mb-3", "sm:grid-cols-2", "lg:grid-cols-4")
            para.setAttribute("id", `add${number}`)

            // input 1
            var input1 = document.createElement("div")
            input1.classList.add("col")
            // label
            var input1l = document.createElement("label")
            input1l.classList.add("form-label")
            input1l.appendChild(document.createTextNode("Tipe Pertanyaan"))
            var span1 = document.createElement("span")
            span1.classList.add("text-danger")
            span1.appendChild(document.createTextNode(" *"))
            // form
            var input1i = document.createElement("select")
            input1i.classList.add("form-control")
            input1i.setAttribute("name", "type[]")
            input1i.setAttribute("type", "text")
            input1i.setAttribute("required", true)

            var opt = document.createElement("option")
            opt.classList.add("hidden")
            var opt1 = document.createElement("option")
            opt1.setAttribute("value", "text")
            opt1.appendChild(document.createTextNode("text"))
            var opt2 = document.createElement("option")
            opt2.setAttribute("value", "long_text")
            opt2.appendChild(document.createTextNode("long text"))
            var opt3 = document.createElement("option")
            opt3.setAttribute("value", "date")
            opt3.appendChild(document.createTextNode("date"))
            var opt4 = document.createElement("option")
            opt4.setAttribute("value", "checklist")
            opt4.appendChild(document.createTextNode("checklist"))
            var opt5 = document.createElement("option")
            opt5.setAttribute("value", "image")
            opt5.appendChild(document.createTextNode("image"))

            input1i.appendChild(opt)
            input1i.appendChild(opt1)
            input1i.appendChild(opt2)
            input1i.appendChild(opt3)
            input1i.appendChild(opt4)
            input1i.appendChild(opt5)

            input1.appendChild(input1l)
            input1l.appendChild(span1)
            input1.appendChild(input1i)

            // input 3
            var par3 = document.createElement("div")
            par3.classList.add("flex", "gap-3", "items-end", "col-span-1", "sm:col-span-2", "md:col-span-2")
            //
            var input3 = document.createElement("div")
            input3.classList.add("col")
            //
            var w = document.createElement("div")
            w.classList.add("w-full")
            // label
            var input3l = document.createElement("label")
            input3l.classList.add("form-label")
            input3l.appendChild(document.createTextNode("Pertanyaan"))
            var span3 = document.createElement("span")
            span3.classList.add("text-danger")
            span3.appendChild(document.createTextNode(" *"))
            // form
            var input3i = document.createElement("input")
            input3i.classList.add("form-control")
            input3i.setAttribute("name", "question[]")
            input3i.setAttribute("type", "text")
            input3i.setAttribute("required", true)

            // hr
            var ht = document.createElement("hr")
            ht.classList.add("my-5", "border-t")
            ht.setAttribute("id", `hr${number}`)

            // removebutton
            var remove = document.createElement("a")
            remove.classList.add("ml-auto", "px-5", "py-2", "shadow", "rounded", "text-white", "bg-red-700", "hover:bg-red-500", "transition-all", "duration-300", "cursor-pointer")
            remove.appendChild(document.createTextNode("Remove"));
            remove.setAttribute("onclick", `removebutton("add${number}", "hr${number}")`)

            w.appendChild(input3)
            input3.appendChild(input3l)
            input3l.appendChild(span3)
            input3.appendChild(input3i)

            par3.appendChild(w)
            par3.appendChild(button)
            par3.appendChild(remove)

            para.appendChild(input1)
            para.appendChild(par3)

            try {
                parent.appendChild(ht)
                parent.appendChild(para)
                number++
            } catch (error) {
                alert('terjadi error')
                window.location.reload()
            }
        }

        function removebutton($id, $hr) {
            document.getElementById($id).remove()
            document.getElementById($hr).remove()

            document.getElementById('first').appendChild(button)
        }
    </script>
@endpush
