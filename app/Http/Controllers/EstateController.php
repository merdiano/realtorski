<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function list(){
        $etype = \request('estate_type');
        $atype =\request('announcement_type');
        $locationP = request('locationP');
        $locationC = request('locationC');
        $room = \request('room');

        $query = Estate::with('location_child:id,name_tm,name_ru')
            ->with('type:id,name_tm,name_ru')
            ->select(['images','title','locationC','estate_type','announcement_type']);

        if($etype)
            $query = $query->where('estate_type',$etype);
        if($atype)
            $estates = $query->where('announcement_type',$atype);
        if($locationP)
            $query = $query->where('locationP',$locationP);
        if($locationC)
            $query = $query->where('locationC',$locationC);
        if($room)
            $query = $query->where('room',$room);

        return $query->orderBy('created_at','DESC')
            ->paginate(10);

    }

    public function item($id){
        return Estate::find($id);
    }

    public function store(){

    }

    public function delete($id){
        $estate = Estate::find($id);
        if($estate && $estate->abonent_id == auth()->id()){
            $estate->delete();
        }
    }

}
