@extends('layouts.profile')

@section('container')
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card m-auto shadow border-0 rounded-4 mb-5" style="width: 80%">
                <div class="card-body ">
                    <div class="text-center m-4">
                        <form method="POST" action="/profile/image/{{ $user->username }}" class="mb-3 d-flex flex-column"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <input class="form-label" type="hidden" name="oldImage" value="{{ $user->image }}">
                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}"
                                    class="img-preview rounded-circle img-fluid mb-3" id="imagePreview"
                                    style="display:block">
                            @else
                                <div>
                                    <img src="" class="img-preview rounded-circle img-fluid mb-3" id="imagePreview"
                                        style="max-height: 10em; overflow:hidden">
                                </div>
                            @endif

                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" onchange="previewImage()" style="visibility:hidden">

                            <div class="border-bottom border-2 mt-2 mb-4"></div>

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </form>
                    </div>



                    <div class="col-lg d-flex justify-content-center mb-1">
                        <a href="/profile/{{ $user->username }}/edit"
                            class="btn btn-outline-success w-100 btn-block border-0 active"><i
                                class="bi bi-pencil-square"></i>
                            Edit Profile</a>
                    </div>
                    <div class="col-lg d-flex justify-content-center mb-1">
                        <button type="button" class="btn btn-outline-success w-100 btn-block border-0">Reset
                            Password</button>
                    </div>
                    @if (auth()->user()->isAdmin)
                        <div class="col-lg d-flex justify-content-center mb-5 w-100">
                            <a href="/purchase/records" class="btn btn-outline-success w-100 btn-block border-0"><i
                                    class="bi bi-receipt-cutoff"></i>Histori
                                Penjualan</a>
                        </div>
                    @else
                        <div class="col-lg d-flex justify-content-center mb-5 w-100">
                            <a href="/purchase/records" class="btn btn-outline-success w-100 btn-block border-0"><i
                                    class="bi bi-receipt-cutoff"></i>Histori
                                Pembelian</button></a>
                        </div>
                    @endif
                    <div class="col-lg d-flex justify-content-center mt-3 mb-3">
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
        <div class="col-lg-8">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h1 text-success font-weight-bold">Ubah Profil</h1>
            </div>
            <form method="POST" action="/profile/{{ $user->username }}" class="mb-3" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control rounded-4 @error('name') is-invalid @enderror" id="name"
                        name="name" required autofocus value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control rounded-4 @error('username') is-invalid @enderror"
                        id="username" name="username" required readonly value="{{ old('username', $user->username) }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input type="email" class="form-control rounded-4 @error('email') is-invalid @enderror" id="email"
                        name="email" required value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Kota</label>
                    <input type="text" class="form-control rounded-4 @error('city') is-invalid @enderror" id="city"
                        name="city" required value="{{ old('city', $user->city) }}">
                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="number" class="form-control rounded-4 @error('phone') is-invalid @enderror"
                        id="phone" name="phone" required value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1 address" class="form-label">Alamat</label>
                    <input type="text"
                        class="form-control align-items-start rounded-4 @error('address') is-invalid @enderror"
                        id="address" name="address" required value="{{ old('address', $user->address) }}">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button class="h3 w-100 btn btn-success btn-lg mt-2 rounded-4" type="submit">Save</button>
            </form>
        </div>
    </div>


    <script>
        function previewImage() {
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
