@extends('dashboard.layouts.main')

@section('container')
    <div class="col-lg-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-2 d-flex justify-content-center">
                    {{-- <div id="carouselExampleIndicators" class="carousel slide rounded-3">
                        <div class="carousel-indicators mb-0">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner rounded-3 mb-lg-0 mb-sm-3">
                            <div class="carousel-item active">
                                <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                                    alt="{{ $product->title }}" class="d-block w-100" style="max-height: 100em">
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
                        <div style="max-height:20em; overflow:hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                class="img-fluid rounded-top">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x800?{{ $product->category->category_name }}"
                            alt="{{ $product->title }}" class="img-fluid rounded-top">
                    @endif

                    <div class="card mb-3 border-0 shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->title }}</h3>
                            <button type="category-button"
                                class="btn btn-outline-success p-1 mb-4"href="/categories/{{ $product->category->slug }}">
                                {{ $product->category->category_name }}
                            </button>
                            <h2 class="font-weight-bold">Rp. {{ number_format($product->price, 2, ',', '.') }}
                            </h2>
                            <a href="/dashboard/products" class="btn btn-success"><span data-feather="arrow-left"></span> |
                                Kembali</a>
                            <a href="/dashboard/products/{{ $product->slug }}/edit" class="btn btn-warning"><span
                                    data-feather="edit"></span> | Edit Produk</a>
                            <form action="/dashboard/products/{{ $product->slug }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                                        data-feather="trash-2"></span> | Hapus Produk
                                </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="descript mb-3">Deskripsi Produk
                    </h6>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="description">{!! $product->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
