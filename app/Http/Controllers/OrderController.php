<?php

namespace App\Http\Controllers;

use App\Mail\OrderDeliverdMail;
use App\Models\Order_Summaries;
use App\Models\Payment;
use App\Models\Depot;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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

        //    $order = Payment::with('Depot')->latest('id')->get();


        $order = DB::table('payments')
            ->join('depots', 'payments.depot_id', '=', 'depots.id')
            ->select('payments.*', 'depots.depot_name')

            // ->where('created_at', '>=', $fromDate)
            // ->where('created_at', '<=', $toDate)
            ->get();
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

    public function indetails()
    {




        // return     Depot::withSum(
        //     ['payment' => function($query) {
        //         $query->whereBetween('created_at',['2022-09-20 10:16:05','2022-09-20 10:16:38']);
        //     }],
        //     'amount'
        // )->get();



        $order = DB::table('payments')
            ->join('depots', 'payments.depot_id', '=', 'depots.id')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->select('payments.*', 'depots.depot_name', 'users.name')
            // ->where('created_at', '>=', $fromDate)
            // ->where('created_at', '<=', $toDate)
            ->get();
        return view('backend.order.indetails', [
            'orders' => $order,
        ]);
        // $order = Payment::with('Depot')->latest('id')->get();
        // return view('backend.order.indetails', ['orders' => $order,]);



    }


    public function searchdetails(Request $request)
    {

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');


        // total sum qury by date range 

        // $report = Depot::withSum(
        //     ['payment' => function ($query) use ($fromDate, $toDate) {
        //         $query->whereDate('created_at', ['2022-09-20', '2022-09-20']);
        //     }],
        //     'amount'
        // )->get();

        $order = DB::table('payments')
            ->join('depots', 'payments.depot_id', '=', 'depots.id')
            ->select('payments.*', 'depots.depot_name')
            ->whereBetween('payments.created_at', [date('Y-m-d', strtotime($fromDate)) . ' 00:00:00', $toDate . ' 23:59:59'])
            // ->where('created_at', '>=', $fromDate)
            // ->where('created_at', '<=', $toDate)
            ->get();
        //  DD($order);
        return view('backend.order.index', ['orders' => $order,]);
    }

    public function searching(Request $Request)
    {

        $fromDate = $Request->input('fromDate');
        $toDate = $Request->input('toDate');
        $order = DB::table('payments')
            ->join('depots', 'payments.depot_id', '=', 'depots.id')
            ->join('users', 'payments.user_id', '=', 'users.id')
            ->select('payments.*', 'depots.depot_name', 'users.name')
            ->whereBetween('payments.created_at', [date('Y-m-d', strtotime($fromDate)) . ' 00:00:00', $toDate . ' 23:59:59'])
            // ->where('created_at', '>=', $fromDate)
            // ->where('created_at', '<=', $toDate)
            ->get();
        //  DD($order);
        return view('backend.order.indetails', ['orders' => $order,]);
    }
}
