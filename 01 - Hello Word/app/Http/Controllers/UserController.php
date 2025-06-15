<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function findUserByID(
        int $id
    ) {
        //CHAMA A MODEL...
        //TRATRA OS DADOS

        return view('user', [
            'id' => $id,
            'name' => 'SatellaSoft',
            'email' => ''
        ]);
    }
}
