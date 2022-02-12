<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom_assets/css/utils.css') }}">
    <title>Invoice</title>
    <style>
        @media print {
            .noPrint {
                display: none;
            }
        }

    </style>
</head>

<body>
    <div class="container my-2" id="invocePage">
        <div class="title border border-2 pb-3 pt-1">
            <h4 class="text-center">PROSENJIT HAZRA</h4>
            <h5 class="text-center">
                OFFICE:PLOT NO - 48 , ZONAL MARKET COMPLEX ,A - ZONE ,DURGAPUR - 713204</h5>
        </div>
        <div class="">
            <div class="text-center h5 m-0 pb-1 w-100 border-start border-end border-2" style="font-style:italic">
                COMMISSION INVOICE</div>
            <div class="d-flex" style="font-style: italic;font-size:12px;font-weight:bold">
                <div class="col-5 border border-2">
                    <div class="border-bottom border-2 pb-4 p-2">

                        <p class="m-0"> INTENDED TO BE NEGOTIATED DIRECT/THROUGH</p>
                        <p class="m-0"> PROSENJIT HAZRA</p>
                        <p class="m-0"> PLOT NO 48 A- ZONE ZONAL COMPLEX</p>
                        <p class="m-0"> DURGAPUR 713204, WEST BENGAL</p>
                        <p class="m-0"> GST NO - 19AEKPH4237C1ZO</p>

                    </div>
                    <div class="pb-4 p-2">
                        <p class="m-0">TO</p>
                        <p class="m-0"> M/S LALWANI FERRO ALLOYS LTD</p>
                        <p class="m-0"> OM TOWER 32 JLN ROAD KOLKATA 700071</p>
                        <p class="m-0"> KOLKATA, WEST BENGAL</p>
                        <p class="m-0">GTS NO - 19AAACL4482G1ZE</p>
                    </div>
                </div>
                <div class="col-7 border border-2">
                    <div class="d-flex py-1 px-3 border-bottom border-2">
                        <div class="d-flex col-6">
                            <span class="mx-2">INVOICE NO.</span>
                            <span class="mx-2">{{$vw_invoice_data->invoice }}</span>
                        </div>
                        <div class="d-flex justify-content-end col-6">
                            <span class="mx-2">Date</span>
                            <span class="mx-2">{{$vw_invoice_data->created_on}}</span>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex py-1 px-3 border-bottom border-2">
                            <div class="d-flex col-6">
                                <span class="mx-2">COMMERCIAL INVOICE NO.</span>
                                <span class="mx-2">{{$vw_invoice_data->c_invoice }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="font-style: italic;font-size:12px;font-weight:bold;">
            <table id="dynamic-table" class="table table-bordered ">
                <thead class="">

                    <tr style="font-size: 13px">
                        <th width="50">#</th>
                        <th width="">DESCRIPTION</th>
                        <th width="">SUPPLIED QTY IN MT</th>
                        <th width="">LFA INV NO</th>
                        <th width="">COMMISSION RATE PER MT</th>
                        <th width="">COMMISSION Rs.</th>

                    </tr>


                </thead>

                <tbody class="" id="tbody">
                    @php
                       $totalSupplyQty = 0;
                        $totalCommission = 0;
                    @endphp
                     @foreach ($invoice_addational_data as $key=>$item)
                     <tr id="row1" style="font-style: normal;font-size:14px">
                        <td>{{$key+1}}</td>
                        <td class="text-center">{{$item->description}}</td>
                        <td class="text-center">
                            @php
                                echo  number_format((float)$item->supplyQty,2,'.',',');
                                $totalSupplyQty +=  (float)$item->supplyQty;
                            @endphp
                            
                        </td>
                        <td class="text-center">{{$item->lfaInv}}</td>
                        <td class="text-center">{{number_format((float)$vw_invoice_data->po_rate,2,'.',',')}}</td>
                        <td class="text-center">
                        @php
                       
                              echo number_format(((float)$vw_invoice_data->po_rate*(float)$item->supplyQty),2,'.',',');
                                $totalCommission +=  ((float)$vw_invoice_data->po_rate*(float)$item->supplyQty);
                        @endphp
                        </td>
                 @endforeach
                 
                   
                    <tr id="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">Total</td>
                        <td class="text-center">{{number_format((float)$totalCommission,2,'.',',')}}</td>
                    </tr>
                    <tr id="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">CGST 9%</td>
                        <td class="text-center">{{number_format((float)$totalCommission*9/100,2,'.',',')}}</td>
                    </tr>
                    <tr id="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">SGST 9%</td>
                        <td class="text-center">{{number_format((float)$totalCommission*9/100,2,'.',',')}}</td>
                    </tr>
                    <tr id="">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">GST Amount</td>
                        <td class="text-center">{{number_format((float)$totalCommission*18/100,2,'.',',')}}</td>
                    </tr>
                    <tr id="">
                        <td></td>
                        <td></td>
                        <td class="text-center">{{number_format((float)$totalSupplyQty,2,'.',',')}}</td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id="">

                        <td colspan="2">RUPEES: FOUR LAKH THIRTEEN THOUSAND ONLY.</td>
                        <td></td>
                        <td></td>
                        <td>Total With GST</td>
                        <td class="text-center">{{number_format((float)$totalCommission*118/100,2,'.',',')}}</td>
                    </tr>
                    <tr id="">
                        <td class="text-end" colspan="2">
                            <p class="m-0 ">ACCOUNT NUMBER : 50200032616352</p>
                            <p class="m-0">PAN NO: AEKPH4237C</p>
                            <p class="m-0">ACCOUNT NUMBER : 50200032616352</p>
                            <p class="m-0">BANK NAME : HDFC BANK</p>
                            <p class="m-0">RTGS CODE : HDFC 0000234</p>
                        </td>
                        <td></td>
                        <td colspan="3">
                            <p class="m-0 text-center">E. & O.E.</p>
                            <p class="m-0 text-center">for PROSENJIT HAZRA </p>
                        </td>
                        </tr>
                    <tr id="">

                        <td class="text-end" colspan="2">INVOICE AMOUNT Rs.</td>

                        <td class="text-center">{{number_format((float)$totalCommission*118/100,2,'.',',')}}</td>
                        <td class="" style=""  colspan="3"></td>

                    </tr>
                    <tr id="">

                        <td class="text-end" colspan="2">AMOUNT DUE Rs.</td>

                        <td class="text-center">{{number_format((float)$totalCommission*118/100,2,'.',',')}}</td>
                        <td class="text-center" colspan="3">AUTHORISED SIGNATORY</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <div class="utils_center  mb-3">
        <button type="button" class="btn btn-secondary noPrint" id="printBtn">Print</button>
    </div>

    <script src="{{ asset('bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap/jquery.min.js') }}"></script>
    <script>
        const invocePage = document.getElementById('invocePage');
        const printBtn = document.getElementById('printBtn');
        printBtn.addEventListener('click', (e) => {
          
            window.print();
           
        })
    </script>
</body>

</html>
