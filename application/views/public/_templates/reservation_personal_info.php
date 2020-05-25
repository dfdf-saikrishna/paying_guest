<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open(base_url('reservation/personal-info'));
?>
<!-- 22 personal-info -->
<div class="mg-available-rooms">
    <div class="row">
        <div class="col-md-8">
            <div class="mg-book-form-personal">

                <h2 class="mg-sec-left-title">Personal Info</h2>
                <?php echo $message; ?>
                <div class="row pb40">
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>First Name</label>
                            <input name="firstname" value="<?php echo set_value('firstname') ?>" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>Last Name</label>
                            <input name="lastname" value="<?php echo set_value('lastname') ?>" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <h2 class="mg-sec-left-title">Account Info</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>Phone</label>
                            <input name="phone" value="<?php echo set_value('phone') ?>" type="tel" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>Email Address</label>
                            <input name="email" value="<?php echo set_value('email') ?>" type="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="clearfix mg-terms-input">
                    <div class="pull-right">
                        <label><?php echo form_checkbox('personal_info_check_box','accept') ?> By Sign up you are agree with our <a href="#">terms and condition</a></label>
                    </div>
                </div>
                <?php echo form_submit('persona_info_btn', 'Next', array('class' => 'btn btn-dark-main pull-right')) ?>
            </div>
        </div>
        <?php echo $booking_details; ?>
    </div>
</div>
<!-- //22 -->
<?php
echo form_close();
