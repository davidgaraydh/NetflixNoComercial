<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//esta linea
use App\Models\ModelUsuario;
use App\Models\ModelCliente;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class controller_cliente extends Controller
{
    
//esta funcion
    public function guardarCliente(Request $request){

        try {


            $validator = Validator::make($request->all(),[
                'email' => 'required|max:200|email|unique:tb_usuario,Email',
                'contra' => 'required|max:20|min:8', //se hizo cambio en la bd con un alter modify
                'fk_idioma' => 'required|max:20|numeric',
                'fk_tarjeta' => 'required|max:20|numeric',
                'Nombre' => 'required|max:100',
                'ApellidoP' => 'required|max:100',
                'ApellidoM' => 'required|max:100',
                'FechaNacimiento' => 'required|date_format:Y-m-d',
                'fk_paquete' => 'required|max:20|numeric',
            ],
            [
                'email.required' => 'El campo del correo electronico es requerido',
                'email.max' => 'El campo del correo electronico debe ser menor a 200',
                'email.email' => 'El campo del correo electronico debe tener un formato correcto',
                'email.unique' => 'El valor del campo en el correo electronico ya existe dentro de Base de Datos',
                'contra.required' => 'El campo de la contraseña es requerida',
                'contra.max' => 'El campo de la contraseña de ser menor de 20',
                'contra.min' => 'El campo de la contraseña de ser mayor a 8 caracteres',
                'fk_idioma.required' => 'la llave foranea de idioma es requerida.',
                'fk_idioma.max' => 'El campo de la llave foranea de idioma debe tener como maximo 20 caracteres.',
                'fk_tarjeta.required' => 'La llave foranea de tarjeta es requerida.',
                'fk_tarjeta.max' => 'El campo de la llave foranea de la tarjeta debe tener como maximo 20 caracteres.',
                'fk_idioma.numeric' => 'La llave foranea de idioma debe ser numerica.',
                'fk_tarjeta.numeric' => 'La llave foranea de tarjeta debe ser numerica.',
                'fk_paquete.required' => 'La llave foranea de paquete debe ser requerida.',
                'fk_paquete.max' => 'La llave foranea de paquete debe ser como maximo de 20 caracteres.',
                'fk_paquete.numeric' => 'La llave foranea de paquete debe ser numerica.',
                'Nombre.required' => 'El campo de nombre debe es requerido',
                'Nombre.max' => 'El campo de Nombre puede tener como maximo 100 caracteres.',
                'ApellidoP.required' => 'El campo de apellido paterno debe es requerido',
                'ApellidoP.max' => 'El campo de apellido paterno puede tener como maximo 100 caracteres.',
                'ApellidoM.required' => 'El campo de apellido materno debe es requerido',
                'ApellidoM.max' => 'El campo de apellido materno puede tener como maximo 100 caracteres.',
                'FechaNacimiento.required' => 'El campo de fecha debe es requerido',
                'FechaNacimiento.date_format' => 'El campo de fecha debe tener un formato valido.',
                
            ]
            );


            if($validator->fails()){
                // In case of validation rule errors, error messages are returned.
                $messages = $validator->messages();
                return response()->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
              } else { 

               $Contrasena= Hash::make($request->contra);
                $usuario = new ModelUsuario;
                $usuario->Email = $request->email;
                $usuario->ContraUser =$Contrasena;
                $usuario->Estatus =1;
                $usuario->FechaRegistro = date('Y-m-d H:i:s');
                $usuario->fk_idioma = $request->fk_idioma;
                $usuario->fk_tarjeta = $request->fk_tarjeta;
                $usuario->save();

                $cliente = new ModelCliente;
                $cliente->Nombre = $request->Nombre;
                $cliente->ApellidoP = $request->ApellidoP;
                $cliente->ApellidoM = $request->ApellidoM;
                $cliente->FechaNacimiento = $request->FechaNacimiento; //cambio en la BD de datetime por date
                $cliente->Estatus = 1;
                $cliente->FechaRegistro =  date('Y-m-d H:i:s');
                $cliente->fk_usuario =  $usuario->idUsuario;
                $cliente->fk_paquete = $request->fk_paquete;
                $cliente->save();

                return response()->json($cliente,200);

              }


        }catch(Throwable $e){
            return response($e,500);
        }

       
    }

}
