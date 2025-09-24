<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Affiche le panier
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // Ajoute un produit au panier
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $quantity = $request->quantity ?? 1;

        // Si le produit existe déjà, incrémente la quantité
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    // Supprime un produit du panier
    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit supprimé du panier.');
    }

    // Vide tout le panier
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Panier vidé.');
    }
}
