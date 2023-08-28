
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Payment Demo</title>
</head>
<body>
    <?php
       $amount = str_replace(".","",$point_movement->price);
        ?>
<form id="payment-form" action="https://sandbox-cdnv3.chillpay.co/Payment/" method="post" role="form" class="form-horizontal">
<modernpay:widget id="modernpay-widget-container"
data-merchantid="M033930" data-amount="{{$amount}}" data-orderno="{{$payment->id}}" data-customerid="{{$payment->customer_id}}"
data-mobileno="" data-clientip="125.26.175.70" data-custemail="{{$customer->email}}" data-lang="TH" data-routeno="1" data-currency="764"
data-description="{{$point_movement->name}}" data-apikey="rE9Dkzl3kblUsjcIEE43H3SxlC3gjouikHDRWtQKrnLGAULC4CNnLIOgttTrreTD">
</modernpay:widget>
<button type="submit" id="btnSubmit" value="Submit" class="btn">Payment</button>
</form>
<script async src="https://sandbox-cdnv3.chillpay.co/js/widgets.js?v=1.00" charset="utf-8"></script>
</body>
</html>
