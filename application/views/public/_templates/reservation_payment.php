<?php
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open(base_url('reservation/payment'));
?>
<!-- 33 payment-->
<div class="mg-available-rooms">
    <div class="row">
        <div class="col-md-8">
            <div class="mg-book-form-billing">
                <h2 class="mg-sec-left-title">Card Info</h2>
                <?php echo $message; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>Card Number</label>
                            <input name="card_number" value="<?php echo set_value('card_number') ?>" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mg-book-form-input">
                            <label>CVV</label>
                            <input name="card_cvv" value="<?php echo set_value('card_cvv') ?>" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mg-book-form-input">
                            <label>Expire</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <select name="card_expire_month" class="form-control">
                                        <option value="">Month</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="card_expire_year" class="form-control">
                                        <option value="">Year</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_submit('payment_later__btn', 'Pay Later', array('class' => 'btn btn-dark-main pull-right')) ?>
                <?php echo form_submit('payment__btn', 'Pay Now', array('class' => 'btn btn-dark-main pull-right')) ?>
            </div>
        </div>
        <?php echo $booking_details; ?>
    </div>
</div>                            
<!-- //33-->
<?php
echo form_close();
