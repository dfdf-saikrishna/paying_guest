<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$bootstrap_dir = base_url($bootstrap_dir);
?>
<footer class="mg-footer">
    <div class="mg-footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="widget">
                        <h2 class="mg-widget-title">Contact US</h2>
                        <address><?php echo $this->config->item('address'); ?></address>
                        <p><?php echo $this->config->item('contact_number'); ?></p>
                        <p><a href="mailto:#"><?php echo $this->config->item('email'); ?></a></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="widget">
                        <h2 class="mg-widget-title">Social Media</h2>
                        <p><?php echo $this->config->item('footer_social_media') ?></p>
                        <ul class="mg-footer-social">
                            <?php if ($this->config->item('footer_facebook')): ?>
                                    <li><a href="<?php echo $this->config->item('footer_facebook') ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>

                            <?php if ($this->config->item('footer_twitter')): ?>
                                    <li><a href="<?php echo $this->config->item('footer_twitter') ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if ($this->config->item('footer_pinterest')): ?>
                                    <li><a href="<?php echo $this->config->item('footer_pinterest') ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php endif; ?>

                            <?php if ($this->config->item('footer_google_plus')): ?>
                                    <li><a href="<?php echo $this->config->item('footer_google_plus') ?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php endif; ?>

                            <?php if ($this->config->item('footer_rss')): ?>
                                    <li><a href="<?php echo $this->config->item('footer_rss') ?>"><i class="fa fa-rss"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mg-copyright">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <ul class="mg-footer-nav">
                        <?php foreach ($navigations as $k => $v): ?>
                                <li><a href="<?php echo base_url($k); ?>"><?php echo $v; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p>&copy; <?php echo $this->config->item('current_year'); ?> <?php echo $this->config->item('public_name'); ?> All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php echo $controller->resources_footer($bootstrap_dir); ?>
</body>
</html>