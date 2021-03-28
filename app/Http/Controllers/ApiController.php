<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    function showData(){
        return ['name' => 'Tareq',
                'name2' => 'Talal'

    ];
    }
}
