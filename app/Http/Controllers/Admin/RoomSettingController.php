<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\RoomSettingRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RoomTypeCreateRequest;
use App\Http\Requests\RoomTypeUpdateRequest;


class RoomSettingController extends Controller
{
    protected $repository;


    public function __construct(RoomSettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $showIndex = $this->repository->showIndex();
        $showRooms = $this->repository->showRoom();
        $showUsers = $this->repository->showUser();
        $showAlphabet = $this->repository->showAlphabet();
        return view('admin.settingrooms.index',compact('showRooms','showAlphabet','showIndex','showUsers'));
    }

    public function store(RoomTypeCreateRequest $request)
    {
        $arItemSetting = [
            'number' => $request->number,
            'room_id' => $request->room_id,
            'alphabet_id' => $request->alphabet_id
        ];
        $checkValidate = $this->repository->checkUniqueAlphabet($request->room_id,$request->alphabet_id);
        if($checkValidate == false){
            $request->session()->flash('msg', ' Alphabet and Room unique!');
            return redirect()->route('admin.settingrooms.index');
        };
        $this->repository->create($arItemSetting);
        $request->session()->flash('msg', ' Setting rooms created successfully');

        return redirect()->route('admin.settingrooms.index');

    }

    public function update(RoomTypeUpdateRequest $request, $id)
    {

        $arItemSetting = [
            'number' => $request->number,
            'room_id' => $request->room_id,
            'alphabet_id' => $request->alphabet_id
        ];
//        $checkValidate = $this->repository->checkUniqueAlphabet($request->room_id,$request->alphabet_id);
//        if($checkValidate == false){
//            $request->session()->flash('msg', ' Alphabet and Room unique!');
//            return redirect()->route('admin.settingrooms.index');
//        };
        $this->repository->update($arItemSetting,$id);
        $request->session()->flash('msg', ' Setting rooms updated successfully');

        return redirect()->route('admin.settingrooms.index');

    }

    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);
        $request->session()->flash('msg', ' Setting rooms deleted successfully');
        return redirect()->route('admin.settingrooms.index');
    }
}
