@php $stripeKey = ""; @endphp
@if(!blank($paymentGateways))
    @foreach($paymentGateways as $paymentGateway)
        @if($paymentGateway->slug === 'stripe')
            @php $paymentGatewayOption = $paymentGateway->gatewayOptions->pluck('value', 'option'); $stripeKey =$paymentGatewayOption['stripe_key'] @endphp
        @endif
    @endforeach
@endif

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripeKey = '<?= $stripeKey ?>';
    const orderRoute = '<?= route('payment.store', ['order' => $order]) ?>';
    const returnURL = '<?= route('payment.stripe.successful', ['order' => $order, 'transaction_no' => "transaction_no"]) ?>';
</script>
<script defer src="{{ asset('paymentGateways/stripe/stripe.js') }}"></script>
