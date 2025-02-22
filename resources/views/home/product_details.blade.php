<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style type="text/css">
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .detail-box {
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="hero_area">

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    </div>

    <!-- Product Details Start -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    {{ $data->title }}
                </h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="div_center">
                            <img width="400" src="{{ asset('storage/products/' . $data->image) }}" alt="{{ $data->title }}">
                        </div>
                        <div class="detail-box">
                            <h6>{{ $data->title }}</h6>
                            <h6>
                                <span>Rp {{ $data->price }}</span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <h6>Category : {{ $data->category }}</h6>
                            <h6>Available Quantity
                                <span><!-- Info stok -->
                                    @if ($data->stock == 0)
                                        <p class="text-danger">Stok habis</p>
                                    @elseif ($data->stock < 10)
                                        <p class="text-warning">Stok menipis, ({{ $data->stock }} tersisa)</p>
                                    @else
                                        <p class="text-success">Stok tersedia</p>
                                    @endif
                                </span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <p>{{ $data->description }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- Product Details End -->

    <!-- info section -->
    @include('home.footer')

    @include('home.scripts')

</body>

</html>
