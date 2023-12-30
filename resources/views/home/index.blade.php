@extends('layouts.app')

@section('title', 'Principal')

@section('contenido')
    <div class="container">
        <h1 class="text-center py-5">CARRITO DE COMRAS</h1>

        <div class="py-3">
            <form action="{{ route('cart.destroy') }}" method="POST">
                @csrf
                <button
                    name="destroy"
                    id="destroy"
                    class="btn btn-warning"
                    type="submit"
                    role="button"
                    >Vaciar carrito</button
                >
            </form>
        </div>
        
        <div class="py-3">
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <button
                    name="destroy"
                    id="destroy"
                    class="btn btn-success"
                    type="submit"
                    role="button"
                    >Guardar venta</button
                >
            </form>
        </div>

        @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Exito!</strong> {{ session('mensaje') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse (Cart::content() as $cart)
                    <tr>
                        <td>
                            <p>
                                <strong>{{ $cart->name }}</strong>
                            </p>
                        </td>
                        <td>
                            <form action="{{ route('cart.update', ['rowId' => $cart->rowId]) }}" method="POST" class="d-inline">
                                @csrf
                                <input name="qty" id="qty" class="form-control d-inline" type="text" value="{{ $cart->qty }}">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        
                            <form action="{{ route('cart.delete', ['rowId' => $cart->rowId]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>                        
                        <td>Q.{{ $cart->price }}</td>
                        <td>Q.{{ $cart->subtotal }}</td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4">CARRITO VACIO</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                @if (Cart::subtotal() > 0)
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>Subtotal</td>
                        <td>{{ Cart::subtotal() }}</td>
                    </tr>
                @endif
            </tfoot>
        </table>
    </div>
@endsection