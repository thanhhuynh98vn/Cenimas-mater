<?php

namespace App\Repositories\Eloquents;

use App\Models\BookingSeat;
use App\Models\Ticket;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\DashboardRepository;
use App\Models\Dashboard;
use Illuminate\Support\Facades\DB;
/**
 * Class DashboardRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class DashboardRepositoryEloquent extends BaseRepository implements DashboardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
//    private $filmTop;
    public function model()
    {
        return Dashboard::class;
    }

    public function showDasboard()
    {
        $filmTop = DB::table('vote_value')
            ->selectRaw('vote_value.* ,(select count(vote_value_user.id) from vote_value_user where vote_value_id = vote_value.id ) as vote ')
            ->whereIn( 'vote_id',DB::table('votes')->select('id')->whereMonth('updated_at',date('m'))
                ->whereYear('updated_at',date('Y')))
            ->orderBy('vote','DESC')
            ->first();
        return $filmTop;

    }

    public function totalTicker()
    {

        $filmTop = $this->showDasboard();
        if (!empty($filmTop)){
            $Total = Ticket::where('vote_value_id',$filmTop->id)->sum('quantity');
            return $Total;
        }

    }

    public function ticketDone()
    {
        $filmTop = $this->showDasboard();
        if (!empty($filmTop)){
            $c = BookingSeat::join('users','booking_seat.user_id','=','users.id')
                ->select('booking_seat.name', 'booking_seat.user_id','users.name as uname')
                ->where('film_id',$filmTop->id)->where('user_id','!=',null)->get();
            return $c;
        }

    }
    public function doneBook()
    {
        $filmTop = $this->showDasboard();
        if(!empty($filmTop)){
            $d = BookingSeat::where('film_id',$filmTop->id)->count('name');
            return $d;
        }

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
