@extends('dashboardLayout')
@section('title', 'PO Details')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')
    <div class="card">

        <nav class="bg-light border-bottom   ">
            <ol class="breadcrumb d-flex align-items-center mx-4 m-0 h4" style="height:51px;font-size:21px">
                <li class="breadcrumb-item">
                    <span class="h5 text-dark">PO Details</span>

                </li>

            </ol>

        </nav>



        <div class="p-3">
            <form class="mt-3" action="{{ route('savePoDetails') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-3  my-2">
                        <label for="exampleFormControlInput0">Customer Name<span style="color: red">*<span></label>

                        <select class="form-select rounded-0" name="customer_id" aria-label="Default select example"
                            id="exampleFormControlInput0" required>
                            <option selected value="">--Select--</option>
                            @foreach ($customer as $item)

                                @if ($item->id == $customer_id)
                                    <option value="{{ $item->id }}" selected readonly>
                                        {{ ucwords($item->customer_name) }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ ucwords($item->customer_name) }}</option>
                                @endif
                            @endforeach
                        </select>

                        <span class="text-danger">@error('customer_id') {{ 'The Customer Name field is required.'}} @enderror</span>
                    </div>
                    <div class="form-group col-3  my-2">
                        <label for="exampleFormControlInput0">Seller Name<span style="color: red">*<span></label>

                        <select class="form-select rounded-0" name="seller_id" aria-label="Default select example"
                            id="exampleFormControlInput0" required>
                            <option selected value="">--Select--</option>
                            @foreach ($seller as $item)

                                @if ($item->id == $seller_id)
                                    <option value="{{ $item->id }}" selected readonly>
                                        {{ ucwords($item->seller_name) }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ ucwords($item->seller_name) }}</option>
                                @endif
                            @endforeach
                        </select>

                        <span class="text-danger">@error('seller_id') {{ 'The Seller Name field is required.'}} @enderror</span>
                    </div>

                    <div class="form-group col-3  my-2">
                        <label for="exampleFormControlInput1">PO Number</label>
                        <input type="text" class="form-control rounded-0" id="exampleFormControlInput1" name="po_number"
                            placeholder="" value="{{ $po_number }}" required>
                        <span class="text-danger">@error('po_number') {{ $message . 'Try Other Po Number' }}
                            @enderror</span>

                    </div>

                    <div class="form-group col-3  my-2">
                        <label for="exampleFormControlInput1">GEMC Number </label>
                        <input type="text" class="form-control rounded-0" id="exampleFormControlInput1" name="gemc_number"
                            placeholder="" value="{{ $gemc_number }}">
                        <span class="text-danger">@error('gemc_number') {{ $message }} @enderror</span>

                    </div>


                    <div class="form-group col-3  my-2">
                        <label for="amount">Price without GST</label>
                        <input type="text" class="form-control rounded-0" id="amount" oninput="amountWoGst(event)"
                            name="amount" placeholder="" value="{{ $amount }}" required>
                        <span class="text-danger">@error('amount') {{ $message }} @enderror</span>

                    </div>

                    <div class="form-group col-3  my-2">
                        <label for="total_qty">Total GRAN Quantity</label>
                        <input type="text" class="form-control rounded-0" id="total_qty" name="total_qty" placeholder=""
                            value="{{$total_qty}}"required>
                                           
                        <span class="text-danger">@error('total_qty') {{ $message }} @enderror</span>

                    </div>

                    <div class="form-group col-3  my-2">
                        <label for="amount">Commission Rate/MT</label>
                        <input type="text" class="form-control rounded-0" id="po_rate" name="po_rate" placeholder=""
                            value="{{ $po_rate }}">
                        <span class="text-danger">@error('po_rate') {{ $message }} @enderror</span>

                    </div>

                    <div class="form-group col-3  my-2">
                        <label for="cgst">CGST</label>
                        <input type="text" class="form-control rounded-0" id="cgst" name="cgst" placeholder="" value="9"
                            readonly>
                        <span class="text-danger">@error('cgst') {{ $message }} @enderror</span>

                    </div>
                    
                    
                     <div class="form-group col-3  my-2">
                        <label for="sgst">SGST</label>
                        <input type="text" class="form-control rounded-0" id="sgst" name="sgst" placeholder="" value="9"
                            readonly>
                        <span class="text-danger">@error('sgst') {{ $message }} @enderror</span>

                    </div>
                    
                    
                    
                    <div class="form-group col-3  my-2">
                        <label for="netAmount">Net Amount</label>
                        <input type="text" class="form-control rounded-0" id="netAmount" name="net_amount" placeholder=""
                            value="{{ $net_amount }}" readonly>
                        <span class="text-danger">@error('net_amount') {{ $message }} @enderror</span>

                    </div>
                    <div class="form-group col-3  my-2">
                        <label for="exampleFormControlInput1">Date</label>
                        <input type="date" class="form-control rounded-0" id="exampleFormControlInput1" name="date"
                            placeholder="" value="{{ $date }}" required>
                        <span class="text-danger">@error('date') {{ $message }} @enderror</span>

                    </div>

                </div>

                <input type="hidden" name="poDetails_id" value="{{ $poDetails_id }}" />
                <input type="hidden" name="action" value="{{$action}}"/>
                <div class="utils_center mt-3">
                    @if ($action != trim('view'))
                        <button type="submit" class="btn btn-success rounded-0 mx-3">Save & Return</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
        function amountWoGst(e) {
            let amount = parseFloat(e.target.value);
            // console.log(amount);
            if (!isNaN(amount)) {

                $('#netAmount').val((amount * (100 + parseFloat($('#cgst').val())+parseFloat($('#sgst').val())) / 100).toFixed(2));
                

            } else {

                $('#netAmount').val(0);
               
            }

        }

        
    </script>
@endsection

    
    
