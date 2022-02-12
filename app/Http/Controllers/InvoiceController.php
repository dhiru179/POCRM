<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LengthException;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\admin\Storage;
use SebastianBergmann\CodeCoverage\CrapIndex;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rule;
use stdClass;

class InvoiceController extends Controller

{


    public function actionOnInvoice($url)
    {
        $param = explode('_', urldecode($url));
        $action = $param[0];
        $invoiceDataId = $param[1];
        if ($action == trim('')) {
            $vw_invoice_data = new stdClass();
            $vw_invoice_data->id = '';
            $vw_invoice_data->po_rate = '';
            $vw_invoice_data->po_number = '';
            $vw_invoice_data->customer_name = '';
            $vw_invoice_data->seller_name = '';
            $vw_invoice_data->invoice = '';
            $vw_invoice_data->c_invoice = '';
            $vw_invoice_data->created_by = '';
            $vw_invoice_data->payment_date = '';
            $vw_invoice_data->remarks = '';
            $vw_invoice_data->created_on = '';

            $data = [
                'invoice_principle_id' => '',
                'vw_invoice_data' => $vw_invoice_data,
                'action' => '',
                'invoice_addational_data' => '',
                'po_details' => DB::table('po_details')->get(),
            ];
            return view('createInvoice', $data);
            // return view('invoiceFormat');
        } elseif ($action == trim('list')) {
            $data['vw_invoice_data'] = DB::table('vw_invoice_data')->get();
            return view('invoiceList', $data);
        }
        // elseif ($action == trim('edit')) {
        //     $data['po_details'] = DB::table('po_details')->get();
        //     $data['vw_invoice_data'] = DB::table('vw_invoice_data')->where(['id' => $invoiceDataId])->get()[0];
        //     $data['invoice_addational_data'] = DB::table('invoice_addational_data')->where(['id' => $data['vw_invoice_data']->id])->get();
        //     $data['action'] = $action;
        //     return view('createInvoice', $data);
        // }
        elseif ($action == trim('create')) {
            $data['vw_invoice_data'] = DB::table('vw_invoice_data')->where(['id' => $invoiceDataId])->get()[0];
            $data['invoice_addational_data'] = DB::table('invoice_addational_data')->where(['invoice_data_id' => $data['vw_invoice_data']->id])->get();

            return view('invoiceFormat', $data);
        } elseif ($action == trim('delete')) {
            $get_id = DB::table('invoice_data')->where(['id' => $invoiceDataId])->delete();
            session()->flash('msg', 'Invoice delete SuccesFully');
            return redirect('admin/invoice_list_');
        } else {

            return ['error' => 'action not performed'];
        }
    }


    public function previewInvoice(Request $request)
    {
        try {

            $invoiceData = [
                'po_id' => $request->po_id, //from po_number
                'invoice_principle_id' => $request->invoice_principle_id,
                'c_invoice' => $request->c_invoice,
                'remarks' => $request->remarks,
                'payment_date' => $request->payment_date,
                'created_on' => $request->created_on,
                'created_by' => $request->created_by,
            ];


            $invoiceFormData = [
                'description' => $request->description,
                'supplyQty' => $request->supplyQty,
                'lfaInv' => $request->lfaInv,
            ];
            $sepprateData = [[]];
            if (count($invoiceFormData['supplyQty']) > 0) {

                for ($i = 0; $i < count($invoiceFormData['supplyQty']); $i++) {
                    foreach ($invoiceFormData as $key => $value) {

                        $sepprateData[$i][$key] = $value[$i];
                    }
                }

                $get_id = DB::table('invoice_data')->insertGetId($invoiceData);

                foreach ($sepprateData as $key => $value) {

                    $data = [
                        'invoice_data_id' => $get_id,
                        'description' => $value['description'],
                        'supplyQty' => $value['supplyQty'],
                        'lfaInv' => $value['lfaInv'],
                    ];
                    DB::table('invoice_addational_data')->insert($data);
                }
                session()->flash('msg', 'Invoice Form Save SuccesFully');

                return redirect('admin/invoice_' . urlencode('list' . '_' . ''));
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
