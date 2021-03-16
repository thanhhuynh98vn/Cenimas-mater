<?php

namespace App\Repositories\Eloquents;

use App\Models\BookingSeat;
use App\Models\VoteValue;
use App\Repositories\Interfaces\VoteValueRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class VoteValueRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class VoteValueRepositoryEloquent extends BaseRepository implements VoteValueRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VoteValue::class;
    }
    public function bookingSeat($filmId, $bookingSeat)
    {
        $getFilm = VoteValue::find($filmId);
        $getFilm->booking_seat= $bookingSeat;
       return $getFilm->update();

    }
    public function bookingVip($filmId,$name, $roomId,$userId)
    {
       $check = BookingSeat::where('film_id',$filmId)->where('room_id',$roomId);
       $a = $check->whereIn('name',$name)->where('user_id','=',null)->update(['user_id'=>$userId]);
       return $a;
    }
    public function userBook($filmId, $userId)
    {
        $userBook = \App\Models\Ticket::where('vote_value_id',$filmId)->where('user_id',$userId)->first();
        return $userBook;
    }

    public function getSeatDoneBook($filmId, $userId)
    {
        $getSeatDoneBook = BookingSeat::where('film_id',$filmId)->where('user_id',$userId)->count('name');
        return $getSeatDoneBook;
    }
    public function getSeatNull($filmId)
    {
        $getSeat = BookingSeat::where('user_id',null)->where('film_id',$filmId)->get()->toArray();
        return $getSeat;
    }

    public function doneRandom($filmID, $name)
    {
        $n = BookingSeat::where('film_id',$filmID)->where('name',$name);
        return $n;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
