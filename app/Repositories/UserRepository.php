<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository  implements UserRepositoryInterface
{
    protected $model;
    
    public function __construct(User $model){
        $this->model = $model;
    }

    public function pagination(array $column = ['*'], array $condition = [],  array $join = [] ,  array $extend = [] , $perpage , array $relation = []){
        $query = $this->model->select($column)->where(function($query1) use ($condition){
            //chu ý muôn lấy dược biến condition từ ngoài vào trong này thì phải use $conđition mới sử dụng được
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query1->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%');
            }

            if(isset($condition['publish']) && ($condition['publish'] != 0)){
                $query1->where('publish', '=', $condition['publish']);
            }
        });
        if(!empty($join)){
            $query->join(... $join);
        }
        //hàm widthQueryString lấy tất cả ? đằng sau url theo khi bấm phân trang
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

}