<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Order;
class InvoiceController extends Controller
{
    public function invoiceClient()
    {
        $user = Auth::user();
        $data = Invoice::where('name', '=', $user->name)->get();
        return view('/invoice',['data' => $data]);
    }

    public function invoiceOpen($invoice)
    {
        $order = Order::where('invoice', '=', $invoice)->get();
        $user = Auth::user();
        return view('/invoice-open',['order' => $order, 'user' => $user,'invoice' => $invoice]);
    }
    public function invoiceAdmin()
    {
        $data = Invoice::all();
        return view('/invoices',['data' => $data]);
    }
}
