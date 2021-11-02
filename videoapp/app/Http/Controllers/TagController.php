<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Tag_User;
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
        $my_id = Auth::user()->id;
        $tags_id = User::find($my_id)->mytags()->pluck('tag_id')->toArray();
        $tags=Tag::find($tags_id);
        return view('tag.create', [
            'tags' => $tags->pluck('name')->toArray(),
            'tag_id'=> $tags->pluck('id')->toArray()

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
        $my_tags=User::myTagsName();
   
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->tag, $match);
        foreach($match[1] as $input)
        {
            $tag_id=Tag::where('name', $input)->first()->id;
            $my_id=Auth::user()->id;
            $tag_exist=Tag_User::where('tag_id',$tag_id)->where('user_id', $my_id)->first();
            if($tag_exist==NULL){
                Tag::firstOrCreate(['name'=>$input]);
                $tag_id=Tag::where('name',$input)->get(['id']);
                $user=User::find(Auth::id());
                $user->tags()->attach($tag_id);
            }


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
        $my_id = Auth::user()->id;
        $result = Tag_User::where('tag_id',$id)->where('user_id', $my_id)->delete();
        
        return redirect()->route('tag.create');
    }
}
