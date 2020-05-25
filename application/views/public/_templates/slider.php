<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="mega-slider" class="carousel slide " data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#mega-slider" data-slide-to="0" class="active"></li>
        <li data-target="#mega-slider" data-slide-to="1"></li>
        <li data-target="#mega-slider" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active beactive">
            <img src="<?php echo $bootstrap_dir; ?>images/slide-4.png" alt="...">
            <div class="carousel-caption">
                <img src="<?php echo $bootstrap_dir; ?>images/stars.png" alt="">
                <h2>Welcome to <?php echo $this->config->item('public_name'); ?></h2>
                <p><?php echo $this->config->item('first_sub_desc'); ?></p>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo $bootstrap_dir; ?>images/slide-2.png" alt="...">
            <div class="carousel-caption">
                <img src="<?php echo $bootstrap_dir; ?>images/stars.png" alt="">
                <h2><?php echo $this->config->item('second_desc'); ?></h2>
                <p><?php echo $this->config->item('second_sub_desc'); ?></p>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo $bootstrap_dir; ?>images/slide-3.png" alt="...">
            <div class="carousel-caption">
                <img src="<?php echo $bootstrap_dir; ?>images/stars.png" alt="">
                <h2><?php echo $this->config->item('third_desc'); ?></h2>
                <p><?php echo $this->config->item('third_sub_desc'); ?></p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#mega-slider" role="button" data-slide="prev">
    </a>
    <a class="right carousel-control" href="#mega-slider" role="button" data-slide="next">
    </a>
</div>