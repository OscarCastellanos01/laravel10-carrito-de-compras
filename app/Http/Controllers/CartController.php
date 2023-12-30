<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function addCart($productId, $description, $price)
    {
        // Realizar validacion de stock (LIVEWIRE)

        // Agregar el producto al carrito
        Cart::add($productId, $description, 1, $price);

        return redirect()->route('products.index')->with('mensaje', "El producto se agrego al carrito");
    }

    public function updateCart($rowId, Request $request)
    {
        // Obtener productos en el carrito
        $cartItem = Cart::get($rowId);

        // Realizar validacion de stock
        $producto = Product::find($cartItem->id);
        $stock_actual = $producto->stock;

        if ($request->qty > $stock_actual) {
            return back()->with('error', "No hay suficiente stock: " . $stock_actual);
        }

        // Agregar al carrito
        Cart::update($rowId, $request->qty);

        return back()->with('mensaje', "Producto actualizado correctamente");
    }

    public function deleteCart($rowId)
    {
        Cart::remove($rowId);

        return back()->with('mensaje', "Producto eliminado correctamente");
    }

    public function destroy()
    {
        Cart::destroy();

        return back()->with('mensaje', "Carrito vaciado correctamente");
    }

    public function store()
    {
        // Obtener productos en el carrito
        $cartItems = Cart::content();
        
        if($cartItems->count() === 0)
        {
            return back()->with('error', 'Aún no se ha agregado ningún artículo al carrito');
        }

        // Validar el stock antes de procesar la orden
        foreach ($cartItems as $cartItem) {
            $producto = Product::find($cartItem->id);
            $stock_actual = $producto->stock;
    
            if ($cartItem->qty > $stock_actual) {
                return back()->with('error', "No hay suficiente stock para: " . $producto->description . ", Stock actual: " . $stock_actual);
            }
        }
    
        // Almacenar orden
        $order = new Order;
        $order->total = Cart::subtotal();
        $order->save();
    
        // Obtener el ID del pedido
        $order_id = $order->id;
    
        // Formatear arreglo
        $orderDetails = [];
    
        // Actualizar stock y almacenar detalles de la orden
        foreach ($cartItems as $cartItem) {
            $producto = Product::find($cartItem->id);
    
            // Actualizar stock
            $producto->stock -= $cartItem->qty;
            $producto->save();
    
            // Almacenar detalles de la orden
            $orderDetails[] = [
                'order_id' => $order_id,
                'product_id' => $producto->id,
                'cantidad' => $cartItem->qty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Almacenar detalles de la orden en la BD
        OrderDetail::insert($orderDetails);
    
        // Eliminar carrito
        Cart::destroy();
    
        return redirect()->route('products.index')->with('mensaje', "Venta realizada correctamente");
    }
}
