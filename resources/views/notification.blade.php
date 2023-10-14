@extends('layouts.main')

@section('container')
    @if ($notifications->count())
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="row mb-4">
                        <div class="col-3 px-0">
                            <h1 class="title mt-4 text-success">Notifikasi</h1>
                        </div>
                        <div class="col-9 px-0">
                            <div class="border-bottom border-success border-3 mt-5"></div>
                        </div>
                    </div>

                    @forelse ($notifications as $notification)
                        @if (auth()->user()->isAdmin)
                            <div class="card rounded-4 mb-3 shadow border-2 overflow-hidden">
                                <div class="card-body h-100 px-4">
                                    <div class="notification-item-content">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                @if ($notification->status == 'pending')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i
                                                                    class="bi bi-exclamation-circle-fill text-warning text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Barang Sedang Ditawar!</strong></h5>
                                                            <p><strong>
                                                                    {{ $notification->buyer->name }}
                                                                </strong>
                                                                melakukan
                                                                penawaran
                                                                pada produk
                                                                <strong>{{ $notification->product->title }}</strong>. Segera
                                                                cek tawaran
                                                                tersebut!
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'accept')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i
                                                                    class="bi bi-arrow-right-circle-fill text-warning text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Diterima!</strong>
                                                            </h5>
                                                            <p>
                                                                Tawaran
                                                                <strong>{{ $notification->buyer->name }}</strong> dengan
                                                                harga
                                                                <strong>Rp.{{ number_format($notification->price, 2, ',', '.') }}</strong>
                                                                telah disetujui! silahkan tunggu respon penawar
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'reject')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-x-circle-fill text-danger text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Dibatalkan!</strong></h5>
                                                            <p>
                                                                Tawaran produk
                                                                <strong>{{ $notification->product->title }}</strong> dengan
                                                                tawaran
                                                                <strong>Rp.{{ number_format($notification->price, 2, ',', '.') }}</strong>
                                                                telah berhasil dibatalkan.
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'cancel')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-x-circle-fill text-danger text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Ditolak!</strong></h5>
                                                            <p>
                                                                Tawaran produk
                                                                <strong>{{ $notification->product->title }}</strong> dengan
                                                                tawaran
                                                                <strong>Rp.{{ number_format($notification->price, 2, ',', '.') }}</strong>
                                                                telah ditolak.
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'done')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-check-circle-fill text-success text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Selesai</strong></h5>
                                                            <p>
                                                                Transaksi produk
                                                                <strong>{{ $notification->product->title }}</strong> dengan
                                                                harga
                                                                <strong>Rp.{{ number_format($notification->price, 2, ',', '.') }}</strong>
                                                                oleh <strong>{{ $notification->buyer->name }}</strong>
                                                                telah
                                                                selesai.
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-2">
                                                @if ($notification->product->image)
                                                    <img src="{{ asset('storage/' . $notification->product->image) }}"
                                                        alt="Product Image" class="img-fluid h-100 w-100 rounded-3"
                                                        style="overflow: hidden">
                                                @else
                                                    <img src="https://source.unsplash.com/250x140?{{ $notification->product->category->slug }}"
                                                        alt="Product Image" class="img-fluid h-100 w-100 rounded-3"
                                                        style="overflow: hidden">
                                                @endif
                                            </div>
                                            <div
                                                class="col-lg-3 border border-top-0 border-bottom-0 border-start-0 d-flex h-100 flex-column align-self-center">
                                                <h5>{{ $notification->product->title }}</h5>
                                                <button
                                                    class="btn btn-sm btn-outline-success mb-3 py-0">{{ $notification->product->category->category_name }}</button>
                                            </div>
                                            <div
                                                class="col-lg-2 px-0 pl-2 mt-0 mb-1 d-flex flex-column align-self-start justify-content-end">
                                                <p class="text-muted mb-1 text-end">
                                                    {{ $notification->updated_at->format('d M Y, H:i') }}
                                                <p class="text-end text-muted">{{ $notification->quantities }} items
                                                </p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card rounded-4 mb-3 shadow border-2 overflow-hidden">
                                <div class="card-body h-100 px-4">
                                    <div class="notification-item-content">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                @if ($notification->status == 'pending')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i
                                                                    class="bi bi-exclamation-circle-fill text-warning text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Diajukan!</strong>
                                                            </h5>
                                                            <p>
                                                                Tawaranmu untuk
                                                                <strong>{{ $notification->product->title }}</strong>
                                                                berhasil diajukan,
                                                                silahkan tunggu respon penjual.
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'accept')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i
                                                                    class="bi bi-arrow-right-circle-fill text-warning text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Disetujui!</strong>
                                                            </h5>
                                                            <p>
                                                                Tawaranmu telah
                                                                {{-- <strong>{{ $notification->product->title }}</strong> --}}
                                                                disetujui dengan harga
                                                                <strong>Rp.{{ number_format($notification->price, 2, ',', '.') }}</strong>
                                                                silahkan
                                                                melanjutkan transaksi
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'reject')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-x-circle-fill text-danger text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Ditolak!</strong>
                                                            </h5>
                                                            <p>
                                                                Tawaranmu untuk
                                                                <strong>{{ $notification->product->title }}</strong>
                                                                ditolak oleh penjual,
                                                                Terimakasih telah menggunakan jasa kami
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'cancel')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-x-circle-fill text-danger text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Penawaran Dibatalkan!</strong>
                                                            </h5>
                                                            <p>
                                                                Kamu membatalkan tawaran pada produk
                                                                <strong>{{ $notification->product->title }}</strong>,
                                                                Terimakasih telah menggunakan jasa kami
                                                            </p>
                                                        </div>
                                                    </div>
                                                @elseif ($notification->status == 'done')
                                                    <div class="row">
                                                        <div class="col-2 d-flex justify-content-center">
                                                            <h4><i class="bi bi-check-circle-fill text-success text-lg"></i>
                                                            </h4>
                                                        </div>
                                                        <div class="col-10">
                                                            <h5 class=""><strong>Transaksi Selesai</strong>
                                                            </h5>
                                                            <p>Transaksimu untuk produk
                                                                <strong>{{ $notification->product->title }}</strong>
                                                                telah selesai. Terimakasih telah mempercayai kami
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-lg-2">
                                                @if ($notification->product->image)
                                                    <img src="{{ asset('storage/' . $notification->product->image) }}"
                                                        alt="Product Image"
                                                        class="img-fluid img-fluid h-100 w-100 rounded-3"
                                                        style="overflow: hidden">
                                                @else
                                                    <img src="https://source.unsplash.com/250x140?{{ $notification->product->category->slug }}"
                                                        alt="Product Image"
                                                        class="img-fluid img-fluid h-100 w-100 rounded-3"
                                                        style="overflow: hidden">
                                                @endif
                                            </div>
                                            <div
                                                class="col-lg-3 border border-top-0 border-bottom-0 border-start-0 d-flex h-100 flex-column align-self-center">
                                                <h5>{{ $notification->product->title }}</h5>
                                                <button
                                                    class="btn btn-sm btn-outline-success mb-3 py-0">{{ $notification->product->category->category_name }}</button>
                                            </div>
                                            <div
                                                class="col-lg-2 px-0 mt-0 mb-1 d-flex flex-column align-self-start justify-content-end">
                                                <p class="text-muted mb-1 text-end">
                                                    {{ $notification->updated_at->format('d M Y, H:i') }}
                                                <p class="text-end text-muted">{{ $notification->quantities }} items
                                                </p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                    @endforelse

                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-8">
                    <div class="row">
                        <div class="col-3 px-0">
                            <h1 class="title mt-4 text-success">Notifikasi</h1>
                        </div>
                        <div class="col-9 px-0">
                            <div class="border-bottom border-success border-3 mt-5"></div>
                        </div>
                    </div>


                    <div class="container d-flex flex-column justify-content-center align-items-center opacity-50"
                        style="height: 30em">
                        <img src="/img/aman.png" alt="">
                        <h4 class="text-muted text-center">Tidak ada barang yang ditawar</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
