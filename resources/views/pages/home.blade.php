@extends('layouts.main')

@section('content')
<div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#storeCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#storeCarousel" data-slide-to="1"></li>
                            <li data-target="#storeCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="/template/images/wings-banner-1.jpg" class="d-block mx-auto" alt="Carousel Image" />
                            </div>
                            <div class="carousel-item">
                                <img src="/template/images/wings-banner-1.jpg" class="d-block mx-auto" alt="Carousel Image" />
                            </div>
                            <div class="carousel-item">
                                <img src="/template/images/wings-banner-1.jpg" class="d-block mx-auto" alt="Carousel Image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>New Products</h5>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                        <a class="component-products d-block" href="{{ route('product.show', $product->slug) }}">
                            <div class="products-thumbnail">
                                @php
                                    $imageSource = '';
                                    if ($product->id % 5 == 0) {
                                        $imageSource = '/template/images/wings-product-boom.png';
                                    } else if ($product->id % 2 == 0) {
                                        $imageSource = '/template/images/wings-product-ekonomi-liquid.png';
                                    } else {
                                        $imageSource = '/template/images/wings-product-floridina.png';
                                    }
                                @endphp

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
