<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class HomeController extends Controller
{
    public function index()
    {
        $item = Item::all();
        return view('home',['item' => $item]);
    }
    public function add_cart(Request $request, $id)
    {
        $user = Auth::user();
        $item = Item::find($id);

        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->price = $item->price * $existingCartItem->quantity;
            $existingCartItem->save();
        } else {
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->user_id = $user->id;
            $cart->item_name = $item->name;
            $cart->quantity = $request->quantity;
            $cart->price = $item->price * $request->quantity;
            $cart->photo = $item->photo;
            $cart->address = $user->address;
            $cart->post_code = $user->post_code;
            $cart->item_id = $item->id;
            $cart->save();
        }

        return redirect()->back();
    }

    public function cart()
    {
        $cart = Cart::all();
        return view('cart',['cart' => $cart]);
    }
    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', '=', $userid)->get();

        if ($data->isNotEmpty()) {
            $invoice = 'Inv-' . time() . '-' . rand(1000, 9999);

            foreach ($data as $data) {
                $order = new Order;
                $order->invoice = $invoice;
                $order->name = $data->name;
                $order->email = $data->email;
                $order->phone = $data->phone;
                $order->address = $data->address;
                $order->post_code = $data->post_code;
                $order->user_id = $data->user_id;
                $order->item_id = $data->item_id;
                $order->item_name = $data->item_name;
                $order->quantity = $data->quantity;
                $order->price = $data->price;
                $order->photo = $data->photo;
                $order->save();

                $item = Item::find($order->item_id);
                if ($item) {
                    $item->quantity -= $order->quantity;
                    $item->save();
                }

                $data->delete();
            }

            $invoiceModel = new Invoice;
            $invoiceModel->invoice = $invoice;
            $invoiceModel->name = $user->name;
            $invoiceModel->phone = $user->phone;
            $invoiceModel->email = $user->email;
            $invoiceModel->save();
        }

        return redirect()->back();
    }

}
