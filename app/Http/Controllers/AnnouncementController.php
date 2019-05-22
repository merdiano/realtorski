<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function list(){
        $mainCategory = request('category');
        $query = Announcement::with('location_child:id,name_tm,name_ru')
            ->with('category2:id,name_tm,name_ru')
            ->where('categoryP',$mainCategory)
            ->where('approved',1);
        $subCategory = request('subcategory');
        $locationP = request('locationP');
        $locationC = request('locationC');
//        todo sorting???
        if($subCategory)
            $query = $query->where('categoryC',$subCategory);
        if($locationP)
            $query = $query->where('locationP',$subCategory);
        if($locationC)
            $query = $query->where('locationC',$subCategory);

        return $query->select(['title','images','price','locationC','categoryC','created_at'])
//            ->select()
            ->orderBy('updated_at','DESC')
            ->paginate(10);
    }

    public function item($id){
        $announcement = Announcement::findOrFail($id);
        return $announcement;
    }

    public function store(AnnouncementRequest $request){

        $announcement = Announcement::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'client_id' => auth()->id(),
            'price' => $request['price'],
            'locationP' => $request['locationP'],
            'locationC' => $request['locationC'],
            'phone' => auth()->user()->phone,
            'categoryP' => $request['categoryP'],
            'categoryC' => $request['categoryC']
        ]);

        if($announcement)
            return true;
        else
            return false;
    }

    public function update(Request $request){

    }

    public function delete(){

    }
}
