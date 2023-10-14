@extends('layouts.main')

@section('container')
    @if ($transactions->count())
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <h1 class="mb-4">Histori Transaksi</h1>
                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <div class="card m-auto shadow border-0 rounded-4" style="width: 80%">
                                <div class="card-body ">
                                    {{-- <div class="text-center m-4 ">
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil" class="img-fluid rounded-circle"
                                            style="width: 150px; height: 150px;">
                                    </div> --}}
                                    {{-- <div class="col-lg d-flex flex-column justify-content-end"> --}}
                                    {{-- <div class="text-center m-4"> --}}
                                    <div class="text-center m-4 ">
                                        <form method="POST" action="" class="mb-3" enctype="multipart/form-data">

                                            <label for="image" class="form-label">Upload Photo</label>

                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" onchange="previewImage()"
                                                style="visibility:hidden">

                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </form>
                                    </div>

                                    {{-- </div> --}}


                                    <div class="col-lg d-flex justify-content-center mb-1">
                                        <a href="/profile/{{ $user->username }}/edit"
                                            class="btn btn-outline-success w-100 btn-block active border-0"><i
                                                class="bi bi-pencil-square"></i>
                                            Edit Profile</a>
                                    </div>
                                    <div class="col-lg d-flex justify-content-center mb-1">
                                        <button type="button"
                                            class="btn btn-outline-success w-100 btn-block border-0">Reset
                                            Password</button>
                                    </div>
                                    <div class="col-lg d-flex justify-content-center mb-5">
                                        <a class="btn btn-outline-success w-100 btn-block border-0"
                                            href="/purchase/history"><i class="bi bi-receipt-cutoff"></i>
                                            Transaction History</a></li>
                                    </div>
                                    <div class="col-lg d-flex justify-content-center mt-5">
                                        <form action="/logout" method="post" class="btn btn-danger">
                                            @csrf
                                            <button type="submit" class="btn dropdown-item btn-danger" style="border:1rem">
                                                <i class="bi bi-box-arrow-right">
                                                </i>
                                                Logout</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @forelse ($transactions as $transaction)
                                    <div class="transaction-item mb-4">
                                        <div class="transaction-item-header">
                                            <h5 class="mb-1">{{ $transaction->product->title }}</h5>
                                            <span
                                                class="text-muted">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="transaction-item-content">
                                            <div class="row">
                                                @if ($transaction->product->image)
                                                    <div class="col-lg-4">
                                                        <img src="{{ asset('storage/' . $transaction->product->image) }}"
                                                            alt="Product Image" class="img-fluid">
                                                    </div>
                                                @else
                                                    <div class="col-lg-4">
                                                        <img src="https://source.unsplash.com/1200x800?{{ $transaction->product->category->slug }}"
                                                            alt="Product Image" class="img-fluid">
                                                    </div>
                                                @endif

                                                <div class="col-lg-8">
                                                    <p>Status : {{ $transaction->status }}</p>
                                                    <p>Jumlah : {{ $transaction->quantities }}</p>
                                                    <p>Harga : Rp {{ number_format($transaction->price, 0, ',', '.') }}
                                                        /Item
                                                    </p>
                                                    <p>Total Harga : Rp
                                                        {{ number_format($transaction->quantities * $transaction->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>Tidak ada transaksi</p>
                                @endforelse

                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center fs-4">No post found.</p>
    @endif
    <div class="d-flex justify-content-center">
        {{ $transactions->links() }}
    </div>
    <script>
        function previewImage() {
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
