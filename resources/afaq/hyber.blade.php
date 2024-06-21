<html>

<body>
    <style>
        body {
            background-color: #f6f6f5;
        }
    </style>


    <form action="{{config('app.APP_URL')}}/{{app()->getLocale()}}/checkout/pay/complete?payment_method_id={{request('payment_method_id')}}" class="paymentWidgets" data-brands="{{request('method_name' , 'VISA')}}"></form>


    <script src="https://code.jquery.com/jquery.js" type="text/javascript"></script>

    <script>
        var wpwlOptions = {
            style: "card",
            paymentTarget: "_top",
        }
    </script>

    <script async src="{{config('app.hyber_pay_url')}}/v1/paymentWidgets.js?checkoutId={{request('checkoutId')}}"></script>
</body>

</html>