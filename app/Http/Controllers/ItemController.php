<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        Gate::authorize('create', Item::Class);
        $item = $request->validated();
        if(empty($item['user_id'])){
            $item['user_id'] = Auth::id();
        }

        Item::create(
            [
                'text'=> $item['text'],
                'done'=> False,
                'user_id'=>$item['user_id'],
                'deadline'=> $item['deadline'],

            ]
        );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Gate::authorize('delete', $item);
        $item->delete();
        return redirect()->route('dashboard.index');
    }
    public function check(Item $item)
    {
        Gate::authorize('update', $item);
        $item->done=true;
        $item->save();
        return redirect()->route('dashboard.index');
    }



}
