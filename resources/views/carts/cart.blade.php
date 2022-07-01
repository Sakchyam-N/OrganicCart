@extends('layouts.header')
@section('title', 'Cart')
@section('content')
    @push('head')
        <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
    @endpush
    <div class="container mt-md-5 border border-bottom-0">
        <div class="row">
            <div class="col">
                <table class="table">
                    @if (Session::get('status'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        hi
                    @endif
                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::get('paid'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('paid') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::get('pass'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('pass') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @php
                        use App\Models\Product_Offer;
                        
                        $cartid = 0;
                        $total = 0;
                        $totalprods = 0;
                    @endphp
                    @if (count($cartprods)>0)
                        <thead>
                            <tr>
                                <th scope="col-auto">S.N</th>
                                <th scope="col-auto">Product Image</th>
                                <th scope="col-auto">Product Name</th>
                                <th scope="col-auto">Quantity</th>
                                <th scope="col-auto">Price</th>
                                <th scope="col-auto">Total</th>
                                <th scope="col-auto">Delete</th>
                            </tr>
                        </thead>
                        <tbody>


                            @for ($count = 0; $count < count($products); $count++)
                                @for ($counts = 0; $counts < count($cartprods); $counts++)
                                    @if ($products[$count]->id == $cartprods[$counts]->product_id)
                                        <tr>
                                            <th scope="row">{{ $counts + 1 }}</th>
                                            <td><a
                                                    href="{{ route('frontProduct.prodDetail', ['frontProduct' => $products[$count]->id]) }}">
                                                    <img src="{{ url('uploadedimages/' . $products[$count]->product_image) }}"
                                                        alt="{{ $products[$count]->product_name }}" height="150px"
                                                        width="150px">
                                                </a>
                                            </td>
                                            <td>{{ $products[$count]->product_name }}</td>
                                            <td>
                                                <div class="row ">
                                                    <div class="col ">
                                                        <form
                                                            action="{{ route('carts.update', ['cart' => $cartprods[$counts]->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-sm-2">
                                                                <input type="number" name="quantity" class="form-control"
                                                                    value="{{ $cartprods[$counts]->total_product }}">
                                                                @error('quantity')
                                                                    <div class="form-label text-danger">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                                <input type="hidden" name="price"
                                                                    value="{{ $products[$count]->product_price }}">
                                                            </div>
                                                            <div class="col-sm-2 border border-grey"><button
                                                                    class="form-control" type="submit">Save</button></div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$
                                                @php
                                                    $prod_offers = Product_Offer::where('product_id', $products[$count]->id)->get();
                                                @endphp

                                                @if (count($prod_offers) > 0)
                                                    @php
                                                        $off = $prod_offers[0]->offer_percentage / 100;
                                                    @endphp
                                                    {{ round($products[$count]->product_price - $off * $products[$count]->product_price, 2) }}
                                                @elseif(count($prod_offers) < 1)
                                                    {{ $products[$count]->product_price }}
                                                @endif

                                            </td>

                                            <td>$ {{ $cartprods[$counts]->total_cost }}</td>
                                            @php
                                                $totalprods += $cartprods[$counts]->total_product;
                                                $total += $cartprods[$counts]->total_cost;
                                                $cartid = $cartprods[$counts]->cart_id;
                                            @endphp
                                            <td>
                                                <form method="post"
                                                    action="{{ route('carts.destroy', ['cart' => $products[$count]->id]) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endfor
                            @endfor

                            <tr>
                                <td class="border-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border border-dark"> Total: </td>
                                <td class="border border-dark">${{ $total }}</td>

                            </tr>
                            <tr>
                                <td class="border-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border-bottom-0 "></td>
                                <td class="border border-dark"> Total Items: </td>
                                <td class="border border-dark">${{ $total }}</td>

                            </tr>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container checkout-buttons mt-md-5  border-top border-grey">
        <div class="row justify-content-end pt-sm-2">
            <div class="col-md-2">
                <a href="{{ route('cust.index') }}" class="btn btn-outline-success" role="button">Continue Shopping</a>
            </div>

            <div class="col-md-3">
            <form method="POST" action="{{route('order.store')}}">
                @csrf
                <input type="hidden" name="amount" value="{{ $total }}">
                <input type="hidden" name="totalprod" value="{{ $totalprods }}">
                <input type="hidden" name="cartid" value="{{ $cartid }}">
                
                @php
                    date_default_timezone_set("Asia/Kathmandu");

                    switch (date('w')) {
                        case 0:
                            echo '
                            <h5>Wednesday '.date('d-m-y', strtotime('+3 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Wednesday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Wednesday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Wednesday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div><br>
                            <h5">Thursday '.date('d-m-y', strtotime('+4 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div><br>
                            <h5>Friday '.date('d-m-y', strtotime('+5 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Friday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Friday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Friday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>';
                            break;
                        case 1:
                            echo '
                            <h5>Wednesday '.date('d-m-y', strtotime('+2 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div><br>
                            <h5>Thursday '.date('d-m-y', strtotime('+3 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div><br>
                            <h5>Friday '.date('d-m-y', strtotime('+4 day')) .'</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>';
                            break;
                        case 2:
                            if (date('G') >= 0 && date('G') < 10) {
                                echo '
                                <h5>Wednesday '.date('d-m-y', strtotime('+1 day')) .' </h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div><br>
                                <h5>Thursday '.date('d-m-y', strtotime('+2 day')) .' </h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div><br>
                                <h5>Friday '.date('d-m-y', strtotime('+3 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>';
                            } elseif (date('G') >= 10 && date('G') < 12) {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')).'"-13"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')).'-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div><br>
                                <h5>Thursday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div><br>
                                <h5>Friday '. date('d-m-y', strtotime('+3 day')) .' </h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>';
                            }
                            else if(date('G')>=12 && date('G')<15)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+1 day')) .' </h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')).'"-13"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')).'-16</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div><br>
                                <h5>Thursday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+3 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=15 && date('G')<18)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-19"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')).'-19</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+3 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else
                            {
                                echo'
                                <h5>Wednesday '. date('d-m-y', strtotime('+8 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+3 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            break;
                        case 3:
                            if(date('G')>=0 && date('G')<10)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=10 && date('G')<12)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value=value='.date('G', strtotime('+1 hour')).'"-13"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')) .'-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=12 && date('G')<15)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Thursday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-16"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')).'-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=16 && date('G')<18)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-19"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')).'-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Thursday '. date('d-m-y', strtotime('+8 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+2 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            break;
                        case 4:
                            
                            if(date('G')>=0 && date('G')<10)
                            {
                                echo'
                                <h5>Wednesday '. date('d-m-y', strtotime('+6 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';

                            }
                            else if(date('G')>=10 && date('G')<12)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+6 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Thursday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value=value='.date('G', strtotime('+1 hour')).'"-13"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">' . date('G', strtotime('+1 hour')) .'-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=12 && date('G')<15)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+6 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Thursday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-16"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'. date('G', strtotime('+1 hour')) .'-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            else if(date('G')>=16 && date('G')<18)
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+6 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Thursday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(13-16) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>

                                <h5>Friday '. date('d-m-y', strtotime('+1 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-16"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <input type="radio" name="timeSlot" value='.date('G', strtotime('+1 hour')) .'"-16"."Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">'.date('G', strtotime('+1 hour')) .'-19</label>
                                </div>
                                ';
                            }
                            else
                            {
                                echo '
                                <h5>Wednesday '. date('d-m-y', strtotime('+6 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot">10-13</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Thursday '. date('d-m-y', strtotime('+7 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                <br>
                                <h5>Friday '. date('d-m-y', strtotime('+8 day')) .'</h5>
                                <div style="margin-left: 50px;">
                                    <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 10-13</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 13-16</label>
                                    <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                    <label for="timeSlot"> 16-19</label>
                                </div>
                                ';
                            }
                            break;
                        case 5:
                            echo '
                            <h5>Wednesday  '. date('d-m-y', strtotime('+5 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            <br>

                            <h5>Thursday  '. date('d-m-y', strtotime('+6 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            <br>
                            <h5>Friday  '. date('d-m-y', strtotime('+7 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            ';
                            break;
                        case 6:
                            echo '
                            <h5>Wednesday '. date('d-m-y', strtotime('+4 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            <br>

                            <h5>Thursday '. date('d-m-y', strtotime('+5 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            <br>

                            <h5>Friday '. date('d-m-y', strtotime('+6 day')). '</h5>
                            <div style="margin-left: 50px;">
                                <input type="radio" name="timeSlot" value="(10-13) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 10-13</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 13-16</label>
                                <input type="radio" name="timeSlot" value="(16-19) Thursday"'. date('d-m-y', strtotime('+6 day')).'>
                                <label for="timeSlot"> 16-19</label>
                            </div>
                            ';
                            break;
                        default:
                        
                    }
                @endphp
                @error('timeSlot')
                <div class="form-label text-danger">
                    {{ $message }}
                </div>
            @enderror
                @if($totalprods <= 20)
                <input type="submit" name="paynow" value="Order" class="btn btn-outline-warning">
                @else
                    <script>
                        alert('You cannot order more than 20 items!!');
                    </script>
                @endif
                
                <div class="col-md-2">
                    
                </div>
            </form>
             </div>


        </div>
    </div>
@else
<div class="row">
    <div class="col m-3">
        <h3 class="text-center"  >No items in cart</h3>
    </div>
</div>
    
    @endif


@endsection


