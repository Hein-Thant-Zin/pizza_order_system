$(document).ready(function () {
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace(" $", ""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " $");
        summaryCalculation();
    });
    $(".btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace(" $", ""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " $");
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
                $(row).find("#total").text().replace(" $", "")
            );
        });
        $("#subTotalPrice").html($totalPrice + " $");
        $(".finalPrice").html($totalPrice + 3000 + " $");
    }
});
