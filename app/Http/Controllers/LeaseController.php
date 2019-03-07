<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clientes = LeaseController::getAllCustomers();
        $zonas = LeaseController::getAllZones();

        return view(
            'Leaseweb.leaseweb', [ 'clientes' => $clientes, 'zonas' => $zonas  ]);
    }


 /* 
  1507411564 CustomerID. 
  592ef5dc-9aaf-4fe5-ab23-ecd807c6381a apikey
  18123a570f520ebbf35da87e5d117cd6878701fe secret
 */


function getAllCustomers(){


    $secret = '18123a570f520ebbf35da87e5d117cd6878701fe';
    $customer_number = '1507411564';
    $zone_id = '5198';
    $path = '/customers/' . $customer_number . '/' . $zone_id;
    $time = time();
    $signature = sha1($secret.$time.$path);
    $full_path = 'https://api.leasewebcdn.com'.$path.'/'.$time.'/'.$signature; 
    //echo $full_path.'<br>';
    $display = file_get_contents($full_path);
   
   return  json_decode($display);

    
}



function getAllZones(){

    $secret = '18123a570f520ebbf35da87e5d117cd6878701fe';
    $customer_number = '1507411564';
    $zone_id = '5198';
    $path = '/origins/' .$customer_number;
    $time = time();
    $signature = sha1($secret.$time.$path);
    $full_path = 'https://api.leasewebcdn.com'.$path.'/'.$time.'/'.$signature; 
    //echo $full_path.'<br>';
    $display = file_get_contents($full_path);
   

   return  json_decode($display);
   
    
}



function getOrigins(Request $zone){
  
    $secret = '18123a570f520ebbf35da87e5d117cd6878701fe';
    $customer_number = '1507411564';
    $zone_id = '5198';
    $path = '/customers/' . $customer_number . '/' . $zone_id;
    $time = time();
    $signature = sha1($secret.$time.$path);
    $full_path = 'https://api.leasewebcdn.com'.$path.'/'.$time.'/'.$signature; 
    
    echo $full_path.'<br>';

}    



function PurgeZone($zone_id){

    $secret = '18123a570f520ebbf35da87e5d117cd6878701fe';
    $customer_number = '1507411564'; 
    $path = '/content/purge/'.$customer_number.'/'.$zone_id; 
    $time = time();
    $signature = sha1($secret.$time.$path);
    $full_path = 'http://api.leasewebcdn.com'.$path.'/'.$time.'/'.$signature.'/'; 


    /*

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $full_path, 
      //CURLOPT_URL => "https://api.leasewebcdn.com/content/purge/1507411564/5198/",
      //CURLOPT_CUSTOMREQUEST => "DELETE",
   //   CURLOPT_POSTFIELDS => "{'urls',['*']}",
      CURLOPT_POSTFIELDS => "{\"urls\": \"*\"}",
        //CURLOPT_HTTPHEADER => array(
        //"content-type: application/json"
        // ),
    ));
    
   // curl_setopt($curl,);
    

    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

} 


Username: 1549485012 
Password: lxrMdRiQk.n4A

*/


$ruta =  "https://api.leasewebcdn.com/content/purge/1507411564/$zone_id/$time/$signature";



$curl = curl_init();



echo $ruta.'<br>';

curl_setopt_array($curl, array(
  CURLOPT_URL => $ruta,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"urls\": [\"*\"]}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}



}


}
