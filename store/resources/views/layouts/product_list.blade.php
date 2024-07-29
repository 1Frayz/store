@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-3 mb-4">
            <a href="{{route("product", ['external_code'=> $product->external_code])}}"
                style="text-decoration: none; color:black">
                <div class="card d-flex flex-column h-100">
                    <img src="{{ asset($product->additionalField->packaging_link) }}" class="card-img-top"
                        alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text mb-auto">{{ $product->price }} руб</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection