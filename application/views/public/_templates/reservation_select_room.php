<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 11 select-room-->
<div class="mg-available-rooms">
    <h2 class="mg-sec-left-title">Available Rooms</h2>
    <div class="mg-avl-rooms">
        <?php
        if ($rooms):
                foreach ($rooms as $room):
                        if (!$room->room_type->room_type_active)
                        {
                                continue;
                        }
                        ?>
                        <div class="mg-avl-room">
                            <div class="row">
                                <div class="col-sm-5">
                                    <a href="#"><img src="<?php echo base_url($this->config->item('room_image_dir') . $room->room_image); ?>" alt="" class="img-responsive"></a>
                                </div>
                                <div class="col-sm-7">
                                    <h3 class="mg-avl-room-title"><a href="#"><?php echo $room->room_type->room_type_name; ?></a>
                                        <?php
                                        list($price_1, $price_2) = explode('.', $room->room_price);
                                        ?>
                                        <span><?php echo $this->config->item('currency') . number_format($price_1); ?><sup>.<?php echo $price_2; ?></sup>/Night</span></h3>
                                    <p><?php echo $room->room_description; ?></p>
                                    <div class="row mg-room-fecilities">
                                        <div class="col-sm-6">
                                            <ul>
                                                <li><i class="fp-ht-bed"></i> <?php echo $room->room_bed_count; ?> Beds</li>

                                                <?php if ($room->room_has_breakfast): ?>
                                                        <li><i class="fp-ht-food"></i> Breakfast</li>
                                                <?php endif; ?>

                                                <?php if ($room->room_has_aircon): ?>
                                                        <li><i class="fa fa-sun-o"></i> Air conditioning</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul>
                                                <?php if ($room->room_has_gym): ?>
                                                        <li><i class="fp-ht-dumbbell"></i> GYM fecility</li>
                                                <?php endif; ?>

                                                <?php if ($room->room_has_tvlcd): ?>
                                                        <li><i class="fp-ht-tv"></i> TV LCD</li>
                                                <?php endif; ?>

                                                <?php if ($room->room_has_wifi): ?>
                                                        <li><i class="fp-ht-computer"></i> Wi-fi service</li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('reservation/check-in/?room-id=' . $room->room_id); ?>" class="btn btn-main">Select This Room</a>
                                </div>
                            </div>
                        </div>
                        <?php
                endforeach;
        endif;
        ?>
    </div>
</div>
<!-- //11 -->