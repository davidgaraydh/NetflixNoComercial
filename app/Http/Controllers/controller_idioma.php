<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelIdioma;

class controller_idioma extends Controller
{

    public function getPrueba(){
        $idiomas=ModelIdioma::all('NombreIdioma');
        return $idiomas;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
