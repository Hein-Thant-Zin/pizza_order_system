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
                                    class="btn  btn-active au-btn au-btn-icon au-btn--green au-btn--small" <i
                                    class="zmdi zmdi-plus"></i> <i class="fa-solid fa-plus"></i>add product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon btn btn btn-active au-btn--green au-btn--small">
                                <i class="fa-solid fa-arrow-down"></i> CSV download
                            </button>
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


                            <h4 class=" text-secondary">Search Key : <span class="text-danger"> {{ request('key') }}</span>
                            </h4>
                        </div>

                        <div class=" col-3 offset-6">
                            <form action="{{ route('products#list') }}" method="GET">
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
                    <div class="  mt-2 ">
                        <div class="float-right ml-3 text-center col-1 offset-10 bg-white shadow-sm p-2">
                            <h3><i class="fa-solid fa-database me-1 "></i>{{ $order->total() }} </h3>
                        </div>
                    </div>
                    {{-- @if (count($categories) != 0)/ --}}
                    {{-- @if (count($pizzas) != 0) --}}
                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $l)
                                    <tr class="tr-shadow">
                                        <td>{{ $l->user_id }}</td>
                                        <td>{{ $l->user_name }}</td>
                                        <td>{{ $l->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $l->order_code }}</td>
                                        <td>{{ $l->total_price }} $</td>
                                        <td class="align-middle">
                                            <select name="status" class="form-control text-center" id="">
                                                <option value="0" @if ($l->status == 0) selected @endif>
                                                    Pending
                                                </option>

                                                <option value="1" @if ($l->status == 0) selected @endif>
                                                    Success
                                                </option>
                                                <option value="2" @if ($l->status == 0) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>

                                        {{-- <td>
                                            <div class="table-data-feature">
                                                <a href="">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>

                                                <a href="">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit "></i>
                                                    </button>
                                                </a>
                                                <a href="">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>

                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-3">
                        {{-- {{ for remaining the searching value after changing the paginate }} --}}
                        {{ $order->links() }}

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
