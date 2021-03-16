<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RoomCreateRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Repositories\Interfaces\RoomRepository;


class RoomsController extends Controller
{

    protected $repository;

    public function __construct(RoomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $getRooms = $this->repository->getNameCinemas();
        $getCinemas = $this->repository->getCinemas();
        return view('admin.rooms.index',compact('getRooms','getCinemas'));
    }

    public function store(RoomCreateRequest $request)
    {
        $arItems = [
            'name' => $request->name,
            'number' => $request->number,
            'cinemas_id'=> $request->cinemas_id,
            'space' => $request->space
        ];
        $this->repository->create($arItems);
        $request->session()->flash('msg', ' Room created successfully');
        return redirect()->route('admin.rooms.index');
    }

    public function update(RoomUpdateRequest $request, $id)
    {
        $arRooms = [
            'name' => $request->name,
            'number' => $request->number,
            'cinemas_id'=> $request->cinemas_id,
             'space' => $request->space
        ];
        $this->repository->update($arRooms,$id);
        $request->session()->flash('msg', ' Room updated successfully');
        return redirect()->route('admin.rooms.index');
    }

    public function destroy(Request $request, $id)
    {
        $this->repository->delete($id);
        $request->session()->flash('msg', ' Room deleted successfully');
        return redirect()->route('admin.rooms.index');
    }


}
