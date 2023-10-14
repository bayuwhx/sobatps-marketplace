@extends('layouts.purchase')

@section('container')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 p-4">
                @if ($transaction->product->image)
                    <div style="" class="rounded-3 mb-lg-0 mb-sm-3">
                        <img src="{{ asset('storage/' . $transaction->product->image) }}"
                            alt="{{ $transaction->product->title }}" class="img-fluid rounded-4">
                    </div>
                @else
                    <div class="rounded-3 mb-lg-0 mb-sm-3">
                        <img src="https://source.unsplash.com/1200x800?{{ $transaction->product->category->slug }}"
                            alt="{{ $transaction->product->title }}" class="img-fluid rounded-4">
                    </div>
                @endif
                {{-- @if (auth()->user()->isAdmin)
                    <a href="/purchase" class="btn btn-success mt-3"><i class="bi bi-arrow-left-circle"></i> |
                        Kembali</a>
                @else
                    <a href="/purchase/offers" class="btn btn-success mt-3"><i class="bi bi-arrow-left-circle"></i> |
                        Kembali</a>
                @endif --}}

            </div>
            <div class="col-lg-6 m-auto p-4">
                <div class="card mb-3 border-0 rounded-4 shadow-lg">
                    <div class="card-body p-4">
                        <h3 class="card-title">{{ $transaction->product->title }}</h3>
                        <div class="row border-bottom border-3 mb-4">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <button type="category-button"
                                    class="btn btn-outline-success mt-3 p-1 py-0 mb-4"href="/categories/{{ $transaction->product->category->slug }}">
                                    {{ $transaction->product->category->category_name }}
                                </button>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <h4 class="font-weight-bold text-end">Rp.
                                    {{ number_format($transaction->product->price, 0, ',', '.') }}
                                </h4>
                            </div>
                        </div>

                        <h6 class="descript mb-3">Deskripsi Produk
                        </h6>
                        <div class="">
                            <p class="description">{!! $transaction->product->description !!}</p>
                        </div>

                        {{-- <div class="row d-flex justify-content-around mt-3">
                            @auth
                                @if (auth()->user()->isAdmin)
                                    <a href="/products" class="btn btn-success"><i class="bi bi-arrow-left-circle"></i> |
                                        Kembali</a>
                                    <div class="col-6">
                                        <a href="/admin/product/{{ $transaction->product->slug }}/edit"
                                            class="btn btn-warning btn-block w-100 btn-lg"><i class="bi bi-pencil-square"></i> |
                                            Edit
                                            Produk</a>
                                    </div>
                                    <div class="col-6">
                                        <form action="/admin/product/{{ $transaction->product->slug }}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-block w-100 btn-lg"
                                                onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i> | Hapus
                                                Produk
                                            </button>
                                    </div>
                                @else
                                    <a href="/product/purchase/{{ $transaction->product->slug }}"
                                        class="btn btn-success w-100"><i class="bi bi-bag-plus"></i>
                                        | Beli Produk</a>
                                @endif
                            @else
                                <a href="/purchase/{{ $transaction->product->slug }}" class="btn btn-success w-100"><i
                                        class="bi bi-bag-plus"></i>
                                    | Beli Produk</a>
                            @endauth
                        </div> --}}
                    </div>
                </div>

                @if (auth()->user()->isAdmin)
                    <div class="card mb-3 border-0 shadow-lg rounded-4">
                        <div class="card-body">
                            <h5 class="mb-0">Pembeli: {{ $transaction->buyer->name }}</h5>
                        </div>
                    </div>
                @else
                    <div class="card mb-3 border-0 shadow-lg rounded-4">
                        <div class="card-body">
                            <h5 class="mb-0">Penjual: {{ $transaction->seller->name }}</h5>
                        </div>
                    </div>
                @endif
                <div class="card mb-3 border-0 shadow-lg rounded-4">
                    <div class="card-body">
                        <h3>Detail Penawaran Produk</h3>
                        <div class="mb-3">
                            <label for="quantities" class="form-label">Jumlah Pembelian</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-11">
                                    <div class="input-group">
                                        <span class="input-group-text" id="quantities">@ </span>
                                        <input type="number" class="form-control" placeholder="Jumlah barang"
                                            id="quantities" name="quantities" readonly
                                            value="{{ $transaction->quantities }}">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span id="quantities" class="form-text">Item
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Tawaran Harga</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-11">
                                    <div class="input-group">
                                        <span class="input-group-text" id="addon-wrapping">Rp</span>
                                        <input type="number" class="form-control" placeholder="Tawar harga" id="price"
                                            name="price"value="{{ $transaction->price }}" readonly>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <span id="price" class="form-text">
                                        /Item
                                    </span>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->isAdmin)
                            <form method="POST" action="/purchase/{{ $transaction->id }}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row d-flex justify-content-around">
                                    <input type="hidden" name="buyer_id" id="buyer_id"
                                        value="{{ $transaction->buyer_id }}">
                                    <input type="hidden" name="seller_id" id="seller_id"
                                        value="{{ $transaction->seller_id }}">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="sumbit"
                                                class="btn btn-success btn-block w-100 font-weight-bold mt-3" name="status"
                                                id="status" value="accept">Terima
                                                Tawaran</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="sumbit"
                                                class="btn btn-danger btn-block w-100 font-weight-bold mt-3" name="status"
                                                id="status" value="reject">Tolak
                                                Tawaran</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        @else
                            @if ($transaction->status == 'pending')
                                <h4>Tawaranmu <span class="text-warning">menunggu</span> konfirmasi penjual, harap
                                    tunggu...
                                </h4>
                            @elseif ($transaction->status == 'accept')
                                <h4>Selamat! Tawaranmu <span class="text-success">diterima</span>, silahkan lanjutkan
                                    transaksi</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-block w-100 rounded-4"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Lanjutkan Transaksi
                                </button>


                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hallo,
                                                    {{ auth()->user()->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Karena tawaranmu untuk produk {{ $transaction->product->title }} sudah
                                                diterima, silahkan lanjutkan transaksimu dengan memilih metode dibawah
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex w-100">
                                                    <form class="w-100" method="POST"
                                                        action="/purchase/{{ $transaction->id }}">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="buyer_id" id="buyer_id"
                                                            value="{{ $transaction->buyer_id }}">
                                                        <input type="hidden" name="seller_id" id="seller_id"
                                                            value="{{ $transaction->seller_id }}">
                                                        <div class="row">
                                                            <div class="col-4"><a
                                                                    href="https://api.whatsapp.com/send?phone={{ $transaction->seller->phone }}"
                                                                    target="_blank" class="btn btn-warning w-100">Hubungi
                                                                    Penjual</a>
                                                            </div>
                                                            <div class="col-4"><button type="sumbit"
                                                                    class="btn btn-success w-100" name="status"
                                                                    id="status" value="done">Selesaikan
                                                                    Transaksi</button>
                                                            </div>
                                                            <div class="col-4"><button type="sumbit"
                                                                    class="btn btn-danger w-100" name="status"
                                                                    id="status" value="cancel">Batalkan
                                                                    Transaksi</button>
                                                            </div>
                                                        </div>





                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($transaction->status == 'reject')
                                <h4>Maaf, tawaran yang kamu ajukan <span class="text-danger">ditolak</span> admin</h4>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
