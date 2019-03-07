@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List of Pixels </div>
              
                <button data-toggle="modal"  onclick="crearModal()"  class="btn btn-info" type="button" name="button"><i class="fa fa-plus" aria-hidden="true"></i> Create New Iframe Pixel</button>

                <div class="card-body">
                    @if (session('status') )

                        <div class="alert alert-success"  role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!empty(session('message')) || !empty($message) )
                    <div class="alert alert-success"   role="alert">

                              {{session('message')}}  {{$message}}

                    </div>
                    @endif  


                    <div id="form-messages" class="alert alert-success" style="display:none"  role="alert">
                            
                    </div> 




<table  class="table table-striped table-bordered dataTable  display responsive " style="width:100%" id="tableiframe">
      <thead>
        <tr>
          <th>Pixel</th>
          <th>Content</th>
          <th>Created at</th>
          <th>Updated at</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach($iframes as $iframe)
        <tr>
          <td>{{$iframe->iframeid}}</td>
          <td>{{$iframe->iframe}}</td>
          <td>{{$iframe->created_at}}</td>
          <td>{{$iframe->updated_at}}</td>
          <td>
            <!--View-->            
            <!--<button class="btn btn-primary" type="button" id="{{$iframe->id}}" onclick="showIframe(this.id)"><i class="fa fa-eye" aria-hidden="true"></i></button>-->            
            <!--Edit-->
            <!--<a href="{{url('/iframe/editiframe/'.$iframe->id)}}"><button type="button" class="btn btn-info" name="edit"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>-->            
            <button data-toggle="modal"  onclick="editModal(this.id)" id="{{$iframe->id}}" class="btn btn-info" type="button" name="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            <!--Delete-->
            <button data-toggle="modal"  onclick="showModal(this.id)" id="{{$iframe->id}}" class="btn btn-danger" type="button" name="button"><i class="fa fa-trash" aria-hidden="true"></i></button>            
            <!--Show Link-->            
            <button class="btn btn-secondary" id="{{$iframe->id}}" type="button" name="button" onclick="showLink(this.id)"><i class="fa fa-link" aria-hidden="true"></i></button></a>
        
          </td>
        </tr>
      
        @endforeach
      </tbody>
    </table>       


                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div style="padding: 5px 4px 5px 4px;" class="card">
                <div class="card-header">Pixel Lookup</div>
                <br>
                <label>Pixel URI</label>
                <input id="foo">
                <br>
                <label>Details</label>
                <textarea id="textareacontent" rows="10" ></textarea>    
                <br>
                <div style="text-align: center;" class="col-md-12">
                <h6>Actions</h6>
                <button class="btn btn-info" data-clipboard-target="#textareacontent" id="CopyPixel">Copy Text</button>
                 <a id="descargapixel"  download> <button type="button" name="button" class="btn btn-default" >Download</button></a>

                            </div>
            </div>
        </div>

    </div>


<!-- Modal -->


<!-- Edit Modal -->


<div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
   
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="crearModalLabel">Create Iframe Pixel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
                    <div class="modal-body">
                            <fieldset>
                                <div class="col-md-12 form-control">
                                            <label>Iframe Title</label>
                                                <input class="form-control" id="ititlenew" name="ititlenew"><br>
                                            <label>Iframe Pixel</label>
                                                <textarea class="form-control" id="iframecodenew" name="iframecodenew"></textarea>
                                </div>
                            </fieldset>
                    </div>

                        <div class="modal-footer">
                        
                                <button type="button" onclick="guardarcrear()" class="btn btn-primary"  data-dismiss="modal"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
        </div>
      </div>
    </div>

<!-- Edit Modal -->


<div class="modal fade" id="editaModal" tabindex="-2" role="dialog" aria-labelledby="editaModalLabel" aria-hidden="true">
   
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editaModalLabel">Edit Iframe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> 
                    <div class="modal-body">
                            <fieldset>
                                <div class="col-md-12 form-control">
                                            <label>Iframe Title</label>
                                                <input class="form-control" id="ititle" name="ititle"><br>
                                            <label>Iframe Pixel</label>
                                                <textarea class="form-control" id="iframecode" name="iframecode"></textarea>
                                </div>
                            </fieldset>
                    </div>

                        <div class="modal-footer">
                        
                                <button type="button" id="idframeid" onclick="guardareditar(this.value)" class="btn btn-primary"  data-dismiss="modal"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
        </div>
      </div>
    </div>


<!--Delete modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Iframe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this item?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="deleteBtn" data-dismiss="modal"><i class="fa fa-trash" aria-hidden="true"></i> Delete Now</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<!-- MODAL END-->




