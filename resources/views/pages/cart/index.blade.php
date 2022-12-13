@extends('layouts.main')

@section('content')
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Cart
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-cart">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-12 table-responsive">
                    <table class="table table-borderless table-cart" aria-describedby="Cart">
                        <thead>
                            <tr>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kuantitas</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                <tr id="{{ $cart->id }}">
                                    <td style="width: 20%;">
                                        <img src="/template/images/product-cart-1.jpg" alt="" class="cart-image" />
                                    </td>
                                    <td style="width: 20%;">
                                        <div class="product-title">{{ $cart->product->product_name }}</div>
                                    </td>
                                    <td style="width: 20%;">
                                        <div class="product-title" id="price-{{ $cart->id }}">{{ $cart->product->price }}</div>
                                    </td>
                                    <td style="width: 20%;">
                                        <div class="product-title">
                                            <input type="number" name="quantity" class="form-control form-control-sm quantity" style="width: 5rem;" value="1" min="1" max="999">
                                        </div>
                                    </td>
                                    <td style="width: 20%;">
                                        <div class="product-title" id="subtotal-{{ $cart->id }}">{{ $cart->product->price }}</div>
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="#" class="btn btn-remove-cart">
                                            X
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Empty ...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '.quantity', function (e) {
            e.preventDefault();

            let row = $(this).closest('tr').attr('id');
            let price = $(`#price-${row}`).text();
            let quantity = $(this).val();

            $(`#subtotal-${row}`).text(price * quantity);
        })
    });
</script>
@endpush
