<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

//dăt tên UserService thay cho UserServiceInterface;
use App\Services\Interfaces\UserServiceInterface as UserService;

class UserController extends Controller
{
    // khai bao biến userService1 để những function khách gọi vào không cần truyền tham số UserService $userService
    // protected $userService1;
    protected $userService;


    public function __construct(UserService $userService){
        // hàm này mục dích gọi UserService với biến là $userService để xử li
        // gán biến đã khia bao protuserService1 ectec cho $userService để các hàm dưới như insex gọi ra dùng
        // $this->userService1 = $userService;
        $this->userService = $userService;
    }

    public function index(){
        $users = $this->userService->paginate();
        $config = $this->config();
        $templade = 'backend.user.index';
        return view('backend.dashboard.layout', compact('templade','config','users'));
    }

    private function config(){
        return [
            'js' => ['backend/js/plugins/switchery/switchery.js'],
            'css' => ['backend/css/plugins/switchery/switchery.css']
        ];
    }

}
