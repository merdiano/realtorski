<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function list(){
        $filters = \request()->only(['categoryP','categoryC','locationP']);
        $query = Announcement::with('location:id,name_tm,name_ru')
            ->with('subCategory:id,name_tm,name_ru')
            ->select(['title','images','price','locationP','categoryC','created_at'])
            ->where('approved',1);

        foreach ($filters as $key => $filter){
            $query->where($key,$filter);
        }
        //        todo sorting???
        return $query->orderBy('created_at','DESC')
            ->paginate(10);
    }

    public function item($id){
        return Announcement::with([
            'location:id,name_tm,name_ru',
            'subCategory:id,name_tm,name_ru'
        ])->find($id);
    }

    public function store(AnnouncementRequest $request){

        try{
            Announcement::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'abonent_id' => auth()->id(),
                'price' => $request['price'],
                'locationP' => $request['locationP'],
//                'locationC' => $request['locationC'],
                'phone' => auth()->user()->phone,
                'email' => auth()->user()->email,
                'categoryP' => $request['categoryP'],
                'categoryC' => $request['categoryC']
            ]);
            return response()->json(['message' => 'Successfully saved']);
        }catch (\Exception $ex){
            return response()->json(['error' => 'Failed']);
        }

    }

    public function update(AnnouncementRequest $request){

    }

    public function delete($id){
        $announce = Announcement::find($id);
        if($announce && $announce->abonent_id == auth()->id()){
            $announce->delete();
        }
    }
}
