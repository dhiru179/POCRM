@extends('dashboardLayout')
@section('title', 'Invoice Own')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')


    <div class="card pb-3">
        <nav class="bg-light border-bottom " style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 d-flex align-items-center justify-content-start h4 px-3"
                style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Invoice Own</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>

        </nav>


        <form class="px-3" action="{{ route('saveInvoiceOwn') }}" method="post" enctype="multipart/form-data">
            @csrf


            <div class="col-10 offset-1 mt-3">
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Enter PO Number<span
                            class="text-danger">*</span></label>
                    <div class="col-8">
                        @if ($invoice_own_id == '')
                            <input type="text" class="form-control rounded-0" name="po_number" id="po_number" required>

                            <ul class="m-0 p-0 bg-light d-none border" id="ul_ponumber_list"
                                style="list-style: none;max-height:200px;width:53%;position: absolute; font-size:18px;overflow:auto">
                                @foreach ($po_details as $item)
                                    <li class="po_list px-3" value="{{ $item->id }}">{{ $item->po_number }}</li>
                                @endforeach
                            </ul>
                            <input type="hidden"  name="po_id" id="po_id"/>
                            <span class="text-danger">@error('po_id') {{ 'Select Existing Po Number' }} @enderror</span>
                        @else
                            <input type="text" class="form-control rounded-0" name="po_number" value="{{ $vw_po_details->po_number }}"
                                required readonly>
                             <input type="hidden" name="po_id" value="{{$vw_po_details->id}}" />
                        @endif
                        <span class="text-danger">@error('po_number') {{ $message }} @enderror</span>

                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Commission Rate/MT</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" name="po_rate" value="{{ $vw_po_details->po_rate }}"
                            id="po_rate" readonly>
                            <span class="text-danger">@error('po_rate') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Customer Name</label>
                    <div class="col-8">
                        <input type="text" disabled class="form-control rounded-0" value="{{ ucwords($vw_po_details->customer_name) }}"
                            name="customer_name" id="customer_name">
                       
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Seller Name</label>
                    <div class="col-8">
                        <input type="text" disabled class="form-control rounded-0" value="{{ ucwords($vw_po_details->seller_name) }}"
                            name="seller_name" id="seller_name">
                       
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Invoice Number</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $invoice }}" name="invoice" id="">
                        <span class="text-danger">@error('invoice') {{ $message }} @enderror</span>
                    </div>

                </div>


                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Date</label>
                    <div class="col-8">
                        <input type="date" name="payment_date" value="{{ $payment_date }}" class="form-control rounded-0" />
                        <span class="text-danger">@error('payment_date') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">GARN Accepted Qty</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $gran_accpt_qty }}"
                            name="gran_accpt_qty" oninput="granAccept(event)" id="gran_accpt_qty">
                            <span class="text-danger">@error('gran_accpt_qty') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Total Receivables</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            value="{{ $total_receive }}" name="total_receive" oninput="totalRecevied(event)" id="recevied_amount" readonly>
                        <span class="text-danger">@error('total_receive') {{ $message }} @enderror</span>
                    </div>

                </div>



                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Received</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            oninput="paymentRecevied(event)" name="payment_recevied" id="recived_payment"
                            value="{{ $payment_recevied }}">
                        <span class="text-danger">@error('payment_recevied') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Short Payment</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            name="short_payment" id="total_due" readonly value="{{ $short_payment }}">
                        <span class="text-danger">@error('short_payment') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Remarks</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" name="remarks" value="{{ $remarks }}"
                            >
                        <span class="text-danger">@error('remarks') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Created On</label>
                    <div class="col-8">
                        <input type="date" class="form-control rounded-0" name="created_on" id="total_amount"
                            value="{{ $created_on }}" >
                        <span class="text-danger">@error('created_on') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Created By</label>
                    <div class="col-8">

                        @if ($created_by == '')
                            <input type="text" class="form-control rounded-0" name="created_by" id="total_amount"
                                value="{{ session('ADMIN_USER') }}" readonly>
                        @else
                            <input type="text" class="form-control rounded-0" name="created_by" id="total_amount"
                                value="{{ $created_by }}" readonly>
                        @endif
                    </div>
                </div>
                <div class="utils_center my-3">

                    @if ($action != trim('view'))

                        <button class="btn btn-success mx-3 rounded-0">Save</button>
                    @endif

                </div>

            </div>
            <input type="hidden" value="{{ $invoice_own_id }}" name="invoice_own_id">


        </form>
    </div>
    <style>
        .po_list:hover {
            background: rgb(23, 86, 97);
            cursor: pointer;
            color: white;
        }

    </style>
    <script>
        // const property = document.getElementById('property_89'); 
        const properties_name = document.getElementById('properties_name');
        const block_name = document.getElementById('block_name');
        const po_number = document.getElementById('po_number');
        const po_list = document.querySelectorAll('.po_list');


        function totalRecevied(e)
        {
            let totalRecevied = parseFloat(event.target.value);
            $('#total_due').val((totalRecevied - parseFloat($('#recived_payment').val())).toFixed(2));
        }

        function paymentRecevied(event) {
            let paymentRecevied = parseFloat(event.target.value);
            $('#total_due').val((parseFloat($('#recevied_amount').val()) - paymentRecevied).toFixed(2));
        }

        function granAccept(event)
        {
            $CommissionRate = $('#po_rate').val();
            $('#recevied_amount').val(($CommissionRate*event.target.value).toFixed(2));
        }



        po_number.addEventListener('keyup', (e) => {
            const ul_ponumber_list = document.getElementById('ul_ponumber_list');

            if (ul_ponumber_list.classList.contains('d-none')) {
                ul_ponumber_list.classList.remove("d-none");;
            }
            let inputValue = (e.target.value).toUpperCase();
            console.log(inputValue);
            const po_list = document.querySelectorAll('.po_list');
            po_list.forEach((eachli) => {

                let liData = (eachli.innerText).toUpperCase();
                if (liData.indexOf(inputValue) > -1) {
                    eachli.style.display = 'block';
                } else {
                    eachli.style.display = 'none';
                }
            })

        })

        po_list.forEach((eachli) => {
            eachli.addEventListener('click', (li) => {

                $('#po_number').val(li.target.innerText);
                $('#po_id').val(li.target.value);
                ul_ponumber_list.classList.add("d-none");
                postCustomerId(li.target.value);

            })
        })


        function postCustomerId(id) {
            const url = "{{ url('admin/po_details/save') }}";
            const data = {

                postData: 'postData', //for check ,where from data comes and return postDetails
                po_details_id: id,
            }
            const token = "{{ csrf_token() }}";
            postData(url, token, data)
                .then((response) => {
                    return response.json(); // JSON data parsed by `data.json()` call
                })
                .then((data) => {
                    console.log('block:', data);
                    if (data['vw_po_details']) {
                        $('#po_rate').val(data['vw_po_details'].po_rate);
                        $('#customer_name').val(data['vw_po_details'].customer_name);
                        $('#seller_name').val(data['vw_po_details'].seller_name);
                        $('#total_qty').val(data['vw_po_details'].total_qty);
                    }
                })
                .catch((error) => {
                    console.log('error:', error)
                });

        }
    </script>
@endsection
