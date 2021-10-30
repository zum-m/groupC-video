<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::get();
       
        return view('tag.index', [
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        $user = new User;
        $my_id = Auth::user()->id;
        $tags_id = $user->find($my_id)->mytags()->pluck('tag_id')->toArray();
        $tags = Tag::find($tags_id)->pluck('name')->toArray();
        return view('tag.create', [
            'tags' => $tags
        ]);
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag, $match);
        foreach($match[1] as $input)
        {
            //すでにデータがあれば取得し、なければデータを作成する
            $tag=Tag::firstOrCreate(['name'=>$input]);
            //$tagを初期化($tagに配列でデータが入ってしまうため)
            $tag=null;
            //入力されたタグのidを取得
            $tag_id=Tag::where('name',$input)->get(['id']);
            //タグとoutfitの紐付け
            $user=User::find(Auth::id());
            // $user_id=$user->id
            $user->tags()->attach($tag_id);

        };
        return redirect()->route('tag.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
