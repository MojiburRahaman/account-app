<?php

namespace App\Http\Controllers;

use App\Models\Coll;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\Collection;
use App\Models\Depot;
use phpDocumentor\Reflection\Types\Null_;

// use App\Http\Controllers\Controller;
class CollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sub_catagories = Subcatagory::
        // ->select('id', 'catagory_id', 'subcatagory_name', 'created_at')
        // ->latest('id')->simplepaginate(15);

        /* $order =  Depot::whereHas('Payment',function($q){
                $q->whereBetween('created_at',['2022-09-20 00:00:00', '2022-09-21 23:59:59']);
                $q->groupBy('depot_id');
            })->get();
        return view('backend.order.index', [
            'orders' => $order,
        ]);*/
        $order = Payment::with('Depot')->select(\DB::raw('DATE(created_at) as date'))
            /*->whereBetween('created_at',[date('Y-m-d',strtotime($fromdate)).' 00:00:00', $todate.' 23:59:59'])*/
            ->whereBetween('created_at', ['2022-09-20 00:00:00', '2022-09-21 23:59:59'])
            ->orderBy('date')->groupBy('date')->get();

        return view('backend.coll.index', [
            'orders' => $order,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Create Depot')) {

            $banks = Bank::latest('id')->get();
            $depots = Depot::select('id', 'code', 'depot_name')->get();
            return view('backend.order.create', [
                'Banks' => $banks,
                'depots' => $depots,
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { {
            // return $request;
            $request->validate([
                'Bank' => ['required', 'numeric', 'min:1', 'max:3'],
                'note' => ['required'],
                'depot_id' => ['required'],
            ]);

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
                $payemnt->depot_id = $request->depot_id;
                $payemnt->save();
                return redirect()->route('coll.create')->with('success', 'Payment Successfull');
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
                $payemnt->depot_id = $request->depot_id;

                $payemnt->details = json_encode($detail);
                $payemnt->save();
                return redirect()->route('coll.create')->with('success', 'Payment Successfull');
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
                $payemnt->depot_id = $request->depot_id;

                $payemnt->details = json_encode($detail);
                $payemnt->save();
                return redirect()->route('coll.create')->with('success', 'Payment Successfull');
            }

            return redirect()->route('coll.create')->with('delete', 'Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coll  $coll
     * @return \Illuminate\Http\Response
     */
    public function show(Coll $coll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coll  $coll
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findorfail($id);
        $banks = Bank::latest('id')->get();
        $depot = Depot::select('id', 'code', 'depot_name')->get();
        return view('backend.order.edit', [
            'banks' => $banks,
            'depot' => $depot,
            'payment' => $payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coll  $coll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payemnt = Payment::findorfail($id);
        $request->validate([
            'Bank' => ['required', 'numeric', 'min:1', 'max:3'],
            'note' => ['required'],
            'depot_id' => ['required'],
        ]);

        $invoice_no = now()->format('dm') . auth()->id() . mt_rand(1, 100);

        if ($request->Bank == 1) {
            $request->validate([
                'amount' => ['required', 'numeric'],
            ]);

            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'Cash';
            $payemnt->amount = $request->amount;
            $payemnt->note = $request->note;
            $payemnt->depot_id = $request->depot_id;
            $payemnt->details = Null;
            $payemnt->save();
            return back()->with('success', 'Payment Edited Successfull');
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

            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'MFS';
            $payemnt->amount = $request->mfs_amount;
            $payemnt->note = $request->note;
            $payemnt->depot_id = $request->depot_id;

            $payemnt->details = json_encode($detail);
            $payemnt->save();
            return back()->with('success', 'Payment Edited Successfull');
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

            $payemnt->user_id = auth()->id();
            $payemnt->invoice_no = $invoice_no;
            $payemnt->method = 'Bank';
            $payemnt->amount = $request->bank_amount;
            $payemnt->note = $request->note;
            $payemnt->depot_id = $request->depot_id;

            $payemnt->details = json_encode($detail);
            $payemnt->save();
            return back()->with('success', 'Payment Edited Successfull');
        }
        return back()->with('delete', 'Failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coll  $coll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coll $coll)
    {
        //
    }
}
