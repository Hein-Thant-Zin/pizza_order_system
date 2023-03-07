@extends('user.layouts.master')


@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                {{-- <input type="hidden" value="{{ $c->pizza_price }}" id="price"> --}}
                                <td class="align-middle pl-5"><img class="img-thumbnail" style="height: 100px"
                                        src="{{ asset('storage/' . $c->image) }}" alt="" srcset=""></td>
                                <td class="align-middle"><input type="hidden" class="productId"
                                        value="{{ $c->product_id }}">
                                    <input type="hidden" class="cartId" value="{{ $c->cart_id }}">
                                    {{ $c->pizza_name }}
                                </td>

                                <input type="hidden" id="userId" value="{{ $c->user_id }}">
                                <td id="price" class="align-middle">{{ $c->pizza_price }} $</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty" value="{{ $c->qty }}"
                                            class="form-control form-control-sm bg-secondary border-0 text-center>                                                                                                                                                                      <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td id="total" class="align-middle">{{ $c->pizza_price * $c->qty }} $</td>
                                <td id="" class="align-middle"><button class="btn btnRemove btn-sm btn-danger"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} $</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">30 $</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="finalPrice">{{ $totalPrice + 30 }} $</h5>
                        </div>
                        <button id="orderBtn" class="btn orderBtn btn-block btn-primary font-weight-bold my-3 py-3">
                            Checkout</button>
                        <button id="clearCartBtn" class="btn btn-block btn-danger font-weight-bold my-3 py-3">
                            Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        // $('#orderBtn').click(function(index, row) {
        //     $orderList = [];
        //     $random = Math.floor(Math.random() * 1000001);
        //     $('#dataTable tbody tr').each(function(index, row) {
        //         $orderList.push({
        //             'user_id': $(row).find('#userId').val(),
        //             'product_id': $(row).find('#productId').val(),

        //         })
        //         console.log($orderList);
        //     })
        // })
        $('#orderBtn').click(function(index, row) {
            $orderList = [];
            $random = Math.floor(Math.random() * 1000000001);
            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').html().replace(' $', '') * 1,
                    'order_code': 'POS' + $random
                });
            });

            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',

                success: function(response) {

                    if (response.status == 'true') {
                        window.location.href = 'http://127.0.0.1:8000/user/homePage';
                    }
                }
            })

        })
        //when clear cart
        $('#clearCartBtn').click(function() {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clearCart',
                dataType: 'json',
            })
            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html("0 $");
            $('.finalPrice').html("30 $");

        })

        $('.btnRemove').click(function() {
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('.productId').val();
            $orderId = $parentNode.find('.cartId').val();
            // console.log($cart_id);

            $parentNode.remove();
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/clearCurrentProduct',
                dataType: 'json',
                data: {
                    'product_id': $productId,
                    'cart_id': $orderId,
                },


            });
            $totalPrice = 0;

            $("#dataTable tr").each(function(index, row) {
                $totalPrice += Number(
                    $(row).find("#total").text().replace(" $", "")
                );
            });
            $("#subTotalPrice").html($totalPrice + " $");
            $(".finalPrice").html($totalPrice + 30 + " $");
        })
    </script>
@endsection
