<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Paymentmethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PaymentmethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('View Paymentmethod')) {
            $methods = Paymentmethod::select('id', 'method_name', 'created_at')->latest('id')->paginate(25);
            return view('backend.method.index', [
                'methods' => $methods,
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
        if (auth()->user()->can('Create Paymentmethod')) {

            return view("backend.method.create");
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
        if (auth()->user()->can('Create Paymentmethod')) {
            $request->validate([
                'method_name' => ['required', 'string', 'unique:paymentmethods,method_name']
                 
            ]);
            $method = new Paymentmethod;
            $method->method_name = strip_tags($request->method_name);
     
 
            $method->save();
            return redirect()->route('payment-method.index')->with('success', 'Paymentmethod Added Succesfully');
        } else {
            abort('404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paymentmethod  $paymentmethod
     * @return \Illuminate\Http\Response
     */
    public function show(Paymentmethod $paymentmethod)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paymentmethod  $paymentmethod
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can('Edit Paymentmethod')) {
            $method = Paymentmethod::findorfail($id);
            return view('backend.method.edit', [
                "method" => $method,
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paymentmethod  $paymentmethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('Edit Paymentmethod')) {
            $request->validate([
                'method_name' => ['required', 'string', 'unique:paymentmethods,method_name,'. $id],
             
            ]);
            $method =  Paymentmethod::findorfail($id);
            $method->method_name = $request->method_name;
          
 

            $method->save();
            return redirect()->route('payment-method.index')->with('warning', 'Paymentmethod Updated Succesfully');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paymentmethod  $paymentmethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paymentmethod $paymentmethod)
    {
        if (auth()->user()->can('Delete Paymentmethod')) {

           
            $method =  Paymentmethod::findorfail($id);
       
            $method->delete();
            return back()->with('delete', 'Paymentmethod Deleted Succesfully');
       
    } else {
        abort('404');
    }
    }


    public function MarkdeleteMethod(Request $request)
    {
        if (auth()->user()->can('Delete Paymentmethod')) {

            if ($request->filled('delete')) {
                foreach ($request->delete as  $value) {
    
                        // if theres no subcatagory under this catafory id

                        $method =  Paymentmethod::findorfail($value);
                     
                        $method->delete();
                    
                }
                return back()->with('delete', 'Paymentmethod Deleted Succesfully');
            } else {
                return back();
            }
        } else {
            abort('404');
        }
    }

}
