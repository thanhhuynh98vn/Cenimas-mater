<?php

namespace App\Repositories\Eloquents;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RoomSettingRepository;
use App\Models\RoomSetting;
use Illuminate\Support\Facades\DB;
/**
 * Class RoomSettingRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RoomSettingRepositoryEloquent extends BaseRepository implements RoomSettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomSetting::class;
    }

    public function showAlphabet()
    {
        return RoomType::all();
    }

    public function showRoom()
    {
        return Room::all();
    }

    public function showUser(){
        return User::all();
    }
    public function showIndex()
    {
        return DB::table('room_type')->join('room_settings','room_type.id','=','room_settings.alphabet_id')
            ->join('rooms','rooms.id','=','room_settings.room_id')->select('*','room_settings.number as sNumber','room_settings.id as rId')->get();
    }

    public function checkUniqueAlphabet($roomId, $alphabetId)
    {
        $setting = RoomSetting::where('room_id', $roomId)->where('alphabet_id', $alphabetId)->first();

        if($setting != null){
            return false;
        }
        else {
            return true;
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
