<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingSeat;
use App\Repositories\Interfaces\VoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Vote_ValueCreateRequest;
use App\Http\Requests\Vote_ValueUpdateRequest;
use App\Repositories\Interfaces\VoteValueRepository;
use Illuminate\Support\Facades\Storage;

class VoteValuesController extends Controller
{


    protected $repository;

    protected $voterepository;


    public function __construct(VoteValueRepository $repository, VoteRepository $voterepository)
    {
        $this->repository = $repository;
        $this->voterepository = $voterepository;
    }


    public function store(Vote_ValueCreateRequest $request)
    {
        $date = $request->start_time;
        $value = date("Y-m-d\TH:i:s", strtotime($date));
        $rep = str_replace('T',' ',$value);
        $arItem = [
            'name' => $request->name,
            'link' => $request->link,
            'vote_id' => $request->vote_id,
            'start_time'=> $rep,
            'address' => $request->address
        ];
        $picture = $request->image;
        if ($picture !='') {
            $patUpload = $request->file('image')->store('public/images');
            $tmp=explode('/',$patUpload);
            $picture=end($tmp);
            $arItem['image']=$picture;
        } else {
            $arItem['image']='';
        }
        $this->repository->create($arItem);
        $request->session()->flash('msg', ' Film created successfully');
        return redirect()->route('admin.votes.index');
    }

    public function show()
    {
        $getFims = $this->repository->all();
        return view('admin.vote_value.index2',compact('getFims'));
    }

    public function edit(Request $request, $id)
    {
        $getFim = $this->repository->find($id);
        return view('admin.vote_value.index2',compact('getFim'));


    }

    public function update(Vote_ValueUpdateRequest $request, $id)
    {    $arItem = $this->repository->find($id);
        $id = (int)$request->id;
        $date = $request->start_time;
        $value = date("Y-m-d\TH:i:s", strtotime($date));
        $rep = str_replace('T',' ',$value);
        if (empty($arItem)) {return;}
        $picture = $request->image;
        $patUpload = $request->file('image');
        if (!empty($patUpload)) {
            $patUpload = $patUpload->store('public/images');
            $tmp = explode('/',$patUpload);
            $picture = end($tmp);
            $oldPic = $arItem->image;
            if($oldPic!=''){
                Storage::delete('public/images/'.$oldPic);
            }
            $arItem->image=$picture;
        }
        $arItem->name = $request->name;
        $arItem->link = $request->link;
        $arItem->start_time = $rep;
        $arItem->address = $request->address;
        $arItem->vote_id = $this->repository->find($id)->vote_id;
        if ($arItem->update()) {
            $request->session()->flash('msg','Film updated successfully');
            return redirect()->route('admin.votes.index');
        } else {
            $request->session()->flash('msg','Film updated fail!');
            return redirect()->route('admin.votes.index');
        }
    }

    public function destroy(Request $request,$id)
    {
        $id= (int)$request->id;
        $arItems = $this->repository->find($id);

        if ( empty($arItems)) {return;}
        $oldPic=$arItems->image;
        if ($oldPic!='') {
            $urlPic='public/images/'.$oldPic;
            Storage::delete($urlPic);
        }
        if ($arItems->delete()) {
            $request->session()->flash('msg', 'Film deleted successfully');
            return redirect()->route('admin.votes.index');
        }else{
            $request->session()->flash('msg','Film deleted fail');
            return redirect()->route('admin.votes.index');
        }
    }

    public function bookingSeat(Request $request)
    {
        $id_film = $request->id_film;
        $seat = $request->allSeatsVals;
        $id_room = $request->room_id;

        $a = $this->repository->find($id_film);
        $a->bookingSeat()->where('user_id','=',null)->delete();
        foreach ($seat as $value) {
            $getNumber = substr($value, 1);
            $getType = substr($value, 0, 1);
            $a->bookingSeat()->firstOrCreate(['name' => $value, 'seat_number' => $getNumber, 'type' => $getType, 'room_id' => $id_room]);

        }

//        $new = collect($book)->pluck('name')->toArray();
//        $deleteSeat = $a->fresh()->bookingSeat->whereNotIn('name', $new)->pluck('id')->toArray();
//        if (count($deleteSeat) > 0) {
//            foreach ($deleteSeat as $seat) {
//                $a->bookingSeat()->delete($seat);
//            }
//
//        }

    }

    public function bookingVip(Request $request){
        $name =$request->seatVip;
        $user_id =$request->user_id;
        $film_id =$request->film_id;
        $room_id =$request->room_id;
        $userId = Auth::id();
        $getFilmTop = $this->voterepository->getFimTicket();
        $userBook = $this->repository->userBook($getFilmTop->id,$userId);
        $getSeatDoneBook = $this->repository->getSeatDoneBook($getFilmTop->id,$user_id);
        $seatNeed = (int)$userBook->quantity;
        $f = count($name)+$getSeatDoneBook;
        if ((int)$f > $seatNeed){
            return response()->json([
                "status" => false,
            ]);
        }else{
            return $this->repository->bookingVip($film_id,$name,$room_id,$user_id);
        }
    }
}
