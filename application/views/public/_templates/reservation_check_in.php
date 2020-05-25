<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div role="tabpanel" class="tab-pane fade in active" id="select-room">
    <div class="mg-saerch-room">
        <div class="mg-book-now mt80">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mg-bn-title">Search Rooms <span class="mg-bn-big">For rates & availability</span></h2>
                </div>
                <div class="col-md-9">
                    <div class="mg-bn-forms">
                        <?php
                        echo form_open(current_url() . '/?room-id=' . $room_id);
                        echo $message;
                        ?>
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group date mg-check-in">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input name="check_in" type="text" class="form-control" id="exampleInputEmail1" placeholder="Check In" value="<?php echo set_value('check_in'); ?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group date mg-check-out">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input name="check_out" type="text" class="form-control" id="exampleInputEmail1" placeholder="Check Out" value="<?php echo set_value('check_out'); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row"> 
                                    <div class="col-xs-6">
                                        <?php
                                        echo form_dropdown(
                                                'adult_count', combo_number_public(1, 4, 'Adult', set_value('adult_count')), set_value('adult_count'), array('class' => 'cs-select cs-skin-elastic')
                                        );
                                        ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php
                                        echo form_dropdown(
                                                'child_count', combo_number_public(0, 4, 'Child', set_value('child_count')), set_value('child_count'), array('class' => 'cs-select cs-skin-elastic')
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-main btn-block">Check Now</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
