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

    <form method="POST" action="/admin/product/{{ $product->slug }}" class="mb-3" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3">
                    {{-- <label for="image" class="form-label">Gambar Produk</label> --}}
                    <input type="hidden" name="oldImage" value="{{ $product->image }}">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                            class="img-preview img-fluid col-sm-6 w-100 img-thumbnail" id="imagePreview"
                            style="display:block">
                    @else
                        <div>
                            <img src="" class="img-preview img-fluid mb-3 col-sm-5 " id="imagePreview"
                                style="max-height: 500px; overflow:hidden">
                        </div>
                    @endif

                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()" style="visibility: hidden">
                    <label for="image" class="btn btn-outline-success btn-block border-0 form-label w-100">Unggah Foto
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
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control rounded-4 @error('title') is-invalid @enderror" id="title"
                        name="title" required autofocus value="{{ old('title', $product->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="source" class="form-label @error('source') is-invalid @enderror">Bahan baku</label>
                    <input type="text" class="form-control rounded-4" id="source" name="source"
                        value="{{ old('source', $product->source) }}">
                    @error('source')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="function" class="form-label @error('function') is-invalid @enderror">Fungsi</label>
                    <input type="text" class="form-control rounded-4" id="function" name="function"
                        value="{{ old('function', $product->function) }}">
                    @error('function')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control rounded-4 @error('price') is-invalid @enderror" id="price"
                        name="price" required value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control rounded-4 @error('stock') is-invalid @enderror" id="stock"
                        name="stock" required value="{{ old('stock', $product->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select rounded-4" name="category_id">
                        @foreach ($categories as $category)
                            @if (old('category_id', $product->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="description" type="hidden" name="description"
                        value="{{ old('description', $product->description) }}">
                    <trix-editor input="description" class="rounded-4"></trix-editor>
                </div>
                <div class="" style="visibility: hidden">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control rounded-4 @error('slug') is-invalid @enderror"
                        id="slug" name="slug" readonly required value="{{ old('slug', $product->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-block btn-lg w-100">Update Produk</button>

            </div>
        </div>
    </form>

    </div>



    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/products/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accpet', function(e) {
            e.preventDefault();
        })

        function previewImage() {
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
