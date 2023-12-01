<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //Get request List
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    //Post request Create
    public function store(Request $request)
    {
        $item = new Item();
        //$item->name = $request->name;
        $item->name = $request->input('name');
        $item->desc = $request->input('desc');
        $item->quantity = $request->input('quantity');
        $item->save();
        return response()->json(['message' => 'Ekleme İşlemi Başarılı.']);
    }

    //Get request Read
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    //Put/Patch request Update
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($request->id);
        $item->name = $request->input('name');
        $item->desc = $request->input('desc');
        $item->quantity = $request->input('quantity');
        $item->save();
        //return response()->json($item);
        return response()->json(['message' => 'Güncelle İşlemi Başarılı.']);
    }

    //Delete request Delete
    public function destroy($id)
    {
        $item = Item::destroy($id);
        return response()->json(['message' => 'Silme İşlemi Başarılı.']);
    }
}
