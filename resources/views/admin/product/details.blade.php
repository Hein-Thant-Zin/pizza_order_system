@extends('admin.layouts.master')
@section('title', 'Product-details')

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
                        <div class="row">

                            <div class="col-1 offset-10">
                                <a href="{{ route('products#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-10 offset-1">
                            <div class=" card ">
                                <div class=" card-body">
                                    <div class="card-title">

                                    </div>
                                    <div class="row">
                                        {{-- @foreach ($pizza as $p) --}}
                                        <div class="col-3 offset-1">

                                            <img src="{{ asset('storage/' . $pizza->image) }}"
                                                class='img-thumbnail shadow-sm' />

                                        </div>
                                        <div class="col-5  offset-2">
                                            <h4 class="my-3"><i class=" fa-solid fa-user-pen me-2"></i>{{ $pizza->name }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class="fa-solid fa-money-bill me-2"></i>{{ $pizza->price }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }}
                                            </h4>

                                            <h4 class=" my-3"><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-user-clock me-2"></i>{{ $pizza->created_at }}
                                            </h4>
                                            <h4 class=" my-3"><i
                                                    class=" fa-solid fa-envelope me-2"></i>{{ $pizza->description }}
                                            </h4>
                                        </div>
                                        {{-- @endforeach --}}
                                    </div>
                                    <div class="row">
                                        <a href="{{ route('product#edit', $pizza->id) }}">
                                            <div class="col-3 offset-5  mt-3">
                                                <button type="submit" class=" btn btn-dark">
                                                    <i class=" fa-solid fa-pen-to-square me-2"></i>Edit Pizza</button>
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