<nav class="navbar shadow-lg navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/img/SOBAT-PS.png" alt="..." height="18"></a>
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
                @auth
                    @if (auth()->user()->isAdmin)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}" href="/purchase">Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }}" href="/admin/product">Produk
                                Saya</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('purchase*') ? 'active' : '' }}"
                                href="/purchase/offers">Penawaran</a>
                        </li>
                    @endif
                @else
                @endauth
            </ul>
            <form action="/products" class="d-flex me-auto my-2 my-lg-0 navbar-nav-scroll mx-auto w-50" role="search">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('user'))
                    <input type="hidden" name="user" value="{{ request('user') }}">
                @endif
                <div class="input-group" style="width: 35em">
                    <input type="text" class="form-control" placeholder="Cari produk disini!" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </div>
            </form>
            <ul class="navbar-nav sm-auto">
                @auth
                    <li class="nav-item">
                        @if (auth()->user()->isAdmin)
                            <a class="nav-link {{ Request::is('notification*') ? 'active' : '' }}"
                                href="/notification/seller"><i class="bi bi-bell"></i></a>
                        @else
                            <a class="nav-link {{ Request::is('notification*') ? 'active' : '' }}" href="/notification"><i
                                    class="bi bi-bell"></i></a>
                        @endif
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile/{{ auth()->user()->username }}"><i
                                        class="bi bi-person-square"></i>
                                    Profil</a></li>
                            @if (auth()->user()->isAdmin)
                                <li><a class="dropdown-item" href="/purchase/records"><i class="bi bi-receipt-cutoff"></i>
                                        Histori Penjualan</a></li>
                            @else
                                <li><a class="dropdown-item" href="/purchase/history"><i class="bi bi-receipt-cutoff"></i>
                                        Histori Penawaran</a></li>
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
