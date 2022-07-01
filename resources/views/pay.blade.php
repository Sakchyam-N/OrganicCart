@extends('layouts.header')
@section('title', 'Order successful')
@section('content')
    <div class="container ">
        <div class="row d-flex justify-content-center ">
            <div class="col-auto border border-success p-3">
                <h2>Order Placed Successfully</h2>
                <p>
                    Your order was placed successfully. <br>
                    Total charge: $ {{$orders}}<br>
                    You can collect your items after payment at below date. <br>    
                    Collection details: {{$collection}}<br>
                </p>
            </div>
        </div>
        <div class="row d-flex justify-content-center  p-2">
            <div class="col-auto  me-5">
                <h3>Pay now</h3>
                <div id="paypal-button-container"></div>
            </div>

            <div class="col-auto ">
                <h3>Pay Later</h3>
                <a href="{{url('/')}}" role="button" class="btn btn-success btn-sm"> Home page</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AXC_Ex60IXpQ0NzZfa1_4v2cUt2LDRt7y2wuHrE0Gay9AXDqb8kVzPdL9gSKIcs3lSlB1C3RFF-W5oWi&currency=USD">
    </script>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{$orders}}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {

                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    //alert(
                    //`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`
                    //'done'
                    //);
                    
                    location.replace('http://127.0.0.1:8000/paid/{{{$order}}}');



                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
