@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">


    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="https://cdn.monday.com/assets/logos/monday_logo_icon.png">
                    <STRONG>MONDAY.COM</STRONG>
                </div>

                <div class="card-body">

                <center><H4> Daily Log - Viewer </H4></center>

                <div>
        <table class="table table-striped table-bordered dataTable no-footer" id="tableMonday">

        <thead>
            <th>Task Name</th>
            <th>Member</th>
            <th>Pulse Id</th>
            <th>Status</th>
            <th>Daily Work</th>
            <th>Overall TimeTrack</th>
            <th>Created</th>
            <th>Updated</th>

        </thead>

        <tbody>

@if(!empty($pulse))

        @foreach ($pulse as $key => $value)

        <?php //$respuesta = Monday::conversorSegundosHoras($value['pulse_timetrack']); ?>

            <tr>


                 <td> {{$value['member']}} </td>
                 <td> {{$value['pulse_name']}} </td>
                 <td> {{$value['pulse_id']}} </td>
                 <td> {{$value['pulse_status']}} </td>
                 <td> {{$value['laboro']}} </td>
                 <td> {{$value['overall_time']}} </td>
                 <td> <small>{{$value['pulse_created']}}</small></td>
                 <td> <small>{{$value['pulse_updated']}}</small></td>

            </tr>


        @endforeach


@else


    no hay nada






@endif

        </tbody>

        </table>

                </div>
            </div>
        </div>
    </div>



</div>

<script type="text/javascript">

  $(document).ready(function(){

    var table = $('#tableMonday').DataTable();
    // Sort by column 1 and then re-draw
    table
        .order( [ 3, 'asc' ] )
       // .column( 1 ).visible( false )
        .draw();


 /*   $('#tableiframe').DataTable();
  });*/

  });
</script>

@endsection
