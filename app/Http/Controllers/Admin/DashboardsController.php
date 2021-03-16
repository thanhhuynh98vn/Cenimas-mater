<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DashboardCreateRequest;
use App\Http\Requests\DashboardUpdateRequest;
use App\Repositories\Interfaces\DashboardRepository;
use App\Validators\DashboardValidator;


class DashboardsController extends Controller
{

    protected $repository;



    public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $show =$this->repository->showDasboard();
        $totalTicker =$this->repository->totalTicker();
        $list = $this->repository->ticketDone();
        if (!empty($list)){
            $list_id=[];
            $total = $this->repository->doneBook();
            foreach ($list as $key=>$value) {
                $list_id[$value->uname][] = $value->name;
            }
        }
//        dd($list);
        return view('admin.dashboard.index',compact('show','totalTicker','list_id','total'));
    }

}
