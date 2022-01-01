<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Fonts -->
<script src="https://kit.fontawesome.com/911ba89c0b.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
      integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/regular.css"
      integrity="sha384-e7wK18mMVsIpE/BDLrCQ99c7gROAxr9czDzslePcAHgCLGCRidxq1mrNCLVF2oaj" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/brands.css"
      integrity="sha384-S5yUroXKhsCryF2hYGm7i8RQ/ThL96qmmWD+lF5AZTdOdsxChQktVW+cKP/s4eav" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"
      integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet">

{{--Select2 CDN--}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>

{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

<style>
    body {
        font-family: 'Poppins', 'sans-serif';
    }

    .list-group-item.active {
        color: black;
        font-weight: 500;
        background-color: transparent;
        border-color: transparent;
    }

    .list-group-item {
        color: #a7a7a7;
        text-decoration: none;
        border: 1px solid rgba(0, 0, 0, 0);
    }

    .list-group-item:hover {
        color: black;
        font-weight: 500;
        text-decoration: none;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .text-bistre {
        color: #3A2218 !important;
    }

    .text-seal-brown-50 {
        color: rgba(80, 46, 22, 0.5) !important;
    }

    .text-jh-dark {
        color: #564134;
    }

    .text-jh-brown {
        color: #2E190D;
    }

    .text-jh-darker {
        color: #1D0C03;
    }

    .fs-0 {
        font-size: 42px;
    }

    .fs-12-px {
        font-size: 12px;
    }

    .fs-20-px {
        font-size: 20px;
    }

    .fs-24-px {
        font-size: 24px;
    }

    .fs-30-px {
        font-size: 30px;
    }

    .fs-40-px {
        font-size: 40px;
    }

    .cart-button {
        background-color: white;
        font-weight: 600;
        border: 1px solid #3A2218;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .product-short-description-card {
        background: linear-gradient(90deg, #564134 2.02%, #2E190D 57.59%);
        box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.25);
        border-radius: 5px;
    }

    .product-description-card {
        background: linear-gradient(280.95deg, #2E190D 33.43%, #564134 96.17%);
        box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.25);
        border-radius: 10px;
    }

    .product-description-line-tabs-divider {
        border-bottom: 1px solid white;
    }

    .text-strikethrough {
        text-decoration: line-through;
    }

    .text-black {
        color: black !important;
    }

    .fw-200 {
        font-weight: 200;
    }

    .fw-600 {
        font-weight: 600;
    }

    .fw-700 {
        font-weight: 700;
    }

    .fs-7 {
        font-size: 14px;
    }

    .cart-logo {
        opacity: 50%;
    }

    .cart-logo:hover {
        opacity: 100%;
    }

    .cart-logo-btn-50 {
        opacity: 50%;
    }

    .cart-logo-btn-100 {
        opacity: 100%;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: white;
        font-weight: bold;
        font-size: 20px;
        background-color: transparent;
        border-color: transparent;
        text-decoration: underline;
    }

    .nav-tabs .nav-link {
        color: white;
    }

    .nav-tabs .nav-link:hover {
        color: white;
        text-decoration: underline;
        border-color: transparent;
    }

    .list-group-item.active {
        z-index: 2;
        font-weight: bold;
        color: black;
        background-color: transparent;
        border-color: transparent;
    }

    a.dropdown-item.fs-7.text-seal-brown-50:hover {
        background-color: transparent;
        color: #3A2218 !important;
    }

    a.nav-link.fs-7.text-seal-brown-50:hover {
        background-color: transparent;
        color: #3A2218 !important;
    }

    .reply-card {
        background: rgba(204, 169, 148, 0.26);
        border-radius: 5px;
    }

    .fw-400 {
        font-weight: 400;
    }

    .comment-img {
        width: 180px;
        height: auto;
    }

    .product-details-card {
        width: 400px;
        height: 400px;
        border: 1px solid #E6E6E6;
        box-sizing: border-box;
        box-shadow: 4px 4px 25px rgba(226, 226, 226, 0.30);
        border-radius: 10px;
    }

    .product-details-img {
        width: 250px;
        height: auto
    }

    .product-details-card-md {
        width: 350px;
        height: 350px;
        background: #FFFFFF;
        border: 1px solid #E6E6E6;
        box-sizing: border-box;
        border-radius: 10px;
    }

    .product-rating-card {
        background: #FCFCFC;
        border: 1px solid #E4E4E4;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .text-star {
        color: #FFB700;
    }

    .btn-comment {
        background-color: white;
        border: 1px solid #3A2218;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .btn-jh-primary {
        background: #3A2218;
        color: white;
        opacity: 100%;
    }

    .btn-jh-primary:hover {
        background: #3A2218;
        color: white;
        opacity: 80%;
    }

    .btn-jh-secondary {
        background-color: white;
        color: #3A2218;
        border: 1px solid #3A2218;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .btn-jh-secondary:hover {
        background-color: #3A2218;
        color: white;
        border: 1px solid #3A2218;
        box-sizing: border-box;
        border-radius: 8px;
    }

    .rating {
        border: none;
        float: left;
    }

    .rating {
        margin: 0;
        padding: 0;
    }

    .rating input {
        display: none;
    }

    .rating label:before {
        padding: 0 10px 0 0;
        font-family: 'Font Awesome 5 Free', serif;
        font-weight: 900;
        font-size: 2em;
        display: inline-block;
        content: "\f005";
    }

    .rating label {
        color: #A7A7A7;
        float: right;
    }

    .rating input:checked ~ label,

        /* show gold star when clicked */
    .rating:not(:checked) label:hover,

        /* hover current star */
    .rating:not(:checked) label:hover ~ label {
        color: #FFB700;
    }

    /* hover previous stars in list */
    .rating input:checked + label:hover,

        /* hover current star when changing rating */
    .rating input:checked ~ label:hover,
    .rating label:hover ~ input:checked ~ label,

        /* lighten current selection */
    .rating input:checked ~ label:hover ~ label {
        color: #FFED85;
    }

    .btn-icon-split {
        padding: 0;
        overflow: hidden;
        display: inline-flex;
        align-items: stretch;
        justify-content: center;
    }

    .btn-icon-split .icon {
        background: rgba(0, 0, 0, 0.15);
        display: inline-block;
        padding: 0.375rem 0.75rem;
    }

    .btn-icon-split .text {
        display: inline-block;
        padding: 0.375rem 0.75rem;
    }

    .cart-cards {
        min-height: 715px;
        background: #FEFEFE;
        border: 1px solid #EFEFEF;
        box-sizing: border-box;
        box-shadow: 0 4px 15px 2px rgba(0, 0, 0, 0.05);
        border-radius: 15px;
    }

    .cart-product-img {
        width: 45px;
        height: 45px;
        border: 1px solid #C4C4C4;
        box-sizing: border-box;
        box-shadow: 4px 4px 15px rgba(226, 226, 226, 0.10);
        border-radius: 3px;
    }

</style>
