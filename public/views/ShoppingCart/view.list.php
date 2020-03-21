<?php $title = "Our Products";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Our Products</h1>
    </div>
</div>
<section id="content" style="width: 70%">
    <div class="row">
        <?php if (count($products) === 0) : ?>
        <h3>No stock Products!</h3>
        <?php endif; ?>
        <?php foreach ($products as $item): ?>
        <div class="col-sm-6 col-md-4">
            <div class="shop__thumb">
                <a href="#">
                    <div class="shop-thumb__img">
                        <img src="<?php echo PATH_IMAGES . '/'. $item->image; ?>" class="img-responsive" alt="...">
                    </div>
                    <h5 class="shop-thumb__title">
                        <?php echo $item->name; ?>
                    </h5>
                    <div class="shop-thumb__price">
                        <?php echo $item->price; ?>
                    </div>
                    <div><a href="#" onClick="addProduct(<?php echo $item->id; ?>, <?php echo $item->price; ?>, 1)"
                            class="btn btn-primary btn-sm"
                            <?php echo (!isset($_SESSION['SESSION_USER'])) ? "disabled" : ""; ?>><i
                                class="fa fa-shopping-cart"></i> Add</a></div>
                    <div id="rating-<?php echo $item->id; ?>">
                        <?php $j = intval ($item->rating); ?>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php $checked = ($i <= $j)? "checked" : ""; ?>
                        <span id="star-<?php echo $item->id; ?>-<?php echo $i; ?>"
                            class="fa fa-star <?php echo (isset($_SESSION['SESSION_USER'])) ? "letter" : ""; ?> <?php echo $checked; ?>"
                            onClick="addRating(<?php echo $item->id; ?>, <?php echo $i; ?>)"></span>
                        <?php endfor; ?>
                    </div>

                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<aside id="sidebar">
    <div id="nav-blog" class="sidebar-item">
        <h3>Cart Summary</h3>
        <a href="<?php echo URL_BASE; ?>ShoppingCart/cart/" class="btn btn-success"
            <?php echo (!isset($_SESSION['SESSION_USER'])) ? "disabled" : ""; ?>>View Cart</a>
    </div>

</aside>

<div class="clearfix"></div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>
<script type="text/javascript">
function addProduct(id, price, amount) {
    $.post("<?php echo URL_BASE; ?>ShoppingCart/addProduct/", {
            id,
            price,
            amount
        })
        .done(function(data) {
            $("#items").text(data);
        });
}

function addRating(id, value) {
    if ($("#star-" + id + "-" + value).hasClass("letter")) {
        $.post("<?php echo URL_BASE; ?>ShoppingCart/saveRating/", {
                id,
                value
            })
            .done(function(data) {
                for (i = 1; i <= 5; i++) {
                    $("#star-" + id + "-" + i).removeClass("checked");
                    if (i <= parseInt(data)) {
                        $("#star-" + id + "-" + i).addClass("checked");
                    }
                }
            });
    }
}
</script>
</body>
</html>