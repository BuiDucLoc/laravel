<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models;
//dăt tên UserCatalogueService thay cho UserCatalogueServiceInterface;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;

class UserCatalogueController extends Controller
{
    // khai bao biến userCatalogueService1 để những function khách gọi vào không cần truyền tham số UserCatalogueService $userCatalogueService
    // protected $userCatalogueService1;
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(UserCatalogueService $userCatalogueService,  UserCatalogueRepository $userCatalogueRepository){
        // hàm này mục dích gọi UserCatalogueService với biến là $userCatalogueService để xử li
        // gán biến đã khia bao protuserCatalogueService1 ectec cho $userCatalogueService để các hàm dưới như insex gọi ra dùng
        // $this->userCatalogueService1 = $userCatalogueService;
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;

    }

    public function index(Request $request){
        $usersCatalogues = $this->userCatalogueService->paginate($request);
        $config =  [
            'js' => [
                        'backend/js/plugins/switchery/switchery.js',
                        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
                    ],
            'css' => [
                        'backend/css/plugins/switchery/switchery.css',
                        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
                    ]
        ];
        $config['seo'] = config('apps.usercatalogue');
        $templade = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact('templade','config','usersCatalogues'));
    }

    public function create(){
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'create';
        $templade = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact('templade','config'));
    }

    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->creates($request)){
            return redirect()->route('user.catalogue.index')->with('success','Thêm nhóm thành viên thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Thêm nhóm thành viên thất bại');
    }

    public function edit($id){
        $usersCatalogue = $this->userCatalogueRepository->findById($id);
        $config = [
            'css'=> ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
            'js' => [
                    'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                    'backend/library/location.js',
                    // 'backend/plugin/ckfinder/ckfinder.js',
                    // 'backend/library/finder.js',
                ]
        ];
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'edit';
        $templade = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact('templade','config','usersCatalogue'));
    }

    public function update(StoreUserCatalogueRequest $request, $id){
        if($this->userCatalogueService->update($id, $request)){
            return redirect()->route('user.catalogue.index')->with('success','Cập nhập nhóm thành viên thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Cập nhập nhóm thành viên thất bại');
    }
    
    public function delete($id){
        $usersCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('apps.usercatalogue');
        $templade = 'backend.user.catalogue.delete';
        return view('backend.dashboard.layout', compact('templade','config','usersCatalogue'));
    }

    public function destroy($id){
        if($this->userCatalogueService->destroy($id)){
            return redirect()->route('user.catalogue.index')->with('success','Xóa nhóm thành viên thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error','Xóa nhóm thành viên thất bại');
    }

}
