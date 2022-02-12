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

class InvoiceOwnController extends Controller

{

    public function invoiceOwn($param)
    {
        try {
            if (session()->get('ADMIN_USER') == 'admin3') {
                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }

            $url = explode('_', urldecode($param));
            $action = trim($url[0]);
            $id = trim($url[1]);
            function viewOwnInvoice($db, $type)
            {
                $vw_po_details = DB::table('vw_po_details')->where(['id' => $db->po_id])->get()[0];
                $data = [
                    'invoice_own_id' => $db->id,
                    'vw_po_details' => $vw_po_details,
                    'invoice' => $db->invoice,
                    'payment_date' => $db->payment_date,
                    'gran_accpt_qty' => $db->gran_accpt_qty,
                    'total_receive' => $db->total_receive,
                    'payment_recevied' => $db->payment_recevied,
                    'short_payment' => $db->short_payment,
                    'remarks' => $db->remarks,
                    'created_on' => $db->created_on,
                    'created_by' => $db->created_by,
                    'action' => $type,
                ];
                return $data;
            }
            if ($action == trim('')) {
                $vw_po_details = new stdClass();
                $vw_po_details->po_number = '';
                $vw_po_details->customer_name = '';
                $vw_po_details->seller_name = '';
                $vw_po_details->po_rate = '';


                $data = [
                    'vw_po_details' => $vw_po_details,
                    'invoice' => '',
                    'payment_date' => '',
                    'gran_accpt_qty' => '',
                    'total_receive' => '',
                    'payment_recevied' => '',
                    'short_payment' => '',
                    'remarks' => '',
                    'created_on' => '',
                    'created_by' => '',
                    'action' => '',
                    'invoice_own_id' => '',
                    'po_details' => DB::table('po_details')->get(),
                ];
                return view('invoiceOwn', $data);
            } elseif ($action == trim('view')) {
                $db = DB::table('invoice_own')->where(['id' => $id])->get()[0];

                return view('invoiceOwn', viewOwnInvoice($db, $action));
            } elseif ($action == trim('edit')) {
                $db = DB::table('invoice_own')->where(['id' => $id])->get()[0];

                return view('invoiceOwn', viewOwnInvoice($db, $action));
            } elseif ($action == trim('report')) {
                if (session()->get('ADMIN_USER') == 'admin3') {
                    session()->flash('error', 'You Have Not Access');
                    return redirect('/admin');
                }
                $db['reportOwn'] = DB::table('vw_invoice_own')->get();
                return view('reportOwn', $db);
            } else {
                return ['error' => 'action not performed'];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function invoiceOwnSave(Request $request)
    {
        try {
            if (session()->get('ADMIN_USER') == 'admin3') {
                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }


            $validator = Validator::make($request->all(), [
                'po_id' => 'required',
                'invoice' => 'required',
                'payment_date' => 'required',
                'gran_accpt_qty' => 'required',
                'total_receive' => 'required|numeric',
                'payment_recevied' => 'required|numeric',
                'short_payment' => 'required|numeric',
                'remarks' => 'required',
                'created_on' => 'required',
                'created_by' => 'required',

            ]);

            $invoice_own_id = $request->input('invoice_own_id'); //for edit and view
            // return $request->all();
            function invoiceOwn($request)
            {
                $data = [
                    'po_id' => $request->input('po_id'),
                    'invoice' => $request->input('invoice'),
                    'payment_date' => $request->input('payment_date'),
                    'gran_accpt_qty' => $request->input('gran_accpt_qty'),
                    'total_receive' => $request->input('total_receive'),
                    'payment_recevied' => $request->input('payment_recevied'),
                    'short_payment' => $request->input('short_payment'),
                    'remarks' => $request->input('remarks'),
                    'created_on' => $request->input('created_on'),
                    'created_by' => $request->input('created_by'),
                ];
                return $data;
            }
            if ($invoice_own_id > 0) {
                if ($validator->fails()) {
                    return redirect('admin/invoice_own_' . urlencode('edit' . '_' . $invoice_own_id))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('invoice_own')->where(['id' => $invoice_own_id])->update(invoiceOwn($request));
                session()->flash('msg', 'Successfully Update InvoiceOwn');
                return redirect('admin/invoiceOwn_' . urlencode('report' . '_' . ''));
            } else {
                if ($validator->fails()) {
                    return redirect('admin/invoiceOwn_' . urlencode('' . '_' . ''))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('invoice_own')->insert(invoiceOwn($request));
                session()->flash('msg', 'Successfully Save InvoiceOwn');
                return  redirect('admin/invoiceOwn_' . urlencode('report' . '_' . ''));
            }
        } catch (\Throwable $th) {
            return $data = [
                'catch' => $th->getMessage(),
                'msg' => 'Server Error',
            ];
        }
    }
}
