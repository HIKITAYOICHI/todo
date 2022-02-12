<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Task;
use App\Models\Comment;


class ImageController extends Controller
{
    public function create(Request $request)
    {
        //
    }
    
    public function store(CRequest $request)
    {
        //
    }
    
     public function delete(Request $request)
    {
        // Modelからデータの取得
        $image = Image::find($request->id);
        
        // 削除
        $image->delete();
        // if(isset($image)){
        // $image->delete();
        // }
        //リダイレクト
        return redirect()->back();
        
        
    }
}