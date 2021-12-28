<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>

{{--Select2 CDN--}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Custom fonts for this template-->
<script src="https://kit.fontawesome.com/911ba89c0b.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

{{--CUSTOM STYLES FOR THIS TEMPLATE--}}
<link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', 'sans-serif';
    }
    .text-jh {
        color: #3A2218;
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
</style>
