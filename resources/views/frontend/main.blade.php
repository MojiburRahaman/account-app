<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <title>{{ config('app.name') }}</title>
</head>

<body>


    <style>
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
    </style>


    <div class="container bg-white px-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="card border-0 rounded-3 shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="h1 fw-light">Contact Form</div>
                        </div>

                        <!-- * * * * * * * * * * * * * *
                // * * SB Forms Contact Form * *
                // * * * * * * * * * * * * * * *
      
     
                -->

                        <form id="contactForm">

                            <!-- Name Input -->
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
                                <textarea class="form-control" id="message" type="text" placeholder="Message"
                                    style="height: 8rem;" ></textarea>
                                <label for="message">Message</label>
                            </div>

                            <!-- Submit success message -->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    <p>To activate this form, sign up at</p>
                                    <a
                                        href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>

                            <!-- Submit error message -->
                            <div class="d-none" id="submitErrorMessage">
                                <div class="text-center text-danger mb-3">Error sending message!</div>
                            </div>

                            <!-- Submit button -->

                        </form>
                        <!-- End of contact form -->

                    </div>
                </div>
                {{--
            </div>
            <div class="col-lg-8 col-12"> --}}

                <div class="card">

                    <div class="accordion accordion-circle" id="accordioncircle">
                        <!-- Credit or debit card START -->
                        <div class="accordion-item mb-3">
                            <h6 class="accordion-header font-base" id="heading-1">
                                <button class="accordion-button bg-white rounded collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false"
                                    aria-controls="collapse-1">
                                    Credit or Debit Card
                                </button>
                            </h6>
                            <div id="collapse-1" class="accordion-collapse collapse " aria-labelledby="heading-1"
                                data-bs-parent="#accordioncircle">
                                <!-- Accordion body -->
                                <div class="accordion-body">
                                    <!-- Form START -->
                                    <form class="row text-start g-3">
                                        <!-- Card number -->
                                        <div class="col-12">
                                            <label class="form-label">Card Number <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control"
                                                    placeholder="xxxx xxxx xxxx xxxx">
                                                <img src="assets/images/client/visa.svg"
                                                    class="w-40px position-absolute top-50 end-0 translate-middle-y me-2 d-none d-sm-block"
                                                    alt="">
                                            </div>
                                        </div>
                                        <!-- Expiration Date -->
                                        <div class="col-md-6">
                                            <label class="form-label">Expiration date <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" maxlength="2"
                                                    placeholder="Month">
                                                <input type="text" class="form-control" maxlength="4"
                                                    placeholder="Year">
                                            </div>
                                        </div>
                                        <!--Cvv code  -->
                                        <div class="col-md-6">
                                            <label class="form-label">CVV / CVC <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" maxlength="3" placeholder="xxx">
                                        </div>
                                        <!-- Card name -->
                                        <div class="col-12">
                                            <label class="form-label">Name on Card <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" aria-label="name of card holder"
                                                placeholder="Enter name">
                                        </div>
                                    </form>
                                    <!-- Form END -->
                                </div>
                            </div>
                        </div>
                        <!-- Credit or debit card END -->

                        <!-- Net banking START -->
                        <div class="accordion-item mb-3">
                            <h6 class="accordion-header font-base" id="heading-2">
                                <button class="accordion-button collapsed bg-white rounded" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false"
                                    aria-controls="collapse-2">
                                    Pay with Net Banking
                                </button>
                            </h6>
                            <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2"
                                data-bs-parent="#accordioncircle">
                                <!-- Accordion body -->
                                <div class="accordion-body">
                                    <!-- Form START -->
                                    <form class="row text-start g-3">
                                        <p class="mb-1">In order to complete your transaction, we will transfer you over
                                            to
                                            Eduport secure servers.</p>
                                        <p class="my-0">Select your bank from the drop-down list and click proceed to
                                            continue
                                            with your payment.</p>
                                        <!-- Select bank -->
                                        <div class="col-md-6">
                                            <div class="choices" data-type="select-one" tabindex="0" role="combobox"
                                                aria-autocomplete="list" aria-haspopup="true" aria-expanded="false">
                                                <div class="choices__inner"><select
                                                        class="form-select form-select-sm js-choice border-0 choices__input"
                                                        aria-label=".form-select-sm" tabindex="-1" data-choice="active"
                                                        hidden="">
                                                        <option value="" data-custom-properties="[object Object]">Please
                                                            choose
                                                            one</option>
                                                    </select>
                                                    <div class="choices__list choices__list--single">
                                                        <div class="choices__item choices__placeholder choices__item--selectable"
                                                            data-item="" data-id="1" data-value=""
                                                            data-custom-properties="[object Object]"
                                                            aria-selected="true">Please
                                                            choose one</div>
                                                    </div>
                                                </div>
                                                <div class="choices__list choices__list--dropdown"
                                                    aria-expanded="false"><input type="text"
                                                        class="choices__input choices__input--cloned" autocomplete="off"
                                                        spellcheck="false" role="textbox" aria-autocomplete="list"
                                                        aria-label="Please choose one" placeholder="">
                                                    <div class="choices__list" role="listbox">
                                                        <div id="choices--pr92-item-choice-4"
                                                            class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted"
                                                            role="option" data-choice="" data-id="4" data-value=""
                                                            data-select-text="Press to select" data-choice-selectable=""
                                                            aria-selected="true">Please choose one</div>
                                                        <div id="choices--pr92-item-choice-1"
                                                            class="choices__item choices__item--choice choices__item--selectable"
                                                            role="option" data-choice="" data-id="1"
                                                            data-value="Bank of America"
                                                            data-select-text="Press to select"
                                                            data-choice-selectable="">Bank of America</div>
                                                        <div id="choices--pr92-item-choice-2"
                                                            class="choices__item choices__item--choice choices__item--selectable"
                                                            role="option" data-choice="" data-id="2"
                                                            data-value="Bank of India"
                                                            data-select-text="Press to select"
                                                            data-choice-selectable="">Bank of
                                                            India</div>
                                                        <div id="choices--pr92-item-choice-3"
                                                            class="choices__item choices__item--choice choices__item--selectable"
                                                            role="option" data-choice="" data-id="3"
                                                            data-value="Bank of London"
                                                            data-select-text="Press to select"
                                                            data-choice-selectable="">Bank of
                                                            London</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Form END -->
                                </div>
                            </div>
                        </div>
                        <!-- Net banking END -->
                    </div>

                </div>
                <div class="d-grid mt-5">
                    <button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button>
                </div>
            </div>
        </div>

    </div>

    <!-- CDN Link to SB Forms Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>