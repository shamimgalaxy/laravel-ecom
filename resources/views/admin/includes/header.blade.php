<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <b>
                    <img src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('admin/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span>
                    <img src="{{ asset('admin/assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                    <img src="{{ asset('admin/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>

        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)">
                        <i class="ti-menu"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                        <i class="icon-menu"></i>
                    </a>
                </li>

                {{-- Fix 1: added id + name to search input --}}
                <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block" role="search">
                        <input
                            type="text"
                            id="admin-search"
                            name="admin_search"
                            class="form-control"
                            placeholder="Search &amp; enter"
                            autocomplete="off"
                            aria-label="Search"
                        >
                    </form>
                </li>
            </ul>

            <ul class="navbar-nav my-lg-0">

                {{-- Mega dropdown --}}
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-layout-width-default"></i>
                    </a>
                    <div class="dropdown-menu animated bounceInDown">
                        <ul class="mega-dropdown-menu row">

                            {{-- Carousel --}}
                            <li class="col-lg-3 col-xlg-2 m-b-30">
                                <h4 class="m-b-20">CAROUSEL</h4>
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <div class="container">
                                                <img class="d-block img-fluid" src="{{ asset('admin/assets/images/big/img1.jpg') }}" alt="First slide">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container">
                                                <img class="d-block img-fluid" src="{{ asset('admin/assets/images/big/img2.jpg') }}" alt="Second slide">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="container">
                                                <img class="d-block img-fluid" src="{{ asset('admin/assets/images/big/img3.jpg') }}" alt="Third slide">
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </li>

                            {{-- Accordion --}}
                            <li class="col-lg-3 m-b-30">
                                <h4 class="m-b-20">ACCORDION</h4>
                                <div class="accordion" id="accordionExample">
                                    <div class="card m-b-0">
                                        <div class="card-header bg-white p-0" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Collapsible Group Item #1
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high.</div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <div class="card-header bg-white p-0" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Collapsible Group Item #2
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high.</div>
                                        </div>
                                    </div>
                                    <div class="card m-b-0">
                                        <div class="card-header bg-white p-0" id="headingThree">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high.</div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            {{-- Contact Us --}}
                            <li class="col-lg-3 m-b-30">
                                <h4 class="m-b-20">CONTACT US</h4>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="contactName" name="contact_name" placeholder="Enter Name">
                                    </div>
                                    {{-- Fix 2: added id + name to email input --}}
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="contactEmail" name="contact_email" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="contactMessage" name="contact_message" rows="3" placeholder="Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-info text-white">Submit</button>
                                </form>
                            </li>

                            {{-- List style --}}
                            <li class="col-lg-3 col-xlg-4 m-b-30">
                                <h4 class="m-b-20">List style</h4>
                                <ul class="list-style-none">
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </li>

                {{-- User profile --}}
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class="">
                        <span class="hidden-md-down">Mark &nbsp;<i class="fa fa-angle-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end animated flipInY">
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                        <form action="{{ route('logout') }}" id="logoutForm" method="post">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>