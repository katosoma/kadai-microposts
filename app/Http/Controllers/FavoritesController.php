<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    //投稿をお気に入りするアクション
    public function store($id)
    {
        //認証済みユーザがidの投稿をお気に入りする
        \Auth::user()->favorite($id);
        //前のURLにリダイレクトさせる
        return back();
    }
    
    //投稿のお気に入りを解除するアクション
    public function destroy($id)
    {
        //認証済みのユーザが、idの投稿のお気に入りを解除する
        \Auth::user()->unfavorite($id);
        //前のページへリダイレクトさせる
        return back();
    }
}
