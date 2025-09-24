<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Affiche la page de commande
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    // Traite la validation de la commande
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string',
            'paiement' => 'required|string',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        // Calcul du total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Création de la commande
        $order = Order::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'paiement' => $request->paiement,
            'total' => $total,
        ]);

        // Création des articles liés à la commande
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Vider le panier après la commande
        session()->forget('cart');

        return redirect()->route('checkout.index')
                         ->with('success', 'Votre commande a été passée avec succès !');
    }
}
