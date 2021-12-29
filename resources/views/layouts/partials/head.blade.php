<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Fonts -->
<script src="https://kit.fontawesome.com/911ba89c0b.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet">

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

    .fs-7 {
        font-size: 14px;
    }

    .cart-logo:hover {
        opacity: 50%;
    }

</style>
