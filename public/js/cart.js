$(document).ready(function () {
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace(" Ks", ""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " Ks");
        summaryCalculation();
    });
    $(".btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace(" Ks", ""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " Ks");
        summaryCalculation();
    });
    $(".btnRemove").click(function () {
        $parentNode = $(this).parents("tr");
        $parentNode.remove();
        summaryCalculation();
    });

    function summaryCalculation() {
        $totalPrice = 0;

        $("#dataTable tr").each(function (index, row) {
            $totalPrice += Number(
                $(row).find("#total").text().replace(" Ks", "")
            );
        });
        $("#subTotalPrice").html($totalPrice + " Ks");
        $(".finalPrice").html($totalPrice + 3000 + " Ks");
    }
});
