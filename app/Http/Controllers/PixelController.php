<?php

namespace App\Http\Controllers;



use App\Iframe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\utils\HttpURL; /*get BaseUrl */
use Response;
use Validator;



class PixelController extends Controller
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
        
    $iframes = Iframe::orderBy('updated_at', 'desc')->get();
    $message = "";
    return view('Frame.index',['iframes' => $iframes, 'iframe' => null,'message' => $message]);
    
  }
  
  /* Obsoleto Crea Vista para crear un Iframe Nuevo */

    public function showCreate(){
    
      return view('Frame.create');   
    
    }
  
  
 /* Obtener Valores del Iframe Clickeado en la Ventana Modal Editar del Listado */

  public function showIframe($id){

    $iframe = Iframe::where('id', $id)->get();
      foreach ($iframe as $value) { 
        $jsoniframe['id'] = $value->id; /*Titulo del Iframe */
        $jsoniframe['iframeid'] = $value->iframeid; /*Titulo del Iframe */
        $jsoniframe['iframe'] = $value->iframe; /* Iframe en codigo */
      }
      return Response::json($jsoniframe); 

  //    echo json_encode($jsoniframe);
  
  }

  
  
  
  /* Guardar Edicion de Iframe */ 
  
  public function editframe($id){
    
    $this->middleware('auth');
    //$iframe = Iframe::where('id', $id)->get();
    $iframe = Iframe::findOrFail($id);
    $frName = $iframe->iframe;
    $frID = $iframe->iframeid;
    return view('Frame.edit',['frName' => $frName, 'frID' => $frID,'id' => $id]);
  }
  
  /* Eliminar Iframe */ 
  
  public function deleteIframe($id){
    
    $this->middleware('auth');
    $iframe = Iframe::find($id);
    $id = $iframe->iframeid;
    $filename = preg_replace('[\s+]',"_", $id);
    $iframe->delete();
    Storage::disk('public')->delete(''.$filename.'.txt');
    $iframes = Iframe::all();
    return redirect('/iframe')->with(['message' => "The iframe was delete"]);
  }
  
  
  public function saveiframe(Request $request){
    
    $validator = Validator::make($request->all(), [
      'ititlenew' => 'required',
      'iframecodenew' => 'required'
      ]);     
      $id = $request->input('ititlenew');  

      $filename = preg_replace('[\s+]',"_", $id);

      $key = md5($request->input('ititlenew'));
          
      $txt = $request->input('iframecodenew');   
          
      $iframe = Iframe::where('iframeid', $id)->get();            
      foreach ($iframe as $value) {
        $find = $value->iframeid;                                
      }      
      if (!empty($find)) {         
        $message = "Ya Existe un iFRAME con el mismo nombre";          
        $data = [
          'status' => false,
          'message'=> $message
          ] ;                    
          return Response::json($data);              
        }  

        $requestData = $request->input();
        $requestData['iframeid'] = $id;
        $requestData['keyframe'] = $key;
        $requestData['iframe'] = $txt;
        $iframe = new Iframe;
        $iframe->fill($requestData);
        $iframe->save();
        
        Storage::disk('public')->put(''.$filename.'.txt', $txt);
        
        $iframes = Iframe::all();
        $message = "The iframe ".$id." was created";
        $data = [
          'status' => true,
          'message'=> $message
          ] ;
          return Response::json($data); 
          
          //return redirect('/iframe')->with(['message' => $message]);
        }
        
        
        public function edit(Request $request){
          
          $a = $request->all();    
          // Array ( [_token] => 2Ns2oINnaqevwOUO9SZmi1Ho4oIxuRg7DVvUQVmC [id] => 1 [framename] => IframeId [changeframe] => Iframe en Codigo )    
          $iframe = Iframe::find($request->id);
          
          $name = $iframe->iframeid; /*nombre original del iframe */
          
          $iframe->iframeid = $request->framename; /*nombre del iframe nuevo */
          
          $iframe->iframe = $request->changeframe; //iframe en codigo */
          
          $txt = $request->changeframe;
          
          $filenameold = preg_replace('[\s+]',"_", $name);

          $filenamenew = preg_replace('[\s+]',"_", $iframe->iframeid);

          
          Storage::disk('public')->delete(''.$filenameold.'.txt'); /*borra archivo del nombre original */
          
          $iframe->save(); /* guarda nuevos datos del iframe */
          
          Storage::disk('public')->put(''.$filenamenew.'.txt', $txt); /* pone un nuevo iframe.txt con nombre nuevo */
          
          $iframes = Iframe::all();
          
          $message = "iFrame with name $name was updated to $request->framename";
          
          $data = [
            'status' => true,
            'message'=> $message
            ] ;
            
            
            return Response::json($data); 
            //        return response()->json($data);
            
            
            
          }
          
          
          public function LinkPublic($hash){
            
            $iframe = Iframe::where('keyframe', '=', $hash)->firstOrFail();            
            $filename =  $iframe->iframeid;

            $filename = preg_replace('[\s+]',"_", $filename);

            $pathToFile = Storage::url($filename.'.txt');

            echo 'Ver PIXEL: '.$iframe->iframeid;
            echo "<br><a href='$pathToFile'>Ver</a>";


          }
          
          
          /* Obtener URI Link */
            
            public function link($id){
              $frame = Iframe::find($id);
            
              $name = $frame->iframeid;
              //$key = md5($name);
              $key = $frame->keyframe;
              
              $iframecode = $frame->iframe;
          
          
              $firstUrl = url('/');
          
              $url = $firstUrl.'/pixel/view/'.$key;
              
          
              $file = Storage::url(trim($name).'.txt');
          
          
              $data = [
                'url' => $url,
                'iframecode'=> $iframecode,
                'file' => $file
                ] ;        
              
                return Response::json($data);
          
          
          
            }
          
          public function validation(Request $request){
            
        $this->validate($request, [
          'file_name' => 'required',
          'iframe' => 'required'
        ]);
    
        $filename = $request->input('file_name');
        $frame = $request->input('iframe');
    
            return view('Frame.validation',[
              'file' => $filename,
              'iframe' => $frame
            ]);
      }
    
    
      
      public function seeyou($key){
            $frame = Iframe::where('keyframe', '=' ,$key)->firstOrFail();
            $iframe = $frame->iframe;
            $id = $frame->iframeid;
            $id = $id.'.txt';
            return view('FrameLink.viewonlink',['frame' => $iframe, 'txt' => $id]);
          }
    
    
        
}
