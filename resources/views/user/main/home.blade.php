@extends('user.layouts.master')
<!-- Shop Start -->
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="bg-dark text-white rounded  py-3 px-3 d-flex align-items-center justify-content-between mb-3">
                            {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                            <a href="{{ route('user#home') }}"><label class="">Categories</label></a>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>

                        @foreach ($category as $c)
                            <a class="" href="{{ route('user#filter', $c->id) }}"><label
                                    class="w-100 pl-2 shadow-sm py-2" for="price-1">{{ $c->name }}</label></a>
                        @endforeach
                        <div class="px-3r">
                            <div
                                class="btn justify-content-center align-items-center text-black  d-flex bg-warning rounded-lg">
                                Order</div>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            {{-- <div class="row" id="dataList">
                @foreach ($pizza as $p)
                    <div class="col-lg-9 col-md-8">
                        <div class="row pb-3">
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                            alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a alt='Details' title="Details" class="btn btn-outline-dark btn-square"
                                                href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }}</h5>
                                            <h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>

                                <a href="{{ route('user#cart') }}">
                                    <button type="button" class="btn  position-relative">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                            {{ count($cart) }}

                                        </span>
                                    </button>
                                </a>

                            </div>
                            @if (session('changeSuccess'))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                        <strong><i class="fa-solid fa-check"></i>
                                            {{ session('changeSuccess') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row  mx-2 " id="dataList">

                        @foreach ($pizza as $p)
                            <div class="col-lg-4 bg-light shadow-current col-md-6 mb-5 col-sm-6 pb-1">
                                <div id="my form" class="product-item mx-2 mb-4">
                                    <div class="product-img  position-relative overflow-hidden">
                                        <img style="height: 270px;" class="img-fluid "
                                            src="{{ asset('storage/' . $p->image) }}">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a alt='Details' title="Details" class="btn btn-outline-dark btn-square"
                                                href="{{ route('pizza#details', $p->id) }}"><i
                                                    class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center ">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price }}</h5>
                                        <h6 class="text-muted ml-2"><del class="">65000 Kyats</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $.ajax({
            //     type: 'get',
            //     url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
            //     dataType: 'json',
            //     success: function(response) {
            //         console.log(response)
            //     }
            // })

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                // console.log($eventOption);
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',

                        success: function(response) {
                            // console.log(response[0].name)
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $list += `
                                <div class="col-lg-4 bg-light shadow-current col-md-6 mb-5 col-sm-6 pb-1">
                                <div id="my form" class="product-item mb-4">
                                    <div class="product-img  position-relative overflow-hidden">
                                        <img style="height: 270px;" class="img-fluid w-100"
                                            src="{{ asset('storage/${response[$i].image}') }}">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a alt='Details' title="Details" class="btn btn-outline-dark btn-square"
                                                href="{{ route('pizza#details', $p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-center ">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        <h6 class="text-muted ml-2"><del class="">65000 Kyats</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>`
                            }
                            $('#dataList').html($list);
                        }
                    })

                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',

                        success: function(response) {
                            // console.log(response[0].name)
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $list += `
                                <div class="col-lg-4 bg-light shadow-current col-md-6 mb-5 col-sm-6 pb-1">
                                <div id="my form" class="product-item mb-4">
                                    <div class="product-img  position-relative overflow-hidden">
                                        <img style="height: 270px;" class="img-fluid w-100"
                                            src="{{ asset('storage/${response[$i].image}') }}">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a alt='Details' title="Details" class="btn btn-outline-dark btn-square"
                                                href="{{ route('pizza#details', $p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-center ">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        <h6 class="text-muted ml-2"><del class="">65000 Kyats</del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>`
                            }
                            $('#dataList').html($list);
                        }
                    })

                }
            })
        })
    </script>
@endsection
