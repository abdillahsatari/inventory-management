<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionAjaxController extends Controller
{

    public function inventories(Request $request): JsonResponse
    {
        $data = [];
        $data = Inventory::where('name','LIKE','%'.$request->search."%")->paginate();

        count($data) > 0 ? $success = true : $success = false;

        return response()->json([
            'success' => $success,
            'data' => $data,
            'request' => $request->all()
        ]);
    }

    public function inventory(Inventory $inventory): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $inventory,
        ]);
    }

    public function customers(Request $request): JsonResponse
    {
        $data = [];
        $data = Customer::where('name','LIKE','%'.$request->search."%")->paginate();

        count($data) > 0 ? $success = true : $success = false;

        return response()->json([
            'success' => $success,
            'data' => $data,
            'request' => $request->all()
        ]);
    }

    public function transactionStore(Request $request): JsonResponse
    {
        $trxUnique = substr(str_shuffle("1234567890"), 0, 4);
        $invUnique = substr(str_shuffle("1234567890"), 0, 4);
		$transactionNumber = "TRX-".str_pad(date('dmy')."".$request->customer_id, 8,STR_PAD_BOTH).$trxUnique;
		$invoiceNumber = "INV-".str_pad(date('dmy')."".$request->customer_id, 8,STR_PAD_BOTH).$invUnique;

        $transaction = new Transaction();
        $transaction->transaction_number = $transactionNumber;
        $transaction->invoice_number = $invoiceNumber;
        $transaction->customer_id = $request->customer_id;
        $transaction->total_price = $request->total_price;
        $transaction->total_payment = $request->total_payment;
        $transaction->total_change = $request->total_change;
        $transaction->total_point_earn = $request->total_point_earn;
        $transaction->created_by = auth()->guard('cashier')->user()->id;
        $transaction->save();

        return response()->json([
            'success' => true,
            'data' => $transaction->id
        ]);
    }

    public function transactionDetailsStore(Request $request): JsonResponse
    {
        $transactionDetails = new TransactionDetail();
        $transactionDetails->transaction_id = $request->transaction_id;
        $transactionDetails->inventory_id = $request->inventory_id;
        $transactionDetails->inventory_name = $request->inventory_name;
        $transactionDetails->inventory_price = $request->inventory_price;
        $transactionDetails->inventory_discount = $request->inventory_discount;
        $transactionDetails->inventory_total_price = $request->inventory_total_price;
        $transactionDetails->quantity = $request->quantity;
        $transactionDetails->inventory_point = $request->inventory_point;
        $transactionDetails->save();

        $inventory = Inventory::findOrFail($request->inventory_id);
        $inventoryStock = ($inventory->stock - $request->quantity);
        $inventory->stock = $inventoryStock;
        $inventory->update();

        return response()->json([
            'success' => true
        ]);
    }

}
