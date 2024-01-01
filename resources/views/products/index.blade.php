@extends('layouts.app')

@section('title', 'Tienda')

@section('contenido')
<div class="mx-auto mt-4 grid gap-4  md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
    @forelse ($products as $product)
        <form action="{{ route('products.addCart', ['productId' => $product->id, 'description' => $product->description, 'price' => $product->price]) }}" method="POST">
        @csrf
            <div class="card w-auto bg-base-100 shadow-xl">
                <figure><img src="{{ asset('assets/img/products/' . $product->img_url) }}" alt="{{ $product->description }}" /></figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $product->description }} </h2>
                    <p>Q{{ $product->price }}</p>
                    <p>Stock: {{ $product->stock }}</p>
                    <div class="rating">
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400"  checked />
                        <input type="radio" name="rating-2" class="mask mask-star-2 bg-orange-400" />
                    </div>
                    <div class="card-actions justify-end">
                        <button type="submit" class="btn btn-primary" {{ $product->stock === 0 ? 'disabled' : '' }}>
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @empty
        <span>No se encontro ningun resultado</span>
    @endforelse
</div>
{{ $products->links() }}
@endsection