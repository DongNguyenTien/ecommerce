<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Mockery\Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Modules\News\Models\Block;


class BlockController extends Controller
{
    /**
     * @param Datatables $datatables
     * @return mixed
     * get data for datatable
     */
    public function getList(Datatables $datatables,Request $request)
    {
        $list=new Block();
        return $datatables->of($list->select(['id','name','key','created_at','updated_at'])->whereNull('deleted_at'))
            ->filter(function ($query) use ($request) {
                if (($request->has('name'))&&($request->has('keyword'))) {
                    $query->where('name', 'LIKE','%'.$request->get('name').'%')->where('key', 'LIKE','%'.$request->get('keyword').'%');
                }
                elseif (($request->has('name'))&&(!$request->has('keyword'))) {
                    $query->where('name', 'LIKE','%'.$request->get('name').'%');
                }
                elseif((!$request->has('name'))&($request->has('keyword'))){
                    $query->where('key', 'LIKE','%'.$request->get('keyword').'%');
                }
            })
            ->escapeColumns([])
            ->addColumn('actions',function($block){
                $html=view('news::includes.block.column',['module' => 'actions', 'column' => 'actions', 'block' => $block])->render();
                return $html;
            })
            ->make(true);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('news::block.index');
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function show(Request $request)
    {

    }


    public function create()
    {
        return view('news::block.create');
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
                'name'=>'required|max:255|unique:news_blocks',
                'key'=>'required|max:255|unique:news_blocks',
                'data'=>'required'
            ],[
                'name.required'=>'Name is not allowed null',
                'name.max'=>'Name is too long',
                'key.required'=>'Keyword is not allowed null',
                'key.max'=>'Keyword is too long',
                'data.required'=>'Content of block is not allowed null'
            ]);

            $data=$request->all();
            Block::create($data);

            return redirect()->route('news.news_block.index')->with('messages',trans('news::Controller.block_add'));

        }
        catch(Exception $exception){
            return redirect()->back()->withInput();
        }
    }


    /**
     * @param $id
     * return ajax call from init.js
     * Puspose: return view modal
     */
    public function detail($id){
        $block = Block::whereNull('deleted_at')->where('id','=',$id)->select('data')->first();
        $block->data =  str_replace('<div class="container">','<div class="">',$block->data);
        $block->data = str_replace('<img', '<img style="max-width:100%"',$block->data);
        return view('news::block.detail')->with('data',$block->data);
    }



    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $block=Block::find($id);
        return view('news::block.edit',compact('block'));
    }




    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request,[
                'name'=>['required','max:255',Rule::unique('news_blocks')->ignore($id)],
                'key'=>['required','max:255',Rule::unique('news_blocks')->ignore($id)],
                'data'=>'required'
            ],[
                'name.required'=>'Name is not allowed null',
                'name.max'=>'Name is too long',
                'name.unique'=>'This name is already registered',
                'key.required'=>'Keyword is not allowed null',
                'key.max'=>'Keyword is too long',
                'key.unique'=>'This keyword is already registered',
                'data.required'=>'Content of block is not allowed null'
            ]);


            $data=$request->all();

//            $item = str_replace('/\s+/'," ",html_entity_decode($data['data']));
            $block  = Block::find($id);
            $block->update($data);

            return redirect()->route('news.news_block.index')->with('messages',trans('news::Controller.block_edit'));

        }
        catch(Exception $exception){
            return redirect()->back()->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $obj = Block::where("id", $id)->first();
        if ($obj) {
            $obj['deleted_at'] = Carbon::today()->toDateString();
            $obj->save();

            return redirect(route('news.news_block.index'))->with('messages',trans('news::Controller.block_delete'));
        } else {
            return Redirect::route('news.news_block.index')->withErrors([trans('news::Controller.block_delete_fail')]);
        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Test frontend block code
     */
    public function test(){
        $block = Block::find('31');
        preg_match_all("/<pre>(?<html>.*?>)<\/pre>/",html_entity_decode($block['data']),$matches);
        $block['data'] = $matches['html'][0];
        return view('news::block.test',compact('block'));
    }
}
