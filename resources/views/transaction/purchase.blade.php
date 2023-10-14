@extends('layouts.purchase')

@section('container')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 p-4 d-flex justify-content-center">
                {{-- <div id="carouselExampleIndicators" class="carousel slide rounded-3">
                    <div class="carousel-indicators mb-0">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner rounded-3 mb-lg-0 mb-sm-3">
                        <div class="carousel-item active">
                            <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                                alt="{{ $product->title }}" class="d-block w-100" style="max-height: 100%">
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                                alt="{{ $product->title }}" class="d-block w-100" style="max-height: 380em">
                        </div>
                        <div class="carousel-item">
                            <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                                alt="{{ $product->title }}" class="d-block w-100" style="max-height: 380em">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div> --}}
                @if ($product->image)
                    <div style="max-height:20em;" class="rounded-3 mb-lg-0 mb-sm-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                            class="img-fluid rounded-top">
                    </div>
                @else
                    <div class="rounded-3 mb-lg-0 mb-sm-3">
                        <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                            alt="{{ $product->title }}" class="img-fluid rounded-top">
                    </div>
                @endif
            </div>
            <div class="col-lg-6 m-auto p-4">
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body p-3">
                        <h3 class="card-title p-1">{{ $product->title }}</h3>
                        <div class="row p-1 pb-0">
                            <div class="col-6">
                                <button type="category-button"
                                    class="btn btn-lg btn-outline-success p-1 mb-4"href="/categories/{{ $product->category->slug }}">
                                    {{ $product->category->category_name }}
                                </button>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <h2 class="font-weight-bold">Rp. {{ number_format($product->price, 2, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="border-bottom border-2 mb-3"></div>

                        <div class="container p-1">
                            <h6 class="descript mb-3">Deskripsi Produk
                            </h6>
                            <p class="description">{!! $product->description !!}</p>
                        </div>




                    </div>
                </div>
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body">
                        <h3 class="mb-4">Detail Pembelian Produk</h3>
                        <form method="POST" action="/purchase" class="mb-3" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                            <input type="hidden" value="{{ $product->user_id }}" name="seller_id" id="seller_id">
                            <div class="mb-3">
                                <label for="quantities" class="form-label">Jumlah Pembelian</label>
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <span class="input-group-text" id="quantities"><i
                                                    class="bi bi-bag-plus"></i></span>
                                            <input type="number"
                                                class="form-control @error('quantities') is-invalid @enderror"
                                                placeholder="Jumlah barang" id="quantities" name="quantities" required
                                                autofocus value="{{ old('quantities') }}">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span id="quantities" class="form-text">Item
                                        </span>
                                    </div>
                                </div>
                                @error('quantities')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Tawar Harga</label>
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <span class="input-group-text" id="addon-wrapping">Rp</span>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Tawar harga" id="price" name="price" required
                                                value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <span id="price" class="form-text">
                                            / Item
                                        </span>
                                    </div>
                                </div>
                                @error('quantities')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" required autofocus
                                    value="{{ old('title', $product->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <button type="sumbit" class="btn btn-success w-100 font-weight-bold mt-3 mb-0 rounded-4">Ajukan
                                Penawaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
