<?php
namespace App\Repositories;
use App\Models\Province;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ProviceRepositoryInterface;
class ProviceReponsitory extends BaseRepository  implements ProviceRepositoryInterface
{
    protected $model;   
    public function __construct(Province $model){
        $this->model = $model;
    }
}