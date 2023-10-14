@extends('layouts.auth')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0 g-0">
                <div class="container d-flex h-100 position-absolute align-items-center">
                    <div class="row">
                        <div class="col-12 p-5"><img src="/img/ecommerce.png" class="pl-4" alt=""
                                style="max-height: 4em">
                        </div>
                    </div>
                </div>

                <img src="/img/hutan.png" alt="" class="object-fit-cover w-100">

            </div>

            <div class="col-lg-6 my-auto align-items-center">
                <div class="d-block">
                    @if (session()->has('successRegist'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('successRegist') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div id="success-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <main class="form d-flex flex-column w-100 m-auto ">
                    <h1 class="h3 mb-3 fw-normal text-center mt-2">Silahkan Masuk</h1>
                    <form action="/login" method="post" class="w-100 p-5">
                        @csrf
                        <h6>Email</h6>
                        <div class="form-floating mb-3">
                            <input type="email" name="email"
                                class="form-control rounded-4 @error('email') is-invalid @enderror" id="email"
                                placeholder="name@example.com" required autofocus value="{{ old('email') }}">
                            <label for="email">Masukan e-mail</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h6>Password</h6>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control rounded-4" id="password"
                                placeholder="Password" required>
                            <label for="password">Masukan password</label>
                        </div>
                        <button class="btn btn-block w-100 btn-success btn-lg m-auto mt-2 rounded-4 mb-3"
                            type="submit">Masuk</button>
                        <small class="d-block text-end mt-2">Belum punya akun? <a href="/register">Daftar
                                disini!</a></small>
                    </form>
                </main>
            </div>
        </div>
    </div>
@endsection
