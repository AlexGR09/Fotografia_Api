<?php

namespace App\Models;

/* use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; */
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Permiso;
use App\Models\Permisionable;

trait hasPermisos {

    public function puede($user,$tabla,$accion) {
        
        $user = $user ?: auth()->user();

        //Primero obtener el permiso id del que se trate

        $permiso = Permiso::where('nombre','=',$tabla)->first();

        if($permiso) //Si existe el permiso, buscar si tiene permiso
        {
            //Primero verificar si su rol tiene permiso para realizar lo que pide
            //dd($user->roles());
            
            $rouls = [];

            foreach($user->roles as $rolito)
                $rouls[] = $rolito->id;            

            $permisoRol = Permisionable::where('permiso_id','=',$permiso->id);
            $permisoRol = $permisoRol->where('permisionable_type','=','App\Models\Role');
            //$permisoRol = $permisoRol->where('permisionable_id','=',$user->role_id);
            $permisoRol = $permisoRol->whereIn('permisionable_id',$rouls);
            $permisoRol = $permisoRol->select('permisionables.'.$accion.' as permiso')->first();            
                        
            //Si existe el permiso para el rol y si además tiene permiso, enviarlo            
            if($permisoRol && $permisoRol->permiso)
                return $permisoRol->permiso;

            //Si no existe el permiso para el rol, o existe pero no tiene, entonces 
            //verificar si existe el permiso para el usuario, si hay permiso especial
            
            $permisoUser = Permisionable::where('permiso_id','=',$permiso->id);
            $permisoUser = $permisoUser->where('permisionable_type','=','App\Models\User');
            $permisoUser = $permisoUser->where('permisionable_id','=',$user->id);
            $permisoUser = $permisoUser->select('permisionables.'.$accion.' as permiso')->first();

            //Si existe el permiso para el usuario y además tiene permiso, enviarlo

            if($permisoUser && $permisoUser->permiso)
                return $permisoUser->permiso;  
            
            //Si no existe el permiso para el usuario o existe, pero no tiene, entonces
            //no tiene permiso de ningún tipo, se envía false

            return false;
        }
        else //Ni siquiera existe el permiso, envía false
            return false;

    }
}
