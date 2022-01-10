<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function info(){
        return "Olá, você está na página INFO!";
    }

    public function permissoes(){
        return "Olá, você está na página PERMISSÕES!";
    }
}
