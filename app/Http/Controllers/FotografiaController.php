<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Fotografia;
use App\Models\Fotografo;
use App\Models\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\FormatterController as Formatear;
use Intervention\Image\Facades\Image;

class FotografiaController extends Controller
{
  public function index(Request $request)
  {
    try {
        $user = User::find(2);

        if($user->puede($user,'Fotografia','r')) //Primero verificar si cuenta con permisos
        { 
          $todolodemas = [];
          $recurso = Fotografia::with('categoria','fotografo')->orderBy('id','desc')->get();

          if(count($recurso)==0){
            $todolodemas['info']['mensaje'] = 'No se encontraron registros en la base de datos';
            $todolodemas['info']['infos'] = ['registros'=>['No se encontraron registros en la base de datos']];
            return (new Formatear)->igor($recurso,202,$todolodemas);
          }
          return (new Formatear)->igor($recurso,200,$todolodemas);
        }
        else{
          $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
          $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
          return (new Formatear)->igor(null,403,$todolodemas);
        }
        } catch (\Throwable $th) {
          $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
          $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
          return (new Formatear)->igor(null,500,$todolodemas);
    }
  }

  public function store(Request $request)
  {    
    try {
        /* $user_id = auth()->user()->id; */
        $user = User::find(2);
            
        $todolodemas = [];

        if($user->puede($user,'Fotografia','c')) //Primero verificar si cuenta con permisos
        {
          DB::beginTransaction();
        
              if($request->fotografias){
                foreach($request->fotografias as $fotografias){
                  $recurso = new Fotografia;
                  $recurso->fotografo_id = $fotografias['fotografo_id'];
                  $recurso->imagen = $fotografias['imagen'];
                  $recurso->fecha = $fotografias['fecha'];
                  $recurso->descripcion = $fotografias['descripcion'];
                  $recurso->categoria_id = $fotografias['categoria_id'];
                  $recurso->tecnica = $fotografias['tecnica'];
                  $recurso->camara = $fotografias['camara'];
                  $recurso->objetivo = $fotografias['objetivo'];
                  $recurso->iso = $fotografias['iso'];
                  $recurso->balance = $fotografias['balance'];
                  $recurso->velocidad = $fotografias['velocidad'];
                  $recurso->diafragma = $fotografias['diafragma'];
                  $recurso->save();
                }
              }
          
            DB::commit();
            return (new Formatear)->igor($recurso,201,$todolodemas);
          }
        
          else{
              $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
              $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
              return (new Formatear)->igor(null,403,$todolodemas);
          }
        } catch (\Throwable $th) {
          $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
          $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
          return (new Formatear)->igor(null,500,$todolodemas);
        }  
    
  }  

  public function show($id, Request $request)
  {
    try {
      $user = User::find(2);
      
      $todolodemas = [];

      if($user->puede($user,'Fotografia','r')) //Primero verificar si cuenta con permisos
      {

          $recurso = Fotografia::with('categoria','fotografo')->find($id);
          
          if (is_null($recurso)) {
            $todolodemas['info']['mensaje'] = 'No se encontró el registro buscado en la base de datos';
            $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro buscado en la base de datos']];
            return (new Formatear)->igor($recurso,202,$todolodemas);
          }

          return (new Formatear)->igor($recurso,200,$todolodemas);
      }
      else
      {
        $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
        $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
        return (new Formatear)->igor(null,403,$todolodemas);
      }
    } catch (\Throwable $th) {
      $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
      $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
      return (new Formatear)->igor(null,500,$todolodemas);
    }
  }

  public function update($id, Request $request)
  {
      try {
        $user = User::find(2);
          
        $todolodemas = [];
  
        if($user->puede($user,'Fotografia','u'))
        {  
              DB::beginTransaction();
  
              $input = $request->all();
              $recurso = Fotografia::find($id);
        
              if(is_null($recurso)){
                $todolodemas['info']['mensaje'] = 'No se encontró el registro para actualizar en la base de datos';
                $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro para actualizar en la base de datos']];
                return (new Formatear)->igor($recurso,202,$todolodemas);
              }
  
              $recurso = $recurso::where('id', $id)->update($input);
              $recurso = Fotografia::find($id);

              DB::commit();
  
              return (new Formatear)->igor($recurso,201,$todolodemas);
            
          }
        
        else{
          $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
          $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
          return (new Formatear)->igor(null,403,$todolodemas);
        }
      } catch (\Throwable $th) {
        $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
        $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
        return (new Formatear)->igor(null,500,$todolodemas);
      }
  }

  public function destroy($id, Request $request)
    {
      try {
        $user = User::find(2);
          
        $todolodemas = [];
  
        if($user->puede($user,'Fotografia','d'))
        { 
            if(isset($request->ids))
            {
              $recurso = Fotografia::whereIn('id',$request->ids)->delete();
              $todolodemas['info']['mensaje'] = 'Registros eliminado correctamente';
              $todolodemas['info']['infos'] = ['registros'=>['Registros eliminado correctamente']];
  
              return (new Formatear)->igor(null,200,$todolodemas);
            }
            else
            {          
              $recurso = Fotografia::find($id);
              if (is_null($recurso)) {
                $todolodemas['info']['mensaje'] = 'No se encontró el registro que se intenta borrar, es probable que haya sido borrado anteriormente';
                $todolodemas['info']['infos'] = ['registros'=>['No se encontró el registro buscado en la base de datos']];
                return (new Formatear)->igor($recurso,202,$todolodemas);
              }
              else{
                $recurso->delete();
              
                $todolodemas['info']['mensaje'] = 'Registro eliminado correctamente';
                $todolodemas['info']['infos'] = ['registros'=>['Registro eliminado correctamente']];
                return (new Formatear)->igor($recurso,200,$todolodemas);
              }
            }
        }
        else{
          $todolodemas['error']['mensaje'] = 'No cuenta con los permisos para este recurso';
          $todolodemas['error']['errores'] = ['permisos'=>['No cuenta con los permisos para este recurso']];
          return (new Formatear)->igor(null,403,$todolodemas);
        }
      } catch (Exception $ex) {
        $todolodemas['error']['mensaje'] = 'Error en el servidor, ocurrió un error inesperado';
        $todolodemas['error']['errores'] = ['errorinesperado'=>[$th]];
        return (new Formatear)->igor(null,500,$todolodemas);
      }
    }
}

/* Respuesta de front 
{
  "fotografias":[
      {
          "fotografo_id" : 1,
          "imagen" : "test",
          "fecha" :"1995-04-19",
          "descripcion" : null,
          "categoria_id" : 4,
          "tecnica" : null,
          "camara" : null,
          "objetivo" : null,
          "iso" : null,
          "balance" : null,
          "velocidad" : null,
          "diafragma" : null
      }
  ]
}

{
  "ids":[
      5,6
  ]
} */