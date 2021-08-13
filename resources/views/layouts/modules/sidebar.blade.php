<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/akustik.png') }}" alt="POS" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Cafe Akustik</span>
    </a>
    ​
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/akustik.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        ​
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if (auth()->user()->role == 'kasir')
                    <li class="nav-item has-treeview @if (Request::segment(1)=='order' ) menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>
                                Manajemen Order
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link @if (Request::segment(1)=='order' ) active @endif">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Order</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.transaksi') }}" class="nav-link @if (Request::segment(1)=='transaksi' || Request::segment(1)=='checkout' ) active @endif"">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                        ​
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item has-treeview">
                        <a href="{{ route('dashboard') }}" class="nav-link @if (Request::segment(1)=='' || Request::segment(1)=='dashboard' ) active @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview @if (Request::segment(1)=='order' ) menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>
                                Manajemen Order
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link @if (Request::segment(1)=='order' ) active @endif">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Order</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview @if (Request::segment(1)=='produk' ||
                        Request::segment(1)=='kategori' ) menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-server"></i>
                            <p>
                                Manajemen Produk
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kategori.index') }}" class="nav-link @if (Request::segment(1)=='kategori' ) active @endif"">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('produk.index') }}" class="nav-link @if (Request::segment(1)=='produk' ) active @endif"">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('bahan.index') }}" class="nav-link @if (Request::segment(1)=='bahan' ) active @endif">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                Manajemen Bahan Baku
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('report.index') }}" class="nav-link @if (Request::segment(1)=='report' ) active @endif">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                Manajemen Laporan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.index') }}" class="nav-link @if (Request::segment(1)=='user' ) active @endif">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Manajemen User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                        ​
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
                @if (auth()->user()->role == 'barista' || auth()->user()->role == 'dapur')

                    <li class="nav-item has-treeview @if (Request::segment(1)=='produk' ||
                        Request::segment(1)=='kategori' ) menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-server"></i>
                            <p>
                                Manajemen Produk
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('produk.index') }}" class="nav-link @if (Request::segment(1)=='produk' ) active @endif"">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('bahan.index') }}" class="nav-link @if (Request::segment(1)=='bahan' ) active @endif">
                            <i class="nav-icon fa fa-archive"></i>
                            <p>
                                Manajemen Bahan Baku
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                {{ __('Logout') }}
                            </p>
                        </a>
                        ​
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
