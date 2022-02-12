@extends('dashboardLayout')
@section('title', 'Create Invoice')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')


    <div class="card pb-3">
        <nav class="bg-light border-bottom " style="" aria-label="breadcrumb">

            <ol class="breadcrumb m-0 d-flex align-items-center justify-content-start h4 px-3"
                style="height:51px;font-size:21px;">
                <li class="breadcrumb-item ">Create Invoice</li>
                <!-- <li class="breadcrumb-item active " aria-current="page">Library</li> -->
            </ol>



        </nav>


        <form class="px-3" id="formData" action="{{ route('previewInvoice') }}" method="POST"
            enctype="multipart/form-data">
            @csrf


            <div class="row mt-3">
                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Enter PO Number<span class="text-danger">*</span></label>
                    @if (!empty($vw_invoice_data->po_number))
                        <input type="text" class="form-control" value="{{ $vw_invoice_data->po_number }}" id="po_number"
                            readonly>
                    @else
                        <input type="text" class="form-control " name="po_number" id="po_number" required>
                    @endif

                    <input type="hidden" id="po_id" name="po_id">
                    <ul class="m-0 p-0 bg-light d-none border" id="ul_ponumber_list"
                        style="list-style: none;max-height:200px;width:22.70%;position: absolute; font-size:18px;overflow:auto">
                        @foreach ($po_details as $item)
                            <li class="po_list px-3" value="{{ $item->id }}">{{ $item->po_number }}</li>
                        @endforeach
                    </ul>


                    <span class="text-danger">@error('po_number') {{ $message }} @enderror</span>
                </div>

                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Commission Rate/MT</label>

                    <input type="text" class="form-control " name="po_rate" id="po_rate"
                        value="{{ $vw_invoice_data->po_rate }}" readonly>

                </div>

                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Customer Name</label>

                    <input type="text" class="form-control " name="customer_name" id="customer_name"
                        value="{{ $vw_invoice_data->customer_name }}" readonly>



                </div>
                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Seller Name</label>

                    <input type="text" class="form-control " name="seller_name" id="seller_name"
                        value="{{ $vw_invoice_data->seller_name }}" readonly>



                </div>
                <div class="mb-3 col-3 ">
                    <label for="" class="form-label p-0">Invoice</label>
                    @if (!empty($vw_invoice_data->invoice))
                        <input type="text" class="form-control " id="invoice" value="{{ $vw_invoice_data->invoice }}"
                            readonly>
                    @else
                        <select class="form-select" name="invoice" id="invoice" aria-label="Default select example"
                            required>

                        </select>
                        <input type="hidden" name="invoice_principle_id" id="invoice_principle_id">
                    @endif
                </div>
                <div class="mb-3 col-3 ">
                    <label for="" class="form-label p-0">Commercial Invoice Number </label>

                    <input type="text" class="form-control" value="{{ $vw_invoice_data->c_invoice }}" name="c_invoice"
                        id="" required>
                    {{-- <span class="text-danger">@error('invoice') {{ $message }} @enderror</span> --}}


                </div>

                <div class="col-12">
                    <table id="dynamic-table" class="table table-bordered table-secondary" style="">
                        <thead class="">


                            <tr style="font-size: 13px">
                                <th width="50">#</th>
                                <th width="">DESCRIPTION</th>
                                <th width="">SUPPLIED QTY IN MT</th>
                                <th width="">LFA INV NO</th>
                                <th width="">COMMISSION RATE PER MT</th>
                                <th width="">COMMISSION Rs.</th>
                                <th class="text-center" width="60">Action</th>
                            </tr>


                        </thead>

                        <tbody class="" id="tbody">
                            @if (!empty($invoice_addational_data))
                                @foreach ($invoice_addational_data as $key => $item)
                                    <tr id="row1">
                                        <td>{{ $key + 1 }}</td>
                                        <td><textarea class="form-control" name="description[]" rows="1"
                                                required>{{ $item->description }}</textarea></td>
                                        <td><input type="number" class="form-control" oninput="supplyQty(event,1)"
                                                name="supplyQty[]"
                                                value="{{ number_format((float) $item->supplyQty, 2, '.', ',') }}"
                                                id=supplyQty1 required></td>
                                        <td><input type="text" class="form-control" value="{{ $item->lfaInv }}"
                                                name="lfaInv[]" required></td>
                                        <td><input type="text" class="form-control"
                                                value="{{ number_format((float) $vw_invoice_data->po_rate, 2, '.', ',') }}"
                                                id="po_rate1" readonly required></td>
                                        <td><input type="text" class="form-control" id="commission1"
                                                value="{{ number_format((float) $vw_invoice_data->po_rate * (float) $item->supplyQty, 2, '.', ',') }}"
                                                name="commission[]" readonly required>
                                        </td>
                                        <td><button type="button" class="form-control btn btn-success" id="add_row"><i
                                                    class="fa fa-plus text-light" aria-hidden="true"></i></button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="row1">
                                    <td>1</td>
                                    <td><textarea class="form-control" name="description[]" rows="1" required></textarea>
                                    </td>
                                    <td><input type="number" class="form-control" oninput="supplyQty(event,1)"
                                            name="supplyQty[]" id="supplyQty1" required></td>
                                    <td><input type="text" class="form-control" name="lfaInv[]" required></td>
                                    <td><input type="text" class="form-control" id="po_rate1" readonly required></td>
                                    <td><input type="text" class="form-control" id="commission1" name="commission[]"
                                            readonly required>
                                    </td>
                                    <td><button type="button" class="form-control btn btn-success" id="add_row"><i
                                                class="fa fa-plus text-light" aria-hidden="true"></i></button></td>
                                </tr>
                            @endif


                        </tbody>
                    </table>
                </div>



                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Remarks</label>

                    <input type="text" class="form-control" name="remarks" value="{{ $vw_invoice_data->remarks }}"
                        id="remarks">



                </div>

                <div class=" mb-3 col-3">
                    <label for="" class="form-label p-0">Payment Date</label>

                    <input type="date" name="payment_date" id="payment_date" value="{{ $vw_invoice_data->payment_date }}"
                        class="form-control " required />

                </div>


                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Created On</label>

                    <input type="date" class="form-control " value="{{ $vw_invoice_data->created_on }}" id="created_on"
                        name="created_on" required>


                </div>

                <div class="mb-3 col-3">
                    <label for="" class="form-label p-0">Created By</label>
                    @if (!empty($vw_invoice_data->created_by))
                        <input type="text" class="form-control " value="{{ $vw_invoice_data->created_by }}" readonly
                            required>

                    @else
                        <input type="text" class="form-control " value="{{ session('ADMIN_USER') }}" name="created_by"
                            id="created_by" readonly>
                    @endif


                </div>
                <div class="utils_center my-3">
                    <input type="hidden" name="invoice_data_id" value="{{ $vw_invoice_data->id }}">
                    @if ($action != trim('view'))
                        <button type="submit" class="btn btn-success mx-3" id="saveBtn">Save & Preview</button>
                    @endif
                </div>

            </div>



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
        const po_number = document.getElementById('po_number');
        const po_list = document.querySelectorAll('.po_list');
        const add_row = document.getElementById('add_row');
        const saveBtn = document.getElementById('saveBtn');
        const invoice = document.getElementById('invoice')
       
        let a = 1;



        // saveBtn.addEventListener('click', (e) => {
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('previewInvoice') }}",
        //         data: $('#formData').serialize(),
        //         dataType: 'json',
        //         success: function(data) {
        //             console.log(data)
        //         },
        //         error: function(error) {
        //             console.log('error:', error)
        //         }
        //     });
        // })

        invoice.addEventListener('change', (e) => {
            $('#invoice_principle_id').val(e.target.value);
        })

        add_row.addEventListener('click', (e) => {
            a++;
            let po_rate = parseFloat($('#po_rate1').val())
            let html = ` <tr id="row${a}">
                        <td>${a}</td>
                        <td><textarea class="form-control" name="description[]" rows="1" required></textarea></td>
                        <td><input type="number" class="form-control" oninput="supplyQty(event,${a})" name="supplyQty[]" id=supplyQty${a} required></td>
                        <td><input type="text" class="form-control" name="lfaInv[]" required></td>
                        <td><input type="text" class="form-control" id="" value=${po_rate} readonly required></td>
                        <td><input type="text" class="form-control" id="commission${a}" name="commission[]" required readonly></td>
                        <td><button type="button" class="form-control btn btn-danger" onclick="remove_row(${a})" required><i
                                    class="fa fa-minus text-light" aria-hidden="true"></i></button></td>
                            </tr>`;
            $('#tbody').append(html);
            // console.log(po_rate)
        })

        function remove_row(a) {

            $('#row' + a).remove();
        }

        function supplyQty(e, a) {
            let qty = parseFloat(e.target.value);
            let po_rate = parseFloat($('#po_rate1').val())
            if (!isNaN(qty)) {
                $('#commission' + a).val((po_rate * qty).toFixed(2))

                console.log('first')
            } else {

                $('#commission' + a).val(0)

            }


        }



        po_number.addEventListener('keyup', (e) => {
            const ul_ponumber_list = document.getElementById('ul_ponumber_list');

            if (ul_ponumber_list.classList.contains('d-none')) {
                ul_ponumber_list.classList.remove("d-none");;
            }
            let inputValue = (e.target.value).toUpperCase();
            // console.log(inputValue);
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
                        $('#po_rate1').val(data['vw_po_details'].po_rate);
                        $('#po_rate').val(data['vw_po_details'].po_rate);
                        $('#customer_name').val(data['vw_po_details'].customer_name);
                        $('#seller_name').val(data['vw_po_details'].seller_name);

                    }

                    if (data['invoice_principle'].length > 0) {
                        let html = `<option value="">Invoice List</option>`;

                        data['invoice_principle'].forEach((elem, index) => {
                            html += `<option value="${elem['id']}">${elem['invoice']}</option>`;
                            console.log(elem['invoice']);

                        })
                        $('#invoice').append(html);
                    }



                })
                .catch((error) => {
                    console.log('error:', error)
                });

        }
    </script>
@endsection
