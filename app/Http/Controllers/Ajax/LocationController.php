<?php

namespace App\Http\Controllers\Ajax;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProviceRepositoryInterface as ProviceReponsitory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepository;
    protected $proviceReponsitory;


    public function __construct(DistrictRepository $districtRepository , ProviceReponsitory $proviceReponsitory){
        $this->districtRepository = $districtRepository;
        $this->proviceReponsitory = $proviceReponsitory;
    }

    public function getLocation(Request $request){
        $get = $request->input();
        $html = '';
        if($get['target'] == 'districts'){
            $provice = $this->proviceReponsitory->findById($get['data']['localtion_id'], ['code', 'name'] , ['districts']);
            $districts = $provice->districts;
            $html = $this->renderHtml($districts);
        }else if($get['target'] == 'wards'){
            $district = $this->districtRepository->findById($get['data']['localtion_id'], ['code', 'name'] , ['wards']);
            $wards = $district->wards;
            $html = $this->renderHtml($wards, '[Chọn quận phường xã]');
        }
        $response = [
            'html' => $html,
        ];
        return response()->json($response);
    }

    public function renderHtml($districts, $root = '[Chọn quận huyện]'){
        $html = '<option value="0">'.$root.'</option>';
        foreach ($districts as  $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
    
}