@extends('dashboardLayout')
@section('title', 'Invoice Principle')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')


    <div class="card pb-3">
        <nav class="bg-light border-bottom " style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 d-flex align-items-center justify-content-start h4 px-3"
                style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Invoice Principle</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>



        </nav>


        <form class="px-3" action="{{ route('saveInvoicePrinciple') }}" method="post"
            enctype="multipart/form-data">
            @csrf


            <div class="col-10 offset-1 mt-3">
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Enter PO Number<span
                            class="text-danger">*</span></label>
                    <div class="col-8">
                        @if ($invoice_principle_id == '')
                            <input type="text" class="form-control rounded-0" name="po_number" id="po_number" required>

                            <ul class="m-0 p-0 bg-light d-none border" id="ul_ponumber_list"
                                style="list-style: none;max-height:200px;width:53%;position: absolute; font-size:18px;overflow:auto">
                                @foreach ($po_details as $item)
                                    <li class="po_list px-3" value="{{ $item->id }}">{{ $item->po_number }}</li>
                                @endforeach
                            </ul>
                            <input type="hidden"  name="po_id" id="po_id" />
                            <span class="text-danger">@error('po_id') {{ $message.'Select Existing Po Number' }} @enderror</span>
                        @else
                            <input type="text" class="form-control rounded-0" name="po_number"
                                value="{{ $vw_po_details->po_number }}" required readonly>
                            <input type="hidden" name="po_id" value="{{ $vw_po_details->id }}" />
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
                        <input type="text" class="form-control rounded-0" name="customer_name"
                            value="{{ ucwords($vw_po_details->customer_name) }}" id="customer_name" readonly>
                        <span class="text-danger">@error('customer_name') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Seller Name</label>
                    <div class="col-8">
                        <input type="text" readonly class="form-control rounded-0" value="{{ ucwords($vw_po_details->seller_name) }}"
                            name="seller_name" id="seller_name">
                       
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Invoice</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $invoice }}" name="invoice" id="">
                        <span class="text-danger">@error('invoice') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">GARN Number</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $gran }}" name="gran" id="">
                        <span class="text-danger">@error('gran') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">GARN Date</label>
                    <div class="col-8">
                        <input type="date" class="form-control rounded-0" value="{{ $gran_date }}" name="gran_date"
                            id="">
                            <span class="text-danger">@error('gran_date') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">GARN Qty</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $gran_qty }}" name="gran_qty"
                            id="total_qty" readonly>
                            <span class="text-danger">@error('gran_qty') {{ $message }} @enderror</span>
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
                    <label for="" class="col-2 col-form-label p-0">GARN Short Qty</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $gran_short_qty }}"
                            name="gran_short_qty" id="gran_short_qty" readonly>
                            <span class="text-danger">@error('gran_short_qty') {{ $message }} @enderror</span>
                    </div>

                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Remarks</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" value="{{ $remarks }}" name="remarks" id="">
                        <span class="text-danger">@error('remarks') {{ $message }} @enderror</span>
                    </div>

                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">BILL PROCESS DATE</label>
                    <div class="col-8">
                        <input type="date" class="form-control rounded-0" value="{{ $bill_process_date }}"
                            name="bill_process_date" id="">
                            <span class="text-danger">@error('bill_process_date') {{ $message }} @enderror</span>
                    </div>

                </div>


                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Date</label>
                    <div class="col-8">
                        <input type="date" name="payment_date" value="{{ $payment_date }}"
                            class="form-control rounded-0" />
                            <span class="text-danger">@error('payment_date') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Amount</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            oninput="onInputAmount(event)" value="{{ $payment_amount }}" name="payment_amount"
                            id="amount" readonly>
                            <span class="text-danger">@error('payment_amount') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class=" col-form-label p-0 col-2">GST Tax</label>
                    <div class="col-8">
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="" class=" col-form-label p-0">CGST%</label>
                                <input type="number" readonly step="0.001" min="0" max="100" class="form-control rounded-0"
                                    value="9" id="cgst_percentage" name="cgst_per" required>
                                    <span class="text-danger">@error('cgst_per') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-8">
                                <label for="" class=" col-form-label p-0">CGST Amount</label>
                                <input type="number" class="form-control rounded-0" name="cgst_amount" id="cgst_amount"
                                    value="{{ $cgst_amount }}" readonly>
                                    <span class="text-danger">@error('cgst_amount') {{ $message }} @enderror</span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="" class=" col-form-label p-0">SGST%</label>
                                <input type="number" readonly step="0.001" min="0" max="100" value="9"
                                    class="form-control rounded-0" id="sgst_percentage" name="sgst_per" required>
                                    <span class="text-danger">@error('sgst_per') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-8">
                                <label for="" class=" col-form-label p-0">SGST Amount</label>
                                <input type="number" class="form-control rounded-0" name="sgst_amount" id="sgst_amount"
                                    value="{{ $sgst_amount }}" readonly>
                                    <span class="text-danger">@error('sgst_amount') {{ $message }} @enderror</span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Total Receivables</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            id="total_received" name="total_receivable" value="{{ $total_receivable }}" readonly>
                            <span class="text-danger">@error('total_receivable') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Received</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            name="payment_recevied" oninput="onInputReceviedAmount(event)" id="recived_payment"
                            value="{{ $payment_recevied }}">
                            <span class="text-danger">@error('payment_recevied') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Payment Due</label>
                    <div class="col-8">
                        <input type="number" step="0.001" min="0" max="1000000000" class="form-control rounded-0"
                            name="payment_due" id="total_due" readonly value="{{ $payment_due }}">
                            <span class="text-danger">@error('payment_due') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Remarks</label>
                    <div class="col-8">
                        <input type="text" class="form-control rounded-0" name="remarks1" id="total_amount"
                            value="{{ $remarks }}">
                            <span class="text-danger">@error('remarks1') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="form-group row mb-3 utils_center">
                    <label for="" class="col-2 col-form-label p-0">Created On</label>
                    <div class="col-8">
                        <input type="date" class="form-control rounded-0" id="total_amount" name="created_on"
                            value="{{ $created_on }}" required>
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
                        <span class="text-danger">@error('created_by') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="utils_center my-3">

                    @if ($action != trim('view'))
                        <button class="btn btn-success mx-3 rounded-0">Save</button>
                    @endif
                </div>

            </div>

            <input type="hidden" value="{{ $invoice_principle_id }}" name="invoice_principle_id">

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






        function onInputReceviedAmount(event) {
            let receviedAmount = parseFloat(event.target.value);
            $('#total_due').val((parseFloat($('#total_received').val()) - receviedAmount).toFixed(2));
        }

        function granAccept(event) {
            granAcceptQty = parseFloat(event.target.value);
            $('#gran_short_qty').val($('#total_qty').val() - granAcceptQty)
            $('#amount').val((parseFloat($('#po_rate').val()) * granAcceptQty).toFixed(2))

            let cgst_per = parseFloat($('#cgst_percentage').val());
            let sgst_per = parseFloat($('#sgst_percentage').val());

            let amount = parseFloat($('#amount').val());
            $('#cgst_amount').val((amount * cgst_per / 100).toFixed(2)); //cgst
            $('#sgst_amount').val((amount * sgst_per / 100).toFixed(2)); //sgst
            $('#total_received').val((amount + parseFloat($('#cgst_amount').val()) + parseFloat($('#sgst_amount').val()))
                .toFixed(2));
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
