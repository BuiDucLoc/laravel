<?php
namespace App\Ward;
use App\Models\Ward;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\WardReponsitoryInterface;
class WardReponsitory extends BaseRepository  implements WardReponsitoryInterface
{
    protected $model;   
    public function __construct(Ward $model){
        $this->model = $model;
    }
}