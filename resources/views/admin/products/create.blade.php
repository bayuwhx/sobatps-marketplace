@extends('admin.layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-8">
            <div
                class="d-flex justify-content-between text-success flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-4 border-bottom">
                <h1 class="h2">Buat produk baru</h1>
            </div>
        </div>
    </div>


    <form method="POST" action="/admin/product" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3 d-flex flex-column">
                    {{-- Preview Image #1 --}}
                    <img src="" class="img-preview img-fluid mb-1 w-100 img-thumbnail" id="imagePreview"
                        style="display:block; height:25em ">

                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()" style="visibility: hidden">
                    <label for="image" class="btn btn-outline-success btn-block border-0 form-label">Unggah Foto
                        Produk</label>

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-8">
                <div class="mb-3">
                    <label for="title" class="form-label @error('title') is-invalid @enderror">Nama produk</label>
                    <input type="text" class="form-control rounded-4" id="title" name="title" required autofocus
                        value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="source" class="form-label @error('source') is-invalid @enderror">Bahan baku</label>
                    <input type="text" class="form-control rounded-4" id="source" name="source"
                        value="{{ old('source') }}">
                    @error('source')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="function" class="form-label @error('function') is-invalid @enderror">Fungsi</label>
                    <input type="text" class="form-control rounded-4" id="function" name="function"
                        value="{{ old('function') }}">
                    @error('function')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label @error('price') is-invalid @enderror">Harga</label>
                    <input type="number" class="form-control rounded-4" id="price" name="price" required
                        value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label @error('stock') is-invalid @enderror">Stok produk</label>
                    <input type="number" class="form-control rounded-4" id="stock" name="stock" required
                        value="{{ old('stock') }}">
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori produk</label>
                    <select class="form-select rounded-4" name="category_id">
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label ">Deskripsi</label>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="description" type="hidden" name="description" required value="{{ old('description') }}">
                    <trix-editor input="description" class="form-control align-items-start rounded-4"></trix-editor>
                </div>

                <div class="" style="visibility: hidden">
                    <label for="slug" class="form-label @error('slug') is-invalid @enderror">Slug</label>
                    <input type="text" class="form-control rounded-4" id="slug" name="slug" required
                        value="{{ old('slug') }}" readonly>
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block w-100 mt-3 mb-5">Buat produk</button>

            </div>
        </div>

    </form>



    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/admin/product/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
