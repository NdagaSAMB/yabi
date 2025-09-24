<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    // Affiche le contenu du panier
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = CartItem::with('product')
                             ->where('session_id', $sessionId)
                             ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Ajoute un produit au panier
    public function store($productId)
    {
        $sessionId = session()->getId();
        $product = Product::findOrFail($productId);

        $cartItem = CartItem::where('session_id', $sessionId)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'product_id' => $productId,
                'quantity' => 1,
                'session_id' => $sessionId,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    // Met à jour la quantité d’un produit
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($request->action === 'increase') {
            $cartItem->quantity++;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity--;
        }

        $cartItem->save();

        return redirect()->back()->with('success', 'Panier mis à jour !');
    }

    // Supprime un produit du panier
    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Produit retiré du panier !');
    }

    // Vide tout le panier
    public function clear()
    {
        $sessionId = session()->getId();
        CartItem::where('session_id', $sessionId)->delete();

        return redirect()->back()->with('success', 'Panier vidé !');
    }
}
