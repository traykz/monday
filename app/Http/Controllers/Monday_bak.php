<?php

namespace App\Http\Controllers;


use App\MondayApi;

use App\Time;
use DateTime;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \App\Http\Controllers\ReminderController;

class Monday extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static  function conversorSegundosHoras($tiempo_en_segundos) {
       
        $horas = floor($tiempo_en_segundos / 3600);
        $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
        $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
    
        $hora_texto = '';



        if ($horas > 0 ) {
            $hora_texto .= $horas . "h ";
        }
    
        if ($minutos >= 0 ) {
            $hora_texto .= $minutos . "m ";
        }
    
        if ($segundos >= 0 ) {
            $hora_texto .= $segundos . "s";
        }
    
        return $hora_texto;

    }
    


 public function index(){


    $ahora = date("Y-m-d");

    $fecha_actual_init = date("Y-m-d 00:00:00");
    $fecha_actual = date("Y-m-d 23:00:00");

    $ayer = date("Y-m-d 00:00:00" ,strtotime($fecha_actual."- 1 days")); 

  //  $regla1 = DB::select("select * from times where horas_dia > 0 and pulse_updated LIKE '".date("Y-m-d")."%' group by monday_api_id");
   
  $regla1 = DB::select("select * from times where created_at BETWEEN '$ayer' AND '".date("Y-m-d")."%' group by monday_api_id");
  

   if(!empty($regla1)){

    $r = json_decode( json_encode($regla1), true);

    $id = '';
       
    $fin = array();  
       
        foreach($r as $row){

            $id = $row['monday_api_id'];

            //$getDay_data = DB::select("select * from monday_apis where id = $id and pulse_timetrack > 0");
            
            $getDay_data = DB::select("select * from monday_apis where id = $id");
            
            $r_data = json_decode( json_encode($getDay_data), true);
         
         

            foreach($r_data as $registro){

                $grl_data['member'] = $registro['member'];
                $grl_data['pulse_id'] = $registro['pulse_id'];
                $grl_data['pulse_name'] = $registro['pulse_name'];
                $grl_data['pulse_category'] = $registro['pulse_category'];
                $grl_data['pulse_status'] = $registro['pulse_status'];
                $grl_data['pulse_updated'] = $registro['pulse_updated'];
                
            }


   
            //$regla2 = DB::select("select * from times where monday_api_id = $id and created_at BETWEEN '2019-02-21 00:00:00' AND '2019-02-22 23:00:00' ");        
       
     //     $regla2 = DB::select("select * from times where monday_api_id = $id and created_at BETWEEN '$ayer' AND '$fecha_actual' and updated_at = '$fecha_actual' ");        
          
     $regla2 = DB::select("select * from times where monday_api_id = $id and created_at >= '$ayer' AND  created_at <= '$fecha_actual' ");    





            if(!empty($regla2)){

                /*IF*/
             $response = json_decode( json_encode($regla2), true);
                    $fechas = array();
                         
                          foreach($response as $key => $value){

                           $fecha = new DateTime($response[$key]['pulse_created']);
                           $myDateTime = $fecha->format('Y-m-d');

                          


                           if($response[$key]['horas_dia'] == 0) {

                       


                               $fechas[$key] = array('horas_dia' => $response[$key]['horas_dia'],
                                               'created_at' => $response[$key]['pulse_created'],
                                               'updated_at' => $response[$key]['pulse_updated'],
                                               'registro' => $response[$key]['created_at'],

                                             );
                                
                            }else{

                                $fechas[$key] = array('horas_dia' => $response[$key]['horas_dia'],
                                'created_at' => $response[$key]['pulse_created'],
                                'updated_at' => $response[$key]['pulse_updated'],
                                'registro' => $response[$key]['created_at'],

                              );


                            }
                            

                           
                          }  

                               $a = $fechas;     
                               $hoy = '';
                               $ayer = '';   

                             for ($i = 0; $i < count($a); $i++) { 
                              
                            
                                if($i == 0){     
                              
                                $ayer.= $a[$i]['horas_dia'];
                                
                                }elseif($i == count($i)){
                                       
                                
                                 $hoy.= $a[$i]['horas_dia'];
                            
                                }

                            //$b[$i] = $a[$i] - (isset($a[$i+1]) ? $a[$i+1] : 0);
                            }

                         if($hoy > $ayer){


                            $laborado = $hoy - $ayer;
 
                            $grl_data['pulse_timetrack'] = $laborado;
      
                          
                           // print_R($grl_data);
                            
                            $fin[] = $grl_data;

                         }
                    
                }else{ 

              echo  'No hay Registro de Tiempos anteriores  tiene que pasar otro dia para poder calcular y extraer las horas laboradas del dia';                  
                
                }
                
                
            }



            
            return view('monday.index', [ 'pulse' => $fin]); 


   } else{

       

            $message =  'No se existen registros de tiempos el dia de hoy'.date("Y-m-d");
            return view('monday.index', [ 'mensaje' => $message]); 

   }

                         
                        
 }  


    public function SaveApi()
    {

        $pageIndex = 1;       
        while($pageIndex){        
            $json = json_decode(file_get_contents("https://api.monday.com:443/v1/boards/183377694/pulses.json?page=$pageIndex&api_key=352b219ab4f38835ed91337496a7a42c"), true);
            if(!empty($json)){
                $pulse = $json;
                        foreach($pulse as $key => $value){

                            $anidado = $pulse[$key]['column_values'];
                            foreach($anidado as $key2 => $value2){

                                date_default_timezone_set('America/Mexico_City');


                                $created = strtotime( $pulse[$key]['pulse']['created_at']);
                                $updated = strtotime( $pulse[$key]['pulse']['updated_at']);
                                
                                $createdtime = date("Y-m-d h:i:s ",$created);
                                $updatetime = date("Y-m-d h:i:s ",$updated);

                                $data['pulse_created'] = $createdtime;
                                $data['pulse_updated'] = $updatetime;


                                $Chingon = $pulse[$key]['column_values'][$key2]['cid'];
                                if($Chingon === "name"){
                                   
                                   $data['pulse_id'] = $value['pulse']['id'];

                                $pulse_id = $value['pulse']['id'];
                                   

                                   $data['pulse_name'] = $pulse[$key]['column_values'][$key2]['name'];

                                }else{
                                    
                                    if($pulse[$key]['column_values'][$key2]['cid'] === 'person'){
                                    
                                        if(!empty($pulse[$key]['column_values'][$key2]['value']['name']) ){
                                            
                                            $data['member'] =  $pulse[$key]['column_values'][$key2]['value']['name'];

                                        }else{
                                            $data['member'] = 'Not assigned Yet';
                                        }

                                }elseif($pulse[$key]['column_values'][$key2]['title'] == 'Status'){
                                    if($pulse[$key]['column_values'][$key2]['value']['index'] === 1){
                                            $data['pulse_status'] = $pulse[$key]['column_values'][$key2]['value']['index'];
                                         //   $data['changed_at'] = $pulse[$key]['column_values'][$key2]['value']['changed_at'];
                                    }elseif($pulse[$key]['column_values'][$key2]['value']['index'] === 10){
                                            $data['pulse_status'] = $pulse[$key]['column_values'][$key2]['value']['index'];
                                           // $data['changed_at'] = $pulse[$key]['column_values'][$key2]['value']['changed_at'];
                                    }elseif($pulse[$key]['column_values'][$key2]['value']['index'] === 0){
                                            $data['pulse_status'] = $pulse[$key]['column_values'][$key2]['value']['index'];
                                          //  $data['changed_at'] = $pulse[$key]['column_values'][$key2]['value']['changed_at'];
                                    }else{
                                            $data['pulse_status'] = '';
                                            $data['changed_at'] = '';
                                           
                                        }
                                    }elseif($pulse[$key]['column_values'][$key2]['cid'] === 'time_tracking'){

                                            if(!empty($pulse[$key]['column_values'][$key2]['value']['duration']) ){
                                            
                                        //  $data['pulse_timetrack'] =
                                        
                                            $duracion_tarea = $pulse[$key]['column_values'][$key2]['value']['duration'];

                                            $fecha_time_inicio = $pulse[$key]['column_values'][$key2]['value']['startDate'];

                                            //echo $duracion_tarea;

                                            $data2['horas_dia'] = $duracion_tarea;


                                            $data3 = date("Y-m-d H:i:s", substr($fecha_time_inicio, 0, 10));

                                           

                                           // date_default_timezone_set('America/Mexico_City');
                                           // $date = date('d/m/Y h:i:s a', time());
                                           // echo $date;
                                            
                                           // $data['pulse_timetrack'] = Monday::conversorSegundosHoras($duracion_tarea);

                                           $data['pulse_timetrack'] = $duracion_tarea;

                                           
                                     //      echo 'Inicio Tiempo el: '.$data3.' y lleva '.$data['pulse_timetrack'].' Trabajando en esa tarea <br>';
    
                                            }else{


                                                //$startTime = mktime(0, 0, 0);

                                                //echo $startTime;

                                                //die();

                                                $data2['horas_dia'] = 0;
                                                $data['pulse_timetrack'] = 0;
                                            }


                                    }
                                }
                            }//endforeach anidado
                 
                            unset($data['changed_at']);

                            $MondayApi = new MondayApi;        
                         
                            $query =  $MondayApi->updateOrCreate(array('pulse_id'=> $data['pulse_id']), $data);
                            
                            $last_id = $query->id;
                                                                                  
                            $final[] = $data;      
                            



                            $daily = new Time;
                            $DataLog = array(
                                'monday_api_id' => $last_id,
                                'horas_dia' => $data2['horas_dia'],
                                'pulse_created' => $data['pulse_created'],
                                'pulse_updated' => $data['pulse_updated'],
                            );
                            
                            $daily->Create($DataLog);
                            //$daily->updateOrCreate(array('monday_api_id'=> $last_id), $DataLog);
                                        
                        } //endforeach api.
                        
                    }else{        
                        break;   
                    }
                    
                    
                    
                    $pageIndex += 1;
                }

                echo 'Guardado Correctamente';
                
            }
            
            
            
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            
            public function create()
            {
                //
            }
            
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {
                //
            }
            
            
            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
