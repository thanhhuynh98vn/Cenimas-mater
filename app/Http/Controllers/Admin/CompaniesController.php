<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinemas;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CompaniesCreateRequest;
use App\Http\Requests\CompaniesUpdateRequest;
use App\Repositories\Interfaces\CinemasRepository;

/**
 * Class CinemasController.
 *
 * @package namespace App\Http\Controllers\Admin;
 */
class CompaniesController extends Controller
{

    protected $repository;


    public function __construct(CinemasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $getCompaies = $this->repository->getCompanies();
        return view('admin.companies.index',compact('getCompaies'));
    }

    public function store(CompaniesCreateRequest $request)
    {
        $arItem = [
          'name'=>$request->name
        ];
        $this->repository->create($arItem);
        $request->session()->flash('msg', ' Company created successfully');
        return redirect()->route('admin.companies.index');
    }

    public function update(CompaniesUpdateRequest $request, $id)
    {
        $find = $this->repository->find($id);
        $find = [
            'name'=> $request->input('name'),
        ];
        $this->repository->update($find,$id);
        $request->session()->flash('msg', ' Company updated successfully');
        return redirect()->route('admin.companies.index');

    }

    public function destroy(Request $request,$id)
    {
        $getParent = $this->repository->find($id)->id;
        $this->repository->subDelete($getParent);
        $this->repository->delete($id);
        $request->session()->flash('msg', ' Company deleted successfully');
        return redirect()->route('admin.companies.index');
    }

}
