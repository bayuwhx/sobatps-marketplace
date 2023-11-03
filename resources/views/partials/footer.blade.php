<footer class="row py-5 px-5 my-5 border-top">
    <div class="col-5 mb-3">
        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
            <img src="/img/sobat-ps-footer.png" alt="">
        </a>
        <h3 style="font-family: 'Poppins', sans-serif;">Marketplace</h3>
        <p class="d-flex text-body-secondary mt-4">Aplikasi ini membantu Anda mendapatkan produk berkualitas tinggi hasil
            hutan
            Kalimantan
            Utara. Mulai
            eksplorasi Anda dalam berkontribusi pada pelestarian dan peningkatan hasil hutan Kalimantan Utara.</p>
        <p class="text-secondary">&copy; 2023, Dinas Kehutanan Provinsi Kalimantan Utara</p>
    </div>

    <div class="col-4">

    </div>

    <div class="col-3 mb-3">
        <h4 class="text-success">Halaman Aplikasi</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a class="nav-link p-0 text-black {{ Request::is('/*') ? 'active' : '' }}"
                    href="/">Beranda</a></li>
            <li class="nav-item mb-2"><a class="nav-link p-0 text-black {{ Request::is('products*') ? 'active' : '' }}"
                    href="/products">Produk</a></li>
            @auth
                @if (auth()->user()->isAdmin)
                    <li class="nav-item mb-2">
                        <a class="nav-link p-0 text-black {{ Request::is('purchase*') ? 'active' : '' }}"
                            href="/purchase">Pesanan</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link p-0 text-black {{ Request::is('admin*') ? 'active' : '' }}"
                            href="/admin/product">Produk
                            Saya</a>
                    </li>
                @else
                    <li class="nav-item mb-2">
                        <a class="nav-link p-0 text-black {{ Request::is('purchase*') ? 'active' : '' }}"
                            href="/purchase/offers">Penawaran</a>
                    </li>
                @endif
            @else
            @endauth
        </ul>
    </div>
</footer>
