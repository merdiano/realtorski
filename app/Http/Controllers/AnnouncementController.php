<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index($mainCategory){
        $query = Announcement::where('categoryP',$mainCategory)
            ->where('approved',1);
        $subCategory = request('subcategory');
        $locationP = request('locationP');
        $locationC = request('locationC');
        dd(\request());
        if($subCategory)
            $query = $query->where('categoryC',$subCategory);
        if($locationP)
            $query = $query->where('locationP',$subCategory);
        if($locationC)
            $query = $query->where('locationC',$subCategory);

        return $query->select(['title','description','view','images','phone','price','locationPName','locationCName'])
            ->orderBy('updated_at','DESC')
            ->get();
    }

    public function get($id){

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
