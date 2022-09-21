<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>{{ config('app.name') }}</title>
</head>

<body>


    {{-- <style>
        .accordion.accordion-circle .accordion-header .accordion-button::before {
            content: "";
            background: #fff;
            -webkit-box-shadow: 0 0.125rem 0.25rem rgba(29, 58, 83, 0.4);
            box-shadow: 0 0.125rem 0.25rem rgba(29, 58, 83, 0.4);
            width: 18px;
            height: 18px;
            border-radius: 100%;
            display: block;
            position: absolute;
            top: 47%;
            left: 14px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            z-index: 9;
        }

        .accordion.accordion-circle .accordion-header .accordion-button::after {
            content: "";
            background: #066ac9;
            width: 12px;
            height: 12px;
            border-radius: 100%;
            display: block;
            position: absolute;
            top: 47%;
            left: 17px;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            z-index: 9;
        }

        .accordion.accordion-circle .accordion-header .accordion-button[aria-expanded="false"]::after {
            visibility: hidden !important;
        }

        .accordion.accordion-circle .accordion-header .accordion-button[aria-expanded="true"]::after {
            visibility: visible;
        }

        .accordion.accordion-circle .accordion-header .accordion-button {
            background: transparent;
            color: #24292d;
            border: none;
            font-size: inherit;
            padding-left: 2.7rem;
            background-color: transparent !important;
        }
    </style> --}}


    <div class="container bg-white px-lg-5 my-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <form id="contactForm" method="POST" action="{{ route('coll.edit') }}">
                    <div class="card border-0 rounded-3 shadow-lg">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="h1 fw-light">Payment</div>
                            </div>
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Name"
                                    data-sb-validations="required" value="{{ auth()->user()->name }}" disabled />
                                <label for="name">Name</label>
                            </div>
                            <!-- Email Input -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                <label for="emailAddress">Email Address</label>
                            </div>

                            <!-- Message Input -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Message" name="note"
                                    style="height: 8rem;"></textarea>
                                <label for="message">Message</label>
                            </div>
                            <div class="form-group">
                                <label  for="depot_id">Depot</label>
                                <select title="Select Depot" class="form-control  @error('depot_id') is-invalid                                
                                @enderror" name="depot_id" id="depot_id">
                                    <option value=>Select One</option>
                                    @foreach ($depots as $depot)
                                    <option value="{{$depot->id}}">{{$depot->depot_name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('depot_id')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card shadow-lg">

                        <div class="accordion accordion-circle" id="accordioncircle">
                            <div style="margin-left: 20px" class="mt-4">
                                <h5>Payment Method:</h5>
                                <div class="form-group mb-2">
                                    <input class="form-check-input position-static" id="Cash" type="radio" name="Bank"
                                        value="1" data-bs-toggle="collapse" data-bs-target="#collapse-1"
                                        aria-expanded="false" aria-controls="collapse-1">
                                    <label for="Cash">Cash</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input class="form-check-input position-static" id="Bank" type="radio" name="Bank"
                                        value="2" data-bs-toggle="collapse" data-bs-target="#collapse-2"
                                        aria-expanded="false" aria-controls="collapse-2">
                                    <label for="Bank">Bank</label>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="radio" class="form-check-input position-static" name="Bank" value="3"
                                        id="MFS" data-bs-toggle="collapse" data-bs-target="#collapse-3"
                                        aria-expanded="false" aria-controls="collapse-3">
                                    <label for="MFS">MFS</label>
                                </div>
                            </div>
                            <!-- Credit or debit card START -->
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-2" class="accordion-collapse collapse " aria-labelledby="heading-1"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Card number -->

                                        <div class="col-12">
                                            <label for="bank" class="form-label">Choose Bank<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <select class="form-control" name="bank_name" id="bank">
                                                    <option value="">--- Select Bank Name ---</option>
                                                    @foreach ($Banks->where('method_id',3) as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>

                                                    @endforeach
                                                </select>
                                                @error('bank_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Deposite Slip No<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="number" name="slip_no" class="form-control"
                                                    placeholder="xxxx xxxx xxxx xxxx">
                                                @error('slip_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Expiration Date -->

                                        <!-- Card name -->
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Branch Name<span
                                                    class="text-danger">*</span></label>
                                            <input name="branch" type="text" spellcheck="true" class="form-control"
                                                placeholder="Enter name">
                                            @error('branch')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="numeric" placeholder="Amount" id="amount"
                                                    name="bank_amount" class="form-control">
                                                @error('bank_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <!-- Credit or debit card END -->

                            <!-- Net banking START -->
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-3" class="accordion-collapse collapse " aria-labelledby="heading-2"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Select bank -->
                                        <div class="col-12">
                                            <label for="bank" class="form-label">Choose Method<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <select class="form-control" name="mfs_name" id="bank">
                                                    <option value="">--- Select One ---</option>
                                                    @foreach ($Banks->where('method_id',5) as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>

                                                    @endforeach
                                                </select>
                                                @error('mfs_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="bank" class="form-label">Transaction id<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" placeholder="Transaction id" name="trasaction_id"
                                                    class="form-control">
                                                @error('trasaction_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="numeric" placeholder="Amount" id="amount" name="mfs_amount"
                                                    class="form-control">
                                                @error('mfs_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-1" class="accordion-collapse collapse " aria-labelledby="heading-2"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Select bank -->
                                        <div class="col-12">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" placeholder="Amount" id="amount" name="amount"
                                                    class="form-control">
                                                @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <!-- Net banking END -->
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- CDN Link to SB Forms Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script>
        @if (session('delete')) 
Command: toastr["error"]("{{session('delete')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('success')) 
Command: toastr["success"]("{{session('success')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('warning')) 
Command: toastr["warning"]("{{session('warning')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
    </script>
</body>

</html>














@extends('backend.master')
@section('Payment_active')
active
@endsection
@section('Payment_add-active')
active
@endsection
@section('Payment_dropdown_active')
menu-open
@endsection
@section('content')

@section('content')
{{-- <div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Collections</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container bg-white px-lg-5 my-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <form id="contactForm" method="POST" action="{{ route('coll.store') }}">
                    <div class="card border-0 rounded-3 shadow-lg">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="h1 fw-light">Payment</div>
                            </div>
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Name"
                                    data-sb-validations="required" value="{{ auth()->user()->name }}" disabled />
                                <label for="name">Name</label>
                            </div>
                            <!-- Email Input -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                                <label for="emailAddress">Email Address</label>
                            </div>

                            <!-- Message Input -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Message" name="note"
                                    style="height: 8rem;"></textarea>
                                <label for="message">Message</label>
                            </div>


                        </div>
                    </div>

                    <div class="card shadow-lg">

                        <div class="accordion accordion-circle" id="accordioncircle">
                            <div style="margin-left: 20px" class="mt-4">
                                <h5>Payment Method:</h5>
                                <div class="form-group mb-2">
                                    <input class="form-check-input position-static" id="Cash" type="radio" name="Bank"
                                        value="1" data-bs-toggle="collapse" data-bs-target="#collapse-1"
                                        aria-expanded="false" aria-controls="collapse-1">
                                    <label for="Cash">Cash</label>
                                </div>
                                <div class="form-group mb-2">
                                    <input class="form-check-input position-static" id="Bank" type="radio" name="Bank"
                                        value="2" data-bs-toggle="collapse" data-bs-target="#collapse-2"
                                        aria-expanded="false" aria-controls="collapse-2">
                                    <label for="Bank">Bank</label>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="radio" class="form-check-input position-static" name="Bank" value="3"
                                        id="MFS" data-bs-toggle="collapse" data-bs-target="#collapse-3"
                                        aria-expanded="false" aria-controls="collapse-3">
                                    <label for="MFS">MFS</label>
                                </div>
                            </div>
                            <!-- Credit or debit card START -->
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-2" class="accordion-collapse collapse " aria-labelledby="heading-1"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Card number -->

                                        <div class="col-12">
                                            <label for="bank" class="form-label">Choose Bank<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <select class="form-control" name="bank_name" id="bank">
                                                    <option value="">--- Select Bank Name ---</option>
                                                    @foreach ($Banks->where('method_id',3) as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>

                                                    @endforeach
                                                </select>
                                                @error('bank_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Deposite Slip No<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="number" name="slip_no" class="form-control"
                                                    placeholder="xxxx xxxx xxxx xxxx">
                                                @error('slip_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Expiration Date -->

                                        <!-- Card name -->
                                        <div class="col-12 mt-2">
                                            <label class="form-label">Branch Name<span
                                                    class="text-danger">*</span></label>
                                            <input name="branch" type="text" spellcheck="true" class="form-control"
                                                placeholder="Enter name">
                                            @error('branch')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="numeric" placeholder="Amount" id="amount"
                                                    name="bank_amount" class="form-control">
                                                @error('bank_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <!-- Credit or debit card END -->

                            <!-- Net banking START -->
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-3" class="accordion-collapse collapse " aria-labelledby="heading-2"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Select bank -->
                                        <div class="col-12">
                                            <label for="bank" class="form-label">Choose Method<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <select class="form-control" name="mfs_name" id="bank">
                                                    <option value="">--- Select One ---</option>
                                                    @foreach ($Banks->where('method_id',5) as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>

                                                    @endforeach
                                                </select>
                                                @error('mfs_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="bank" class="form-label">Transaction id<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" placeholder="Transaction id" name="trasaction_id"
                                                    class="form-control">
                                                @error('trasaction_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="numeric" placeholder="Amount" id="amount" name="mfs_amount"
                                                    class="form-control">
                                                @error('mfs_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3 border-0">
                                <div id="collapse-1" class="accordion-collapse collapse " aria-labelledby="heading-2"
                                    data-bs-parent="#accordioncircle">
                                    <!-- Accordion body -->
                                    <div class="accordion-body">
                                        <!-- Form START -->
                                        <!-- Select bank -->
                                        <div class="col-12">
                                            <label for="amount" class="form-label">Amount<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" placeholder="Amount" id="amount" name="amount"
                                                    class="form-control">
                                                @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Form END -->
                                    </div>
                                </div>
                            </div>
                            <!-- Net banking END -->
                        </div>
                    </div>
                    <div class="d-grid mt-5">
                        <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div> --}}
@endsection