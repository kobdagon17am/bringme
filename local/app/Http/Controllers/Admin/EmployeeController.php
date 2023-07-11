<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend/employee');
    }



    public function employee_add(Request $request){


        $rule = [
            // BEGIN ข้อมูลส่วนตัว
            'name' => 'required|max:50',
            'phone' => 'required|numeric',
            'id_card' => 'required|numeric|min:13',
            'email' => 'required|unique:users',
            'password' => 'required',

        ];

        $message = [
            // BEGIN ข้อมูลส่วนตัว
            'name.required' => 'กรุณากรอกข้อมูล',
            'phone.required' => 'กรุณากรอกข้อมูล',
            'phone.numeric' => 'เป็นตัวเลขเท่านั้น',
            'id_card.numeric' => 'เป็นตัวเลขเท่านั้น',
            'id_card.required' => 'กรุณากรอกข้อมูล',
            'id_card.min' => 'กรุณากรอกให้ครบ 13 หลัก',
            'email.required' => 'กรุณากรอกข้อมูล',
            'email.unique' => 'Email นี้ถูกใช้งานแล้ว',
            'password.required' => 'กรุณากรอกข้อมูล',


        ];

        $validator = Validator::make(
            $request->all(),
            $rule,
            $message
        );

        if (!$validator->fails()) {
            $user = [
            'name' =>  $request->name,
            'phone' => $request->phone,
            'id_card' => $request->id_card,
            'email' => $request->email,
            'password' =>  Hash::make($request['password']),

            ];

            try {
                DB::BeginTransaction();
                $users = DB::table('users')
                  ->insert($user);
                DB::commit();
                return redirect('admin/employee')->withSuccess('เพิ่มพนักงานสำเร็จ');
              } catch (Exception $e) {
                DB::rollback();
                return redirect('admin/employee')->withError('เพิ่มพนักงานไม่สำเร็จ กรุณาทำรายการไหม่');

              }




            }else{
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'กรุณากรอกข้อมูลให้ครบถ้วนก่อนลงทะเบียน');
            }
    }

    public function admin_datable(Request $request)
    {


        $customer = DB::table('users')
            // ->where('status','=','success')
            ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' = ''  THEN  date(created_at) = '{$request->s_date}' else 1 END"))
            ->whereRaw(("case WHEN '{$request->s_date}' != '' and '{$request->e_date}' != ''  THEN  date(created_at) >= '{$request->s_date}' and date(created_at) <= '{$request->e_date}'else 1 END"))
            ->whereRaw(("case WHEN '{$request->s_date}' = '' and '{$request->e_date}' != ''  THEN  date(created_at) = '{$request->e_date}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->user_name}' != ''  THEN  customer_user = '{$request->user_name}' else 1 END"));
        // ->whereRaw(("case WHEN  '{$request->position}' != ''  THEN  new_lavel = '{$request->position}' else 1 END"))
        // ->whereRaw(("case WHEN  '{$request->type}' != ''  THEN  type = '{$request->type}' else 1 END"));

        $sQuery = Datatables::of($customer);
        return $sQuery


            ->addColumn('img', function ($row) {
                $img = '<div class="flex">
                <div class="w-10 h-10 image-fit zoom-in">
                    <img alt="Midone - HTML Admin Template" class=" rounded-full"
                        src="' . asset('backend/dist/images/preview-9.jpg') . '">
                </div>
            </div>';

                return $img;
            })

            ->addColumn('name', function ($row) {
                $name_full = $row->name;
                return $name_full;
            })

            ->addColumn('position', function ($row) {
                $position = 'ผู้ดูแลระบบ 1';
                return $position;
            })



            ->addColumn('status', function ($row) {
                // if ($row->approve_store == 1) {
                //     $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>';
                // } elseif ($row->approve_store == 2) {

                //     $htmml =  '<div class="flex text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Not Active </div>';
                // } else {
                //     $htmml = '<div class="flex text-warring"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Paning </div>';;
                // }
                $htmml = '<div class="flex text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> กำลังใช้งาน </div>';
                return $htmml;
            })

            ->addColumn('action', function ($row) {
                $url = route('admin/stores-detail');
                $้html = '
                <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="employee-edit.php"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i>  แก้ไข </a>
                                <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>  ลบ </a>
                            </div>
                 ';
                return $้html;
            })


            ->rawColumns(['img','status', 'action'])
            ->make(true);
    }
}
