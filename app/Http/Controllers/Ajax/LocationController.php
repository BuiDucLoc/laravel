<?php

namespace App\Http\Controllers\Ajax;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepository;
    public function __construct(DistrictRepositoryInterface $districtRepository){
        $this->districtRepository = $districtRepository;
    }

    public function getLocation(Request $request){
        $districId = $request->input('province_id');
        $districts = $this->districtRepository->findByCondition($districId);
        $response = [
            'html' => $this->renderHtml($districts),
        ];
        return response()->json($response);
    }
    public function renderHtml($districts){
        $html = '<option value="0">[Chọn quận huyện]</option>';
        foreach ($districts as  $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
    
}