<?php

namespace App\Http\Controllers;

use App\Mail\OrderDeliverdMail;
use App\Models\Order_Summaries;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Payment::latest('id')->get();
        return view('backend.order.index', [
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Payment::findorfail($id);
        // $order=Order_Summaries::findorfail($id);

        return view('backend.order.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function InvoiceDownload($id)
    {
        // return 'ok';
        $Order_Summaries = Order_Summaries::findorfail($id);
        $pdf = PDF::loadView('backend.download.invoice', [
            'order' => $Order_Summaries,
        ])->setPaper('a4', 'protrait');
        return $pdf->stream('invoice.pdf');
    }
    public function DeliveryStatus($id)
    {
        $status =   Order_Summaries::findorfail($id);
        $user = $status->User;
        $email = $status->User->email;
        if ($status->delivery_status == 1) {
            $status->delivery_status = 2;
            $status->save();
            return back();
        } elseif ($status->delivery_status == 2) {

            $status->delivery_status = 3;
            $status->save();
            Mail::to($email)->send(new OrderDeliverdMail($user->name, $status));
            return back();
        } elseif ($status->delivery_status == 3) {
            return back();
        }
    }
}
