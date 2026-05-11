<!--[if lte IE 9]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve
    your experience and security.
</p>
<![endif]-->

<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>

<header class="header navbar-area">

    {{-- ── Top Bar ──────────────────────────────────── --}}
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">

                {{-- Currency & Language --}}
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-left">
                        <ul class="menu-top-link">
                            <li>
                                <div class="select-position">
                                    <select id="select4" name="currency">
                                        <option value="usd" selected>$ USD</option>
                                        <option value="eur">€ EURO</option>
                                        <option value="cad">$ CAD</option>
                                        <option value="inr">₹ INR</option>
                                        <option value="cny">¥ CNY</option>
                                        <option value="bdt">৳ BDT</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="select-position">
                                    <select id="select5" name="language">
                                        <option value="en" selected>English</option>
                                        <option value="es">Español</option>
                                        <option value="ph">Filipino</option>
                                        <option value="fr">Français</option>
                                        <option value="ar">العربية</option>
                                        <option value="hi">हिन्दी</option>
                                        <option value="bn">বাংলা</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Nav Links --}}
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('home.about-us') }}">About Us</a></li>
                            <li><a href="{{ route('home.contact-us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Auth --}}
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        @if(Session::get('customer_id'))
                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ Session('customer_name') }}
                                <ul class="user-login">
                                    <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('customer-logout') }}">Log Out</a></li>
                                </ul>
                            </div>
                        @else
                            <ul class="user-login">
                                <li><a href="{{ route('customer-login') }}">Sign In</a></li>
                                <li><a href="{{ route('customer-login') }}">Register</a></li>
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Header Middle (Logo + Search + Cart) ────── --}}
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">

                {{-- Logo --}}
                <div class="col-lg-3 col-md-3 col-7">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="ShopGrids Logo">
                    </a>
                </div>

                {{-- Search Bar --}}
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <div class="main-menu-search">
                        <div class="navbar-search search-style-5">
                            <div class="search-select">
                                <div class="select-position">
                                    {{-- Fix: added id + name to fix "form field" console warning --}}
                                    <select id="search-category" name="search_category">
                                        <option value="" selected>All</option>
                                        <option value="1">option 01</option>
                                        <option value="2">option 02</option>
                                        <option value="3">option 03</option>
                                        <option value="4">option 04</option>
                                        <option value="5">option 05</option>
                                    </select>
                                </div>
                            </div>
                            <div class="search-input">
                                {{-- Fix: added id + name to fix "form field" console warning --}}
                                <input type="text" id="search-query" name="search_query" placeholder="Search">
                            </div>
                            <div class="search-btn">
                                <button type="button" aria-label="Search">
                                    <i class="lni lni-search-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hotline + Cart --}}
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline">
                            <i class="lni lni-phone"></i>
                            <h3>Hotline: <span>(+100) 123 456 7890</span></h3>
                        </div>
                        <div class="navbar-cart">
                            <div class="wishlist">
                                <a href="javascript:void(0)">
                                    <i class="lni lni-heart"></i>
                                    <span class="total-items">0</span>
                                </a>
                            </div>
                            <div class="cart-items">
                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items">{{ count($cart_items ?? []) }} Items</span>
                                </a>
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span class="total-items">{{ count($cart_items ?? []) }} Items</span>
                                        <a href="{{ route('show-cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @php($total = 0)
                                        @foreach ($cart_items ?? [] as $item)
                                            @php($total += $item->price)
                                            <li>
                                                <a href="javascript:void(0)" class="remove" title="Remove this item">
                                                    <i class="lni lni-close"></i>
                                                </a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img" href="{{ route('product-detail', ['id' => $item->id ?? '#']) }}">
                                                        <img src="{{ $item->image }}" alt="{{ $item->name }}">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h4>
                                                        <a href="{{ route('product-detail', ['id' => $item->id ?? '#']) }}">
                                                            {{ $item->name }}
                                                        </a>
                                                    </h4>
                                                    <p class="quantity">1x - <span class="amount">${{ $item->price }}</span></p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{ number_format($total, 2) }}</span>
                                        </div>
                                        <div class="button">
                                            <a href="{{ route('show-cart') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── Nav Bar (Categories + Menu + Social) ────── --}}
    <div class="container">
        <div class="row align-items-center">

            {{-- Categories + Main Nav --}}
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">

                    {{-- Mega Category --}}
                    <div class="mega-category-menu">
                        <span class="cat-button"><i class="lni lni-menu"></i> All Categories</span>
                        <ul class="sub-category">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('product-category', ['id' => $category->id]) }}">
                                        {{ $category->name }}
                                        @if($category->subCategories->count() > 0)
                                            <i class="lni lni-chevron-right"></i>
                                        @endif
                                    </a>
                                    <ul class="inner-sub-category">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li>
                                                <a href="{{ route('product-category', ['id' => $subCategory->id]) }}">
                                                    {{ $subCategory->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Main Nav --}}
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="active" aria-label="Home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-2"
                                        aria-expanded="false" aria-label="Pages">Pages</a>
                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><a href="{{ route('home.about-us') }}">About Us</a></li>
                                        <li class="nav-item"><a href="faq.html">FAQ</a></li>
                                        <li class="nav-item"><a href="{{ route('customer-login') }}">Login</a></li>
                                        <li class="nav-item"><a href="{{ route('customer-login') }}">Register</a></li>
                                        <li class="nav-item"><a href="404.html">404 Error</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-3"
                                        aria-expanded="false" aria-label="Shop">Shop</a>
                                    <ul class="sub-menu collapse" id="submenu-1-3">
                                        <li class="nav-item"><a href="product-grids.html">Shop Grid</a></li>
                                        <li class="nav-item"><a href="product-list.html">Shop List</a></li>
                                        <li class="nav-item"><a href="product-details.html">Shop Single</a></li>
                                        <li class="nav-item"><a href="{{ route('show-cart') }}">Cart</a></li>
                                        <li class="nav-item"><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-4"
                                        aria-expanded="false" aria-label="Blog">Blog</a>
                                    <ul class="sub-menu collapse" id="submenu-1-4">
                                        <li class="nav-item"><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a></li>
                                        <li class="nav-item"><a href="blog-single.html">Blog Single</a></li>
                                        <li class="nav-item"><a href="blog-single-sidebar.html">Blog Single Sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('home.contact-us') }}" aria-label="Contact Us">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>
            </div>

            {{-- Social Links --}}
            <div class="col-lg-4 col-md-6 col-12">
                <div class="nav-social">
                    <h5 class="title">Follow Us:</h5>
                    <ul>
                        <li><a href="javascript:void(0)" aria-label="Facebook"><i class="lni lni-facebook-filled"></i></a></li>
                        <li><a href="javascript:void(0)" aria-label="Twitter"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="javascript:void(0)" aria-label="Instagram"><i class="lni lni-instagram"></i></a></li>
                        <li><a href="javascript:void(0)" aria-label="Skype"><i class="lni lni-skype"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</header>