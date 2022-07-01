@extends('layouts.cusprofheader')
@section('title', 'My orders')
@section('content')

<div class="col">
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Order No</th>
        <th scope="col">Products</th>
        <th scope="col">Total charge</th>
        <th scope="col">Order Date</th>
        <th scope="col">Order Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr> 
            {{-- $order->order_products->products->product_name --}}
            <th scope="row">{{$order->id}}</th>
            <td>
                @for($i=0;$i<count($orderprods);$i++)
                    @for($j=0;$j<count($products);$j++)
                        @if($orderprods[$i]->order_id==$order->id &&$orderprods[$i]->product_id == $products[$j]->id)
                            {{$products[$j]->product_name}} | 
                        @endif
                    @endfor
                @endfor
            </td>
            <td>{{$order->total_charge}}</td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
            <td>{{$order->status}}</td>
            @if($order->status == "Pending")
                <td> 
                  <div class="col-sm-1">
                  <div id="paypal-button-container">
                    </div> 
                  </div>
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
                            value: '{{$order->total_charge}}' // Can also reference a variable or function
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
                    
                    location.replace('http://127.0.0.1:8000/paid/{{{$order->id}}}');



                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }
        }).render('#paypal-button-container');
    </script>
                </td>
            @else
                <td>---</td>
            @endif
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection