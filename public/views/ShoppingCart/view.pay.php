<?php $title = "Our Products";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User Balance</h1>
    </div>
</div>
<section id="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                Your Order was processed!
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-body panel-tw panel-content">
                    <div class="col-xs-5">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="alerts-heading tex text-size"><?php echo $result->total; ?></p>
                        <p class="alerts-text tex">Total Purchase</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-body panel-fb panel-content">
                    <div class="col-xs-5">
                        <i class="fa fa-dollar fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="alerts-heading tex text-size"><?php echo $result->previous; ?></p>
                        <p class="alerts-text tex">Previous Balance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-body panel-in panel-content">
                    <div class="col-xs-5">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="alerts-heading tex text-size"><?php echo $result->current; ?></p>
                        <p class="alerts-text tex">Actual Balance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default ">
                <div class="panel-body panel-dl panel-content">
                    <div class="col-xs-5">
                        <i class="fa fa-th-list fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="alerts-heading tex text-size"><?php echo $result->products; ?></p>
                        <p class="alerts-text tex">Available Products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once PATH_TEMPLATE.'/footer.php';?>
</body>

</html>