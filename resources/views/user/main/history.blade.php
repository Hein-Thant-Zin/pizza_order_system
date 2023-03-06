@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid " style="height:400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-lg-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }} $</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text-warning ">Pending... <i class="fa-solid fa-spinner"></i></span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success ">Success <i class="fa-solid fa-check"></i></span>
                                    @elseif ($o->status == 2)
                                        <span class="text-danger ">Reject <i class="fa-solid fa-xmark"></i></span>
                                    @endif
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <span>{{ $order->links() }}</span>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
