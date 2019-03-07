@extends('layouts.partials.the_header')
@section('header_title','Autentication')

  <div class="wrapper">
    <div class="container">
      @if($errors->has('username'))
      <div class="message">
        <center><p>Error {{$errors->first('username')}}</p></center>
      </div>
      @endif
      @if($errors->has('password'))
      <div class="message">
        <center><p>Error {{$errors->first('password')}}</p></center>
      </div>
      @endif
    </div>
    <form class="form-signin" method="POST">
    
    {{ csrf_field() }}

      <input type="text" class="form-control" name="username" placeholder="Username"  value="" />
      <input type="password" class="form-control" name="password" placeholder="Password" value=""/>
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit" id="send">Login</button>
    </form>
  </div>
  <input type="hidden" id="url" value="{{$base_url}}">
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

</body>
</html>
