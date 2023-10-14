@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produk dari, {{ Auth::user()->name }}</h1>
    </div>
    @if (session()->has('createProduct'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('createProduct') }}
        </div>
    @elseif(session()->has('successDelete'))
        <div class="alert alert-danger col-lg-8" role="alert">
            {{ session('successDelete') }}
        </div>
    @elseif(session()->has('successUpdate'))
        <div class="alert alert-success col-lg-8" role="alert">
            {{ session('successUpdate') }}
        </div>
    @endif
    <div class="table-responsive col-lg">
        <a href="/dashboard/products/create" class="btn btn-primary mb-3">Create new product</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->title }}</td>
                        <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td class="align-items-center">
                            <a href="/dashboard/products/{{ $product->slug }}" class="badge bg-info"> <span
                                    data-feather="eye" class="align-text-bottom"></span></a>
                            <a href="/dashboard/products/{{ $product->slug }}/edit" class="badge bg-warning"> <span
                                    data-feather="edit" class="align-text-bottom"></span></a>
                            <form action="/dashboard/products/{{ $product->slug }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                                        data-feather="trash-2"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
