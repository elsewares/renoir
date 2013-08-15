<form action="<?php echo $url ?>" method="post" id="firstData_POST" target="_new"/>
    <input type="hidden" name="txntype" value="sale" />
    <input type="hidden" name="storename" value="<?php echo $storename ?>" />
    <input type="hidden" name="mode" value="PayOnly" />
    <input type="hidden" name="chargetotal" value="<?php echo $total ?>" />
    <input type="hidden" name="order_id" value="<?php echo $order_id ?>" />
    <input type="hidden" name="client_id" value="<?php echo $client_id ?>" />
    <input type="submit" name="submit" class="btn btn-danger span2 payment_submit" value="Process Payment" />
</form>
<!--    <input type="hidden" name="oid" value="<?php echo $order_id ?>" />
    <input type="hidden" name="subtotal" value="<?php echo $total - $taxes ?>" />
    <input type="hidden" name="tax" value="<?php echo $taxes ?>" />
    <input type="hidden" name="userid" value="<?php echo $user_id ?>" /> -->