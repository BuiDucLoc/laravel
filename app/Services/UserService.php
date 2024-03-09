<?php

namespace App\Services;
use App\Services\Interfaces\UserServiceInterface;

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

}
