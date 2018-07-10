<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\News\Http\Requests\CatAddRequest;
use Modules\News\Http\Requests\CatEditRequest;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Region;
use Modules\News\Repositories\Categoryes\CategoryRepository;
use Yajra\Datatables\Datatables;

class NewsCategoryController extends Controller
{

    protected $category;


    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $categories = NewsCategory::where('status', '>', NewsCategory::STATUS_DELETED)->get();
        return view('news::news_category.index', compact('categories'));
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        if(request()->get('action')=='get'){
            $categories = NewsCategory::where('status',1)->with('region')->getNestedList(true);
            return $categories;
        }else{
            $categories = NewsCategory::where('status',1)->orderBy('position','ASC')->get();
//            $regions = Region::select(['id','name','lang_code'])->whereNull('deleted_at')->get();
            return view('news::news_category.create', compact('categories'));
        }
    }



    /**
     * @param Request $request
     * @return string
     */
    public function checkRegion(Request $request){
        $data = $request->all();
        $categories = NewsCategory::select(['id','name','region_id'])->where('status','>=',0)->where('id','=',$data['id'])->first();
        $result= $categories->region_id;
        return $result;
    }



    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CatAddRequest $request)
    {
        try {

            $data = $request->only(['parent_id', 'name', 'position', 'cover', 'summary','slug','status']);
            $data['region_id']=3;
            if ($request->slug == '') {
                $data['slug'] = str_slug($request->name);
            }

            if ($request->position == '') {
                $data['position'] = 0;
            }
            if(!isset($request->status)){
                $data['status'] = 0;
            }

            if($request->hasFile('cover')){
                $img = $request->file('cover')->getClientOriginalName();
                $request->cover->move('img/category',$img);
                $data['cover'] = $img;
            }
    
            $data['created_id'] = Auth::id();
            
            $add = NewsCategory::create($data);
            if($request->ajax()){
                return $add;
            }else{
                return redirect(route('news.news_category.index'))->with('messages',trans('news::Controller.category_add'));
            }
        } catch (\Exception $ex) {
            Log::error('[NewsCategory] ' . $ex->getMessage());

            return redirect()->back()->withInput();
        }
    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
//        $type_order = ($request->checkTypeOrder!=null)?$request->checkTypeOrder:0;

        return Datatables::of($this->category->getForDataTable())

            ->filter(function ($query) use ($request) {
                if (($request->get('checkHasChildren')=="1")&&(($request->get('category')) != "-1")) {
                    $query->where(function($q) use($request){
                       $q->where('id', $request->get('category'));
                       $q->orwhere('parent_id',$request->get('category'));
                    });
                }
                elseif ((!$request->has('checkHasChildren'))&&(($request->get('category')) != "-1")) {
                    $query->where('id', $request->get('category'));
                }
                elseif((!$request->has('checkHasChildren'))&&(($request->get('category')) == "-1")){
                    $query->where('parent_id', 0);
                }
            })

            ->escapeColumns([])
            ->editColumn('name',function ($category){
                return $category->name;
            })
            ->editColumn('parent_id',function ($category){
                if($category->parent_id ==0){
                    return "<label class='label label-info'>Root category</label>";
                }else{
                    $parentCategory = NewsCategory::where('id',$category->parent_id)->select(['name','parent_id'])->first();
                    $checklevel = ($parentCategory->parent_id == 0)?1:2;
                    if($checklevel == 1) {
                        return "<label class='label label-warning'>Belong to <i>".$parentCategory['name']."</i></label>";
                    }
                    else {
                        return "<label class='label bg-purple-active color-palette'>Belong to <i>".$parentCategory['name']."</i></label>";
                    }

                }
            })
            ->editColumn('status',function ($category){
                if($category->status == 1){
                    return "<label class='label label-success'>Active</label>";
                }else{
                    return "<label class='label label-warning'>Unactive</label>";
                }
            })
            ->addColumn('actions',function ($category){
                $html   = view('news::includes.category.colum',['module' => 'actions', 'column' => 'actions','category'=>$category])->render();
                return $html;
            })
            ->make(true);
    }
    public function edit($id)
    {
        // Get category info
        $category = NewsCategory::with('region')->where('id','=',$id)->first();
        $categories = NewsCategory::where('status',1)->orderBy('position','ASC')->get();
        //$categories = NewsCategory::getNestedList(true);
        $regions = Region::select(['name','id','lang_code'])->whereNull('deleted_at')->get();
        return view('news::news_category.edit', compact('category', 'categories','regions'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CatEditRequest $request, $id)
    {
        try {
            $data = $request->only(['parent_id', 'name', 'position', 'cover', 'summary','slug','status']);
            $category = NewsCategory::find($id);
            if ($request->slug = '') {
                $data['slug'] = str_slug($request->name);
            }

            if ($request->position == '') {
                $data['position'] = 0;
            }

            if($request->hasFile('cover')){
                $img = $request->file('cover')->getClientOriginalName();
                $request->cover->move('img/category',$img);
                $data['cover'] = $img;
            }
            else {
                $data['cover'] = $category->cover;
            }

            $category->update($data);

            return redirect(route('news.news_category.index'))->with('messages','Edit category successfully');
        } catch (\Exception $ex) {
            Log::error('[NewsCategory] ' . $ex->getMessage());

            return redirect()->back()->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $obj = NewsCategory::find($id);
        if ($obj) {
            $obj->status = NewsCategory::STATUS_DELETED;
            $obj->save();

            return redirect(route('news.news_category.index'))->with('messages',trans('news::Controller.category_delete'));
        } else {
            return Redirect::route('news.news_category.index')->withErrors([trans('news::Controller.category_delete_fail')]);
        }
    }


}
