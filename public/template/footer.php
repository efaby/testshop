            </div>
            </div>
            <footer id="footer">
                <div class="center">
                    <p>
                        &copy; Efabyshop 2020
                    </p>
                </div>
            </footer>
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-login">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Login</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="../../Security/valide/" method="post">

                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" class="form-control" placeholder="Username" required="required"
                                        name="username" id="username">
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" class="form-control" placeholder="Password"
                                        required="required" name="password" id="password">
                                </div>

                                <div class="form-group">
                                    <input type="button" id="btn-login" class="btn btn-primary btn-block btn-lg"
                                        value="Login">
                                </div>
                            </form>
                            <div id="message" style="color: red; padding-bottom: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo PATH_JS; ?>/jquery-ui.min.js" type="text/javascript"></script>
            <script src="<?php echo PATH_JS; ?>/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo PATH_JS; ?>/app.js" type="text/javascript"></script>

            <script type="text/javascript">
$("#btn-login").click(function() {
    var username = $("#username").val();
    var password = $("#password").val();
    $.post("<?php echo URL_BASE; ?>Security/valide/", {
            username,
            password
        })
        .done(function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                $("#message").text(result.data);
            } else {
                location.href = result.data;
            }
        });
});

$(".close").click(function() {
    $("#message").text("");
});
            </script>