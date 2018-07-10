<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Modules\News\Models\Region;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Modules\News\Models\NewsCategory;

class RegionController extends Controller
{

    /**
     * @param Datatables $datatables
     * @param Request $request
     * @return mixed
     * Get data for Datatable
     */
    public function regionList(Datatables $datatables,Request $request){
        $list = new Region();
        return $datatables->of($list->whereNull('deleted_at')->select(['id','name','lang_code']))
            ->filter(function($query) use($request){
                if((!$request->has('name'))&&($request->language != '-1')){
                    return $query->where('lang_code',$request->language);
                }
                elseif(($request->has('name'))&&($request->language != '-1')){
                    return $query->where('lang_code',$request->language)->where('name','LIKE','%'.$request->name.'%');
                }
                elseif(($request->has('name'))&&($request->language == '-1')){
                    return $query->where('name','LIKE','%'.$request->name.'%');
                }
            })
            ->escapeColumns([])
            ->editColumn('lang_code',function($region){
                if($region->lang_code == 'vn'){
                    return '<button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Tiếng Việt</button>';
                }
                if($region->lang_code== 'en'){
                    return '<button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> English</button>';
                }
                if($region->lang_code == 'fr'){
                    return '<button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Francais</button>';
                }
            })
            ->addColumn('actions', function ($region) {
                $html = view('news::includes.region.column', ['module' => 'actions', 'column' => 'actions', 'region' => $region])->render();
                return $html;
                })
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('news::news_region.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('news::news_region.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'name'=>'required|max:255|unique:news_regions',
                'lang_code'=>'required'
            ],[
                'name.required' => trans('news::validation.region_name_required'),
                'lang_code.required'=>trans('news::validation.region_lang_code_required')
            ]);

            //Save Project Table
            $data=$request->all();
            Region::create($data);


            return redirect()->back()->with('messages',trans('news::Controller.region_add'));
        }
        catch (Exception $ex){
            return redirect()->back()->withInput();
        }

    }

    /**
     * Show the specified resource.
     * @return Response
     */

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data = new Region();
        $data=$data->find($id);
        return view('news::news_region.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        try{
            $this->validate($request,[
                'name'=>['required','max:255',Rule::unique('news_regions','name')->ignore($id)],
                'lang_code'=>'required',
                ],[
                'name.required' => trans('news::validation.region_name_required'),
                'lang_code.required'=>trans('news::validation.region_lang_code_required'),
                'name.unique'=>trans('news::validation.region_name_unique'),
            ]);

            $data=$request->all();
            $region = Region::find($id)->update($data);

            return redirect(route('news.news_region.index'))->with('messages',trans('news::Controller.region_edit'));
        }
        catch (Exception $ex){
            return redirect()->back()->withInput();
        }


    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Check if has Category use this region, return false
     */
    public function checkDelete(Request $request){
        $data= $request->all();
        $categories= NewsCategory::where('status',1)->where('region_id','=',$data)->select('name')->get();
        return view('news::news_region.checkDelete',compact('categories','data'));
    }



    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $obj = Region::find($id);
        if ($obj) {
            $obj['deleted_at'] = Carbon::today()->toDateString();
            $obj->save();

            return redirect()->route('news.news_region.index')->with('messages', trans('news::Controller.region_delete').$obj->name);
        } else {
            return redirect(route('news.news_region.index'))->withErrors([trans('news::Controller.region_delete_fail')]);
        }
    }
}
