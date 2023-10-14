@extends('layouts.main')

@section('container')
    <div class="container">

        <form action="/purchase/offers" method="GET">
            @csrf
            <div class="row mt-5">
                <div class="col-4 px-0">
                    <h1 class="title mt-3 text-success">Penawaran Berlangsung</h1>
                </div>
                <div class="col-6">
                    <div class="border-bottom border-3 mt-5 border-success"></div>
                </div>

                <div class="col-2 d-flex justify-content-start align-items-center mt-4 p-2">
                    <select class="form-select w-auto rounded-start w-100 mx-1" name="statusFilter">
                        <option value="">Semua Tawaran</option>
                        <option value="pending" {{ $selectedStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accept" {{ $selectedStatus == 'accept' ? 'selected' : '' }}>Diterima</option>
                    </select>
                    <button class="btn btn-success rounded-end" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </form>
        @if (session()->has('successUpdate'))
            <div class="alert alert-success col-lg-4 mx-auto text-center" role="alert">
                {{ session('successUpdate') }}
            </div>
        @endif
    </div>
    <div class="container mt-3">
        @if ($transactions->count())
            <div class="row">
                @foreach ($transactions as $transaction)
                    <div class="col-md-3 mb-3">
                        <div class="card rounded-4 mb-3 shadow border-0 overflow-hidden" style="">
                            @if ($transaction->product->image)
                                <div style="overflow:hidden; width: auto; max-height: 10em">
                                    <img src="{{ asset('storage/' . $transaction->product->image) }}"
                                        alt="{{ $transaction->product->title }}" class="img-fluid rounded-top-4">
                                </div>
                            @else
                                <img src="https://source.unsplash.com/500x400?{{ $transaction->product->category->slug }}"
                                    class="card-img-top rounded-top-4"
                                    alt="{{ $transaction->product->category->category_name }}"
                                    style="overflow: hidden; max-height: 10em">
                            @endif

                            <div class="card-body">
                                <a href="/products?category={{ $transaction->product->category->slug }}"
                                    class="btn btn-outline-success mb-2 py-0 text-decoration-none">{{ $transaction->product->category->category_name }}</a>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title">{{ $transaction->product->title }}
                                        </h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted text-end">{{ $transaction->quantities }} items</p>
                                    </div>

                                </div>
                                <p class="text-muted mb-1">Rp {{ $transaction->product->price }}</p>
                                <h6 class="card-text text-success">Di tawar Rp.
                                    {{ number_format($transaction->price, 2, ',', '.') }}
                                </h6>
                                {{-- <p class="card-text">Jumlah beli {{ $transaction->quantities }} item</p> --}}
                                @if ($transaction->status == 'pending')
                                    <p class="card-text p-1 px-0">Status: <span
                                            class="btn py-0 btn-outline-warning">Menunggu</span>
                                    </p>
                                @elseif ($transaction->status == 'accept')
                                    <p class="card-text p-1 px-0">Status: <span
                                            class="btn py-0 btn-outline-success">Diterima</span>
                                    </p>
                                @elseif ($transaction->status == 'reject')
                                    <p class="card-text p-1 px-0">Status: <span
                                            class="btn py-0 btn-outline-danger">Ditolak</span>
                                    </p>
                                @endif
                                {{-- <p class="card-text">Status Tawaran {{ $transaction->status }}</p> --}}
                                <p class="card-text text-end"><small
                                        class="text-body-secondary text-end">{{ $transaction->updated_at->toFormattedDateString() }}</small>
                                </p>
                                <a href="/purchase/{{ $transaction->id }}"
                                    class="btn btn-success btn-block w-100 rounded-4">Lihat
                                    Tawaran</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@else
    <div class="container d-flex flex-column justify-content-center align-items-center opacity-50" style="height: 30em">
        <img src="/img/aman.png" alt="">
        <h4 class="text-muted text-center">Tidak ada barang yang ditawar</h4>
    </div>
    @endif
    <div class="d-flex justify-content-center">
        {{ $transactions->links() }}
    </div>
@endsection
