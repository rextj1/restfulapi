<?php
namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
trait ApiResponser
{
    private function successResponse($data,$code){
        return response()->json($data,$code);
    }

    // the protected method can be used directly within the same class
    protected function errorResponse($message,$code){
        return response()->json(['error'=>$message,'code'=>$code],$code);
    }

    // this is declearing the private method so it can be used by within the same class
    protected function showAll(Collection $collection, $code=200){
        return $this->successResponse(['data'=>$collection],$code);
    }

    protected function showOne(Model $model, $code=200){
        return $this->successResponse(['data'=>$model],$code);
    }
}
