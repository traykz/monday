@extends('layouts.partials.headerframe')

@section('header_title', 'Create')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/iframe/iFrameindex')}}">Adtctools<span class="sr-only">(current)</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


</nav>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center><h1>New Pixel</h1></center>
      <h2><b>Instructions:</b></h2>
      <h4><b style="color:gray">Use the standard nomenclature to name the pixel: COUNTRY + PROJECT + CAMPAIGN ID + PIXEL TYPE. e.g: US SPYCAM 333 iFAME PIXEL or AU VIRAL 444 IMAGE PIXEL.</b></h4>

    </div>
  </div>


  <br><br>
  <h3>{{session('message')}}</h3>
</div>
<div class="container">
  <form action="{{url('/iframe/save')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">Pixel name:</label>
      <input class="form-control" type="text" name="file_name" value="">
      @if ($errors->has('file_name'))
      <div class="errorTxt">
        <div class="error"><p style="color:red">{{ $errors->first('file_name') }}</p></div>
      </div>
      @endif
    </div>
    <label for="exampleFormControlTextarea1">Paste the previous created pixel in the text area.</label>
   
    <textarea class="form-control" id="myTextArea" rows="20"  name="iframe" style="border:solid 1px orange;">
   
        <!-- CAMPAIGN       iFrame pixel -->
        <iframe src="" frameborder="0" style="display: none;"></iframe>
        <!-- CAMPAIGN       iFrame pixel -->

    </textarea>
    @if ($errors->has('iframe'))
    <div class="errorTxt">
      <div class="error"><p style="color:red">{{ $errors->first('iframe') }}</p></div>
    </div>
    @endif
    <br>
    <input type="submit" name="save" value="SAVE" class="btn btn-success">
  </form>
</div>

<script src="{{asset('codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('codemirror/mode/javascript/javascript.js')}}"></script>
<script src="{{asset('codemirror/addon/edit/matchbrackets.js')}}"></script>

<script type="text/javascript">
var editor = CodeMirror.fromTextArea(document.getElementById("myTextArea"), {
  mode: "javascript",
});
</script>
