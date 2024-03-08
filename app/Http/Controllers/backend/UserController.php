<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){

    }

    public function index(){
        
        $config = $this->config();
        $templade = 'backend.user.index';
        return view('backend.dashboard.layout', compact('templade','config'));
    }

    private function config(){
        return [
            'js' => ['backend/js/plugins/switchery/switchery.js'],
            'css' => ['backend/css/plugins/switchery/switchery.css']
        ];
    }

}
