@extends('layouts.auth')

@section('container')
    <div class="row justify-content-center">
        <div class="row justify-content-center d-flex">
            <div class="col-6 p-0 g-0">
                <div class="container d-flex h-100 position-absolute d-flex align-items-center pl-4">
                    <div class="row">
                        <div class="col-12 p-5"><img src="/img/ecommerce.png" class="pl-4" alt=""
                                style="max-height: 4em">
                        </div>
                    </div>
                </div>

                <img src="/img/hutan.png" alt="" class="" style="width: 100%">
            </div>
            <div class="col-6 p-5 align-items-center my-auto">
                <main class="form d-flex m-auto flex-column">
                    <h1 class="h3 mb-3 fw-normal text-center mb-3 w-100">Halaman Registrasi</h1>
                    <form action="/register" method="post" class="w-100">
                        @csrf
                        <h6>Nama</h6>
                        <div class="form-floating mb-3">
                            <input type="text" name="name"
                                class="form-control rounded-4 @error('name') is-invalid @enderror" id="name"
                                placeholder="Name" required value="{{ old('nam') }}">
                            <label for="name">Name</label>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h6>Username</h6>
                        <div class="form-floating mb-3">
                            <input type="text" name="username"
                                class="form-control rounded-4 @error('username') is-invalid @enderror" id="username"
                                placeholder="username" required value="{{ old('username') }}">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h6>Email</h6>
                        <div class="form-floating mb-3">
                            <input type="email" name="email"
                                class="form-control rounded-4 @error('email') is-invalid @enderror" id="email"
                                placeholder="name@email.com" required value="{{ old('email') }}">
                            <label for="email">Email address</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <h6>Password</h6>
                        <div class="form-floating mb-3">
                            <input type="password" name="password"
                                class="form-control rounded-4 @error('password') is-invalid @enderror" id="password"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class="w-100 btn btn-lg btn-success mt-3" type="submit">Register</button>
                    </form>
                    <small class="d-block text-end mt-2">Sudah terdaftar? <a href="/login">Masuk</a></small>
                </main>
            </div>
        </div>
    @endsection