<input hidden type="" name="link" id="createIframe" value="{{url('/iframe/create/')}}">
<input hidden type="" name="link" id="getIframe" value="{{url('/iframe/showframe/')}}">
<input hidden type="" name="link" id="getLink" value="{{url('/iframe/link/')}}">
<input hidden type="" name="" value="{{url('/iframe/showframe')}}" id="show">

<!-- Scripts

  
 
  <script src="{{asset('codemirror/lib/codemirror.js')}}"></script>
  <script src="{{asset('codemirror/mode/javascript/javascript.js')}}"></script>
  <script src="{{asset('codemirror/addon/edit/matchbrackets.js')}}"></script>

-->

    </div>
</div>



<script type="text/javascript">
  
  $(document).ready(function(){
    
    new ClipboardJS('#CopyPixel');

    var table = $('#tableiframe').DataTable();
    // Sort by column 1 and then re-draw
    table
        .order( [ 3, 'dsc' ] )
        .column( 1 ).visible( false )
        .draw();


 /*   $('#tableiframe').DataTable();
  });*/

  });
</script>

<script>


/*
function showIframe(id){
  $.ajax({
    url: $('#show').val()+'/'+id,
    method: 'GET',
    dataType: 'json',
    success: function(response){
      $('html, body').animate({
        scrollTop: $(".shows").offset().top
      }, 1000);
      $('.links').hide();
      $('.shows').show();
      $('.shows > ').remove();
      $('.shows').append('<h4>'+response['iframeid'] +'</h4>');
      $('.shows').append('<textarea class="form-control" id="myTextArea" rows="16"  name="frame" readonly></textarea>');
      var myCodeMirror = CodeMirror(function(elt) {
        myTextArea.parentNode.replaceChild(elt, myTextArea);
      }, {
        mode: 'javascript',
        value: response['iframe'],
        readOnly: true
      });
    }
  });
}*/
function showModal(id){
  // alert(id);

  $('#deleteBtn').click(function(){
    window.location.href = '{!!url("/iframe/delete/")!!}/'+id;
  });
  $('#exampleModal').modal('show');
}

/*Abrir Modal Editar */
function editModal(id){
  // alert(id);
  $.ajax({
        url: $('#getIframe').val()+'/'+id,
        method: 'GET',
        success: function(jsoniframe){

          //  var obj = $.parseJSON(jsoniframe);

            console.log(jsoniframe);

            $('#idframeid').val(jsoniframe.id);
            $('#ititle').val(jsoniframe.iframeid);
            $('#iframecode').val(jsoniframe.iframe);
        }
    });
    $('#editaModal').modal('show');
}


/* Crear nuevo Iframe Pixel Modal*/

/*Abrir Modal Editar */
function crearModal(){
    $('#crearModal').modal('show');
}


function guardarcrear(){

ititlenew =  $('#ititlenew').val(),
iframecodenew = $('#iframecodenew').val(),

$.ajax({
    url: '{!!url("/iframe/create/")!!}',
    method: 'POST',
    data: {
            _token : "{{ csrf_token() }}",
            ititlenew : ititlenew,
            iframecodenew : iframecodenew
    },
    dataType: 'json',
    success: function(data){
    console.log(data);
    var formMessages = $('#form-messages');
    $(formMessages).text(data.message);
     formMessages.show();
      if(data.status == true){
        setTimeout(function(){// wait for 5 secs(2)
            window.location = '/iframe';
        }, 1500);
      }                          
    }
});

}

/*Guardar Modal Editar */

function guardareditar(id){
    id = id,
    ititle =  $('#ititle').val(),
    iframecode = $('#iframecode').val(),
    console.log(ititle + ' ' + iframecode + ' ' + id  );
    $.ajax({
        url: '{!!url("/iframe/update/")!!}' + '?_method=PUT',
        method: 'POST',
        data: {
                _token : "{{ csrf_token() }}",
                id : id,
                framename : ititle,
                changeframe : iframecode
        },
        dataType: 'json',
        success: function(data){ 
        console.log(data);
        var formMessages = $('#form-messages');
        $(formMessages).text(data.message);
        formMessages.show();
            setTimeout(function(){// wait for 5 secs(2)
                window.location = '/iframe';
            }, 1500);
                                
        }
    });

}

function showLink(id){
  $.ajax({
    url: $('#getLink').val()+'/'+id,
    method: 'GET',
    success: function(data){
      console.log(data);
      $('#foo').val(data.url);
      $("textarea#textareacontent").val(data.iframecode);

    filename = data.file;
 
     filename = filename.replace(/\s/g,"_");

      $("#descargapixel").attr("href", filename)
      
    }
  });
}

  
 




</script>


@endsection
