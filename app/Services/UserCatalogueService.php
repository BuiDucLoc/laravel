<?php

namespace App\Services;
use App\Services\Interfaces\UserCatalogueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
//lay gia tri tu bien reponciti
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    public $userCatalogueRepository;
    public function __construct(UserCatalogueRepository $userCatalogueRepository){
        $this->userCatalogueRepository = $userCatalogueRepository;
    }
    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->user_catalog_publish;
        $perpage = $request->integer('perpage');
        // ham nafy laf return User::paginate(15);
       $userCatalogue = $this->userCatalogueRepository->pagination($this->selectpaginate(), $condition, [],  ['path' => 'user/catalogue/index'] , $perpage, ['users'] );
       return  $userCatalogue;
    }

    private function selectpaginate(){
        return ['id', 'name','description','publish'];
    }

    public function creates( $request){
        DB::beginTransaction();
        try{
            //hamexcept loai bo cac truong nay ra
            $payload = $request->except(['_token','send']);
            $user = $this->userCatalogueRepository->create($payload);
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
            $payload = $request->except(['_token','send']);
            $user = $this->userCatalogueRepository->update($id, $payload);
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
            $payload[$post['field']] = ($post['value'] == 1) ? 2 : 1 ;
            $user = $this->userCatalogueRepository->update($post['modelid'], $payload);
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
            $user = $this->userCatalogueRepository->updateBywhereIn($post['modelid'], $payload);
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
            $user = $this->userCatalogueRepository->delete($id);
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
