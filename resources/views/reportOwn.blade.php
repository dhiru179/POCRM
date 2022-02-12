@extends('dashboardLayout')
@section('title', 'party')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')
    <div class="card">
        <nav class="bg-light" style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 w-100 h4 d-flex align-items-center px-2" style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Report Own</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>

        </nav>
        @if (session()->has('msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message</strong> {{session('msg')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif


        <div class="py-3">
            <div class="d-flex mb-3">

                <input type="date" class="form-control rounded-0 mx-2" value="" id="searchByDate"
                    placeholder="Search By Date">
                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByInvoiceOwn"
                    placeholder="Search By Invoice Own">

                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByInvoicePpl"
                    placeholder="Search By Invoice Principle">

            </div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 14px">
                    <thead class="thead_sticky">


                        <tr>
                            <th width="50">#</th>
                            <th class="text-center" width="">DATE</th>
                            <th class="text-center" width="">CUSTOMER</th>
                            <th class="text-center" width="">SELLER</th>
                            <th class="text-center" width="">INVOICE NO-OWN</th>
                            {{-- <th width="">INVOICE NO PRINCIPAL</th> --}}
                            <th class="text-center" width="">QUANTITY</th>
                            <th class="text-center" width="">AMOUNT RECEIVABLES</th>
                            <th class="text-center">AMOUNT PAID</th>
                            <th class="text-center">AMOUNT SHORT</th>
                            <th>REMARKS</th>
                            <th class="text-center" width="120">Action</th>
                        </tr>


                    </thead>

                    <tbody class="" id="tbody">

                        @foreach ($reportOwn as $key => $item)
                            <tr>
                                <td class="">{{ $key + 1 }}</td>
                                <td class="">{{ $item->created_on }}</td>
                                <td class="">{{ $item->customer_name }}</td>
                                <td class="">{{ $item->seller_name }}</td>
                                <td class="">{{ $item->invoice }}</td>
                                {{-- <td class="text-center"></td> --}}
                                <td class="text-center">{{$item->gran_accpt_qty}}</td>
                                <td class="text-center">{{ $item->total_receive }} </td>
                                <td class="text-center">{{ $item->payment_recevied }}</td>

                                <td class="text-center">{{ $item->short_payment }}</td>
                                <td class="text-center">{{ $item->remarks }}</td>

                                <td class="">
                                    <a href="{{ url('admin/invoiceOwn_') }}{{ urlencode('view' . '_' . $item->id) }}"
                                        title="View" class="btn btn-primary btn-sm rounded-0"><i class="fa fa-eye"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ url('admin/invoiceOwn_') }}{{ urlencode('edit' . '_' . $item->id) }}"
                                        title="Edit" class="btn btn-warning btn-sm rounded-0"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    {{-- <a href="{{ url('admin/a/a/invoice_own') }}{{urlencode('delete'.'_'.$item->id)}}" title="Delete" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i></a> --}}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        const searchByDate = document.getElementById('searchByDate');
        const searchByInvoiceOwn = document.getElementById('searchByInvoiceOwn');
        const searchByInvoicePpl = document.getElementById('searchByInvoicePpl');

        const tbody = document.getElementById('tbody');
        const trList = tbody.children;

        searchByDate.addEventListener('keyup', (e) => {
            let input = (e.target.value).toUpperCase();

            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[1];

                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })

        searchByInvoiceOwn.addEventListener('keyup', (e) => {
            let input = e.target.value;
            console.log(input);
            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[2];
                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })

        searchByInvoicePpl.addEventListener('keyup', (e) => {
            let input = (e.target.value).toUpperCase();
            console.log(trList.length);
            for (let index = 0; index < trList.length; index++) {
                let data = (trList[index].children)[3];
                let tdData = (data.innerText).toUpperCase() || (data.innerHtml).toUpperCase();
                if (tdData.indexOf(input) > -1) {
                    trList[index].style.display = "";
                } else {
                    trList[index].style.display = "none";
                }
            }
        })
    </script>
@endsection
