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

class PoController extends Controller

{

    public function PoDetails($url)
    {
        try {

            $action = trim(urldecode($url));


            if ($action == trim('details')) {
                $data = [
                    'customer_id' => '',
                    'seller_id' => '',
                    'customer' => DB::table('customer')->get(),
                    'seller' => DB::table('seller')->get(),
                    'po_number' => '',
                    'po_number' => '',
                    'total_qty' => '',
                    'po_rate' => '',
                    'gemc_number' => '',
                    'amount' => '',
                    'cgst_perc' => '',
                    'sgst_perc' => '',
                    'net_amount' => '',
                    'date' => '',
                    'action' => '',
                    'poDetails_id' => '',
                ];
                return view('poDetails', $data);
            } elseif ($action == trim('list')) {

                $data = [
                    'podetails' => DB::table('vw_po_details')->get(),
                ];
                return view('polist', $data);
            } else {


                return ['error' => 'page not found'];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function actionOnPo($url)
    {
        try {
            $param = explode('_', urldecode($url));
            $action = $param[0];
            $id = $param[1];

            function poDetailsData($id, $action)
            {
                $db = DB::table('po_details')->where(['id' => $id])->get()[0];
                return  [
                    'poDetails_id' => $db->id,
                    'customer_id' => $db->customer_id,
                    'seller_id' => $db->seller_id,
                    'po_number' => $db->po_number,
                    'po_number' => $db->po_number,
                    'total_qty' => $db->total_qty,
                    'po_rate' => $db->po_rate,
                    'gemc_number' => $db->gemc_number,
                    'amount' => $db->amount,
                    'cgst_perc' => $db->cgst_perc,
                    'sgst_perc' => $db->sgst_perc,
                    'net_amount' => $db->net_amount,
                    'date' => $db->date,
                    'action' => $action,
                    'customer' => DB::table('customer')->get(),
                    'seller' => DB::table('seller')->get(),
                ];
            }
            if ($action == trim('view')) {

                return view('poDetails', poDetailsData($id, $action));
            } elseif ($action == trim('edit')) {

                return view('poDetails', poDetailsData($id, $action));
            } else {
                return ['error' => 'page not found )'];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function PoDetailsSave(Request $request)
    {
        try {
            if ($request->input('postData') == trim('postData')) {
                $id = $request->input('po_details_id');
                $db = [
                    'vw_po_details' => DB::table('vw_po_details')->where(['id' => $id])->get()[0],
                    'invoice_principle' => DB::table('invoice_principle')->where(['po_id' => $id])->get(),
                ];
                return $db;
            }

            $poDetails_id =  $request->input('poDetails_id');
            $action = $request->input('action');
            // return $request->all();
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required',
                // 'seller_id'=>'required',
                'po_number' => 'required|unique:po_details,po_number,' . $poDetails_id . 'id',
                // 'po_number' => ['required', Rule::unique('po_details','po_number')->ignore($poDetails_id)],
                'gemc_number' => 'required',
                'total_qty' => 'required|numeric',
                'po_rate' => 'required|numeric',
                'amount' => 'required|numeric',
                'cgst' => 'required|numeric',
                'sgst' => 'required|numeric',
                'net_amount' => 'required|numeric',
                'date' => 'required',

            ]);


            $data = [
                'customer_id' => $request->input('customer_id'),
                'seller_id' => $request->input('seller_id'),
                'po_number' => $request->input('po_number'),
                'gemc_number' => $request->input('gemc_number'),
                'total_qty' => $request->input('total_qty'),
                'po_rate' => $request->input('po_rate'),
                'amount' => $request->input('amount'),
                'cgst_perc' => $request->input('cgst'),
                'sgst_perc' => $request->input('sgst'),
                'net_amount' => $request->input('net_amount'),
                'date' => $request->input('date'),
            ];
            if ($poDetails_id > 0) {
                if ($validator->fails()) {
                    return redirect('admin/po_details' . '/' . urlencode($action . '_' . $poDetails_id))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('po_details')->where(['id' => $poDetails_id])->update($data);
                session()->flash('msg', 'Successfully update PoDetails');
                return redirect('admin/po_list');
            }
            if ($validator->fails()) {
                return redirect('admin/po_details')
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::table('po_details')->insert($data);
            session()->flash('msg', 'Successfully Save PoDetails');
            return redirect('admin/po_list');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

 


}
