@extends('main')
@section('title','Contact')

@section('stylesheets')
{{Html::style('css/contact-me.css')}}
@stop
@section('content')
    
  <form id="contact" action="{{ route('contact') }}" method="post">
    <h3 class="text-center">Contact Us</h3>
    {{csrf_field()}}
    <fieldset>
      <input placeholder="Your name" type="text" name="name" tabindex="1" required autofocus>
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address" type="email" name="email"tabindex="2" required>
    </fieldset>

    <fieldset>
     <fieldset>
      <input placeholder="Subject (optional)" type="tel" name="subject" tabindex="3" required>
    </fieldset>
      <textarea placeholder="Type your message here...." tabindex="5" name="message" required></textarea>
    </fieldset>
    <fieldset>
      <button  type="submit" id="contact-submit" >Submit</button>
    </fieldset>
  </form>
@endsection