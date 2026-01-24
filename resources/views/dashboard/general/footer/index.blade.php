@extends('dashboard.app')
@push('styles')
    {{--
    <link rel="stylesheet" href="{{ asset('css/dashboard/footer.css') }}"> --}}
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Footer</h3>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createFooterModal" class=" text-white" data-bs-toggle="modal"
                        data-bs-target="#createFooterModal">Create
                        <i class="fa fa-plus ms-2" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.footer') }}" class="links-color">General / Footer / Home</a>
            </li>
        </ol>
    </div>




    <div class="header-layout d-flex col-12 px-2 py-3 rounded my-4 header-link justify-content-around">

        <!-- Logo & Intro -->
        <div class="col-2 d-flex flex-column justify-content-center align-items-center">
            <div class="logo-div mb-5">
                @if($footer && $footer->logo)
                    {{-- <img src="{{ asset('storage/' . $footer->logo) }}" class="w-100" alt="Footer Logo"> --}}
                    <img src="{{ $footer && $footer->logo ? asset('uploads/footer/' . $footer->logo) : asset('images/website_images/home/dark-logo.webp') }}"
                        class="w-100" alt="Footer Logo">
                @else
                    <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" class="w-100" alt="Default Logo">
                @endif
            </div>

            <div class="footer-intro-div">
                <p>{{ $footer->intro_text ?? 'Travel de Mentor, a trusted Visa Consultancy firm dedicated to assisting clients with all their visa and travel requirements.' }}
                </p>
            </div>

            <div class="my-3 col-12">
                <label for="newsletterInput" class="form-label">{{ $footer->newsletter_text ?? 'Stay Updated' }}</label>
                <input type="text" class="form-control col-8" id="newsletterInput">
                <button type="button" class="btn bg-color text-white col-12 mt-2">Subscription</button>
            </div>
        </div>

        <!-- Company Links -->
        <div class="col-3">
            <div class="menu-div d-flex flex-column justify-content-center align-items-center h-100">
                <ul class="d-flex flex-column mb-0 align-items-left justify-content-evenly h-100 w-100 fs-5">
                    <li>
                        <p class="fs-5 fw-bold">Company</p>
                    </li>

                    @if($footer && $footer->company_links)
                        @foreach($footer->company_links as $link)
                            <li>
                                <a href="{{ $link['url'] ?? '#' }}" class="links-color">{{ $link['title'] ?? 'Link' }}</a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="#" class="links-color">FAQs</a></li>
                        <li><a href="#" class="links-color">Privacy Policy</a></li>
                        <li><a href="#" class="links-color">Terms & Conditions</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-4">
            <div class="menu-div d-flex flex-column justify-content-center align-items-center h-100">
                <ul class="d-flex flex-column mb-0 align-items-left justify-content-evenly h-100 w-100 fs-5">
                    <li>
                        <p class="fs-5 fw-bold">Get in Touch</p>
                    </li>

                    @if($footer)
                        @if($footer->phone)
                            <li>
                                <div class="d-flex">
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-telephone me-2"></i>
                                    </div>
                                    <p>{{ $footer->phone }}</p>
                                </div>
                            </li>
                        @endif

                        @if($footer->email)
                            <li>
                                <div class="d-flex">
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-envelope me-2"></i>
                                    </div>
                                    <p>{{ $footer->email }}</p>
                                </div>
                            </li>
                        @endif

                        @if($footer->address)
                            <li>
                                <div class="d-flex">
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-geo-alt me-2"></i>
                                    </div>
                                    <p>{{ $footer->address }}</p>
                                </div>
                            </li>
                        @endif

                        <!-- Social Links -->
                        <li>
                            <div class="d-flex">
                                @if($footer->facebook)
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-facebook me-2"></i>
                                    </div>
                                @endif
                                @if($footer->instagram)
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-instagram me-2"></i>
                                    </div>
                                @endif
                                @if($footer->mail)
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-envelope me-2"></i>
                                    </div>
                                @endif
                                @if($footer->linkedin)
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-linkedin me-2"></i>
                                    </div>
                                @endif
                                @if($footer->youtube)
                                    <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                        <i class="bi bi-youtube me-2"></i>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @else
                        <li>
                            <div class="d-flex">
                                <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                    <i class="bi bi-telephone me-2"></i>
                                </div>
                                <p>+92 3 111 333 257</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <div class="icon-dv d-flex justify-content-center align-items-center me-2">
                                    <i class="bi bi-envelope me-2"></i>
                                </div>
                                <p>info@traveldementor.com</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Edit / Delete -->
        <div class="col-1 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-around align-items-center w-100">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#editFooterModal" class="" data-bs-toggle="modal" data-bs-target="#editFooterModal"
                        data-footer="{{ $footer ? $footer->toJson() : '{}' }}">
                        <i class="fa fa-pencil-square-o fs-5 text-white" aria-hidden="true"></i>
                    </a>
                </div>

                @if($footer)
                    <div class="bg-danger px-3 py-2 rounded">
                        <form action="{{ route('footer.destroy', $footer->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this footer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-style">
                                <i class="fa fa-trash fs-5"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </div>



    <div class="modal fade" id="createFooterModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Global Footer Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('footer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <!-- Logo -->
                        <div class="mb-3">
                            <label class="fw-bold">Footer Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>

                        <!-- Intro Text -->
                        <div class="mb-3">
                            <label class="fw-bold">Company Intro</label>
                            <textarea name="intro_text" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Newsletter -->
                        <div class="mb-3">
                            <label class="fw-bold">Newsletter Text</label>
                            <input type="text" name="newsletter_text" class="form-control" placeholder="Stay Updated">
                        </div>

                        <hr>

                        <!-- Company Links -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="fw-bold">Company Links</label>
                                <button type="button" id="addFooterLink" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Add Link
                                </button>
                            </div>

                            <div id="footerLinksContainer">
                                <div class="row mb-2 footer-link-row align-items-center mb-2">
                                    <div class="col-5">
                                        <input type="text" name="company_links[0][title]" class="form-control"
                                            placeholder="Link Title">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" name="company_links[0][url]" class="form-control"
                                            placeholder="/privacy-policy">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger removeFooterLink">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Contact Info -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="fw-bold">Address</label>
                                <textarea name="address" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Facebook</label>
                                <input type="text" name="facebook" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Instagram</label>
                                <input type="text" name="instagram" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Mail</label>
                                <input type="text" name="mail" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>LinkedIn</label>
                                <input type="text" name="linkedin" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>YouTube</label>
                                <input type="text" name="youtube" class="form-control">
                            </div>
                        </div>

                        <hr>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="fw-bold">Footer Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Footer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>






