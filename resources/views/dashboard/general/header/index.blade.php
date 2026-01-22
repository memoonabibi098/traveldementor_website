@extends('dashboard.app')
@push('styles')
    {{--
    <link rel="stylesheet" href="{{ asset('css/dashboard/header.css') }}"> --}}
@endpush
@section('content')
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Header</h3>
        <div class="col-2 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="edit-del-icon px-3 py-2 rounded">
                    <a href="#createHeaderModal" class="text-white" data-bs-toggle="modal"
                        data-bs-target="#createHeaderModal">
                        Create <i class="fa fa-plus ms-2"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="header-link col-12 py-3 rounded">
        <ol class="mb-0">
            <li>
                <a href="{{ route('admin.header') }}" class="links-color">General / Header / Home</a>
            </li>
        </ol>
    </div>
    {{-- <div class="header-layout d-flex col-12 px-2 py-3 rounded my-4 header-link justify-content-around">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <div class="logo-div">
                <img src="{{ asset('images/website_images/home/dark-logo.webp') }}" class="w-100" alt="">
            </div>
        </div>
        <div class="col-7">
            <div class="menu-div d-flex justify-content-center align-items-center h-100">
                <ul class="d-flex mb-0 align-items-center justify-content-evenly h-100 w-100 fs-5">
                    <li>
                        <a href="" class="links-color">Home</a>
                    </li>
                    <li>
                        <a href="" class="links-color">About us</a>
                    </li>
                    <li>
                        <a href="" class="links-color">Services</a>
                    </li>
                    <li>
                        <a href="" class="links-color">Visa Status</a>
                    </li>
                    <li>
                        <a href="" class="links-color">Contact us</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="bg-color px-3 py-2 rounded">
                    <a href="" class=" text-white">Login / Signup</a>
                </div>
            </div>
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-around align-items-center w-100">
                <div class="edit-del-icon px-3 py-2  me-2 rounded">
                    <a href="" class="">
                        <i class="fa fa-pencil-square-o fs-5 text-white" aria-hidden="true"></i></a>
                </div>
                <div class="bg-danger px-3 py-2 rounded">
                    <a href="" class="">
                        <i class="fa fa-trash-o fs-5 text-white" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="header-layout d-flex col-12 px-2 py-3 rounded my-4 header-link justify-content-around">

        {{-- Logo --}}
        <div class="col-2 d-flex justify-content-center align-items-center">
            <div class="logo-div">
                <img src="{{ $header && $header->logo ? asset('uploads/' . $header->logo) : asset('images/website_images/home/dark-logo.webp') }}"
                    class="w-100" alt="">
            </div>
        </div>

        {{-- Menu --}}
        <div class="col-7">
            <div class="menu-div d-flex justify-content-center align-items-center h-100">
                <ul class="d-flex mb-0 align-items-center justify-content-evenly h-100 w-100 fs-5">
                    @if($header && $header->menus)
                        @foreach($header->menus as $menu)
                            <li>
                                <a href="{{ $menu['url'] ?? '#' }}" class="links-color">{{ $menu['title'] ?? '' }}</a>
                            </li>
                        @endforeach
                    @else
                        {{-- Fallback static menus --}}
                        <li><a href="" class="links-color">Home</a></li>
                        <li><a href="" class="links-color">About us</a></li>
                        <li><a href="" class="links-color">Services</a></li>
                        <li><a href="" class="links-color">Visa Status</a></li>
                        <li><a href="" class="links-color">Contact us</a></li>
                    @endif

                </ul>
            </div>
        </div>

        {{-- Header Button --}}
        <div class="col-2 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="bg-color px-3 py-2 rounded">
                    <a href="{{ $header->button_url ?? '#' }}" class="text-white">
                        {{ $header->button_text ?? 'Login / Signup' }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Edit/Delete Icons --}}
        <div class="col-1 d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-around align-items-center w-100">
                <div class="edit-del-icon px-3 py-2 me-2 rounded">
                    <a href="#editHeaderModal" data-bs-toggle="modal" data-id="{{ $header?->id ?? '' }}"
                        data-logo="{{ $header?->logo ? asset('uploads/' . $header->logo) : '' }}"
                        data-button_text="{{ $header?->button_text ?? '' }}"
                        data-button_url="{{ $header?->button_url ?? '' }}" data-status="{{ $header?->status ?? 0 }}"
                        data-menus='@json($header?->menus ?? [])'>
                        <i class="fa fa-pencil-square-o fs-5 text-white"></i>
                    </a>

                </div>

                @if($header)
                    <div class="bg-danger px-3 py-2 rounded">
                        <form action="{{ route('header.destroy', $header->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure?');">
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


    {{-- add modal --}}
    <div class="modal fade" id="createHeaderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Global Header Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('header.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <!-- 🔹 Logo Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Logo</h6>
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Recommended: PNG / WEBP (Transparent)</small>
                        </div>

                        <hr>

                        <!-- 🔹 Menu Items -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold">Menu Items</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="addMenu">
                                    <i class="fa fa-plus"></i> Add Menu
                                </button>
                            </div>

                            <div id="menuContainer">
                                <!-- Menu Row -->
                                <div class="row align-items-center mb-2 menu-row">
                                    <div class="col-md-5">
                                        <input type="text" name="menus[0][title]" class="form-control"
                                            placeholder="Menu Name (e.g. Home)">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="menus[0][url]" class="form-control"
                                            placeholder="Menu URL (/about)">
                                    </div>
                                    <div class="col-md-2 text-end">
                                        <button type="button" class="btn btn-danger btn-sm removeMenu">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <small class="text-muted">Menus will appear in the same order</small>
                        </div>

                        <hr>

                        <!-- 🔹 CTA Button -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Header Button</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="button_text" class="form-control" placeholder="Login / Signup">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Button URL</label>
                                    <input type="text" name="button_url" class="form-control" placeholder="/login">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- 🔹 Status -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Header Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        Save Header
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    {{-- Edit Modal --}}
    <div class="modal fade" id="editHeaderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Header</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- Form submits normally --}}
                    <form id="editHeaderForm" action="{{ $header ? route('header.update', $header->id) : '#' }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Logo --}}
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Logo</h6>
                            <input type="file" name="logo" class="form-control">
                            <img id="editHeaderLogoPreview"
                                src="{{ $header && $header->logo ? asset('uploads/' . $header->logo) : '' }}" class="mt-2"
                                width="150" style="{{ $header && $header->logo ? '' : 'display:none;' }}">
                        </div>

                        {{-- Menus --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold">Menu Items</h6>
                                <button type="button" class="btn btn-sm btn-primary" id="editAddMenu">
                                    <i class="fa fa-plus"></i> Add Menu
                                </button>
                            </div>

                            <div id="editMenuContainer">
                                @if($header && $header->menus)
                                    @foreach($header->menus as $index => $menu)
                                        <div class="row align-items-center mb-2 menu-row">
                                            <div class="col-md-5">
                                                <input type="text" name="menus[{{ $index }}][title]" class="form-control"
                                                    value="{{ $menu['title'] }}">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="menus[{{ $index }}][url]" class="form-control"
                                                    value="{{ $menu['url'] }}">
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <button type="button" class="btn btn-danger btn-sm removeMenu">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Button Text & URL --}}
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="button_text" class="form-control"
                                        value="{{ $header->button_text ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Button URL</label>
                                    <input type="text" name="button_url" class="form-control"
                                        value="{{ $header->button_url ?? '' }}">
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Header Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ ($header->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ($header->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Header</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
@push('scripts')
    <script src="{{ asset('js/dashboard/header.js') }}"></script>


@endpush