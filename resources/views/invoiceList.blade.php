@extends('dashboardLayout')
@section('title', 'invoiceList')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')
    <div class="card">
        <nav class="bg-light" style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 w-100 h4 d-flex align-items-center px-2" style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Invoice List</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>

        </nav>
        @if (session()->has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Message</strong> {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="p-3">
            <div class="d-flex mb-3 col-4">

                <input type="text" class="form-control rounded-0 mx-2" value="" id="searchByPoNumber"
                    placeholder="Enter PO Number">


            </div>
            <div>
                <table id="dynamic-table" class="table table-striped table-bordered  table-hover" style="font-size: 14px">
                    <thead class="thead_sticky" style="border-style:none">


                        <tr>
                            <th width="50">#</th>
                            <th class="text-center" width="">PO Number</th>
                            <th class="text-center" width="">Customer Name</th>
                            <th class="text-center" width="">Seller</th>
                            <th class="text-center" width="">Invoice</th>
                            <th class="text-center" width="">Invoice Link</th>

                            <th class="text-center" width="120">Action</th>
                        </tr>


                    </thead>

                    <tbody class="" id="tbody">

                        @foreach ($vw_invoice_data as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $item->po_number }}</td>
                                <td class="text-center">{{ $item->customer_name }}</td>
                                <td class="text-center">{{ $item->seller_name }}</td>
                                <td class="text-center">{{ $item->invoice }}</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/invoice_') }}{{ urlencode('create' . '_' . $item->id) }}"
                                        class="">Dawnload Invoice</a>
                                </td>


                                <td class="text-center">
                                    {{-- <a href="{{ url('admin/invoice_') }}{{ urlencode('view' . '_' . $item->id) }}"
                                        title="View" class="btn btn-primary btn-sm rounded-0"><i class="fa fa-eye"
                                            aria-hidden="true"></i></a> --}}
                                    {{-- <a href="{{ url('admin/invoice_') }}{{ urlencode('edit' . '_' . $item->id) }}"
                                        title="Edit" class="btn btn-warning btn-sm rounded-0"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --}}
                                    <a href="{{ url('admin/invoice_') }}{{ urlencode('delete' . '_' . $item->id) }}"
                                        title="Delete" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash-o"
                                            aria-hidden="true"></i></a>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        const searchByPoNumber = document.getElementById('searchByPoNumber');
        const tbody = document.getElementById('tbody');
        const trList = tbody.children;



        searchByPoNumber.addEventListener('keyup', (e) => {
            let input = e.target.value;
            console.log(input);
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
    </script>
@endsection
