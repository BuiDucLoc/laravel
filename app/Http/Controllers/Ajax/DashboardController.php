<?php

namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
class DashboardController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
       $this->userService = $userService;
    }

    public function changeStatus(Request $request){
        $post = $request->input();
        // $this->userService->updateStatus();
        //$post['model']) = User;
        // tạo đường dẫn động để vào file usersevice.
        //sau đố gọi funtion updateStatus() ra sài
        $serviceInterfaceNamespace = '\App\Services\\'. ucfirst($post['model']) . 'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flat = $serviceInstance->updateStatus($post);
        return response()->json(['flag' => $flat]);
    }


    public function changeStatusAll(Request $request){
        $post = $request->input();
        // $this->userService->updateStatus();
        //$post['model']) = User;
        // tạo đường dẫn động để vào file usersevice.
        //sau đố gọi funtion updateStatus() ra sài
        $serviceInterfaceNamespace = '\App\Services\\'. ucfirst($post['model']) . 'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        $flat = $serviceInstance->updateStatusAll($post);
        return response()->json(['flag' => $flat]);
    }
    
}