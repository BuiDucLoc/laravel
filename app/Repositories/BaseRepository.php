<?php
namespace App\Repositories;
use App\Models\Base;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function pagination(array $column = ['*'], array $condition = [],  array $join = [] ,  array $extend = [] , $perpage){
        $query = $this->model->select($column)->where(function($query1) use ($condition){
            //chu ý muôn lấy dược biến condition từ ngoài vào trong này thì phải use $conđition mới sử dụng được
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query1->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        if(!empty($join)){
            $query->join(... $join);
        }
        //hàm widthQueryString lấy tất cả ? đằng sau url theo khi bấm phân trang
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }

    public function create(array $payload = []){
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $id = 0  , array $payload = []){
        $model = $this->findById($id);
        return $model->update($payload);
    }

    public function updateBywhereIn(array $id = []  , array $payload = []){
        return $this->model->whereIn('id', $id)->update($payload);
    }

    //xoa mem
    public function delete(int $id = 0){
        return $this->findById($id)->delete();
    }

    // xoa cứng mất luôn dữ liệu
    public function forceDelete(int $id = 0){
        return $this->findById($id)->forceDelete();
    }

    public function all(){
        return $this->model->all();
    }
    
    public function findById(int $modelId, array $column = ['*'], array $relation = []){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}