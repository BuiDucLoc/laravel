<?php

namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
//lay gia tri tu bien reponciti
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $perpage = $request->integer('perpage');
        // ham nafy laf return User::paginate(15);
       $user = $this->userRepository->pagination($this->selectpaginate(), $condition, [],  ['path' => 'user/index'] , $perpage);
       return  $user;
    }

    private function selectpaginate(){
        return ['id', 'name', 'email', 'phone', 'address' , 'publish'];
    }

    public function creates( $request){
        DB::beginTransaction();
        try{
            //hamexcept loai bo cac truong nay ra
            $payload = $request->except(['_token','send','re_password']);
            if($payload['birthday'] != null){
                $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            }
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function update( $id, $request){
        DB::beginTransaction();
        try{
            //hamexcept loai bo cac truong nay ra
            $payload = $request->except(['_token','send','re_password']);
            if($payload['birthday'] != null){
                $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            }
            $user = $this->userRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function updateStatus($post=[]){
        DB::beginTransaction();
        try{
            //hamexcept loai bo cac truong nay ra
            $payload[$post['field']] = ($post['value'] == 1) ? 0 : 1 ;
            $user = $this->userRepository->update($post['modelid'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }


    public function updateStatusAll($post=[]){
        DB::beginTransaction();
        try{
            //hamexcept loai bo cac truong nay ra
            $payload[$post['field']] = ($post['value']);
            $user = $this->userRepository->updateBywhereIn($post['modelid'], $payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function convertBirthdayDate($birthday = ''){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $user = $this->userRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

}
