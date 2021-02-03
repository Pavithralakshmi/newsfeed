<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Item;
use App\Like;

use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home($head, $id)
    {
        $var = $head . '-' . $id;
        $user_type = $head;
        //    echo $user_type;
        // $user_details = Staffs::find(id);
        if ($user_type = 'students') {
            $users = DB::table('students')->find($id);
            $likes = DB::table('likes')->select('items_id', 'liked')->where('user_id', $id)->get();
        }
        if ($user_type = 'staffs') {
            $users = DB::table('staffs')->find($id);
            $likes = DB::table('likes')->where('user_id', '<=', $id)->get();
            $wordlist = DB::table('likes')->where('user_id', '<=', $id)
                ->get()
                ->groupBy("items_id");
            $wordCount = $wordlist->count();
        }
        foreach ($likes as $likees) {
            $wordlist = DB::table('likes')->select(DB::raw('count(*) as user_count'))->where('items_id', '=', $likees->items_id)
                ->get()
                ->groupBy("items_id");
            $wordCount2 = $wordlist;
        }
        // print_r($wordlist);
        // '<pre>';
        // print_r($likes);
        // print_r($wordlist);
        // '</pre>';
        $items = Item::latest()->paginate(5);
        $wordCount2 = $wordlist->count();
        return view('livepost', compact('items', 'users', 'likes', 'wordCount', 'wordlist', 'wordCount2'))
            ->with('i', (request()->input('page', 1) - 1) * 5);;
    }
    public function index()
    {
        $items = Item::latest()->paginate(5);

        return view('items.index', compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|max:255|nullable',
            'description' => 'string|nullable',
            'image' => 'nullable',
        ]);

        if ($request->hasfile('image')) {
            // echo '<pre>';
            // print_r($request->file('image'));
            // echo '</pre>';
            $imagess = array();
            foreach ($request->file('image') as $key => $image) {
                $imageName =  time() . $key . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('public/images'), $imageName);
                $imagess[] = $imageName;
            }
            // unset($request['image']);
            $request['imageurl'] = implode(",", $imagess);
            $request->request->remove('image');
        }
        // print_r($request['imageurl']);
        Item::create($request->except('image'));
        // print_r($request->all());
        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'title' => 'string|max:255|nullable',
            'description' => 'string|nullable',
        ]);
        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
