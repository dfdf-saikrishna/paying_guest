<?php
defined('BASEPATH') or exit('no direct script allowed');
$title         = 'Log in | ' . $this->config->item('public_name');
$bootstrap_dir = base_url($bootstrap_dir);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>
        <link href="<?php echo base_url('assets/images/icon.png'); ?>" rel="shortcut icon" type="image/x-icon" />

        <link href="<?php echo $bootstrap_dir; ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $bootstrap_dir; ?>css/datepicker3.css" rel="stylesheet">
        <link href="<?php echo $bootstrap_dir; ?>css/styles.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading"><?php echo $title; ?></div>
                    <div class="panel-body">
                        <?php echo form_open(current_url(), array('role' => 'form')) ?>
                        <fieldset>                            
                            <?php echo (!is_null($message)) ? '<div class="form-group">' . $message . '</div>' : ''; ?>                            
                            <div class="form-group">
                                <?php echo form_input($identity); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_password($password); ?>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox($remember) . 'Remember Me'; ?>
                                </label>
                            </div>
                            <?php
                            echo form_submit('save', 'Login', array(
                                'class' => 'btn btn-primary'
                            ));
                            ?>
                        </fieldset>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
        <script src="<?php echo $bootstrap_dir; ?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/chart.min.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/chart-data.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/easypiechart.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/easypiechart-data.js"></script>
        <script src="<?php echo $bootstrap_dir; ?>js/bootstrap-datepicker.js"></script>
        <script>
                !function ($) {
                    $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                        $(this).find('em:first').toggleClass("glyphicon-minus");
                    });
                    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
                }(window.jQuery);

                $(window).on('resize', function () {
                    if ($(window).width() > 768)
                        $('#sidebar-collapse').collapse('show')
                })
                $(window).on('resize', function () {
                    if ($(window).width() <= 767)
                        $('#sidebar-collapse').collapse('hide')
                })
        </script>	
    </body>

</html>

