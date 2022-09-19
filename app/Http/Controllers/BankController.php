<?php

namespace App\Http\Controllers;

use App\Models\Paymentmethod;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Bank')) {

            $banks = Bank::with('Paymentmethod')
                ->select('id', 'method_id', 'bank_name', 'created_at')
                ->latest('id')->simplepaginate(100);
            return view('backend.subcatagory.index', [
                'banks' => $banks,
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('Create Bank')) {

            $methods = Paymentmethod::select('id', 'method_name')->get();

            return view('backend.bank.create', [
                'methods' => $methods,

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
    {
        if (auth()->user()->can('Create Bank')) {
            $request->validate([
                'bank_name' => ['required', 'unique:banks,bank_name'],
                'method_id' => ['required']
            ]);
            $bank = new Bank;
            $bank->method_id = $request->method_id;
            $bank->bank_name = strip_tags($request->bank_name);

            $bank->save();
            return redirect()->route('bank.index')->with('success', 'Bank Created Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Bank')) {

            $bank = Bank::select('id', 'bank_name', 'method_id')->findorfail($id);
            $methods = Paymentmethod::select('id', 'method_name')->get();

            return view(
                'backend.bank.edit',
                [
                    'methods' => $methods,
                    'bank' => $bank,
                ]
            );
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Edit Bank')) {

            $request->validate([
                'bank_name' => ['required', 'unique:banks,bank_name,' . $id],
                'method_id' => ['required']
            ]);
            $bank = Bank::findorfail($id);
            $bank->method_id = $request->method_id;
            $bank->bank_name = strip_tags($request->bank_name);

            $bank->save();
            return redirect()->route('bank.index')->with('success', 'Bank Edited Successfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->can('Delete Bank')) {
            Bank::findorfail($id)->delete();
            return back()->with('delete', 'Deleted Successfully');
        } else {
            abort('404');
        }
    }

    public function MarkdeleteBank(Request $request)
    {
        if (auth()->user()->can('Delete Bank')) {
            if ($request->filled('delete')) {
                foreach ($request->delete as $value) {

                    Bank::findorfail($value)->delete();
                }
                return back()->with('delete', 'Bank Deleted Successfully');
            } else {
                return back()->with('warning', 'No Item Selected');
            }
        } else {
            abort('404');
        }
    }
}
