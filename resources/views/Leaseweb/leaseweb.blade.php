@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Lease Web API</div>

                <div class="card-body">
               
               
    <div>
   

@foreach ((array) $clientes as $item) 
 
    <Label>Cliente</label>
    <input class="form-control" value="{{$item->companyName}}">
    <Label>Api Key Secret</label>
    <input class="form-control" value="{{$item->api_secret}}">
    <Label>Client ID</label>
    <input class="form-control" value="{{$item->customer_number}}">
 
@endforeach
 
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
            <div class="card">
                <div class="card-header">CDN Zones</div>

                <div class="card-body">
               

                <div>
        <table class="table table-striped table-bordered dataTable no-footer" id="tableiframe">
        <thead>
            <th>Origen</th>
            <th>Accion</th>
        </thead>
        <tbody>
               
             @foreach ((array) $zonas as $item) 
                @foreach ($item as $key => $value)
                
                <?php //print_r($value);?>
            <tr>
                <td> {{$value->origin}} <small>({{$value->id}})</small></td>

                 <td> 
                       <a href="{{ URL::route('purge', array('zone_id' => $value->id)) }}">  <button class="form-control btn-sm btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i></button>  </a></td>
                 </td>
                   </tr>
           
                              
                @endforeach

                @endforeach
        </tbody>

        </table>

                </div>
            </div>
        </div>
    </div>



</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    
    var table = $('#tableZones').DataTable();
    // Sort by column 1 and then re-draw
    table
        .order( [ 3, 'asc' ] )
        .column( 1 ).visible( false )
        .draw();


 /*   $('#tableiframe').DataTable();
  });*/

  });
</script>

@endsection
