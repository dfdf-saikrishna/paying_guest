<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bootstrap_dir = base_url($bootstrap_dir);
?>

</div>	<!--/.main-->
<script src="<?php echo $bootstrap_dir; ?>/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/chart.min.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/chart-data.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/easypiechart.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/easypiechart-data.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/bootstrap-datepicker.js"></script>
<script src="<?php echo $bootstrap_dir; ?>/js/bootstrap-table.js"></script>
<script>
        $('#calendar').datepicker({
        });
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
