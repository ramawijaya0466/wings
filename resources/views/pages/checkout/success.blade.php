<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Store - Your Best Marketplace</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/template/style/main.css" rel="stylesheet" />
</head>

<body>
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/template/images/success.svg" alt="" class="mb-4" />
                        <h2>
                            Transaction Processed!
                        </h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan <br />
                            kami akan menginformasikan resi secept mungkin!
                        </p>
                        <div>
                            <a class="btn btn-success w-50 mt-4" href="{{ route('home') }}">
                                Continue Shopping
                            </a>
                            <a class="btn btn-signup w-50 mt-2" href="{{ route('dashboard') }}">
                                My Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/template/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="/template/script/navbar-scroll.js"></script>
</body>

</html>
