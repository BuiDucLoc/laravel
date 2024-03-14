<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models;
//dăt tên UserService thay cho UserServiceInterface;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProviceRepositoryInterface as ProviceRepository;


class UserController extends Controller
{
    // khai bao biến userService1 để những function khách gọi vào không cần truyền tham số UserService $userService
    // protected $userService1;
    protected $userService;
    protected $proviceRepository;



    public function __construct(UserService $userService, ProviceRepository $proviceRepository){
        // hàm này mục dích gọi UserService với biến là $userService để xử li
        // gán biến đã khia bao protuserService1 ectec cho $userService để các hàm dưới như insex gọi ra dùng
        // $this->userService1 = $userService;
        $this->userService = $userService;
        $this->proviceRepository = $proviceRepository;
    }

    public function index(){
        $users = $this->userService->paginate();
        $config =  [
            'js' => ['backend/js/plugins/switchery/switchery.js'],
            'css' => ['backend/css/plugins/switchery/switchery.css']
        ];
        $config['seo'] = config('apps.user');
        $templade = 'backend.user.index';
        return view('backend.dashboard.layout', compact('templade','config','users'));
    }

    public function create(){
        $province = $this->proviceRepository->all();
        $config = [
            'css'=> ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                    'backend/library/location.js',
                ]
        ];
        $config['seo'] = config('apps.user');
        $templade = 'backend.user.create';
        return view('backend.dashboard.layout', compact('templade','config','province'));
    }

}
