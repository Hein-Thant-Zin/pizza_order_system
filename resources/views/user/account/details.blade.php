@extends('user.layouts.master')
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
                    <div class=" col-10  offset-1 ">
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

                        <div class="col-lg-10 offset-1">
                            <div class=" card ">
                                <div class=" card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-3">Account Information
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if (Auth::user()->image != null)
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                    class='img-thumbnail shadow-sm' />
                                            @elseif (Auth::user()->gender == 'female')
                                                <img src="{{ asset('admin/images/default_female.png') }}" alt=""
                                                    srcset="">
                                            @else
                                                <img src="{{ asset('admin/images/default_user.png') }}" alt=""
                                                    srcset="">
                                            @endif
                                        </div>
                                        <div class="col-5  offset-2">
                                            <h4 class="my-3"><i
                                                    class=" fa-solid fa-user-pen mr-2"></i>{{ Auth::user()->name }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-envelope mr-2"></i>{{ Auth::user()->email }}</h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-phone mr-2"></i>{{ Auth::user()->phone }}</h4>
                                            <h4 class=" my-3"><i
                                                    class="fa-solid fa-venus-mars mr-2"></i>{{ Auth::user()->gender }}</h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-address-card mr-2"></i>{{ Auth::user()->address }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-user-clock mr-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <a href="{{ route('user#edit') }}">
                                        <div class="col-3 offset-5  mt-3">
                                            <button type="submit" class="rounded btn btn-dark">
                                                <i class=" fa-solid fa-pen-to-square mr-2"></i>Edit Profile</button>
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

    <!-- END MAIN CONTENT-->
@endsection
