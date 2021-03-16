<?php

namespace App\Repositories\Eloquents;

use App\Models\VoteValue;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RoomRepository;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Models\Cinemas;
/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RoomRepositoryEloquent extends BaseRepository implements RoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Room::class;
    }

    public function getNameCinemas()
    {
      return  DB::table('rooms')->join('cinemas','cinemas.id','=','rooms.cinemas_id')
            ->select('*','cinemas.name as cname','rooms.name as rname','rooms.id as rid')->get();
    }

    public function getCinemas()
    {
        return Cinemas::all()->where('parent_id','!=','');

    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
