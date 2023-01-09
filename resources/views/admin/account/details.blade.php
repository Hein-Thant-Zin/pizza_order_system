@extends('admin.layouts.master')
@section('title', 'account-details')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="section__content section__content--p30">

            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-1 offset-2 bg-danger">12</div>
                </div> --}}
                <div class="row">
                    <div class=" col-7 offset-4 ">
                        @if (session('UpdateSuccess'))
                            <div class=" col-4 offset-8">
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <strong><i class="fa-solid fa-check"></i>
                                        {{ session('UpdateSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-1 offset-10">
                                <a href="{{ route('category#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class=" card ">
                                <div class=" card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-3">Account Information
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if (Auth::user()->image == null)
                                                <img
                                                    src="{{ asset('admin/images/default_user.png') }} "class='img-thumbnail shadow-sm' />
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class='img-thumbnail shadow-sm' />
                                            @endif
                                        </div>
                                        <div class="col-5  offset-2">
                                            <h4 class="my-3"><i
                                                    class=" fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                            <h4 class=" my-3"><i
                                                    class="fa-solid fa-venus-mars me-2"></i>{{ Auth::user()->gender }}</h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="{{ route('admin#edit') }}">
                                            <div class="col-3 offset-5  mt-3">
                                                <button type="submit" class=" btn btn-dark">
                                                    <i class=" fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection
