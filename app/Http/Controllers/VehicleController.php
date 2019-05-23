<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function list(){
        $mark = \request('mark');
        $model = \request('model');
        $year_start = \request('year_start');
        $year_end = \request('year_end');
        $credit  =\request('credit');
        $exchange = \request('exchange');
        $price_start = \request('price_start');
        $price_end = \request('price_end');
        $locationP = request('locationP');
        $locationC = request('locationC');

        $query = Vehicle::with('location_child:id,name_tm,name_ru')
            ->where('approved',1);
//        todo sorting???
        if($subCategory)
            $query = $query->where('categoryC',$subCategory);
        if($locationP)
            $query = $query->where('locationP',$locationP);
        if($locationC)
            $query = $query->where('locationC',$locationC);

        return $query->select(['title','images','price','locationC','categoryC','created_at'])
//            ->select()
            ->orderBy('created_at','DESC')
            ->paginate(10);
    }

    public function store(){

    }

    public function item($id){

    }

    public function delete($id){
        $vehicle = Vehicle::find($id);
        if($vehicle && $vehicle->abonent_id == auth()->id()){
            $vehicle->delete();
        }
    }
}
