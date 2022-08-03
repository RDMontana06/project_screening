<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\BoCompany;
use App\Payment;
use App\PaymentAttachment;
use Alert;
use Validator;

class BuyoutController extends Controller
{
    public function index()
    {
        $projects = Project::with('attachment', 'contact', 'bo_companies')->where('status', 'Buyout')->get();
        return view('buyout.index', ['projects' => $projects]);
    }
    public function view(Request $request, $id){
        // dd($id);
        $buyouts = BoCompany::with('user', 'payments' )->where('project_id', $id)->orderBy('id', 'desc')->get();
        // dd($buyouts);
        return view('buyout.view', ['buyouts' => $buyouts]);
    }
    public function updateBuyout(Request $request){

        $this->validate($request, [
            'company_name' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'total_amt' => 'required',
            // 'attachment' => 'required|mimes:jpeg,jpg,bmp,png,pdf',
        ]);

        $company = new BoCompany();
        $company->project_id = $request->project_id;
        $company->company_name = $request->company_name;
        $company->contact_person = $request->contact_person;
        $company->contact_number = $request->contact_number;
        $company->total_amt = $request->total_amt;

        // Save Attachment
        if($request->file('attachment')){
            $attachment = $request->file('attachment');
            $original_name = $attachment->getClientOriginalName();
            $name = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path() . '/buyout-attachments/', $name);
            $file_name = '/buyout-attachments/' . $name;
            $company->attachment = $file_name;
        }
        $company->save();
        Alert::success('Buyout Details', 'Successfully Updated')->persistent('Dismiss');
        return back();
        
    }
    public function savePayment(Request $request, $p_id, $b_id){
        //  dd($request);
        $this->validate($request, [
            'amount' => 'required',
            'attachment' => 'required',
        ]);

        $bo = BoCompany::findOrFail($b_id);
        $payments = Payment::where('bo_company_id', $b_id)->sum('amount');
        // dd($payments);
        if($request->amount > $bo->total_amt ){
            Alert::error('Amount is greater than total amount!')->persistent('Dismiss');
            return back();
        }
        // if(($request->amount + $payments) >= $bo->total_amt ){
        //     Alert::error('Amount is greater than or equal total amount!')->persistent('Dismiss');
        //     return back();
        // }

        $payment = new Payment;
        $payment->project_id = $p_id;
        $payment->amount = $request->amount;
        $payment->bo_company_id = $b_id;
        $payment->status = 'Paid';
        $payment->save();

        $files = $request->file('attachment');
        if ($request->hasFile('attachment')) {

            foreach ($files as $file) {
                $path = $file->getClientOriginalName();
                $name = time() . '-' . $path;

                $attachment = new PaymentAttachment();
                $file->move(public_path() . '/payment-files/', $name);
                $file_name = '/payment-files/' . $name;
                $attachment->attachment = $file_name;
                $attachment->payment_id = $payment->id;
                $attachment->save();
            }
        }
        

        
        Alert::success('Payment Success')->persistent('Dismiss');
        return back();
        

    }
}