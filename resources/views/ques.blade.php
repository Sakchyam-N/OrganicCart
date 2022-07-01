@extends('layouts.header')
@section('title', 'FAQ')
@section('content')
<link rel="stylesheet" href="{{url('css/faqstyle.css')}}">

  <div class="faq-content">
    <div class="faq-question">
      <input id="q1" type="checkbox" class="panel" />
      <div class="plus">+</div>
      <label for="q1" class="panel-title">What is Organic cart?</label>
      <div class="panel-content">
        Organic cart is an e-commerce website which is made for easy accessibility of goods for the people of
        chelkshuddefax.
      </div>
    </div>

    <div class="faq-question">
      <input id="q2" type="checkbox" class="panel" />
      <div class="plus">+</div>
      <label for="q2" class="panel-title">Can I return my item if needed?</label>
      <div class="panel-content">
        Sorry the items can't be return.
      </div>
    </div>

    <div class="faq-question">
      <input id="q3" type="checkbox" class="panel" />
      <div class="plus">+</div>
      <label for="q3" class="panel-title">How do I know about the offers?</label>
      <div class="panel-content"> To know about the offers please turn on the notification button.</div>
    </div>
    </div>
  


  <div class="faq-question">
    <input id="q4" type="checkbox" class="panel" />
    <div class="plus">+</div>
    <label for="q4" class="panel-title">Where do I collect my product?</label>
    <div class="panel-content"> To collect your item it would be ideal if you visit our given location.</div>
  </div>
  </div>


  <div class="faq-question">
    <input id="q5" type="checkbox" class="panel" />
    <div class="plus">+</div>
    <label for="q5" class="panel-title">Which of your product are dairy-free?</label>
    <div class="panel-content">All products have description provided clearly , so do refer to it to know about the particular product<span class="More-txt"></span></div>
  </div>
  </div>

  <div class="faq-question">
    <input id="q6" type="checkbox" class="panel" />
    <div class="plus">+</div>
    <label for="q6" class="panel-title">Are your product fresh?</label>
    <div class="panel-content"> Yes absolutely, Our product are fresh and organic.</div>
  </div>
  </div>

  <div class="faq-question">
    <input id="q7" type="checkbox" class="panel" />
    <div class="plus">+</div>
    <label for="q7" class="panel-title">Do you deliver?</label>
    <div class="panel-content">No, We do not delivery but soon we will.</div>
  </div>
</div>

@endsection