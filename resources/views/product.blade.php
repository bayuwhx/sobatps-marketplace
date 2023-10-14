@extends('layouts.main')

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
                    <div style="" class=" mb-lg-0 mb-sm-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                            class="img-fluid rounded-4">
                    </div>
                @else
                    <div class="mb-lg-0 mb-sm-3">
                        <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                            alt="{{ $product->title }}" class="img-fluid rounded-4">
                    </div>
                @endif
            </div>
            <div class="col-lg-6 m-auto p-4">
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body p-4">
                        <h3 class="card-title">{{ $product->title }}</h3>
                        <div class="row border-bottom border-3 mb-4">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <button type="category-button"
                                    class="btn btn-outline-success btn-lg mt-3 p-1 mb-4"href="/categories/{{ $product->category->slug }}">
                                    {{ $product->category->category_name }}
                                </button>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <h2 class="font-weight-bold text-end">Rp. {{ number_format($product->price, 0, ',', '.') }}
                                </h2>
                            </div>
                        </div>

                        <h6 class="descript mb-3">Deskripsi Produk
                        </h6>
                        <div class="">
                            <p class="description">{!! $product->description !!}</p>
                        </div>
                        <h6 class="descript mb-3">Sumber Produk
                        </h6>
                        <div class="">
                            <p class="description">{{ $product->source }}</p>
                        </div>
                        <h6 class="descript mb-3">Manfaat
                        </h6>
                        <div class="">
                            <p class="description">{{ $product->function }}</p>
                        </div>

                        <div class="row d-flex justify-content-around mt-3">
                            @auth
                                @if (auth()->user()->isAdmin)
                                    {{-- <a href="/products" class="btn btn-success"><i class="bi bi-arrow-left-circle"></i> |
                                        Kembali</a> --}}
                                    <div class="col-6">
                                        <a href="/admin/product/{{ $product->slug }}/edit"
                                            class="btn btn-warning btn-block w-100 btn-lg"><i class="bi bi-pencil-square"></i> |
                                            Edit
                                            Produk</a>
                                    </div>
                                    <div class="col-6">
                                        <form action="/admin/product/{{ $product->slug }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-block w-100 btn-lg"
                                                onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> | Hapus
                                                Produk
                                            </button>
                                    </div>
                                @else
                                    <a href="/purchase/product/{{ $product->slug }}" class="btn btn-success w-100"><i
                                            class="bi bi-bag-plus"></i>
                                        | Beli Produk</a>
                                @endif
                            @else
                                <a href="/purchase/product/{{ $product->slug }}" class="btn btn-success w-100"><i
                                        class="bi bi-bag-plus"></i>
                                    | Beli Produk</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body p-3">
                        <div class="row">
                            @if ($product->user->image)
                                <div class="col-2">
                                    <img src="{{ asset('storage/' . $product->user->image) }}"
                                        alt="{{ $product->user->name }}" class="img-fluid rounded-4">
                                </div>
                            @else
                                <div class="col-2">
                                    <img src="https://source.unsplash.com/1200x800?profile"
                                        alt="{{ $product->user->name }}" class="img-fluid rounded-4">
                                </div>
                            @endif

                            <div class="col">
                                <h6 class="card-text">{{ $product->user->name }}</h6>
                                <p class="card-text text-body-secondary"><small>{{ $product->user->city }}</small></p>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- <h6 class="descript mb-3">Deskripsi Produk
                </h6>
                <div class="card">
                    <div class="card-body">
                        <p class="description">{!! $product->description !!}</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
