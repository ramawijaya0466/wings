@extends('layouts.main')

@section('content')
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Checkout
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
                    <table class="table table-borderless table-cart" aria-describedby="Cart" id="table-checkout">
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
                            @forelse ($checkouts as $checkout)
                                @php
                                    $imageSource = '';
                                    if ($checkout->id % 11 == 0) {
                                        $imageSource = '/template/images/wings-product-ale-ale.png';
                                    } else if ($checkout->id % 9 == 0) {
                                        $imageSource = '/template/images/wings-product-boom.png';
                                    } else if ($checkout->id % 7 == 0) {
                                        $imageSource = '/template/images/wings-product-chochodrink.png';
                                    } else if ($checkout->id % 2 == 0) {
                                        $imageSource = '/template/images/wings-product-ekonomi-liquid.png';
                                    } else {
                                        $imageSource = '/template/images/wings-product-floridina.png';
                                    }

                                    $productAfterDiscount = $checkout->product->price - (($checkout->product->price * $checkout->product->discount) / 100);
                                @endphp

                                <tr id="{{ $checkout->id }}">
                                    <input type="hidden" class="product-code" value="{{ $checkout->product->product_code }}" id="product-code-{{ $checkout->product->product_code }}">
                                    <input type="hidden" class="unit" value="{{ $checkout->product->unit }}">
                                    <input type="hidden" class="currency" value="{{ $checkout->product->currency }}">

                                    <td class="pt-0">
                                        <img src="{{ $imageSource }}" alt="" class="cart-image" />
                                    </td>
                                    <td>
                                        <div class="product-title my-0">{{ $checkout->product->product_name }}</div>
                                    </td>
                                    <td>
                                        <div class="product-title my-0 price" id="price-{{ $checkout->id }}">
                                            {{ number_format($productAfterDiscount, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-start pt-1">
                                        <div class="product-title my-0">
                                            <input type="number" name="quantity" class="form-control quantity" style="width: 5rem;" value="1" min="1" max="999">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-title my-0 subtotal" id="subtotal-{{ $checkout->id }}">
                                            {{ number_format($productAfterDiscount, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="p-0 d-flex justify-content-center align-items-start">
                                        <form class="p-0 m-0" action="{{ route('cart.destroy', $checkout->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-remove-cart m-0">
                                                X
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="py-5 bg-light">
                                    <td colspan="6" class="text-center">Empty item ...</td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if ($checkouts->count() > 0)
                            <tfoot class="border">
                                <tr>
                                    <td style="width: 20%;">
                                        {{--  --}}
                                    </td>
                                    <td style="width: 25%;" class="font-weight-bolder">
                                        {{--  --}}
                                    </td>
                                    <td style="width: 20%;">
                                        {{--  --}}
                                    </td>
                                    <td style="width: 20%;" class="font-weight-bolder">
                                        TOTAL:
                                    </td>
                                    <td style="width: 20%;" class="font-weight-bolder" id="total">
                                        0
                                    </td>
                                    <td style="width: 10%;">
                                        {{--  --}}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-end px-4">
                    <button type="submit" class="btn btn-success mt-4" id="btn-checkout">
                        Checkout Now
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script type="text/javascript">
    $(document).ready(function () {
        // Init formatter
        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID").format(number);
        }

        // Init total
        let data = [];
        $('table#table-checkout tbody tr').each(function(rows, index){
            data.push({
                price: $(this).find('.price').text(),
                quantity: $(this).find('.quantity').val(),
                subtotal: $(this).find('.subtotal').text(),
            });
        });
        let total = data.reduce((accumulator, object) => {
            object.subtotal = object.subtotal.replace('.', '')
            return Number(accumulator) + Number(object.subtotal);
        }, 0);
        $('tfoot #total').text(rupiah(total));

        // Event onchange
        $(document).on('change', '.quantity', function (e) {
            e.preventDefault();

            let row = $(this).closest('tr').attr('id');
            let price = $(`#price-${row}`).text().trim();
            let quantity = $(this).val();

            price = Number(price.replace('.', ''))
            quantity = Number(quantity.replace('.', ''))

            let subtotal = price * quantity
            $(`#subtotal-${row}`).text(rupiah(subtotal));

            let data = [];
            $('table#table-checkout tbody tr').each(function(rows, index) {
                let price = $(this).find('.price').text()
                let quantity = $(this).find('.quantity').val()
                let subtotal = $(this).find('.subtotal').text()
                data.push({
                    price: price.trim().replace('.', ''),
                    quantity: quantity.trim().replace('.', ''),
                    subtotal: subtotal.trim().replace('.', ''),
                });
            });

            let total = data.reduce((accumulator, object) => {
                object.subtotal = object.subtotal.replace('.', '');
                return Number(accumulator) + Number(object.subtotal);
            }, 0);
            $('tfoot #total').text(rupiah(total));
        });

        // Event submit
        $(document).on('click', '#btn-checkout', function (e) {
            e.preventDefault();

            let data = [];
            $('table#table-checkout tbody tr').each(function(rows, index) {
                let price = $(this).find('.price').text().trim()
                let quantity = $(this).find('.quantity').val()
                let subtotal = $(this).find('.subtotal').text().trim()

                data.push({
                    product_code: $(this).find('.product-code').val(),
                    unit: $(this).find('.unit').val(),
                    currency: $(this).find('.currency').val(),
                    price: price,
                    quantity: quantity,
                    subtotal: subtotal,
                });
            });

            let payload = {
                'data': JSON.stringify(data),
                'user': '{!! Auth::user()->email !!}',
                'user_id': '{!! Auth::user()->id !!}',
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/checkout",
                data: payload,
                success: function (response) {
                    if (response) {
                        window.location.href = '/checkout-success';
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
