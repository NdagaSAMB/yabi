<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function index()
    {
        $cartItems = CartItem::where('session_id', session()->getId())
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Ajouter un produit au panier
    public function store(Product $product)
    {
        $cartItem = CartItem::where('product_id', $product->id)
            ->where('session_id', session()->getId())
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'session_id' => session()->getId(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    // Mettre à jour la quantité d’un produit
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::where('id', $id)
            ->where('session_id', session()->getId())
            ->firstOrFail();

        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour !');
    }

    // Supprimer un produit du panier
    public function destroy($id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where('session_id', session()->getId())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier !');
    }

    // Vider le panier
    public function clear()
    {
        CartItem::where('session_id', session()->getId())->delete();

        return redirect()->route('cart.index')->with('success', 'Panier vidé !');
    }
}
