<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo $image_top_header;
?>

<div class="mg-page">
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <h2 class="mg-sec-left-title">Send an E-mail</h2>
                <?php echo $result; ?>
                <?php echo form_open(current_url(), array('class' => 'clearfix')) ?>
                <div class="mg-contact-form-input">
                    <label for="full-name">Full Name</label>
                    <?php echo form_input('fullname', set_value('fullname'), array('class' => 'form-control', 'id' => 'full-name')) ?>
                </div>
                <div class="mg-contact-form-input">
                    <label for="email">E-mail</label>
                    <?php echo form_input('email', set_value('email'), array('class' => 'form-control', 'id' => 'email')) ?>
                </div>
                <div class="mg-contact-form-input">
                    <label for="subject">Subject</label>
                    <?php echo form_input('subject', set_value('subject'), array('class' => 'form-control', 'id' => 'subject')) ?>
                </div>
                <div class="mg-contact-form-input">
                    <label for="subject">Message</label>
                    <textarea name="message" class="form-control" id="subject" rows="5"><?php echo set_value('message'); ?></textarea>
                </div>
                <input type="submit" class="btn btn-dark-main pull-right" value="Send">
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-7">
                <h2 class="mg-sec-left-title">Office Address</h2>
                <p><?php echo $this->config->item('contact_long_description') ?></p>
                <ul class="mg-contact-info">
                    <li><i class="fa fa-map-marker"></i> <?php echo $this->config->item('address') ?></li>
                    <li><i class="fa fa-phone"></i> <?php echo $this->config->item('contact_number') ?></li>
                    <li><i class="fa fa-envelope"></i> <a href="mailto:#"><?php echo $this->config->item('email') ?></a></li>
                </ul>
                <!--                <div id="mg-map" class="mg-map"></div>-->
            </div>
        </div>
    </div>
</div>