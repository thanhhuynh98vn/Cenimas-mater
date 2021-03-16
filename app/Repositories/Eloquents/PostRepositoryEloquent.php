<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PostRepository;
use App\Models\Post;
use App\Validators\PostValidator;
use App\Models\Tag;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    protected $model;

    /**
     * Boot up the repository, pushing criteria
     */


    public function firstOrNew(array $attributes = [])
    {
        return Tag::firstOrNew($attributes);
    }

    public function editTag($id)
    {
        return Post::select('tags.name as tag_name')->join('post_tag','posts.id','=','post_tag.id_post')
            ->join('tags','tags.id','=','post_tag.id_tag')->where('post_tag.id_post',$id)->get()->toArray();
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
