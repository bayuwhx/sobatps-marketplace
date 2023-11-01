@extends('layouts.main')

@section('container')
    <div class="container-fluid g-0 border-0">
        @if ($products->count())
    </div>
    <div class="container">
        <div class="row ml-3 mb-4">
            <div class="col-lg-4 px-0 mt-4">
                <h1 class="container-fluid text-success tittle mt-5 mx-0 fs-2 px-2">{{ $title }}</h1>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="border-bottom border-3 border-success mt-5 px-0"></div>
            </div>
            <div class="col-2 px-0 mt-3 mb-3 px-4">
                <div class="container px-2">

                    <a href="/admin/product/create"
                        class="btn w-100 btn-outline-success p-0 btn-lg border-2 btn-block col-lg-2 mt-5">
                        <div class="row px-3">
                            <div class="col-4 p-2 d-flex justify-content-center align-items-center">
                                <h2 class="pb-0 mb-0"><i class="bi w-100 bi-lg bi-plus-circle-fill"></i></h2>
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-center px-0">
                                <p class="mb-0">Tambah Produk</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @if (session()->has('createProduct'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('createProduct') }}
                </div>
            @elseif(session()->has('successDelete'))
                <div class="alert alert-danger col-lg-4 text-center" role="alert">
                    {{ session('successDelete') }}
                </div>
            @elseif(session()->has('successUpdate'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('successUpdate') }}
                </div>
            @elseif(session()->has('createTransaction'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('createTransaction') }}
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-3">
                    <div class="card rounded-4 mb-3 shadow border-0 overflow-hidden" style="">
                        @if ($product->image)
                            <div style="overflow:hidden; width: auto; max-height: 10em">
                                <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="img-fluid rounded-top-4">
                            </div>
                        @else
                            <img src="https://source.unsplash.com/500x400?{{ $product->category->category_name }}"
                                class="card-img-top rounded-top-4" alt="{{ $product->category->category_name }}"
                                style="overflow: hidden; max-height: 10em">
                        @endif

                        <div class="card-body">
                            <a href="/products?category={{ $product->category->slug }}"
                                class="btn btn-outline-success mb-3 py-0">{{ $product->category->category_name }}</a>
                            <a href="/products/{{ $product->slug }}" class="text-black text-decoration-none">
                                <h5 class="card-title">{{ $product->title }}</h5>
                            </a>
                            <p class="card-text">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <p class="card-text">{{ Str::limit($product->excerpt, 65, '...') }}</p>
                            <p class="card-text text-end"><small
                                    class="text-body-secondary text-end">{{ $product->created_at->toFormattedDateString() }}</small>
                            </p>
                            <a href="/admin/product/{{ $product->slug }}"
                                class="btn btn-success btn-block w-100 rounded-4">Lihat
                                produk</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="container">

        <div class="row ml-3 mb-4">
            <div class="col-lg-2 px-0 mt-4">
                <h1 class="container-fluid text-success tittle mt-5 fs-2 px-2">{{ $title }}</h1>
            </div>
            <div class="col-lg-8 mt-5">
                <div class="border-bottom border-3 border-success mt-5"></div>
            </div>
            <div class="col-2 px-0 mt-3 mb-3 px-4">
                <div class="container px-2">
                    <a href="/admin/product/create"
                        class="btn w-100 btn-outline-success p-0 btn-lg border-2 btn-block col-lg-2 mt-5">
                        <div class="row px-3">
                            <div class="col-4 p-2 d-flex justify-content-center align-items-center">
                                <h2 class="pb-0 mb-0"><i class="bi w-100 bi-lg bi-plus-circle-fill"></i></h2>
                            </div>
                            <div class="col-8 d-flex flex-column justify-content-center px-0">
                                <p class="mb-0">Tambah Produk</p>
                            </div>
                        </div>
                    </a>

                </div>

            </div>
            <div class="container d-flex flex-column justify-content-center align-items-center opacity-50"
                style="height: 30em">
                <img src="/img/empty-cart.png" alt="" width="40%">
                <h4 class="text-muted text-center">Belum produk dipasarkan</h4>
            </div>
        </div>


        <div class="row justify-content-center">
            @if (session()->has('createProduct'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('createProduct') }}
                </div>
            @elseif(session()->has('successDelete'))
                <div class="alert alert-danger col-lg-4 text-center" role="alert">
                    {{ session('successDelete') }}
                </div>
            @elseif(session()->has('successUpdate'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('successUpdate') }}
                </div>
            @elseif(session()->has('createTransaction'))
                <div class="alert alert-success col-lg-4 text-center" role="alert">
                    {{ session('createTransaction') }}
                </div>
            @endif
        </div>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection
