@extends('layouts.profile')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            @if (session()->has('createProduct'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('createProduct') }}
                </div>
            @elseif(session()->has('successDelete'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('successDelete') }}
                </div>
            @elseif(session()->has('successUpdate'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('successUpdate') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <div class="card m-auto shadow border-0 rounded-4 mb-3" style="width: 80%">
                    <div class="card-body ">
                        <div class="text-center m-4">
                            <form method="POST" action="/profile/image/{{ $user->username }}"
                                class="mb-3 d-flex flex-column" enctype="multipart/form-data">
                                @method('put')
                                @csrf

                                <input class="form-label" type="hidden" name="oldImage" value="{{ $user->image }}">
                                @if ($user->image)
                                    <img src="{{ asset('img/' . $user->image) }}"
                                        class="img-preview rounded-circle img-fluid" id="imagePreview"
                                        style="display:block">
                                @else
                                    <div>
                                        <img src="/img/default_profile.jpg" class="img-preview rounded-circle img-fluid"
                                            id="imagePreview" style="max-height: 10em; overflow:hidden">
                                    </div>
                                @endif

                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    id="image" name="image" onchange="previewImage()" style="visibility:hidden">

                                <label for="image" class="btn btn-outline-success btn-block form-label">Unggah
                                    Foto</label>
                                <button type="submit" class="btn btn-success btn-block mb-3">Simpan
                                    Foto</button>
                                <div class="border-bottom border-2 mt-4 mb-2"></div>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </form>
                        </div>
                        <div class="col-lg d-flex justify-content-center mb-1">
                            <a href="/profile/{{ $user->username }}/edit"
                                class="btn btn-outline-success w-100 btn-block border-0"><i class="bi bi-pencil-square"></i>
                                Ubah Data Diri</a>
                        </div>
                        <div class="col-lg d-flex justify-content-center mb-1">
                            <button type="button" class="btn btn-outline-success w-100 btn-block border-0">Ubah
                                Password</button>
                        </div>
                        @if (auth()->user()->isAdmin)
                            <div class="col-lg d-flex justify-content-center mb-5 w-100">
                                <a href="/purchase/records" class="btn btn-outline-success w-100 btn-block border-0"><i
                                        class="bi bi-receipt-cutoff"></i>Histori
                                    Penjualan</a>
                            </div>
                        @else
                            <div class="col-lg d-flex justify-content-center mb-4 w-100">
                                <a href="/purchase/history" class="btn btn-outline-success w-100 btn-block border-0"><i
                                        class="bi bi-receipt-cutoff"></i> Histori
                                    Penawaran</button></a>
                            </div>
                        @endif
                        <div class="col-lg d-flex justify-content-center mt-2 pb-2">
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
            <div class="col-md-8">
                <div class="align-items-center pt-3 pb-2 mb-3 border-bottom border-3">
                    <h1 class="h1 text-success font-weight-bold text-start">Profil</h1>
                </div>

                <br>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Nama</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->name ? $user->name : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Username</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->name ? $user->username : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Email</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->email ? $user->email : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Kota</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->city ? $user->city : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Alamat</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->address ? $user->address : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>
                <div class="row border-bottom border-2 mb-3 pb-2">
                    <div class="col-4">
                        <h4><strong>Nomor Telepon</strong></h4>
                    </div>
                    <div class="col-8">
                        <h4>
                            : {{ $user->phone ? $user->phone : 'Update data untuk melengkapi bagian ini' }}
                        </h4>
                    </div>
                </div>

            </div>

        </div>
        <script>
            function previewImage() {
                imagePreview.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
    @endsection
