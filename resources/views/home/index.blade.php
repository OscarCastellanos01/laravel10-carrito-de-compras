@extends('layouts.app')

@section('title', 'Carrito')

@section('contenido')
    <div class="dropdown">
        <div tabindex="0" role="button" class="m-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
            <li>
                <form action="{{ route('cart.destroy') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        <span>Vaciar carrito</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        <span>Guardar venta</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    @if (session('mensaje'))
    <div role="alert" class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('mensaje') }}.</span>
    </div>
    @endif

    @if (session('error'))
    <div role="alert" class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>{{ session('error') }}.</span>
    </div>
    @endif
    <div class="overflow-x-auto py-3">
        <table class="table shadow-xl">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse (Cart::content() as $cart)
                    <tr class="hover">
                        <td>
                            <p>
                                <strong>{{ $cart->name }}</strong>
                            </p>
                        </td>
                        <td>
                            <div class="flex items-center">
                                <form action="{{ route('cart.update', ['rowId' => $cart->rowId]) }}" method="POST" class="mr-2 flex items-center">
                                    @csrf
                                    <input name="qty" id="qty" class="input input-bordered input-primary w-full max-w-20" type="number" value="{{ $cart->qty }}" />
                                    <button type="submit" class="btn btn-primary ml-2">Actualizar</button>
                                </form>
                                
                                <form action="{{ route('cart.delete', ['rowId' => $cart->rowId]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-error">Eliminar</button>
                                </form>
                            </div>
                        </td>            
                        <td>Q.{{ $cart->price }}</td>
                        <td>Q.{{ $cart->subtotal }}</td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4" class="text-xl">CARRITO VACIO</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                @if (Cart::subtotal() > 0)
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td class="text-base">Subtotal</td>
                        <td class="text-base">{{ Cart::subtotal() }}</td>
                    </tr>
                @endif
            </tfoot>
        </table>
    </div>
@endsection