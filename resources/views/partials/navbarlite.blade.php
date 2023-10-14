<nav class="navbar shadow-lg navbar-expand-lg bg-body-tertiary">
    <div class="container" style="">
        <a class="navbar-brand" href="#"><img src="/img/sobat-ps.png" alt="..." height="18"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/*') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="/products">Produk</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">Kategori</a>
                </li> --}}
                @auth
                    @if (auth()->user()->isAdmin)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}" href="/purchase">Diminati</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}"
                                href="/purchase/offers">Transaksi
                                Berlangsung</a>
                        </li>
                    @endif
                @else
                @endauth
                {{-- @can('admin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}" href="/purchase">Diminati</a>
                        </li>
                    @endcan --}}
            </ul>
            <ul class="navbar-nav sm-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile/{{ auth()->user()->username }}"><i
                                        class="bi bi-person-square"></i>
                                    My Profile</a></li>
                            <li>
                                @if (auth()->user()->isAdmin)
                            <li><a class="dropdown-item" href="/purchase/records"><i class="bi bi-receipt-cutoff"></i>
                                    Histori Penjualan</a></li>
                            <li>
                            <li><a class="dropdown-item" href="/notification/seller"><i class="bi bi-bell"></i></i>
                                    Notifikasi</a></li>
                            <li>
                            @else
                            <li><a class="dropdown-item" href="/purchase/history"><i class="bi bi-receipt-cutoff"></i>
                                    Histori Penawaran</a></li>
                            <li>
                            <li><a class="dropdown-item" href="/notification"><i class="bi bi-bell"></i></i>
                                    Notifikasi</a></li>
                            <li>
                                @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                                    Logout</button>
                            </form>
                    </li>
                </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="/login" class="nav-link {{ $active === 'login' ? 'active' : '' }} btn btn-outline-success"><i
                            class="bi bi-box-arrow-in-right"></i> Login</a>
                </li>
            @endauth
            </ul>
        </div>
    </div>
</nav>
