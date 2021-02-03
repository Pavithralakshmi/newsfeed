<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $var = URL::current();
        $splitName = explode('/', $var);
$first_name = $splitName[3];
$uploed_id = explode('=', $first_name);
$user_id = $uploed_id[1];
$user_type = $uploed_id[0];
$item_id = $splitName[4];


        // print_r($user_type);die();
        Comment::create([
            'comment' => request('comment'),
            'item_id' => $item_id,
            'user_id' => $user_id,
            'user_type' =>$user_type,
        ]);
        return back();
    }
}
