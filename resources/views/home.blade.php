@extends('layouts.main')

@section('container')
    <div class="container-fluid w-100 p-0">
        <div class="card border-0 w-100 align-items-center mb-5">
            <div class="bg-image hover-overlay w-100">
                <img src="/img/hutancemara.png" class="w-100">
                <div class="mask"
                    style="background: linear-gradient(45deg, hsla(168, 85%, 52%, 0.5), hsla(263, 88%, 45%, 0.5) 100%);">
                </div>
            </div>
            <div class="card-img-overlay d-flex align-items-center">
                <div class="col-4">
                    <h1 class="card-title text-white">Mencari hasil olahan hutan asli menjadi lebih mudah!
                    </h1>
                    <h6 class="card-title text-white">Selamat datang di website SOBAT-PS marketplace, semua kebutuhanmu
                        terkait hasil hutan ada disini!
                    </h6>
                </div>
            </div>
        </div>
        <h1 class="text-center">Beberapa kategori yang kami sajikan</h1>
        <h1 class="text-center mb-5">untuk kebutuhan anda!</h1>
        <div class="row">
            <div class="col-6 d-flex justify-content-end">
                <a href="/products?category=wood">
                    <div class="g-0 d-flex justify-content-center align-items-center" style="width: 30rem;">
                        <img class="card-img-top text-white p-0" src="/img/hhk.png" alt="Hasil Hutan Kayu">
                        <h1 class="text-center position-absolute text-white">Hasil Hutan Kayu</h1>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="/products?category=materials">
                    <div class="g-0 d-flex justify-content-center align-items-center" style="width: 30rem;">
                        <img class="card-img-top p-0 " src="/img/hhkb.png" alt="Card image cap">
                        <h1 class="text-center position-absolute text-white">Hasil Hutan Bukan Kayu</h1>
                    </div>
                </a>
            </div>
        </div>


        <div class="container-fluid w-80 pt-5 pb-5" id="kotak" style="">
            <div class="text pt-5 mt-5 mb-5">
                <h2 class="text-center text-white pt-5 mt-5">Apasih SOBAT-PS</h2>
                <h2 class="text-center text-white">Marketplace?</h2>
            </div>
            <div class="row mb-5 pt-3">
                <div class="col-6 d-flex justify-content-end">
                    <div class="p-0 g-0 d-flex justify-content-center align-items-center border-0" style="width: 30rem;">
                        <img class="card-img-top text-white p-0" src="/img/hhk.png" alt="Hasil Hutan Kayu"
                            style="height: 15em">
                        <h1 class="text-center position-absolute text-white">Hasil Hutan Kayu</h1>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-transparent" style="width: 30rem">
                        <div class="card-body text-white">
                            <h4 class="card-title mb-3">Membantu 3500++ UMKM untuk memasarkan produknya melalui aplikasi
                                kami
                            </h4>
                            <h5 class="card-subtitle mb-2 ">Membantu 3500++ UMKM untuk memasarkan produknya
                                melalui aplikasi kami</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-5 mt-3">
                <div class="col-6 d-flex justify-content-end">
                    <div class="p-0 g-0 d-flex justify-content-center align-items-center border-0" style="width: 30rem;">
                        <img class="card-img-top text-white p-0" src="/img/hhkb.png" alt="Hasil Hutan Kayu"
                            style="height: 15em">
                        <h1 class="text-center position-absolute text-white">Hasil Hutan Bukan Kayu</h1>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card-transparent" style="width: 30rem;">
                        <div class="card-body text-white">
                            <h4 class="card-title mb-3">Membantu 3500++ UMKM untuk memasarkan produknya melalui
                                aplikasi kami
                            </h4>
                            <h5 class="card-subtitle mb-2">Membantu 3500++ UMKM untuk memasarkan produknya
                                melalui aplikasi kami</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-center mt-5">Kenapa harus menggunakan</h1>
        <h1 class="text-center mb-5">SOBAT-<span class="text-success">PS</span> E-Bussines</h1>

        <h4 class="text-center" style="color: #959595">Masih ragu pake aplikasi ini sobat?</h4>
        <h4 class="text-center mb-5" style="color: #959595">ini nih keunggulan yang kami punya!</h4>

        <div class="container d-flex flex-row mb-5 justify-content-around">
            <div class="card border-0" style="width: 12rem;">
                <img class="card-img-top" src="/img/klik.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="text-center">Tinggal</h4>
                    <h4 class="text-center text-success">Klik!</h4>
                </div>
            </div>
            <div class="card border-0" style="width: 12rem;">
                <img class="card-img-top" src="/img/aman.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="text-center">Barang pasti</h4>
                    <h4 class="text-center text-success">aman deh!</h4>
                </div>
            </div>
            <div class="card border-0" style="width: 12rem;">
                <img class="card-img-top" src="/img/bayar.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="text-center">Gak repot</h4>
                    <h4 class="text-center text-success">Bayar Bayar!</h4>
                </div>
            </div>
            <div class="card border-0" style="width: 12rem;">
                <img class="card-img-top" src="/img/akses.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="text-center">Bisa akses</h4>
                    <h4 class="text-center text-success">darimanapun!</h4>
                </div>
            </div>
            <div class="card border-0" style="width: 12rem;">
                <img class="card-img-top" src="/img/shopping.png" alt="Card image cap">
                <div class="card-body">
                    <h4 class="text-center">Udah Siap</h4>
                    <h4 class="text-center text-success">Belanja?</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Frequently</h1>
                    <h1>Asked Question></h1>
                </div>
                <div class="col-lg-8">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the
                                    collapse plugin adds the appropriate classes that we use to style each element. These
                                    classes
                                    control the overall appearance, as well as the showing and hiding via CSS transitions.
                                    You can
                                    modify any of this with custom CSS or overriding our default variables. It's also worth
                                    noting
                                    that just about any HTML can go within the <code>.accordion-body</code>, though the
                                    transition
                                    does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the
                                    collapse plugin adds the appropriate classes that we use to style each element. These
                                    classes
                                    control the overall appearance, as well as the showing and hiding via CSS transitions.
                                    You can
                                    modify any of this with custom CSS or overriding our default variables. It's also worth
                                    noting
                                    that just about any HTML can go within the <code>.accordion-body</code>, though the
                                    transition
                                    does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the
                                    collapse plugin adds the appropriate classes that we use to style each element. These
                                    classes
                                    control the overall appearance, as well as the showing and hiding via CSS transitions.
                                    You can
                                    modify any of this with custom CSS or overriding our default variables. It's also worth
                                    noting
                                    that just about any HTML can go within the <code>.accordion-body</code>, though the
                                    transition
                                    does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
