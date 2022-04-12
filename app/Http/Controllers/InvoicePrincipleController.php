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
use Illuminate\Support\Facades\Validator;
use stdClass;

class InvoicePrincipleController extends Controller

{

    public function invoicePrinciple($param)
    {
        try {
            $url = explode('_', urldecode($param));
            $action = trim($url[0]);
            $id = trim($url[1]);
            function viewInvoicePrinciple($db, $type)
            {
                $vw_po_details = DB::table('vw_po_details')->where(['id' => $db->po_id])->get()[0];
                $data = [
                    'invoice_principle_id' => $db->id,
                    'vw_po_details' => $vw_po_details,
                    'invoice' => $db->invoice,
                    'gran' => $db->gran,
                    'gran_date' => $db->gran_date,
                    'gran_qty' => $db->gran_qty,
                    'gran_accpt_qty' => $db->gran_accpt_qty,
                    'gran_short_qty' => $db->gran_short_qty,
                    'remarks' => $db->remarks,
                    'bill_process_date' => $db->bill_process_date,
                    'payment_date' => $db->payment_date,
                    'payment_amount' => $db->payment_amount,
                    'cgst_per' => $db->cgst_per,
                    'cgst_amount' => $db->cgst_amount,
                    'sgst_per' => $db->sgst_per,
                    'sgst_amount' => $db->sgst_amount,
                    'total_receivable' => $db->total_receivable,
                    'payment_recevied' => $db->payment_recevied,
                    'payment_due' => $db->payment_due,
                    'remarks1' => $db->remarks1,
                    'created_on' => $db->created_on,
                    'created_by' => $db->created_by,
                    'action' => $type,
                ];
                return $data;
            }
            if ($action == trim('')) {
                $vw_po_details = new stdClass();
                $vw_po_details->po_rate = '';
                $vw_po_details->po_number = '';
                $vw_po_details->customer_name = '';
                $vw_po_details->seller_name = '';

                $data = [
                    'invoice_principle_id' => '',
                    'vw_po_details' => $vw_po_details,
                    'invoice' => '',
                    'gran' => '',
                    'gran_date' => '',
                    'gran_qty' => '',
                    'gran_accpt_qty' => '',
                    'gran_short_qty' => '',
                    'remarks' => '',
                    'bill_process_date' => '',
                    'payment_date' => '',
                    'payment_amount' => '',
                    'cgst_per' => '',
                    'cgst_amount' => '',
                    'sgst_per' => '',
                    'sgst_amount' => '',
                    'total_receivable' => '',
                    'payment_recevied' => '',
                    'payment_due' => '',
                    'remarks1' => '',
                    'created_on' => '',
                    'created_by' => '',
                    'action' => '',
                    'po_details' => DB::table('po_details')->get(),
                ];
                return view('invoicePrinciple', $data);
            } elseif ($action == trim('view')) {
                $db = DB::table('invoice_principle')->where(['id' => $id])->get()[0];

                return view('invoicePrinciple', viewInvoicePrinciple($db, $action));
            } elseif ($action == trim('edit')) {
                $db = DB::table('invoice_principle')->where(['id' => $id])->get()[0];

                return view('invoicePrinciple', viewInvoicePrinciple($db, $action));
            } elseif ($action == trim('report')) {
                $db['reportPrinciple'] = DB::table('vw_invoice_principle')->get();

                return view('reportPrinciple', $db);;
            } else {
                return ['error' => 'action not performed'];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function invoicePrincipleSave(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'po_id' => 'required',
                ]);
            $id = $request->input('invoice_principle_id');
            // return $request->all();
            function principleData($request)
            {
                $data = [

                    'po_id' => $request->input('po_id'),
                    'invoice' => $request->input('invoice'),
                    'gran' => $request->input('gran'),
                    'gran_date' => $request->input('gran_date'),
                    'gran_qty' => $request->input('gran_qty'),
                    'gran_accpt_qty' => $request->input('gran_accpt_qty'),
                    'gran_short_qty' => $request->input('gran_short_qty'),
                    'remarks' => $request->input('remarks'),
                    'bill_process_date' => $request->input('bill_process_date'),
                    'payment_date' => $request->input('payment_date'),
                    'payment_amount' => $request->input('payment_amount'),
                    'cgst_per' => $request->input('cgst_per'),
                    'cgst_amount' => $request->input('cgst_amount'),
                    'sgst_per' => $request->input('sgst_per'),
                    'sgst_amount' => $request->input('sgst_amount'),
                    'total_receivable' => $request->input('total_receivable'),
                    'payment_recevied' => $request->input('payment_recevied'),
                    'payment_due' => $request->input('payment_due'),
                    'remarks1' => $request->input('remarks1'),
                    'created_on' => $request->input('created_on'),
                    'created_by' => $request->input('created_by'),
                ];
                return array_filter($data,function($a){
                    return isset($a);
                });
            }
            if ($id > 0) {

                if ($validator->fails()) {
                    return redirect('admin/invoicePrinciple_' . urlencode('edit' . '_' . $id))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('invoice_principle')->where(['id' => $id])->update(principleData($request));
                session()->flash('msg', 'Successfully Update InvoicePrinciple');
                return redirect('admin/invoicePrinciple_' . urlencode('report' . '_' . ''));
            }

            if ($validator->fails()) {
                return redirect('admin/invoicePrinciple_' . urlencode('' . '_' . ''))
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::table('invoice_principle')->insert(principleData($request));
            session()->flash('msg', 'Successfully Save InvoicePrinciple');
            return redirect('admin/invoicePrinciple_' . urlencode('report' . '_' . ''));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
