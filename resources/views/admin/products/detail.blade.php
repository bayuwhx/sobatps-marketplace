@extends('layouts.main')

@section('container')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 p-4 d-flex justify-content-center">
                @if ($product->image)
                    <div style="" class=" mb-lg-0 mb-sm-3">
                        <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->title }}"
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
                        <h6 class="descript mb-3">Kegunaan
                        </h6>
                        <div class="">
                            <p class="description">{{ $product->function }}</p>
                        </div>
                        <div class="row d-flex justify-content-around mt-3">
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
                        </div>
                    </div>
                </div>
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body p-3">
                        <div class="row">
                            @if ($product->user->image)
                                <div class="col-2">
                                    <img src="{{ asset('img/' . $product->user->image) }}"
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
            </div>
        </div>
    </div>
@endsection
