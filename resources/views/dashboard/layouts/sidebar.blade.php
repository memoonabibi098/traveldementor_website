<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" alt="navbar brand"
                    class="navbar-brand" height="35" />
            </a>
            {{-- <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div> --}}
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="{{ route('admin.dashboard') }}" class="collapsed"
                        aria-expanded="false">
                        <i class="fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Pages</h4>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fa fa-cogs"></i>
                        <p>General</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.header') }}">
                                    <span class="sub-item">Header</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.footer') }}">
                                    <span class="sub-item">Footer</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.hero') }}">
                                    <span class="sub-item">Hero</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fa fa-home"></i>
                        <p>Home</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.choose-us.index') }}">
                                    <span class="sub-item">Choose us</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.popular-destination-section.index') }}">
                                    <span class="sub-item">Popular Destination</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.visa-options.index') }}">
                                    <span class="sub-item">Visa Options</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Featured Services</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Visa Holder</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Our Achievements</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Our Satisfied Customers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fa fa-info-circle"></i>
                        <p>About</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">CEO Massage</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Affiliation</span>
                                </a>
                            </li>
                            <li>
                                <a href="}">
                                    <span class="sub-item">Guiding Your Journey</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Dedicated Team</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#maps">
                        <i class="bi bi-gear-wide-connected"></i>
                        <p>Services</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">Document & Identity</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Tours & Ticketing</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Travel & Visa Support</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Expert Visa Assistance</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="bi bi-ubuntu"></i>
                        <p>Visa Status</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">Steps</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Check Visa Status</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Travel & Visa Support</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Expert Visa Assistance</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#submenu">
                        <i class="fa fa-question-circle-o"></i>
                        <p>FAQ,s</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">FAQ's</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#contact">
                        <i class="fa fa-question-circle-o"></i>
                        <p>Contact</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="contact">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="">
                                    <span class="sub-item">Contact Features</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="sub-item">Contact Info</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#additional">
                        <i class="fa fa-question-circle-o"></i>
                        <p>Additional Record</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="additional">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('countries.index') }}">
                                    <span class="sub-item">Country</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->