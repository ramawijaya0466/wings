@extends('layouts.main')

@section('content')
<div class="page-content page-categories">
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $product->id++ }}">
                        <a class="component-products d-block" href="{{ route('product.show', $product->slug) }}">
                            @php
                                $imageSource = '';
                                if ($product->id % 11 == 0) {
                                    $imageSource = '/template/images/wings-product-ale-ale.png';
                                } else if ($product->id % 9 == 0) {
                                    $imageSource = '/template/images/wings-product-boom.png';
                                } else if ($product->id % 7 == 0) {
                                    $imageSource = '/template/images/wings-product-chochodrink.png';
                                } else if ($product->id % 2 == 0) {
                                    $imageSource = '/template/images/wings-product-ekonomi-liquid.png';
                                } else {
                                    $imageSource = '/template/images/wings-product-floridina.png';
                                }
                            @endphp

                            <div class="products-thumbnail">
                                <div class="products-image" style="background-image: url({{ $imageSource }});"></div>
                            </div>
                            <div class="products-text">
                                {{ $product->product_name }}
                            </div>
                            <div class="products-price">
                                {{ $product->currency }} {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
