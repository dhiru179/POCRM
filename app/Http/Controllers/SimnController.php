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

class SimnController extends Controller

{
    public function Login()
    {

        return view('login');
    }
    public function LoginAuth(Request $request)
    {

        try {
            $user = $request->input('user');
            $password = $request->input('password');
            // return Hash::make('admin@3');
            $result = DB::table('users')->where(['user_name' => $user])->first();

            if ($result) {
                if (Hash::check($request->input('password'), $result->password)) {
                    $request->session()->put('ADMIN_LOGIN', true);
                    $request->session()->put('ADMIN_ID', $result->id);
                    $request->session()->put('ADMIN_USER', $result->user_name);
                    return redirect('/admin');
                } else {
                    $request->session()->flash('error', 'Please enter correct password');
                    return redirect('/');
                }
            } else {
                $request->session()->flash('error', 'Please enter valid login details');
                return redirect('/');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function dashBoard()
    {

        return view('dashboard');
    }


    public function actionOnCustomer($url)
    {

        try {

            if (session()->get('ADMIN_USER') == 'admin3') {

                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }

            $param = explode('_', urldecode($url));
            $action = $param[0];
            $id = $param[1];
            if ($id > 0) {
                // edit,view,delete action perform
                $data = [
                    'customer' => DB::table('customer')->where(['id' => $id])->get()[0],
                    'action' => $action,
                ];
                if ($action == trim('view')) {
                    return view('addcoustomer', $data);
                } elseif ($action == trim('edit')) {
                    return view('addcoustomer', $data);
                }
                // elseif ($action == trim('delete')) { 
                //     // implement in future
                //     return 'delete';
                // }
                else {
                    return ['error' => 'Action Not Perform'];
                }
            } else {
                function blankCustomerDetails()
                {
                    $customer = new stdClass();
                    $customer->customer_name = '';
                    $customer->email = '';
                    $customer->phone = '';
                    $customer->address = '';
                    $customer->id = '';
                    return $customer;
                }
                if ($action == trim('add')) {
                    $data = [
                        'customer' => blankCustomerDetails(),
                        'action' => '',
                    ];
                    return view('addcoustomer', $data);
                } elseif ($action == trim('list')) {
                    $data['customer'] = DB::table('customer')->get();
                    return view('customerlist', $data);
                } else {
                    return ['error' => 'Action Not Perform' . $action];
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function coustomerSave(Request $request)
    {
        try {
            if ($request->session()->get('ADMIN_USER') == 'admin3') {
                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }

            $customer_id  = $request->input('customer_id');
            $validator = Validator::make($request->all(), [
                'name' => 'required',

            ]);
            $get_data = [
                'customer_name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];
            $data = array_filter($get_data, function ($a) {
                return isset($a);
            });
            if ($customer_id > 0) {
                if ($validator->fails()) {
                    return redirect('admin/customer_' . urlencode('edit' . '_' . $customer_id))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('customer')->where(['id' => $customer_id])->update($data);
                session()->flash('msg', 'Customer update Success');
                return redirect('admin/customer_' . urlencode('list' . '_' . ''));
            }
            if ($validator->fails()) {
                return redirect('admin/customer_' . urlencode('add' . '_' . ''))
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::table('customer')->insert($data);
            session()->flash('msg', 'Customer add Success');
            return redirect('/admin/customer_' . urlencode('list' . '_' . ''));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function actionOnSeller($url)
    {
        try {

            if (session()->get('ADMIN_USER') == 'admin3') {

                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }

            $param = explode('_', urldecode($url));
            $action = $param[0];
            $id = $param[1];
            if ($id > 0) {
                // edit,view,delete action perform
                $data = [
                    'seller' => DB::table('seller')->where(['id' => $id])->get()[0],
                    'action' => $action,
                ];


                if ($action == trim('view')) {
                    return view('addseller', $data);
                } elseif ($action == trim('edit')) {
                    return view('addseller', $data);
                }
                // elseif ($action == trim('delete')) {
                //     //future work
                //     return 'delete';
                // } 
                else {
                    return ['error' => 'Action Not Perform'];
                }
            } else {
                function blankSellerDetails()
                {
                    $seller = new stdClass();
                    $seller->seller_name = '';
                    $seller->email = '';
                    $seller->phone = '';
                    $seller->address = '';
                    $seller->id = '';
                    return $seller;
                }
                if ($action == trim('add')) {
                    $data = [
                        'seller' => blankSellerDetails(),
                        'action' => $action,
                    ];
                    return view('addseller', $data);
                } elseif ($action == trim('list')) {
                    $data['seller'] = DB::table('seller')->get();
                    return view('sellerlist', $data);
                } else {
                    return ['error' => 'Action Not Perform'];
                }
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function sellerSave(Request $request)
    {
        try {
            if ($request->session()->get('ADMIN_USER') == 'admin3') {
                session()->flash('error', 'You Have Not Access');
                return redirect('/admin');
            }

            $customer_id  = $request->input('customer_id');
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            $get_data = [
                'seller_name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ];
            $data = array_filter($get_data,function($a){
                return isset($a);
            });
            if ($customer_id > 0) {
                if ($validator->fails()) {
                    return redirect('admin/seller_' . urlencode('edit' . '_' . $customer_id))
                        ->withErrors($validator)
                        ->withInput();
                }
                DB::table('seller')->where(['id' => $customer_id])->update($data);
                session()->flash('msg', 'Seller update Success');
                return redirect('admin/seller_' . urlencode('list' . '_' . ''));
            }
            if ($validator->fails()) {
                return redirect('admin/seller_' . urlencode('add' . '_' . ''))
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::table('seller')->insert($data);
            session()->flash('msg', 'Seller add Success');
            return redirect('/admin/seller_' . urlencode('list' . '_' . ''));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
