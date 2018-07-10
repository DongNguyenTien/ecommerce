<?php

namespace Modules\News\Http\Controllers;

use function GuzzleHttp\Psr7\parse_query;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Core\Models\Group;
use Modules\Core\Models\UserGroup;
use Modules\News\Http\Requests\PostAddRequest;
use Modules\News\Http\Requests\PostEditRequest;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\NewsCategoryPost;
use Modules\News\Models\NewsPost;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Modules\News\Repositories\Post\PostRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\News\Models\NewsTag;
use Modules\News\Models\NewsTagsPost;

class NewsPostController extends Controller
{
    protected $post;
    
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
        
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return to index post
     */
    public function index()
    {

        $all_category = NewsCategory::where('parent_id', 0)->where('status', 1)->orderBy('position', 'ASC')->get();
        
        //List Category to show in filter Post
        $listCategory = array();
        foreach ($all_category as $item) {
            $listCategory[] = $item;
            $childrenCate = NewsCategory::where('parent_id', $item['id'])->where('status', 1)->get();
            foreach ($childrenCate as $subitem) {
                $subitem['name'] = '--' . $subitem['name'];
                $listCategory[] = $subitem;
                $childrenLevel3 = NewsCategory::where('parent_id', $subitem['id'])->where('status', 1)->get();
                foreach ($childrenLevel3 as $lv3item) {
                    $lv3item['name'] = '----' . $lv3item['name'];
                    $listCategory[] = $lv3item;
                }
            }
        }
        
        //Tags
        //$tags = NewsTag::all();
        
//        $post_id_tags = NewsPost::where('status', 1)->select('id')->get()->toArray();
//        $tags = NewsTagsPost::whereIn('post_id', $post_id_tags)->select('tag_id')->groupBy('tag_id')->get();
//        $tags = NewsTag::whereIn('id', $tags->toArray())->get();
        return view('news::news_post.index', compact('listCategory'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $data = NewsPost::getMyNews(Auth::id());
        return Datatables::of($data)
            ->filter(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (($value == "") || ($value == -1) || ($value == null)) {
                    
                    } else {
                        if ($key == 'title') {
                            $query->where('news_posts.title', 'LIKE', '%' . $value . '%');
                        } elseif ($key == 'published_at') {
                            $query->whereDate('published_at', Carbon::parse($value)->toDateTimeString());
                        } elseif ($key == 'post_status') {
                            $query->where('post_status', $value);
                        } elseif ($key == 'tag') {
                            $query->whereHas('tags', function ($q) use ($value) {
                                $q->where('name', $value);
                            });
                        } elseif ($key == 'category') {
                            //Check category -> get all children category -> select all post of list category above
                            $checkCate = NewsCategory::where('status', 1)->where('id', $value)->select(['parent_id', 'id'])->first();
                            
                            //List all this cate  + all child category
                            $finallist = array();
                            $finallist[] = $checkCate['id'];
                            
                            $listChildrenCategory = NewsCategory::where('status', 1)->where('parent_id', $checkCate['id'])->select(['id', 'parent_id'])->get();
                            foreach ($listChildrenCategory as $item) {
                                $finallist[] = $item['id'];
                                foreach (NewsCategory::where('status', 1)->where('parent_id', $item['id'])->select(['id', 'parent_id'])->get() as $subitem) {
                                    $finallist[] = $subitem['id'];
                                }
                            }
                            
                            $query->whereIn('news_posts.id', function ($q) use ($finallist) {
                                return $q->select('post_id')->from('news_category_posts')->whereIn('news_category_posts.category_id', $finallist);
                            });
                        }
                    }
                }
            })
            ->escapeColumns([])
            ->editColumn('published_at', function ($post) {
//                Carbon::setLocale('en');
//                return Carbon::parse($post->published_at)->diffForHumans();
                return Carbon::parse($post->published_at)->format('d M Y');
            })
            ->editColumn('post_status', function ($post) {
                if ($post->post_status == NewsPost::STATUS_PUBLISHED) {
                    return "<label class='label label-success'>Release</label>";
                } else {
                    return "<label class='label label-warning'>Draft</label>";
                }
            })
            ->editColumn('post_view', function ($post) {
                return number_format((int)$post->post_view, 0);
            })
            ->editColumn('created_at', function ($post) {
                return Carbon::parse($post->created_at)->format('d M Y');
            })
            ->addColumn('category', function ($post) {
                $data = '';
                foreach ($post->cat as $val) {
                    if ($val->parent_id == 0) {
                        $data .= "<label class='label label-default'>" . $val->name . "</label>" . ' ';
                    } else {
                        $parent_cate = NewsCategory::where('id', $val->parent_id)->first();
                        $data .= "<label class='label label-default'>" . $val->name . "(Belong to " . $parent_cate->name . ")</label>" . ' ';
                    }
                    
                }
                return $data;
            })
            /*->addColumn('tag', function ($post) {
                $data = '';
                foreach ($post->tags as $val) {
                    $data .= "<label class='label label-info'>" . $val->name . "</label>" . ' ';
                }
                return $data;
            })*/
            ->addColumn('actions', function ($post) {
                $html = view('news::includes.post.colum', ['module' => 'actions', 'column' => 'actions', 'post' => $post])->render();
                return $html;
            })
            ->make(true);
    }
    
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user_id = Auth::id();
        $group = UserGroup::where('user_id', $user_id)->select('group_id')->first();
        $listCatePermission = Group::where('id', $group['group_id'])->select('category')->first();
        if (count($listCatePermission->category) == 0) {
            $listCatePermission = [];
        } else {
            $listCatePermission = \GuzzleHttp\json_decode($listCatePermission->category);
        }
        $categories = NewsCategory::where('status', 1)->orderBy('position')->orderBy('name')->get();
        return view('news::news_post.create', compact('categories', 'listCatePermission'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(PostAddRequest $request)
    {
        try {
            $data = $request->only(['title', 'summary', 'data', 'post_type', 'post_status', 'slug', 'category']);
            if ($request->slug == '') {
                $data['slug'] = str_slug($request->title);
            }
            
            if ($request->post_status == '') {
                $data['post_status'] = 0;
            }
            $data['published_at'] = Carbon::parse($request->published_at)->toDateTimeString();
            
            if ($request->hasFile('thumbnail')) {
                $img = $request->file('thumbnail')->getClientOriginalName();
                $request->thumbnail->move('img/posts', $img);
                $data['images'] = $img;
                $thumnail = Image::make('img/posts/' . $img)->resize(300, 200);
    
                $thumnail->save('img/posts/thumbnail_' . $img);
                $data['thumbnail'] = 'thumbnail_' . $img;
            }
            
            $media = NewsPost::uploadMedia();
            
            $data['media'] = json_encode($media);
            $data['created_id'] = Auth::id();
            $data['author'] = Auth::user()->username;
            
            //Create Object Here
            $post = NewsPost::create($data);
    
            // Update post category
            if (isset($request->category) && !empty($request->category)) {
                // Update post category
                if (isset($request->category)) {
                    NewsCategoryPost::updateForPost($post->id, $request->category);
                }
            }
            
            return redirect(route('news.news_post.index'))->with('messages', trans('news::Controller.post_add'));
        } catch (\Exception $ex) {
            Log::error('[NewsPost] ' . $ex->getMessage());
            return redirect()->back()->withInput()->with('messages', 'Something wrong');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $post = NewsPost::find($id);
        $tag = $post->tags()->get(['name']);
        
        $old_cate_id = array();
        $array_category = NewsCategoryPost::select('category_id')->where('post_id', '=', $id)->get()->toArray();
        //Checked Cate
        foreach ($array_category as $item) {
            $old_cate_id[] = $item['category_id'];
        }
        $categories = NewsCategory::where('status', 1)->orderBy('position')->orderBy('name')->get();
        
        //Permission Category
        $user_id = Auth::id();
        $group = UserGroup::where('user_id', $user_id)->select('group_id')->first();
        $listCatePermission = Group::where('id', $group['group_id'])->select('category')->first();
        if (count($listCatePermission->category) == 0) {
            $listCatePermission = [];
        } else {
            $listCatePermission = \GuzzleHttp\json_decode($listCatePermission->category);
        }

        $user_id = Auth::id();
        $listCateCreated = NewsCategory::where('created_id',$user_id)->select('id')->get();
        $listCategoryCreated = array();
        foreach($listCateCreated as $item){
            $listCategoryCreated[]=$item->id;
        }

        return view('news::news_post.edit', compact('post', 'categories', 'tag', 'old_cate_id', 'listCatePermission','listCategoryCreated'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(PostEditRequest $request, $id)
    {
        try {
            $post = NewsPost::find($id);
            
            $request->only(['title', 'images', 'summary', 'data', 'post_type', 'slug', 'post_status', 'category']);
            if ($request->slug == '') {
                $post['slug'] = str_slug($request->title);
            } else $post['slug'] = $request->slug;
            
            $post['title'] = $request->title;
            $post['summary'] = $request->summary;
            $post['data'] = $request->data;
            $post['post_type'] = $request->post_type;
            $post['post_status'] = $request->post_status;
            $post['published_at'] = Carbon::parse($request->published_at)->toDateTimeString();

            //Image
            $media = NewsPost::uploadMedia();

            $post['media'] = json_encode($media);
            
            if ($request->hasFile('thumbnail')) {
                $img = $request->file('thumbnail')->getClientOriginalName();
                if ($img != $post['images']) {
                    $request->file('thumbnail')->move('img/posts', $img);
                    $post['images'] = $img;
                    $thumbnail = Image::make('img/posts/' . $img)->resize(300, 200);
    
                    $thumbnail->save('img/posts/thumbnail_' . $img);
                    $post['thumbnail'] = 'thumbnail_' . $img;
                }
            }
            
            $post->save();
    
            // Update post category
            if (isset($request->category)) {
                NewsCategoryPost::updateForPost($id, $request->category);
            }
            
            return redirect()->route('news.news_post.index')->with('messages', trans('news::Controller.post_edit'));
        } catch (\Exception $ex) {
            Log::error('[NewsPost] ' . $ex->getMessage());
            return redirect()->back()->withInput()->with('message', $ex->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $obj = NewsPost::where("id", $id)->first();
        if ($obj) {
            $obj->post_status = NewsPost::STATUS_DELETED;
            $obj->deleted_at = date('Y-m-d H:i:s');
            $obj->deleted_id = Auth::id();
            $obj->save();
    
            // Delete new category post
            DB::table('news_category_posts')->where('post_id', $id)->delete();
            
            // Delete new tag post
            DB::table('news_tags_post')->where('post_id', $id)->delete();
            
            return redirect(route('news.news_post.index'))->with('messages', trans('news::Controller.post_delete'));
        } else {
            return Redirect::route('news.news_post.index')->withErrors([trans('news::Controller.post_delete_fail')]);
        }
    }
    
}
