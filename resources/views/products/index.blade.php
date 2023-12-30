@extends('layouts.app')

@section('title', 'Products')

@section('contenido')
    <div class="container">
        <h1 class="text-center py-5">Productos</h1>

        <div class="py-3">
            <a
                name="add-cart"
                id="add-cart"
                class="btn btn-primary"
                href="{{ route('carrito') }}"
                role="button"
                >Ver carrito</a
            >
        </div>

        @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Exito!</strong> {{ session('mensaje') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-6 col-md-3 col-lg-2">
                    <form action="{{ route('products.addCart', ['productId' => $product->id, 'description' => $product->description, 'price' => $product->price]) }}" method="POST">
                        @csrf
                        <div class="card">
                            <img src="{{ asset('assets/img/products/' . $product->img_url) }}" class="card-img-top" alt="{{ $product->description }}">
                        
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->description }}</h5>
                                <p class="card-text">Q.{{ $product->price }}</p>
                                <p class="card-text">Stock: {{ $product->stock }}</p>

                                @if ($product->stock != 0)
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <span>No se encontro ningun resultado</span>
            @endforelse

            {{ $products->links() }}
        </div>
@endsection