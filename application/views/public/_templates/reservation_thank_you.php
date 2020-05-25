<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 44 thank-you-->
<div class="mg-available-rooms">
    <div class="alert alert-success alert-dismissible clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="mg-alert-icon"><i class="fa fa-check"></i></div>
        <?php echo $result_; ?>
    </div>
    <div class="mg-cart-container mg-paid">
        <aside class="mg-widget mt50" id="mg-room-cart">
            <h2 class="mg-widget-title">Booking Details</h2>
            <div class="mg-widget-cart">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mg-cart-room">
                            <img src="<?php echo base_url($this->config->item('room_image_dir') . $room->room_image); ?>" alt="<?php echo $room->room_type->room_type_name; ?>" class="img-responsive">
                            <h3><?php echo $room->room_type->room_type_name; ?></h3>
                            <p><?php echo $room->room_description; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mg-payment-id">Your Payment ID: <?php echo $payment_id; ?></h3>
                        <div class="mg-widget-cart-row">
                            <strong>Check In:</strong>
                            <span><?php echo convert_date_($this->session->userdata('check_in')); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Check Out:</strong>
                            <span><?php echo convert_date_($this->session->userdata('check_out')); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Adults:</strong>
                            <span><?php echo $this->session->userdata('adult_count'); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Child:</strong>
                            <span><?php echo $this->session->userdata('child_count'); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Fullname:</strong>
                            <span><?php echo $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname'); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Email:</strong>
                            <span><?php echo $this->session->userdata('email'); ?></span>
                        </div>
                        <div class="mg-widget-cart-row">
                            <strong>Phone:</strong>
                            <span><?php echo $this->session->userdata('phone'); ?></span>
                        </div>

                        <div class="mg-cart-total">
                            <strong>Total:</strong>
                            <span>     
                                <?php echo $this->config->item('currency') ?>
                                <?php echo number_format((different_days_($this->session->userdata('check_in'), $this->session->userdata('check_out')) * $room->room_price)); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>
<!-- //44-->