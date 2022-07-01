@extends('layouts.header')
@section('title', 'Contact us')
@section('content')

<link rel="stylesheet" href="{{url('css/contact.css')}}" />
<section class="contact">
  <div class="content">
    <h2>Contact Us</h2>
    <p>
      Welcome to the <strong>Organic Cart </strong>website!! 
    </p>
    <p>Need to get touch with us!Please feel free to fill the form or you can always call us.</p>
  </div>
  <div class="container-con">
    <div class="contactInfo">
      <div class="box">
        <div class="icon">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
        </div>
        <div class="text">
          <h3>Address</h3>
          <p>Kendal<br />street 11, United Kingdom</p>
        </div>
      </div>
      <div class="box">
        <div class="icon">
          <i class="fa fa-phone" aria-hidden="true"></i>
        </div>
        <div class="text">
          <h3>Phone</h3>
          <p>+44-123456</p>
        </div>
      </div>
      <div class="box">
        <div class="icon">
          <i class="fa fa-envelope-o" aria-hidden="true"></i>
        </div>
        <div class="text">
          <h3>Email</h3>
          <p>OrganicCart@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="contactForm">
      <form action="">
        <h2>Send Message</h2>
        <div class="inputBox">
          <input type="text" required="required" />
          <span>Full Name</span>
        </div>
        <div class="inputBox">
          <input type="email" required="required" />
          <span>Email</span>
        </div>
        <div class="inputBox">
          <textarea required="required"></textarea>
          <span>Your Message...</span>
        </div>
        <div class="inputBox">
          <input type="submit" value="Send" />
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
