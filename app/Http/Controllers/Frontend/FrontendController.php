<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Payment;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function Frontendhome()
    {
        $banks = Bank::latest('id')->get();

        return view('frontend.main', [
            'Banks' => $banks,
        ]);
    }
    function FrontendhomeSUbmit(Request $request)
    {
        // return $request;
        $request->validate([
            'Bank' => ['required', 'numeric', 'min:1', 'max:3']
        ]);
        // return redirect()->route('Frontendhome')->with('success', 'Payment Successfull');

        $invoice_no = now()->format('dm') . auth()->id() . mt_rand(1, 100);

        if ($request->Bank == 1) {
            $request->validate([
                'amount' => ['required', 'numeric'],
            ]);

            $payemnt = new Payment;
            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'Cash';
            $payemnt->amount = $request->amount;
            $payemnt->note = $request->note;
            $payemnt->save();
            return redirect()->route('Frontendhome')->with('success', 'Payment Successfull');
        }
        if ($request->Bank == 3) {
            $request->validate([
                'mfs_amount' => ['required', 'numeric'],
                'mfs_name' => ['required', 'string'],
                'trasaction_id' => ['nullable', 'string'],
            ], [
                'mfs_name.required' => 'Please Choose One method',
                'mfs_amount.required' => 'Amount Required',
            ]);

            $detail = [
                'trasaction_id' => $request->trasaction_id,
                'bank_name' => $request->mfs_name,
            ];

            $payemnt = new Payment;
            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'MFS';
            $payemnt->amount = $request->mfs_amount;
            $payemnt->note = $request->note;
            $payemnt->details = json_encode($detail);
            $payemnt->save();
            return redirect()->route('Frontendhome')->with('success', 'Payment Successfull');
        }
        if ($request->Bank == 2) {
            $request->validate(
                [
                    'bank_amount' => ['required', 'numeric'],
                    'slip_no' => ['required', 'numeric'],
                    'bank_name' => ['required', 'string'],
                    'branch' => ['required', 'string'],
                ],
                [
                    'bank_name.required' => 'Please Choose Bank',
                    'bank_amount.required' => 'Amount Required',
                ]
            );


            $detail = [
                'slip_no' => $request->slip_no,
                'bank_name' => $request->bank_name,
                'branch' => $request->branch,
            ];

            $payemnt = new Payment;
            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'Bank';
            $payemnt->amount = $request->bank_amount;
            $payemnt->note = $request->note;
            $payemnt->details = json_encode($detail);
            $payemnt->save();
            return redirect()->route('Frontendhome')->with('success', 'Payment Successfull');
        }

        return redirect()->route('Frontendhome')->with('delete', 'Failed');
    }
}
