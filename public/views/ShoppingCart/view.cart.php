<?php $title = "Cart";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Shopping Cart</h1>
    </div>
</div>
<section id="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                            </div>
                            <div class="col-xs-6">
                                <a href="../../ShoppingCart/products/" class="btn btn-primary btn-sm pull-right">
                                    <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php if (count($products) === 0) : ?>
                    <h3>No stock Products!</h3>
                    <?php endif; ?>
                    <?php $total = 0; ?>
                    <?php foreach ($products as $item): ?>
                    <div class="row" id="item-<?php echo $item->id; ?>">
                        <div class="col-xs-2"><img class="img-responsive"
                                src="<?php echo PATH_IMAGES . '/'. $item->image; ?>">
                        </div>
                        <div class="col-xs-4 text-left">
                            <h4 class="product-name"><strong><?php echo $item->name; ?></strong></h4>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-8 text-right">
                                <h6><strong><?php echo $item->price; ?> <span class="text-muted">x</span></strong></h6>
                                <h4><small>Per <?php echo $item->unit; ?></small></h4>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control input-item" data-id="<?php echo $item->id; ?>"
                                    data-value="<?php echo $item->amount; ?>" data-price="<?php echo $item->price; ?>"
                                    min="1" name="amount" type="number"
                                    value="<?php echo $item->amount; ?>" id="in-<?php echo $item->id; ?>" />
                            </div>
                            <div class="col-xs-2">
                                <button type="button" class="btn btn-link btn-ms btn-item"
                                    data-id="<?php echo $item->id; ?>">
                                    <span class="glyphicon glyphicon-trash"> </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php $total = $total + ($item->price * $item->amount); ?>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="text-center">
                            <div class="col-xs-9">
                                <h4 class="text-right">Shipping method</h4>
                            </div>
                            <div class="col-xs-3">
                                <select class="form-control" id="shipping">
                                    <option value="-">Select One Option</option>
                                    <option value="0">Pick up (USD 0)</option>
                                    <option value="5">UPS (USD 5)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 class="text-right">Total <strong>$<span id="total"
                                        data-value="<?php echo $total; ?>"><?php echo $total; ?></span></strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" class="btn btn-success btn-pay btn-block" disabled>
                                Pay
                            </button>
                            <form id="frmPay" action="../../ShoppingCart/saveCart/" method="post">
                                <input type="hidden" name="totalPay" id="totalPay">
                                <input type="hidden" name="shippingPay" id="shippingPay">
                            </form>
                            <div id="msg" style="color: red; padding-bottom: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once PATH_TEMPLATE.'/footer.php';?>

<script type="text/javascript">
$(".input-item").bind('keyup mouseup', function() {
    if ($(this).val()) {
        var amount = parseInt($(this).data("value")) * parseFloat($(this).data("price"));
        var newAmount = parseInt($(this).val()) * parseFloat($(this).data("price"));
        $(this).data("value", $(this).val());
        $.post("../../ShoppingCart/sumAmount/", {
                id: $(this).data("id"),
                amount: $(this).val()
            })
            .done(function(data) {
                $("#items").text(data);
                var total = parseFloat($("#total").data("value"));
                total = total - amount;
                total = total + newAmount;
                $("#total").data("value", total);
                var shipping = $("#shipping").val();
                if (shipping !== "-") {
                    total = total + parseInt(shipping);
                }
                $("#total").text(total);
            });
    }
});

$(".btn-item").click(function() {
    var id = $(this).data("id");
    $.post("../../ShoppingCart/removeProduct/", {
            id
        })
        .done(function(data) {
            $("#items").text(data);
            var value = parseInt($("#in-" + id).data("value")) * parseFloat($("#in-" + id).data("price"));
            var total = parseFloat($("#total").data("value"));
            total = total - value;
            $("#total").data("value", total);
            $("div").remove("#item-" + id);
            $("#shipping").val("-");
        });
});

$("#shipping").change(function() {
    var value = $(this).val();
    if (value === "-") {
        $(".btn-pay").prop("disabled", true);
    } else {
        $(".btn-pay").prop("disabled", false);
        var total = parseFloat($("#total").data("value"));
        total = total + parseInt(value);
        $("#total").text(total);
    }
});

$(".btn-pay").click(function() {
    var total = $("#total").text();
    $.post("../../ShoppingCart/valideBalance/", {
            totalPay: total
        })
        .done(function(data) {
            console.log("data", data);
            if (parseInt(data)) {
                $("#totalPay").val($("#total").text());
                $("#shippingPay").val($("#shipping").val());
                $("#frmPay").submit();
            } else {
                $(".btn-pay").prop("disabled", true);
                $("#shipping").val("-");
                $("#msg").text("Balance Insufficient");
            }
        });        
});
</script>
</body>
</html>