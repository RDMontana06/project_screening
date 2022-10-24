<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\BoCompany;
use App\Payment;
use App\User;
use App\PaymentAttachment;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class BuyoutController extends Controller
{
    public function index()
    {
        $user = User::with('user_roles.roles')->where('id', auth()->user()->id)->first();
        $projects = Project::with('attachment', 'contact', 'bo_companies')->whereIn('status', ['Buyout', 'For Payment'])->orderBy('id', 'desc')->get();
        return view('buyout.index', ['projects' => $projects, 'user' => $user]);
    }
    public function view(Request $request, $id)
    {
        // dd($id);
        $buyouts = BoCompany::with('user', 'payments', 'project')->where('project_id', $id)->orderBy('id', 'desc')->get();
        // dd($buyouts);
        $user = User::with('user_roles.roles')->where('id', auth()->user()->id)->first();
        return view('buyout.view', ['buyouts' => $buyouts, 'user' => $user]);
    }
    public function updateBuyout(Request $request)
    {

        $this->validate($request, [
            'company_name' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            // 'total_amt' => 'required',
            // 'attachment' => 'required|mimes:jpeg,jpg,bmp,png,pdf',
        ]);

        $company = new BoCompany();
        $company->project_id = $request->project_id;
        $company->company_name = $request->company_name;
        $company->contact_person = $request->contact_person;
        $company->contact_number = $request->contact_number;
        $company->total_amt = $request->total_amt;
        $company->balance = 0.00;

        // Save Attachment
        if ($request->file('attachment')) {
            $attachment = $request->file('attachment');
            $original_name = $attachment->getClientOriginalName();
            $name = time() . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path() . '/buyout-attachments/', $name);
            $file_name = '/buyout-attachments/' . $name;
            $company->attachment = $file_name;
        }
        $company->save();

        Project::Where('id', $company->project_id)->update(
            [
                'status' => 'For Payment'
            ]
        );
        Alert::success('Buyout Details', 'Successfully Updated')->persistent('Dismiss');
        return back();
    }
    public function savePayment(Request $request, $p_id, $b_id)
    {

        $this->validate($request, [
            'amount' => 'required',
            'attachment' => 'required',
            // 'total_amt' => 'required',
        ]);
        // dd($request->all());
        // $request->amount =  number_format($request->amount, 2);
        // dd($request->amount, $request->total_amt);
        $bo = BoCompany::findOrFail($b_id);
        $status = "";
        $varAmt = $request->amount;
        $varAmt = floatval($varAmt);

        $varTotAmt = $request->total_amt;
        $varTotAmt = floatval($varTotAmt);
        // dd($request->total_amt);
        if ($request->amount > $request->total_amt) {
            Alert::error('Amount is greater than total amount!')->persistent('Dismiss');
            return back();
        }
        if ($request->amount < $request->total_amt) {
            Alert::error('Amount cannot be less than total amount!')->persistent('Dismiss');
            return back();
        }

        $bo->total_amt = $request->total_amt;
        $bo->balance = $bo->total_amt - $request->amount;
        // dd($bo->balance);
        if ($bo->balance == 0) {
            $status = 'Fully Paid';
            // Update project Status
            $pr = Project::findOrFail($p_id);
            $pr->status = 'Buyout Fully Paid';
            $pr->update();
        } else {
            $status = 'Partial';
        }
        $bo->status = $status;
        $bo->update();

        $payment = new Payment;
        $payment->project_id = $p_id;
        $payment->amount = $request->amount;
        $payment->bo_company_id = $b_id;
        $payment->status = $status;
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
    public function buyoutPayment()
    {
        $buyoutPayment = Project::with('attachment', 'contact', 'bo_companies.payments')->whereIn('status', ['Buyout Fully Paid', 'For Payment'])->orderBy('id', 'desc')->get();
        // dd($buyoutPayment);
        $user = User::with('user_roles.roles')->where('id', auth()->user()->id)->first();
        return view('buyoutPayment.index', ['buyoutPayment' => $buyoutPayment, 'user' => $user]);
    }
    public function updatePayment(Request $request, $idx)
    {
        $this->validate($request, [
            'amount_edit' => 'required',
        ]);
        // dd($request, $idx);
        $boComp = BoCompany::findOrFail($idx);
        // dd($boComp);
        $boPay = Payment::where('bo_company_id', $idx)->first();
        // dd($boPay);


        if ($request->amount_edit > $boComp->total_amt) {
            Alert::warning('Invalid Amount', 'Amount cannot be greater than Total Amount')->persistent('Dismiss');
            return back();
        }
        //Update Amount
        $boPay->amount = $request->amount_edit;
        $boComp->balance = $boComp->total_amt - $boPay->amount;
        if ($boComp->balance == 0) {
            $boPay->status = "Fully Paid";
        }
        $boPay->save();
        // dd($boComp->balance);
        if ($boComp->balance == 0) {
            $boComp->status = "Fully Paid";
            $boComp->balance = $boComp->balance;
            $boComp->save();
        }
        Alert::success('Payment amount was updated')->persistent('Dismiss');
        return back();
    }
}
