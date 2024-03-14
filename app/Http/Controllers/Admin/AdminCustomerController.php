<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\View\View;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $c_customerList = Customer::all();
        $pageTemplate = collect([
            "hasmodal" => true,
            "modals" => "templates.admin.modals.customerModals"
        ]);
        return view('admin.adminCustomers.index', compact('c_customerList', 'pageTemplate'));
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->phone_number = $request->customer_phone_number;
        $customer->address = $request->customer_address;
        $customer->save();

        return redirect()->route('admin.customer.index')->with("Pelanggan Berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $pageTemplate = collect([
            "hasmodal" => false,
        ]);
        return view('admin.adminCustomers.form', compact('customer', 'pageTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->customer_name;
        $customer->phone_number = $request->customer_phone_number;
        $customer->address = $request->customer_address;
        $customer->update();

        return redirect()->route('admin.customer.edit', ["id" => $customer->id ])->with("Pelanggan Berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customer.index')->with('success','Pelanggan Berhasil dihapus');
    }
}
