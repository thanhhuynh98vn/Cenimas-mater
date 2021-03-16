<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\cinemasRepository;
use App\Models\Cinemas;
use App\Validators\CinemasValidator;

/**
 * Class CinemasRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class CinemasRepositoryEloquent extends BaseRepository implements CinemasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cinemas::class;
    }

    protected $model;

    public function all($columns = ['*'])
    {
      return Cinemas::all()->where('parent_id','!=','');

    }

    public function getCompanies()
    {
        return Cinemas::all()->where('parent_id','');
    }

    public function subDelete($id)
    {
        return Cinemas::where('parent_id',$id)->delete();

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
