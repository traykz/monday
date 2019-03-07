@extends('layouts.app')

@section('content')


<div class="container">


<input type="" name="" value="{{$frName}}" id="f">


<form class="" action="{{url('/iframe/update/'.$id)}}" method="post">
  {{ method_field('PUT') }}

  {{ csrf_field() }}

  <label for="">Edit iframe</label>
  <input type="text" class="form-control" name="framename" value="{{$frID}}">
  <textarea class="form-control" id="myTextArea" name="changeframe" rows="25"></textarea>
  <textarea name="changeframe2" rows="20" hidden id="paste"></textarea>
  <br>
  <input type="submit" class="btn btn-success" id="snd" value="Save">
  <a href="{{url('/iframe/iFrameindex')}}"><button type="button" class="btn btn-secondary" name="button">Back</button></a>
</form>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{asset('codemirror/lib/codemirror.js')}}"></script>
<script src="{{asset('codemirror/mode/javascript/javascript.js')}}"></script>
<script src="{{asset('codemirror/addon/edit/matchbrackets.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#paste').val($('#f').val());
  });
</script>
<script type="text/javascript">
var myCodeMirror = CodeMirror(function(elt) {
  myTextArea.parentNode.replaceChild(elt, myTextArea);
}, {
  mode: 'javascript',
  value: $('#f').val()
}).on('change', editor => {
    console.log(editor.getValue());
    $('#paste').val(editor.getValue());
});


</script>
