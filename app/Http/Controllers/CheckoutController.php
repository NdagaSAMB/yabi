<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'payment_method' => 'required|in:wave,orange_money,especes',
        ]);

        $sessionId = session()->getId();
        $cartItems = CartItem::where('session_id', $sessionId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cartItems as $ci) {
            $total += ($ci->product->price * $ci->quantity);
        }

        $order = Order::create([
            'name'           => $request->name,
            'address'        => $request->address,
            'phone'          => $request->phone,
            'payment_method' => $request->payment_method,
            'total'          => $total,
        ]);

        foreach ($cartItems as $ci) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $ci->product->id,
                'product_name' => $ci->product->name,
                'quantity'     => $ci->quantity,
                'price'        => $ci->product->price,
                'subtotal'     => $ci->product->price * $ci->quantity,
            ]);
        }

        // vider le panier en BDD pour cette session
        CartItem::where('session_id', $sessionId)->delete();

        return redirect()->route('cart.index')->with('success', '✅ Votre commande a été validée avec succès !');
    }
}
