<?php

namespace App\Repositories\Eloquents;

use App\Models\Room;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RoomTypeRepository;
use App\Models\RoomType;
use App\Validators\RoomTypeValidator;

/**
 * Class RoomTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RoomTypeRepositoryEloquent extends BaseRepository implements RoomTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomType::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
