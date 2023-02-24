$(document).ready(function () {
    // $.ajax({
    //     type: 'get',
    //     url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
    //     dataType: 'json',
    //     success: function(response) {
    //         console.log(response)
    //     }
    // })

    $("#sortingOption").change(function () {
        $eventOption = $("#sortingOption").val();
        // console.log($eventOption);
        if ($eventOption == "asc") {
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/user/ajax/pizza/list",
                data: {
                    status: "asc",
                },
                dataType: "json",

                success: function (response) {
                    // console.log(response[0].name)
                    $list = "";
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
                            </div>`;
                    }
                    $("#dataList").html($list);
                },
            });
        } else if ($eventOption == "desc") {
            $.ajax({
                type: "get",
                url: "http://127.0.0.1:8000/user/ajax/pizza/list",
                data: {
                    status: "desc",
                },
                dataType: "json",

                success: function (response) {
                    // console.log(response[0].name)
                    $list = "";
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
                            </div>`;
                    }
                    $("#dataList").html($list);
                },
            });
        }
    });
});
