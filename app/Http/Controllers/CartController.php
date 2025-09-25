<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $cartItems = CartItem::where('session_id', $sessionId)->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $sessionId = session()->getId();

        $cartItem = CartItem::where('session_id', $sessionId)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity'   => 1,
                'session_id' => $sessionId,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');

    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $sessionId = session()->getId();

        $cartItem = CartItem::where('id', $id)->where('session_id', $sessionId)->firstOrFail();
        $cartItem->quantity = (int) $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }

    public function remove($id)
    {
        $sessionId = session()->getId();
        CartItem::where('id', $id)->where('session_id', $sessionId)->delete();

        return redirect()->back()->with('success', 'Article supprimé.');
    }

    public function clear()
    {
        $sessionId = session()->getId();
        CartItem::where('session_id', $sessionId)->delete();

        return redirect()->back()->with('success', 'Panier vidé.');
    }
}
