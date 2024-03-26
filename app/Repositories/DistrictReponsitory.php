<?php

namespace App\Repositories;
use App\Models\District;

use App\Repositories\Interfaces\DistrictRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class DistrictReponsitory extends BaseRepository  implements DistrictRepositoryInterface
{   
    protected $model;
    
    public function __construct(District $model){
        $this->model = $model;
    }

    public function findByCondition(int $proid = 0){
        return $this->model->where('province_code', '=' ,$proid)->get();
    }
}