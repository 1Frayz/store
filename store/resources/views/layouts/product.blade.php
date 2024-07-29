@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="row">
                    <div class="col-md-10">
                        <a href="#" data-toggle="modal" data-target="#mainImageModal">
                            <img src="{{ asset($product->additionalField->packaging_link) }}" alt="{{ $product->name }}"
                                class="img-fluid rounded">
                        </a>
                    </div>
                    <div class="col-md-2">
                        @foreach($product->images as $key => $image)
                        <a href="#" data-toggle="modal" data-target="#imageModal{{$key}}">
                            <img src="{{ asset($image->path) }}" class="img-thumbnail mb-3" style="max-width: 100px;">
                        </a>
                        <div class="modal fade" id="imageModal{{$key}}" tabindex="-1" role="dialog"
                            aria-labelledby="imageModal{{$key}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="{{ asset($image->path) }}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-body">
                    <h1 class="card-title">{{ $product->name }}</h1>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><strong>Цена:</strong> {{ $product->price }} руб</p>

                    @if($product->discount)
                    <p class="card-text text-danger"><strong>Скидка:</strong> {{ $product->discount }} руб</p>
                    @endif

                    <h3>Детали товара</h3>
                    <ul class="list-unstyled">
                        <li><strong>Артикул:</strong> {{ $product->external_code }}</li>
                        <li><strong>Бренд:</strong> {{ $product->additionalField->brand ?? 'Не указано' }}</li>
                        <li><strong>Размер:</strong> {{ $product->additionalField->size ?? 'Не указан' }}</li>
                        <li><strong>Цвет:</strong> {{ $product->additionalField->color ?? 'Не указан' }}</li>
                        <li><strong>Состав:</strong> {{ $product->additionalField->composition ?? 'Не указан' }}</li>
                        <li><strong>Количество в упаковке:</strong>
                            {{ $product->additionalField->quantity_per_pack ?? 'Не указано' }}
                        </li>
                        <li><strong>Вес:</strong> {{ $product->additionalField->weight ?? 'Не указан' }} кг</li>
                        <li><strong>Размеры упаковки:</strong>
                            {{ $product->additionalField->packaging_length ?? 'Не указано' }} x
                            {{ $product->additionalField->packaging_width ?? 'Не указано' }} x
                            {{ $product->additionalField->packaging_height ?? 'Не указано' }} см
                        </li>
                        <li><strong>Категория:</strong> {{ $product->additionalField->category ?? 'Не указана' }}</li>
                    </ul>

                    <h3>SEO Информация</h3>
                    <ul class="list-unstyled">
                        <li><strong>SEO Title:</strong> {{ $product->additionalField->seo_title ?? 'Не указан' }}</li>
                        <li><strong>SEO H1:</strong> {{ $product->additionalField->seo_h1 ?? 'Не указан' }}</li>
                        <li><strong>SEO Description:</strong>
                            {{ $product->additionalField->seo_description ?? 'Не указано' }}
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mainImageModal" tabindex="-1" role="dialog" aria-labelledby="mainImageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset($product->additionalField->packaging_link) }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection