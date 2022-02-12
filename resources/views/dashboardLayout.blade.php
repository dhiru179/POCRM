<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('custom_assets/css/utils.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('fonts/font_awesome_4.5.7.css')}}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>@yield('title')</title>
</head>

<body>

    <div class="wrapper">
        <nav class="admin-nav fixed-top" style="background-color: #FFFFFF;">
            <ul class="left">
                <li class="toggle" id="toggle"><i class="fa fa-bars" aria-hidden="true"></i></li>
                {{-- <li class="logo">Genesis Resedence</li> --}}
            </ul>

            <div class="right">
                {{-- <li><i class="fa fa-search" aria-hidden="true"></i></li>
                <li><i class="fa fa-cog" aria-hidden="true"></i></li>
                <li><i class="fa fa-bell" aria-hidden="true"></i></li>
                <li class="profile"><i class="fa fa-user" aria-hidden="true"></i></li> --}}
                @if(session()->has('ADMIN_USER'))
             <h4 class="mx-3"><span class="mx-2">{{'Welcome :'}}</span>{{ucwords(session('ADMIN_USER'))}}</h4>
             @endif
            </div>
        </nav>


        <div class='aside ' style="background-color: #233C46;">
            <div style="color: #233C46" class="brand">
                <span class="brand_icon" style="font-size: 32px"><i class="fa fa-home"
                        aria-hidden="true"></i></span>
                <span class="" style="font-size: 15px">PO CRM</span>
            </div>
            <ul class="parent">
                <li>
                    <a href="{{ url('admin/po_') }}{{urlencode('details')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text"></i></span>
                        <div class="nav_title">
                            <span>Create PO Details </span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>

                </li>
                <li>
                    <a href="{{ url('admin/po_') }}{{urlencode('list')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list"></i></span>
                        <div class="nav_title">
                            <span>PO List</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>

                </li>

                <li>
                    <a href="{{ url('admin/invoicePrinciple_') }}{{urlencode(''.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Create Invoice Principle</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/invoicePrinciple_') }}{{urlencode('report'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Report Principle</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/invoiceOwn_') }}{{urlencode(''.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text"></i></span>
                        <div class="nav_title">
                            <span>Create Invoice Own</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
   
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/invoiceOwn_') }}{{urlencode('report'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Report Own</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/customer_') }}{{urlencode('add'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Add Customer</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/customer_') }}{{urlencode('list'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Customer List</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/seller_') }}{{urlencode('add'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Add Seller</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
                @if(session()->get('ADMIN_USER') != 'admin3')
                <li>
                    <a href="{{ url('admin/seller_') }}{{urlencode('list'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Seller List</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ url('admin/invoice_') }}{{urlencode(''.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Create Invoice</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/invoice_') }}{{urlencode('list'.'_'.'')}}" class="">
                        <span class="nav_icon"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Invoice List</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" class="">
                        <span class="nav_icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                        <div class="nav_title">
                            <span>Logout</span>
                            <!-- <span class="arrow"><i class="bi bi-chevron-down"></i></span> -->
                        </div>
                    </a>
                </li>


            </ul>

        </div>




        <div class="main_container">

            @section('dashboard_section')

            @show

        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom_assets/js/script.js') }}"></script>
    <script src="{{ asset('custom_assets/js/fetchData.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="{{ asset('bootstrap/jquery.min.js') }}"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
