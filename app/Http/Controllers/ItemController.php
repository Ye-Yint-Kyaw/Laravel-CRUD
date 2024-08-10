<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(){
        $items = Item::paginate(2);
        return view('index', compact('items'));
    }
    public function create(){
        return view('create');
    }
    public function store(){
        request()->validate([
            'name' => 'required|min:2',
            'image' => 'required|mimes:png,jpg'
        ],[
            'name.required' => 'အမည်ထည့်ပေးရန် လိုအပ်ပါတယ်',
            'name.min' => 'အနည်းဆုံး နှစ်လုံး လိုအပ်ပါတယ်',
            'image.required' => 'ပုံလိုအပ်ပါတယ်',
            'image.mimes' => 'ပုံးသာရွေးချယ်ပေးပါ'
        ]);
        if(request()->has('image')){
            $image = request()->file('image');
            // $img_name = $image->getClientOriginalName();
            // $ext = $image->getClientOriginalExtension();
            $file_name = $image->getClientOriginalName();
            $image->move(public_path('/image'),$file_name);
            $image_path = '/image/'.$file_name;

        }else{
            return 'No Image';
        }
        Item::create([
            'name' => request()->name,
            'image' => $image_path
        ]);
        return redirect('/')->with('success', 'Created Successfully');
    }

    public function edit($id){
        $item = Item::find($id);
        return view('edit', compact('item'));
    }
    public function update($id){
        $item = Item::find($id);
        if(request()->has('image')){
            $image = request()->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('/image'), $image_name);
            $image_path = '/image/'.$image_name;
        }else{
            $image_path = $item->image;
        }
        $item->update([
            'name' => request()->name,
            'image' => $image_path
        ]);
        return redirect()->back()->with('success', 'Updated Successfully');
    }

    public function delete($id){
        Item::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
