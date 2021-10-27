<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User;
        // ユーザーテーブルから更新順でroomがopenしているものを選ぶ
        $users=User::getOpenedRoomOrderByUpdated_at();
        // ユーザーのタグ
        $my_id = Auth::user()->id;
        $tag_id=$user->find($my_id)->mytags()->pluck('tag_id')->toArray();
        // オーナーのID
        $owners_id=$users->pluck('id')->toArray();
        // タグ
        $tags=Tag::get();

        // オーナーのタグリスト
        $owners_tags=array();
        // 共通のタグのリスト
        $commons_tags=array();
        foreach($owners_id as $owner_id){
            $owner_tags=$user->find($owner_id)->mytags()->pluck('tag_id')->toArray();
            $owners_tags[]=$owner_tags;
            $common_id=array_intersect($owner_tags,$tag_id);
            $commons_tags[]=array_column($tags->find($common_id)->toArray(),'name');
        }

        return view('room.index', [
            'rooms' => $users->pluck('room_name')->toArray(),
            'commons_tags' => $commons_tags,
            'owners_tags'=>$owners_tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
