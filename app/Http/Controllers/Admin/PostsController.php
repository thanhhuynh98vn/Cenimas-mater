<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Post;
use App\Models\Post_Tag;
use App\Models\Tag;
use App\Repositories\Interfaces\RolesRepository;
use App\Repositories\Interfaces\VoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Interfaces\PostRepository;
use Illuminate\Support\Facades\Storage;
use Entrust;
/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends Controller
{
    protected $repository;
    protected $voteRepository;


    public function __construct(PostRepository $repository, VoteRepository $voteRepository)
    {
        $this->repository = $repository;
        $this->voteRepository = $voteRepository;
    }

    public function index()
    {
        $allPosts = $this->repository->with('tags','users')->get();
        $getTimeShowPopup = $this->voteRepository->getMonthVote();
        return view('admin.posts.index',compact('allPosts','getTimeShowPopup'));
    }

    public function create(Request $request)
    {
        return view('admin.posts.create');
    }

    public function store(PostCreateRequest $request)
    {
        $arItem = [
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'content'=>$request->input('description'),
            'slug'=>$request->input('slug'),
            'view'=>0,
            'author_id'=>Auth::user()->id
        ];
        $picture = $request->avatar;
        if ($picture !='') {
            $patUpload = $request->file('avatar')->store('public/avatar');
            $tmp=explode('/',$patUpload);
            $picture=end($tmp);
            $arItem['avatar']=$picture;
        } else {
            $arItem['avatar']='';
        }
        $getPost=$this->repository->create($arItem);
        $getTags=$request->tags;
        $tags= explode(",", $getTags );
        foreach ($tags as $tag=>$value) {
            $tag = $this->repository->firstOrNew(['name' => $value]);
            $tag->save();
            $article = $this->repository->find($getPost->id);
            $article->tags()->attach($tag->id);
        }
        $request->session()->flash('msg', ' Post created successfully');
        return redirect()-> route('admin.posts.index');

    }

    public function show($id)
    {
      $showDetail = $this->repository->find($id)->with('tags')->first();
      dd($showDetail);
    }

    public function edit($id)
    {
        $hasRole = Entrust::hasRole('superadmin');
        $getEdit = $this->repository->find($id);
        $AuthorLogin = Auth::user();
        if ($hasRole || $getEdit->author_id == $AuthorLogin->id ) {
            $arTag = $this->repository->editTag($getEdit->id);
            $tagsList = [];
            foreach ($arTag as $k => $v) {
                $tagsList[] = $v['tag_name'];
            }
            $tagsList = implode(',', $tagsList);
            return view('admin.posts.edit',['tagsList'=>$tagsList,'getEdit'=>$getEdit]);
        }
        if( $getEdit->author_id != $AuthorLogin->id ){
            return redirect('403');
        }
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $arItem = $this->repository->find($id);
        $AuthorLogin = Auth::user();
        $hasRole = Entrust::hasRole('superadmin');

        if ($hasRole || $arItem->author_id == $AuthorLogin->id) {
            $id = (int)$request->id;
            if (empty($arItem)) {return;}
            $picture = $request->avatar;
            $patUpload = $request->file('avatar');
            if (!empty($patUpload)) {
                $patUpload = $patUpload->store('public/avatar');
                $tmp = explode('/',$patUpload);
                $picture = end($tmp);
                $oldPic = $arItem->avatar;
                if($oldPic!=''){
                    Storage::delete('public/avatar/'.$oldPic);
                }
                $arItem->avatar=$picture;
            }
            $arItem->title = $request->title;
            $arItem->description = $request->description;
            $arItem->content = $request->contents;
            $arItem->slug = $request->slug;
            $arItem->view = $this->repository->find($id)->view;
            $arItem->author_id = Auth::user()->id;
            $getTags=$request->tags;
            $tags= explode(",", $getTags );
            $query=$arItem->tags()->count();
            if ($query == 0 ) {
                foreach($tags as $tag=>$value){
                    $tag = $this->repository->firstOrNew(['name' => $value]);
                    $tag->save();
                    $article = $this->repository->find($arItem->id);
                    $article->tags()->attach($tag->id);
                }
            } else {
                $article = $this->repository->find($arItem->id);
                $article->tags()->detach();
                foreach ($tags as $tag=>$value) {
                    $arTag=[
                        'name'=>$value
                    ];
                    $tag = $this->repository->firstOrNew($arTag);
                    $tag->save();
                    $arCould=[
                        'id_post'=>$id,
                        'id_tag'=>$tag->id
                    ];
                    $article = $this->repository->find($arItem->id);
                    $article->tags()->attach($tag->id);
                }
            }
            if ($arItem->update()) {
                $request->session()->flash('msg','Post updated successfully');
                return redirect()->route('admin.posts.index');
            } else {
                $request->session()->flash('msg','Post updated fail!');
                return redirect()->route('admin.posts.index');
            }
        }
        if ( $arItem->author_id != $AuthorLogin->id) {
            return redirect('403');
        }
    }

    public function destroy($id, Request $request)
    {
        $AuthorLogin = Auth::user();
        $hasRole = Entrust::hasRole('superadmin');
        $id= (int)$request->id;
        $arItems = $this->repository->find($id);
        if ($hasRole || $arItems->author_id == $AuthorLogin->id) {
            $arItems->tags()->detach();
            if ( empty($arItems)) {return;}
            $oldPic=$arItems->avatar;
            if ($oldPic!='') {
                $urlPic='public/avatar/'.$oldPic;
                Storage::delete($urlPic);
            }
            if ($arItems->delete()) {
                $request->session()->flash('msg', 'Post deleted successfully');
                return redirect()->route('admin.posts.index');
            }else{
                $request->session()->flash('msg','Post deleted fail');
                return redirect()->route('admin.posts.index');
            }
        }
        if ( $arItems->author_id != $AuthorLogin->id) {

            return redirect('403');
        }
    }
}
