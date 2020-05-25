<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo $image_top_header;
?>


<div class="mg-gallery-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mg-filter">
                    <form id="mg-filter">
                        <fieldset>
                            <label class="btn btn-dark btn-main">
                                <input type="radio" name="filter" value="all" checked="checked">
                                All
                            </label>
                            <?php
                            if ($room_types):
                                    foreach ($room_types as $k => $v):
                                            ?>
                                            <label class="btn btn-dark">
                                                <input type="radio" name="filter" value="<?php echo $v->room_type_name; ?>">
                                                <?php echo $v->room_type_name; ?>
                                            </label>
                                            <?php
                                    endforeach;
                            endif;
                            ?>
                        </fieldset>
                    </form>
                </div>

                <div class="row" id="mg-grid">
                    <?php
                    if ($rooms):
                            foreach ($rooms as $room):
                                    if (!$room->room_type->room_type_active)
                                    {
                                            continue;
                                    }
                                    ?>
                                    <figure class="col-md-4 mg-gallery-item" data-groups='["<?php echo $room->room_type->room_type_name; ?>"]'>
                                        <a href="<?php echo base_url('assets/images/rooms/' . $room->room_image); ?>" data-lightbox-gallery="rooms">
                                            <img src="<?php echo base_url('assets/images/rooms/' . $room->room_image); ?>" class="img-responsive" alt="room number <?php echo $room->room_number; ?>" />
                                            <span class="mg-gallery-overlayer">
                                                <i class="fa fa-search-plus"></i>
                                            </span>
                                        </a>
                                    </figure>
                                    <?php
                            endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
