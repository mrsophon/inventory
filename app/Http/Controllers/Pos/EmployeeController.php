<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Emptype;
use Auth;
use Illuminate\Support\Carbon;
use Image;

class EmployeeController extends Controller
{
    public function EmployeeAll(){

        $employees = Employee::latest()->get();
        return view('backend.employee.employee_all',compact('employees'));

    } // End Method


    public function EmployeeAdd(){
        $emptype = Emptype::all();
        return view('backend.employee.employee_add',compact('emptype'));
    }    // End Method


    public function EmployeeStore(Request $request){

        if ($request->file('employee_image')) {

            $folderPath = 'upload/employee';
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $image = $request->file('employee_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
            // Image::make($image)->resize(200,200)->save($folderPath.'/'.$name_gen);
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($folderPath.'/'.$name_gen);
            $save_url = $folderPath.'/'.$name_gen;

            Employee::insert([
                'name' => $request->name,
                'emptype_id' => $request->emptype_id,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'employee_image' => $save_url ,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Employee Inserted with Image Successfully',
                'alert-type' => 'success'
            );

        } else {

            Employee::insert([
                'name' => $request->name,
                'emptype_id' => $request->emptype_id,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'employee_image' => $request->employee_image,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Employee Inserted without Image Successfully',
                'alert-type' => 'success'
            );

        } // end else

        return redirect()->route('employee.all')->with($notification);

    } // End Method


    public function EmployeeEdit($id){

        $emptype = Emptype::all();
        $employee = Employee::findOrFail($id);
        return view('backend.employee.employee_edit',compact('employee','emptype'));

    } // End Method


    public function EmployeeUpdate(Request $request){

        $employee_id = $request->id;
        if ($request->file('employee_image')) {

            $folderPath = 'upload/employee';
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $image = $request->file('employee_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
            // Image::make($image)->resize(200,200)->save($folderPath.'/'.$name_gen);
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($folderPath.'/'.$name_gen);
            $save_url = $folderPath.'/'.$name_gen;

            $employees = Employee::findOrFail($employee_id);
            $img = $employees->employee_image;
            if (file_exists($img)) {
                unlink($img);
            }

            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'emptype_id' => $request->emptype_id,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'employee_image' => $save_url,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Employee Updated with Image Successfully',
                'alert-type' => 'success'
            );

        } else {

            $employees = Employee::findOrFail($employee_id);
            $img = $employees->employee_image;
            if (file_exists($img)) {
                unlink($img);
            }

            Employee::findOrFail($employee_id)->update([
                'name' => $request->name,
                'emptype_id' => $request->emptype_id,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'employee_image' => $request->employee_image,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Employee Updated without Image Successfully',
                'alert-type' => 'success'
            );

        } // end else

        return redirect()->route('employee.all')->with($notification);

    } // End Method


    public function EmployeeDelete($id){

        $employees = Employee::findOrFail($id);
        $img = $employees->employee_image;
        if (file_exists($img)) {
            unlink($img);
        }

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    public function CreditEmployee(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.employee.employee_credit',compact('allData'));

    } // End Method


    public function CreditEmployeePrintPdf(){

        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.employee_credit_pdf',compact('allData'));

    } // End Method


    public function EmployeeEditInvoice($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.employee.edit_employee_invoice',compact('payment'));

    }// End Method


    public function EmployeeUpdateInvoice(Request $request,$invoice_id){

        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
                'message' => 'Sorry You Paid Maximum Value',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

            $notification = array(
                'message' => 'Invoice Update Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('credit.employee')->with($notification);

        }

    }// End Method


    public function EmployeeInvoiceDetails($invoice_id){

        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.pdf.invoice_details_pdf',compact('payment'));

    }// End Method


    public function PaidEmployee(){
        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.employee.employee_paid',compact('allData'));
    }// End Method


    public function PaidEmployeePrintPdf(){

        $allData = Payment::where('paid_status','!=','full_due')->get();
        return view('backend.pdf.employee_paid_pdf',compact('allData'));
    }// End Method


    public function EmployeeWiseReport(){

        $employees = Employee::all();
        return view('backend.employee.employee_wise_report',compact('employees'));

    }// End Method


    public function EmployeeWiseCreditReport(Request $request){

        $allData = Payment::where('employee_id',$request->employee_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('backend.pdf.employee_wise_credit_pdf',compact('allData'));
    }// End Method


    public function EmployeeWisePaidReport(Request $request){

        $allData = Payment::where('employee_id',$request->employee_id)->where('paid_status','!=','full_due')->get();
        return view('backend.pdf.employee_wise_paid_pdf',compact('allData'));
    }// End Method

}