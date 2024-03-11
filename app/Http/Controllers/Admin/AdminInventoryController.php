<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inventory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;

class AdminInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::all();
        $pageTemplate = collect([
            "hasmodal" => true,
            "modals" => "templates.admin.modals.inventoryModals"
        ]);
        return view('admin.adminInventories.index', compact('inventories', 'pageTemplate'));
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
     * @param  \App\Http\Requests\StoreInventoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryRequest $request)
    {
        $inventory = new Inventory();
        $inventory->name = $request->input('inventory_name');
        $inventory->price = $request->input('inventory_price');
        $inventory->point = $request->input('inventory_point');
        $inventory->stock = $request->input('inventory_stock');
        $inventory->save();

        return redirect()->route('admin.inventory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $pageTemplate = collect([
            "hasmodal" => false,
        ]);
        return view('admin.adminInventories.edit', compact('inventory', 'pageTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventoryRequest  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, $id)
    {

        $inventory = Inventory::findOrFail($id);
        $inventory->name = $request->inventory_name;
        $inventory->price = $request->inventory_price;
        $inventory->point = $request->inventory_point;
        $inventory->stock = $request->inventory_stock;
        $inventory->update();

        return redirect()->route('admin.inventory.edit', ["id" => $inventory->id ])->with("Inventory Berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('admin.inventory.index')->with('success','Inventory has been deleted successfully');
    }
}
