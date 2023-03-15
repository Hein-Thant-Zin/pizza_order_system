@extends('admin.layouts.master')
@section('title', 'Admin Order List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Orders List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button type="submit"
                                    class="btn  btn-active bg-dark au-btn au-btn-icon au-btn--green au-btn--small" <i
                                    class="zmdi zmdi-plus"></i> <i class="fa-solid fa-plus"></i>add product
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- alert box for pizzaSuccess --}}
                    @if (session('createSuccess'))
                        <div class=" col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- alert box for pizzaDelete --}}
                    @if (session('deleteSuccess'))
                        <div class=" col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                <strong><i class="fa-sharp fa-solid fa-circle-xmark"></i>
                                    {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary"> <span class="text-danger"> {{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class=" col-3 offset-6">
                            <form action="{{ route('admin#orderList') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" placeholder="Search.." value="{{ request('key') }}"
                                        class="mr-1 form-control">
                                    <button class=" btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>







                    <a class="text-black" href="{{ route('admin#orderList') }}"><i
                            class="fa-solid  fa-arrow-left-long mr-1"></i>Back</a>

                    <div class="row col-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h3> Order Info</h3> <small class="text-warning"> <i
                                        class="fa-sharp fa-solid fa-circle-exclamation"></i> Included delivery
                                    charge</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col"> <i class="fa-solid fa-user mr-2"></i> Customer Name </div>
                                    <div class="col">{{ strtoupper($orderList[0]->user_name) }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"> <i class="fa-solid fa-barcode mr-2"></i> Order Code</div>
                                    <div class="col">{{ $orderList[0]->order_code }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"> <i class="fa-solid fa-calendar-days mr-2"></i> Order Date</div>
                                    <div class="col">
                                        {{ $orderList[0]->created_at->format('Y-m-d') }} </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"> <i class="fa-solid fa-money-bill mr-2"></i> Total</div>
                                    <div class="col">
                                        {{ $order->total_price }} $
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive table-responsive-data2 text-center">

                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <td>QTY</td>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" value="{{ $o->order_id }}" name="" id="orderId">
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td class="col-2"><img class="img-thumbnail shadow-sm"
                                                src="{{ asset('storage/' . $o->product_image) }}" alt=""></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td id="amount">{{ $o->total }} $</td>
                                        <td>{{ $o->created_at->format('Y-m-d') }}</td>
                                        <td class="align-middle">
                                            <select name="status" class="form-control statusChange  text-center"
                                                id="">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending
                                                </option>

                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success
                                                </option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-3">
                        {{-- {{ for remaining the searching value after changing the paginate }} --}}
                        {{ $orderList->links() }}

                    </div>
                    {{-- @else --}}
                    {{-- <h2 class="mt-5 text-center align">There is no Product</h2> --}}
                    {{-- @endif --}}


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')

@endsection
