@extends('layouts.main')

@section('content')
<div class="page-content page-details">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Product Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" data-aos="zoom-in">
                    <img src="/template/images/wings-banner-1.jpg" class="w-100 main-image" alt="">
                </div>
                <div class="col-lg-5 store-details-container position-relative">
                    <div class="store-heading">
                        <h1>{{ $product->product_name }}</h1>

                        <div class="owner">
                            {{ $product->description }}
                        </div>

                        <hr>

                        <div class="owner">
                            <div>
                                Dimension: {{ $product->dimension }}
                            </div>

                            <div>
                                Unit: {{ $product->unit }}
                            </div>
                        </div>

                        @if ($product->discount != 0)
                            <div>
                                <div class="" style="text-decoration: line-through;">
                                    {{ $product->currency }} {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                <div class="price" style="font-size: 24px;">
                                    @php
                                        $productAfterDiscount = $product->price - (($product->price * $product->discount) / 100);
                                    @endphp

                                    {{ $product->currency }} {{ number_format($productAfterDiscount, 0, ',', '.') }}
                                </div>
                            </div>
                        @else
                            <div class="price" style="font-size: 24px;">
                                {{ $product->currency }} {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>
                    <div class="position-absolute w-100" style="bottom: 0;">
                        @auth
                            <button type="button" class="btn btn-success nav-link px-4 text-white btn-block mb-3 w-50" id="btn-buy-now">
                                Buy Now
                            </button>
                            <button type="button" class="btn btn-primary nav-link px-4 text-white btn-block w-50" id="btn-add-to-cart">
                                Add to Cart
                            </button>
                        @endauth

                        @guest
                            <a class="btn btn-success nav-link px-4 text-white btn-block mb-3 w-50" href="{{ route('login') }}">
                                Sign In To Checkout
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#btn-buy-now', function (e) {
            e.preventDefault();

            let payload = {
                'product_id': '{!! $product->id !!}',
                'user_id': '{!! Auth::user() ? Auth::user()->id : '' !!}',
            };

            $.ajax({
                method: "POST",
                url: "/cart",
                data: payload,
                success: function (response) {
                    if (response) {
                        window.location.href = '/checkout';
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '#btn-add-to-cart', function (e) {
            e.preventDefault();

            let payload = {
                'product_id': '{!! $product->id !!}',
                'user_id': '{!! Auth::user() ? Auth::user()->id : '' !!}',
            };

            $.ajax({
                method: "POST",
                url: "/cart",
                data: payload,
                success: function (response) {
                    if (response) {
                        window.location.reload();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endpush
