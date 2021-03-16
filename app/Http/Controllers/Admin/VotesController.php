<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingSeat;
use App\Models\Ticket;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\VoteRepository;
use App\Repositories\Interfaces\VoteValueRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VoteUpdateRequest;
use App\Http\Requests\VoteCreateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class VotesController extends Controller
{

    protected $repository;
    protected $userrepository;
    protected $votevalueRepository;

    public function __construct(VoteRepository $repository, UserRepository $userRepository, VoteValueRepository $voteValueRepository)
    {
       $this->repository =$repository;
       $this->userrepository =$userRepository;
       $this->votevalueRepository = $voteValueRepository;
    }

    public function index()
    {
//        $getValues = $this->repository->all();
        $getValues = $this->repository->winnerFilm();
        $now = date('Y-m-d H:i:s');
        $getMonthVotes = $this->repository->getMonthVote();
        if (!empty($getMonthVotes)){
            $getMonthVotes= $getMonthVotes->expiry_date;
        }

        return view('admin.votes.index',compact('getValues','getMonthVotes','now'));
    }

    public function store(VoteCreateRequest $request)
    {
        $date = $request->expiry_date;
        $dateTicket = $request->expiry_date_ticket;
        $value = date("Y-m-d\TH:i:s", strtotime($date));
        $valueTicket = date("Y-m-d\TH:i:s", strtotime($dateTicket));
        $rep = str_replace('T',' ',$value);
        $repTicket = str_replace('T',' ',$valueTicket);
        $arItem = [
            'question'=>$request->question,
            'month'=>$request->month,
            'expiry_date'=>$rep,
            'expiry_date_ticket'=>$repTicket,
            'allow_update'=>$request->allow_update,
            'type'=>$request->type,
        ];
        $this->repository->create($arItem);
        $request->session()->flash('msg', ' Vote created successfully');
        return redirect()->route('admin.votes.index');
    }

    public function update(VoteUpdateRequest $request, $id)
    {
        $date = $request->expiry_date;
        $dateTicket = $request->expiry_date_ticket;
        $value = date("Y-m-d\TH:i:s", strtotime($date));
        $valueTicket = date("Y-m-d\TH:i:s", strtotime($dateTicket));
        $rep = str_replace('T',' ',$value);
        $repTicket = str_replace('T',' ',$valueTicket);
        $arItem = [
            'question'=>$request->question,
            'month'=>$request->month,
            'expiry_date'=>$rep,
            'expiry_date_ticket'=>$repTicket,
            'allow_update'=>$request->allow_update,
        ];
        $this->repository->update($arItem,$id);
        $request->session()->flash('msg', ' Vote updated successfully');
        return redirect()->route('admin.votes.index');
    }

    public function destroy(Request $request,$id)
    {
        $this->repository->delete($id);
        $request->session()->flash('msg', ' Vote deleted successfully');
        return redirect()->route('admin.votes.index');
    }

    public function loadAjax(Request $request){
        $idRead = $request->idRead;
        $getMonth = $this->repository->find($idRead);
        $detailReads = $this->repository->getVoteValue($idRead);
        return response()->json([
            "status" => true,
            "html" => view("admin.votes._load", ["detailReads" => $detailReads,'idRead'=>$idRead,'getMonth'=>$getMonth])->render(),
        ]);
    }

    public function voteMonth()
    {

        //show fim
        $getMonthVotes = $this->repository->getMonthVote();
        if(!empty($getMonthVotes)){
            $now = date('Y-m-d H:i:s');
            if ($getMonthVotes->expiry_date < $now)
            {
                return redirect()->route('admin.ticket.index');
            }
        }

        if(!empty($getMonthVotes)){
            $getFims = $this->repository->getVoteValue($getMonthVotes->id);
        }else{
            $getFims  =[];
        }
        $datas =   $this->repository->getTopVote();



        return view('admin.votes.show',compact('getFims','datas','getMonthVotes'));
    }

    public function getIdVote(Request $request){
           $idVotes = $request->id;
           $user = Auth::user();
        $getLogin = Auth::user()->id;
       $data = $user->votes()->sync($idVotes);
        return json_encode( $data );
    }

    public function checkVote(Request $request){
        $idVote = Auth::user()->votes->pluck('pivot.vote_value_id');
        if(count($idVote) > 0)
        {
           return json_encode($idVote);
        }
    }

    public function getTicket(){
        $now = date('Y-m-d H:i:s');
        $getMonthVotes = $this->repository->getMonthVote()->expiry_date;
        $getMonthTicket= $this->repository->getMonthVote()->expiry_date_ticket;
        if($getMonthVotes > $now){
            return redirect()->route('admin.votes.show');
        }
        if ($getMonthTicket <$now){
            return redirect()->route('admin.posts.index');
        };

        $hoin = $this->userrepository->all();
        $listUsers = $this->repository->showUserTicket();
        $getFimTicket = $this->repository->getFimTicket();
        return view('admin.tickets.index',compact('listUsers','getFimTicket'));
    }

    public function ajaxTicket(Request $request){
        $arrayItem = [
            'user_id' => $request->id_user,
            'vote_value_id' => $request->vote_value_id,
            'quantity' => $request->quantity,
        ];
        $done = $this->repository->registerTicket($request->id_user,$request->vote_value_id,$request->quantity);
        return json_encode($done);
    }

    public function getSelectSeat(){
        $getFimTop = $this->repository->getFimTicket();
        $showRooms = $this->repository->showRooms();
        $showUsers = $this->repository->showUser();

        return view('admin.rooms.room1',compact('getFimTop','showRooms','showUsers'));
    }

    public function LoadSeat(Request $request){
        $ajaxShowSeat = $this->repository->ajaxShowSeat($request->room_id);
        $getMaxRow = $this->repository->maxSeatRow($request->room_id);
        $spaceRoom = $this->repository->spaceRoom($request->room_id);
        $showUsers = $this->repository->showUser();

        if($request->ajax()){
            return response()->json([
                "status" => true,
                "html" => view("admin.rooms.room01",['showUsers'=>$showUsers,'ajaxShowSeats'=>$ajaxShowSeat,'getMaxRows'=>$getMaxRow,'spaceRoom'=>$spaceRoom])->render(),
            ]);
        }
    }

    public function randomSeat(Request $request){
        $userId = Auth::id();
        $filmTop = $this->repository->getFimTicket();
        $userBook = $this->votevalueRepository->userBook($filmTop->id,$userId);
        $adminBook = $this->votevalueRepository->getSeatDoneBook($filmTop->id,$userId);
        $seatNeed = (int)$userBook->quantity - $adminBook;
        $getSeat = $this->votevalueRepository->getSeatNull($filmTop->id);
        $getSeatNulls = BookingSeat::where('user_id',null)->where('film_id',$filmTop->id)->count('name');
        if ((int)$getSeatNulls < (int)$seatNeed ){
            dd('Full seat');
        }
        else{
            $random = array_random($getSeat,$seatNeed);
            if (!empty($random)){
                $name = $random[0]['name'];
                if($seatNeed == 0){
                    return false;
                }elseif($seatNeed == 1){
                    $a=  $random[0]['seat_number'];
                    while ($a %2 == 0) {
                        $random = array_random($getSeat,$seatNeed);
                        $a=  $random[0]['seat_number'];
                        $name = $random[0]['name'];
                    }
                    $b = $this->repository->booking1Film($name,$filmTop->id,$userId);
                    return $name;
                }elseif($seatNeed == 2){
                    $random = array_random($getSeat,1);
                    $type = [];
                    $number = [];
                    $afterNumber=[];
                    $beforeNumber=[];
                    $list_name=[];
                    $afterName=[];
                    $beforeName=[];
                    $check = 0;
                    foreach ($random as $key=> $value){
                        $list_name[] = $value['name'];
                        $type[] = $value['type'];
                        $number[] = $value['seat_number'];
                        $afterNumber[] = $value['seat_number']+1;
                        $beforeNumber[] = $value['seat_number']-1;
                        $afterName[] = $value['type'].($value['seat_number']+1);
                        $beforeName[] = $value['type'].($value['seat_number']-1);
                        $d = $this->votevalueRepository->doneRandom($filmTop->id,$afterName[0])->count('user_id');
                        if ($d == 1){
                            $e = $this->votevalueRepository->doneRandom($filmTop->id,$beforeName[0])->count('user_id');
                            if ($e == 0){
                                $this->votevalueRepository->doneRandom($filmTop->id,$list_name)->update(['user_id' => $userId]);
                                $this->votevalueRepository->doneRandom($filmTop->id,$beforeName[0])->update(['user_id' => $userId]);
                                print_r ($list_name[0]);
                                print_r ($beforeName[0]);
                            }else{
                                $getSeatNull = $this->repository->checkSeatRandomNull($filmTop->id)->count('name');
                                if ($getSeatNull == 2){
                                    $this->votevalueRepository->doneRandom($filmTop->id,$list_name)->update(['user_id' => $userId]);
                                    $this->repository->checkSeatRandomNull($filmTop->id)->update(['user_id' => $userId]);
                                }else{
                                    $getSeat = $this->votevalueRepository->getSeatNull($filmTop->id);
                                    $this->votevalueRepository->doneRandom($filmTop->id,$list_name)->update(['user_id' => $userId]);
                                    $random = array_random($getSeat,1);
                                    $name = $random[0]['name'];
                                    $z = $this->repository->booking1Film($name,$filmTop->id,$userId);
                                    print_r ($list_name[0]);
                                    print_r ($name);
                                }
                            }
                        }else{
                            $this->votevalueRepository->doneRandom($filmTop->id,$list_name)->update(['user_id' => $userId]);
                            $this->votevalueRepository->doneRandom($filmTop->id,$afterName[0])->update(['user_id' => $userId]);
                            print_r ($list_name[0]);
                            print_r ($afterName[0]);

                        }
                    }
                }
                else{
                    $random = array_random($getSeat,$seatNeed);
                    $list_name=[];

                    foreach ($random as $key=> $value){

                        $list_name[] = $value['name'];
                    }
                    $c =  $this->repository->bookingNfilm($filmTop->id,$list_name,$userId);
                    return $list_name;
                }
            }
        }
    }

    public function LoadSeatChecked(Request $request){
        $id_film = $request->film_id;
        $id_room = $request->room_id;
        $a = $this->repository->LoadSeatChecked($id_film,$id_room);
        return json_encode($a);

    }



}
