@extends('layouts.partials.headerframe')

@section('header_title','Validation')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CleanerLP</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Index<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/iframe/create">Create Iframe</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <h1>iFrame:</h1>

<table class="table table-striped">
  <tbody>
    <tr>
      <td>File Name:</td>
      <td><b>{{$file}}</b></td>
    </tr>
  </tbody>
</table>

  <h2>waiting to be confirmed for use in production.</h2>
  <form action="{{url('/iframe/save')}}" method="post">
{{ csrf_field() }}
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="myTextArea" rows="8"  name="iframe">{{$iframe}}</textarea>
    @if ($errors->has('iframe'))
    <div class="errorTxt">
      <div class="error">{{ $errors->first('iframe') }}</div>
    </div>
    @endif
    <input type="text" name="frameid" value="{{$file}}">
    @if ($errors->has('frameid'))
    <div class="errorTxt">
      <div class="error">{{ $errors->first('frameid') }}</div>
    </div>
    @endif
      <input type="submit" name="save" value="CONFIRM" class="btn btn-success">
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
