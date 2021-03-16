<?php

namespace App\Repositories\Eloquents;

use App\Models\BookingSeat;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Ticket;
use App\Models\Vote;
use App\Repositories\Interfaces\VoteRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\DB;
use App\Models\User;
/**
 * Class VoteRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class VoteRepositoryEloquent extends BaseRepository implements VoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vote::class;
    }


    public function  getTopVote(){
        $listVote = DB::table('vote_value')
            ->selectRaw('vote_value.* ,(select count(vote_value_user.id) from vote_value_user where vote_value_id = vote_value.id ) as vote ')
            ->whereIn( 'vote_id',DB::table('votes')->select('id')->whereMonth('created_at',date('m'))
            ->whereYear('created_at',date('Y')))
            ->orderBy('vote','DESC')
            ->limit(3) ->get();
        return $listVote;

    }

    public function getVoteValue($id)
    {
        return $detailReads = DB::table('vote_value')->where('vote_id',$id)->get();
    }

    public function getMonthVote()
    {
        return DB::table('votes')
            ->whereMonth('created_at',date('m') )->whereYear('created_at',date('Y'))
            ->first();

    }


    public function winnerFilm()
    {
        $vote = Vote::with(['vote_values' => function($q){
            return $q->withCount('users as vote_count')->latest('vote_count')->get();
        }])->get()->map(function($vote) {
            return $vote->setRelation('vote_values', $vote->vote_values->first());
        });
        return $vote;
    }

    public function getFimTicket()
    {
        $listVote = DB::table('vote_value')
            ->selectRaw('vote_value.* ,(select count(vote_value_user.id) from vote_value_user where vote_value_id = vote_value.id ) as vote ')
            ->whereIn( 'vote_id',DB::table('votes')->select('id')->whereMonth('created_at',date('m'))
                ->whereYear('created_at',date('Y')))
            ->orderBy('vote','DESC')
            ->first();
        return $listVote;
    }

    public function registerTicket($user_id,$vote_value_id,$quantity)
    {
        $ticket = Ticket::where('user_id', $user_id)->where('vote_value_id', $vote_value_id)->first();
        if($ticket == null){
            Ticket::insert([
               'user_id' =>$user_id,
               'vote_value_id' => $vote_value_id,
               'quantity' => $quantity
            ]);
        }
        else{
            $ticket->quantity = $quantity;
            $ticket->save();
        }

        return $ticket;
    }

    public function showUserTicket()
    {
        //Lay film co luot vote cao nhat
        $FilmTopVote = $this->getFimTicket();

        $ticket = User::with(['tickets' => function ($q) use ($FilmTopVote)  {
           $q->where('tickets.vote_value_id', $FilmTopVote->id)->toSql();
        }])->get();
        return $ticket;
    }

    public function showRooms()
    {
        return Room::all();
    }

    public function ajaxShowSeat($idRoom)
    {
        $get = DB::table('room_type')
            ->select('*','room_settings.number as rnumber')
            ->join('room_settings','room_settings.alphabet_id','=','room_type.id')
            ->join('rooms','rooms.id','=','room_settings.room_id')
            ->where('room_id',$idRoom)->orderBy('alphabet')->get();
        return $get;
    }

    public function showUser(){
        $FilmTopVote = $this->getFimTicket();

        $b = User::join('tickets','users.id','=','tickets.user_id')->select('users.id as uId','users.name as name')->where('tickets.quantity','!=',0)->where('tickets.vote_value_id',$FilmTopVote->id)->get();
        return $b;
    }

    public function maxSeatRow($idRoom)
    {
        $getMax = DB::table('room_type')->join('room_settings','room_settings.alphabet_id','=','room_type.id')
            ->where('room_id',$idRoom)->max('number');
        return $getMax;
    }

    public function spaceRoom($idRoom)
    {
        return Room::where('id',$idRoom)->first();
    }

    public function booking1Film($name, $filmId, $userId)
    {
       return BookingSeat::where('name',$name)->where('film_id',$filmId)->update(['user_id'=>$userId]);
    }

    public function bookingNfilm($filmId, $name, $userID)
    {
        return BookingSeat::where('film_id',$filmId)->whereIn('name',$name)->update(['user_id'=>$userID]);
    }
    public function LoadSeatChecked($filmId, $roomId)
    {
        return BookingSeat::all()->where('film_id',$filmId)->where('room_id',$roomId);
    }

    public function checkSeatRandomNull($filmId)
    {
        return BookingSeat::where('user_id',null)->where('film_id',$filmId);
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