<div class="modal fade" id="editFooterModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Footer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editFooterForm" method="POST" enctype="multipart/form-data"
                action="{{ $footer ? route('footer.update', $footer->id) : '#' }}">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <!-- Logo -->
                    <div class="mb-3">
                        <label class="fw-bold">Footer Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if($footer && $footer->logo)
                            <img src="{{ asset('uploads/footer/' . $footer->logo) }}" class="mt-2 w-25">
                        @endif
                    </div>

                    <!-- Intro Text -->
                    <div class="mb-3">
                        <label class="fw-bold">Company Intro</label>
                        <textarea name="intro_text" class="form-control" rows="3">{{ $footer->intro_text ?? '' }}</textarea>
                    </div>

                    <!-- Newsletter -->
                    <div class="mb-3">
                        <label class="fw-bold">Newsletter Text</label>
                        <input type="text" name="newsletter_text" class="form-control"
                            value="{{ $footer->newsletter_text ?? '' }}" placeholder="Stay Updated">
                    </div>

                    <hr>

                    <!-- Company Links -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <label class="fw-bold">Company Links</label>
                            <button type="button" id="editAddFooterLink" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Add Link
                            </button>
                        </div>

                        <div id="editFooterLinksContainer">
                            @if($footer && $footer->company_links)
                                @foreach($footer->company_links as $index => $link)
                                    <div class="row mb-2 footer-link-row align-items-center">
                                        <div class="col-5">
                                            <input type="text" name="company_links[{{ $index }}][title]" class="form-control"
                                                value="{{ $link['title'] }}">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="company_links[{{ $index }}][url]" class="form-control"
                                                value="{{ $link['url'] }}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-danger removeFooterLink">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <hr>

                    <!-- Contact Info -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $footer->phone ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $footer->email ?? '' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="fw-bold">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ $footer->address ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $footer->facebook ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ $footer->instagram ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Mail</label>
                            <input type="text" name="mail" class="form-control" value="{{ $footer->mail ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ $footer->linkedin ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>YouTube</label>
                            <input type="text" name="youtube" class="form-control" value="{{ $footer->youtube ?? '' }}">
                        </div>
                    </div>

                    <hr>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="fw-bold">Footer Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ ($footer->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($footer->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Update Footer</button>
                </div>

            </form>
        </div>
    </div>
</div>








@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/footer.js') }}"></script>
@endpush