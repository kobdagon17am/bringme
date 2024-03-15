{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Demo</title>
</head>

<body>
    <?php
    //    $amount = str_replace(".","",$point_movement->price);
    $amount = 0;
    ?>
    <form id="payment-form" action="https://sandbox-cdnv3.chillpay.co/Payment/" method="post" role="form"
        class="form-horizontal">
        <modernpay:widget id="modernpay-widget-container" data-merchantid="M033930" data-amount="10000"
            data-orderno="00000001" data-customerid="123456" data-mobileno=""
            data-clientip="125.26.175.70" data-custemail="warawut140@gmail.com" data-lang="TH" data-routeno="1"
            data-currency="764" data-description="Test Payment"
            data-apikey="QFUbuOg6OrRzigvXaspcULOw95GczT1GCdc3CnBHQRxJDKNYuKlW1FvGIBYWrs9U">
        </modernpay:widget>
        <button type="submit" id="btnSubmit" value="Submit" class="btn">Payment</button>
    </form>
    <script async src="https://sandbox-cdnv3.chillpay.co/js/widgets.js?v=1.00" charset="utf-8"></script>
</body>

</html> --}}




<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Demo</title>

    <style>
        /* .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        } */
    </style>

</head>

<body>

    <div class="container">
        <div class="Centerdive">
            <form id="payment-form" action="https://sandbox-cdnv3.chillpay.co/Payment/" method="post" role="form"
                class="form-horizontal">
                <modernpay:widget id="modernpay-widget-container" data-merchantid="M034461" data-amount="{{ ($cart->grand_total*100) }}"
                    data-orderno="{{ $cart->id }}" data-customerid="{{ $cart->customer_id }}" data-mobileno="{{ $customer_cart_address->tel }}"
                    data-clientip="101.109.170.201" data-routeno="1" data-currency="764" data-description="{{ $cart->order_number }}" data-lang="TH"
                    data-apikey="QFUbuOg6OrRzigvXaspcULOw95GczT1GCdc3CnBHQRxJDKNYuKlW1FvGIBYWrs9U">
                </modernpay:widget>
                {{-- <button type="submit" id="btnSubmit" value="Submit" class="btn">Payment</button> --}}
            </form>
        </div>
    </div>

    {{-- <div class="container">
        <div class="Centerdive">
            <form id="payment-form" action="https://sandbox-cdnv3.chillpay.co/Payment/" method="post" role="form"
                class="form-horizontal">
                <modernpay:widget id="modernpay-widget-container" data-merchantid="M034461"
                    data-amount="{{ ($cart->grand_total*100) }}" data-orderno="{{ $cart->order_number }}"
                    data-customerid="{{ $cart->customer_id }}" data-mobileno="{{ $customer_cart_address->tel }}"
                    data-routeno="1" data-currency="764" data-description="Test Payment"
                    data-apikey="QFUbuOg6OrRzigvXaspcULOw95GczT1GCdc3CnBHQRxJDKNYuKlW1FvGIBYWrs9U">
                </modernpay:widget>
            </form>
        </div>
    </div> --}}

    <script async src="https://sandbox-cdnv3.chillpay.co/js/widgets.js?v=1.00" charset="utf-8"></script>
</body>

</html>
