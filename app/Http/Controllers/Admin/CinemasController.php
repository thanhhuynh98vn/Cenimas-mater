<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CinemasCreateRequest;
use App\Http\Requests\CinemasUpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CinemasRepository;

/**
 * Class CinemasController.
 *
 * @package namespace App\Http\Controllers\Admin;
 */
class CinemasController extends Controller
{

    protected $repository;



    public function __construct(CinemasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $getCinemas = $this->repository->all();
        $getCompaies = $this->repository->getCompanies();
        return view('admin.cinemas.index',compact('getCinemas','getCompaies'));
    }

    public function store(CinemasCreateRequest $request)
    {
        $arItems = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'address'=> $request->address,
            'phone' => $request->phone,
        ];
        $this->repository->create($arItems);
        $request->session()->flash('msg', ' Cinemas created successfully');
        return redirect()->route('admin.cinemas.index');
    }

    public function update(Request $request, $id){
        $arItems = $this->repository->find($id);
        $arItems = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'address'=> $request->address,
            'phone' => $request->phone,
        ];
        $this->repository->update($arItems,$id);
        $request->session()->flash('msg', ' Cinemas updated successfully');
        return redirect()->route('admin.cinemas.index');
    }

    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);
        $request->session()->flash('msg', ' Cinemas deleted successfully');
        return redirect()->route('admin.cinemas.index');
    }

}
