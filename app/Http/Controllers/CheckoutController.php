<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
        ]);

        $cart = session('cart', []);
        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Créer la commande
        $order = Order::create([
            'name'    => $request->name,
            'address' => $request->address,
            'phone'   => $request->phone,
            'total'   => $total,
        ]);

        // Ajouter les produits liés
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_name' => $item['name'],
                'quantity'     => $item['quantity'],
                'price'        => $item['price'],
                'subtotal'     => $item['price'] * $item['quantity'],
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Commande validée avec succès !');
    }
}
