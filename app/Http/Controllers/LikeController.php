<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function ajaxRequestPost(Request $request)
    {
        // print_r(request('post_id'));
        $fields = array(
            'user_id' => request('user_id'),
            'user_type' => request('user_type'),
            'items_id' => request('post_id'),
            'liked' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        );
        // print_r("user_id");
        // print_r($fields);
        // die();
        if (Like::where('items_id', '=', request('post_id'))->count() > 0) {
            print_r("already exit");
        } else {
            Like::insert($fields);
            return response()->json(['success' => 'Got Simple Ajax Request.']);
        }
        // $input = $request->all();
        // \Log::info($input);
    }
}
