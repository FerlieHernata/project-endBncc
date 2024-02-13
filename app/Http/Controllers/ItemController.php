<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items',['items' => $items]);
    }
    public function add()
    {
        $category = Category::all();
        return view('items-add',['categories' => $category]);
    }
    public function store(Request $request)
    {
        // dd($request->file('photos'));
        $validation = $request->validate([
            'name' => 'required|unique:items|min:5|max:80',
            'price' => 'required',
            'quantity' => 'required',
        ]);
            $newName = '';
            if($request->file('photos'))
            {
                $extension = $request->file('photos')->getClientOriginalExtension();
                $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
                $request->file('photos')->storeAs('photo',$newName);
            }
            $request['photo'] = $newName;
            $item = Item::create($request->all());
            $item->categories()->sync($request->categories);
            return redirect('items')->with('status','Item Added Successfully');
        }

        public function edit($slug)
        {
            $item = Item::where('slug',$slug)->first();
            $category = Category::all();
            return view('items-edit',['categories'=>$category,'items'=>$item]);
        }
        public function update(Request $request,$slug)
        {
            // dd($request->file('photos'));
            $newName = '';
            if($request->file('photos'))
            {
                $extension = $request->file('photos')->getClientOriginalExtension();
                $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
                $request->file('photos')->storeAs('photo',$newName);
                $request['photo'] = $newName;
            }
            // dd($request->all());
            $item = Item::where('slug',$slug)->first();
            $item->update($request->all());
            if($request->categories)
            {
                $item->categories()->sync($request->categories);
            }
            return redirect('items')->with('status','Item Edited Successfully');
        }
        public function delete($slug)
        {
            $item = Item::where('slug',$slug)->first();
            $item->delete();
            return redirect('items')->with('status','Item Deleted Successfuly');
        }
        public function deleted()
        {
            $deletedItem= Item::onlyTrashed()->get();

            return view('items-deleted',['deleted' => $deletedItem]);
        }
        public function restore($slug)
        {
            $item = Item::withTrashed()->where('slug',$slug)->first();
            $item->restore();
            return redirect('items')->with('status','Item Restored Successfuly');
        }
    }
