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
                    {{-- <div class="  mt-2 ">
                        <div class="float-right ml-3 text-center col-1 offset-10 bg-white shadow-sm p-2">
                            <h3><i class="fa-solid fa-database me-1 "></i>{{ $order->total() }} </h3>
                        </div>
                    </div> --}}

                    <form action="{{ route('admin#changeStatus') }}" method="post">
                        @csrf

                        <div class="col-3 input-group mb-3">
                            <button class="btn bg-dark  text-white"><i class="fa-solid fa-database me-1 "></i>
                                {{ $order->total() }}
                            </button>
                            <select class="custom-select" name="orderStatus" id="orderStatus">
                                <option value="">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn p-1 input-group-text btn-sm bg-dark text-white">Search</button>
                            </div>
                        </div>
                    </form>







                    {{-- <form action="{{ route('admin#changeStatus') }}" method="post">
                        @csrf
                        <div class="d-flex">
                            <label class="p-2" for="">

                            </label>

                            <select class="custom-select col-2" name="orderStatus" id="orderStatus">
                                <option value="">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                </option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Success
                                </option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <button type="submit" class="btn ml-1 p-1 btn-sm bg-dark text-white">Search</button>
                        </div>
                    </form> --}}
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
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        {{-- <input type="hidden" value="{{ $o->order_id }}" name="" id="orderId"> --}}
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('Y-m-d') }}</td>
                                        <td><a
                                                href="{{ route('order#listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td id="amount">{{ $o->total_price }} $</td>
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
@section('scriptSection')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     console.log($status);
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/order/status',
            //         dataType: 'json',
            //         data: {
            //             'status': $status,
            //         },
            //         success: function(response) {
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 console.log(response[$i].created_at);

            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                        <select name="status" class="form-control statusChange text-center" id="">
        //                                     <option value="0" selected>
        //                                         Pending
        //                                     </option>
        //                                     <option value="1">
        //                                         Success
        //                                     </option>
        //                                     <option value="2">
        //                                         Reject
        //                                     </option>
        //                                 </select>
        //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                        <select name="status" class="form-control statusChange text-center" id="">
        //                                     <option value="0" >
        //                                         Pending
        //                                     </option>
        //                                     <option value="1" selected>
        //                                         Success
        //                                     </option>
        //                                     <option value="2">
        //                                         Reject
        //                                     </option>
        //                                 </select>
        //                     `;

            //                 } else {
            //                     $statusMessage = `
        //                        <select name="status" class="form-control statusChange text-center" id="">
        //                                     <option value="0" >
        //                                         Pending
        //                                     </option>
        //                                     <option value="1" >
        //                                         Success
        //                                     </option>
        //                                     <option value="2" selected>
        //                                         Reject
        //                                     </option>
        //                                 </select>
        //                     `;

            //                 }

            //                 // console.log(`${response[$i].name}`);
            //                 $list += `<tr class="tr-shadow">
        //                     <input type="hidden" value="${response[$i].order_id}" name="" id="orderId">
        //                             <td>${response[$i].user_id}</td>
        //                             <td>${response[$i].user_name}</td>
        //                             <td> ${response[$i] . created_at} </td>
        //                             <td> ${response[$i] . order_code} </td>
        //                             <td> ${response[$i] . total_price} $</td>
        //                             <td class="align-middle">
        //                             ${$statusMessage}
        //                             </td>

        //                         </tr>
        //                     `
            //             }
            //         }

            //     })


            // })

            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('#orderId').val();
                $price = Number($parentNode.find("#amount").text().replace(" $", ""));
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId,
                };
                // console.log($data);
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    dataType: 'json',
                    data: $data,
                });
                // window.location.href = '/admin/order/list';


            });
        })
    </script>
@endsection
