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
    public function paginate(){
        // ham nafy laf return User::paginate(15);
       return  $this->userRepository->getAllPaginate();
    }

    public function creates( $request){
        DB::beginTransaction();
        try{
            $payload = $request->except(['_token','send','re_password']);
            // if($payload['birthday'] != null){
            //     $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            // }
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->userRepository->create($payload);
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
