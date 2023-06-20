
<style>
    #applePay {
        width: 150px;
        height: 50px;
        display: none;
        border-radius: 5px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 20px;
        background-image: -webkit-named-image(apple-pay-logo-white);
        background-position: 50% 50%;
        background-color: black;
        background-size: 60%;
        background-repeat: no-repeat;
    }
</style>
<script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
<style>
    apple-pay-button {
      --apple-pay-button-width: 140px;
      --apple-pay-button-height: 30px;
      --apple-pay-button-border-radius: 5px;
      --apple-pay-button-padding: 5px 0px;
    }
    </style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->



<div class="container wrapper">
    <div class="row cart-head">
        <div class="container">
            <div class="row">
                <p></p>
            </div>

            <div class="row">
                <p></p>
            </div>
        </div>
    </div>
    <div class="row cart-body">
        <form class="form-horizontal" action="{{ route('applepayindex') }}" method="post" id="orderForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <input type="hidden" class="form-control" name="trackid" value="{{$out->id}}" />
            <input type="hidden" name="amount" class="form-control" value="{{$out->amount}}" />
            <input type="hidden" name="udf5" id="udf5" class="form-control" value="" />
            

            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Pay Order</div>
                    <div class="panel-body">
                        <!--apple pay start-->
                        <div>
                            <!--<apple-pay-button buttonstyle="black" type="buy" locale="ar-AB"></apple-pay-button>-->
                            <button type="button" id="applePay"></button>
                            <p style="display:block" id="info"></p>
                            <p style="display:none" id="got_notactive">ApplePay is possible on this browser, but not currently activated(or you do not have active cards).</p>
                            <p style="display:none" id="notgot">ApplePay is not available on this browser</p>
{{--                            <p style="display:none" id="success">Test transaction completed, thanks. <a href="<?=$_SERVER["SCRIPT_URL"]?>">reset</a></p>--}}
                        </div>
                        <script type="text/javascript">

                            var debug = true;

                            if (window.ApplePaySession) {

                                var merchantIdentifier = '{{$PRODUCTION_MERCHANTIDENTIFIER}}';
                                var promise = ApplePaySession.canMakePaymentsWithActiveCard(merchantIdentifier);
                                promise.then(function (canMakePayments) {
                                    if (canMakePayments) {
                                        document.getElementById("applePay").style.display = "block";
                                        logit('hi, I can do ApplePay');
                                    } else {
                                        document.getElementById("applePay").style.display = "block";
                                        // document.getElementById("got_notactive").style.display = "block";
                                        logit('ApplePay is possible on this browser, but not currently activated.');
                                    }
                                });
                            } else {
                                logit('ApplePay is not available on this browser');
                                document.getElementById("notgot").style.display = "block";
                            }

                            document.getElementById("applePay").onclick = function(evt) {
                                
                                var runningAmount 	= {{$out->amount}};
                                var runningPP		= 0;
                                var runningTotal	= function() { return runningAmount + runningPP; }
                                var shippingOption = "";

                                var subTotalDescr	= "Alreem Application";
                                //,{label: 'Expedited Shipping', amount: getShippingCosts('domestic_exp', false), detail: '1-3 days', identifier: 'domestic_exp'}
                                function getShippingOptions(shippingCountry){
                                    logit('getShippingOptions: ' + shippingCountry );
                                    //if( shippingCountry.toUpperCase() == "<?//=PRODUCTION_COUNTRYCODE?>//" ) {
                                    shippingOption = [{label: 'Standard Shipping', amount: getShippingCosts('domestic_std', true), detail: '3-5 days', identifier: 'domestic_std'}];
                                    // } else {
                                    // 	shippingOption = [{label: 'International Shipping', amount: getShippingCosts('international', true), detail: '5-10 days', identifier: 'international'}];
                                    // }

                                }
                                //
                                //function getShippingCosts(shippingIdentifier, updateRunningPP ){
                                //
                                //var shippingCost = 0;
                                //
                                //	 switch(shippingIdentifier) {
                                //case 'domestic_std':
                                //	shippingCost = 30;
                                //	break;
                                //case 'domestic_exp':
                                //	shippingCost = 0;
                                //	break;
                                //case 'international':
                                //	shippingCost = 0;
                                //	break;
                                //default:
                                //	shippingCost = 0;
                                //	}
                                //
                                //if (updateRunningPP == true) {
                                //	runningPP = shippingCost;
                                //}
                                //
                                //logit('getShippingCosts: ' + shippingIdentifier + " - " + shippingCost +"|"+ runningPP );
                                //
                                //return shippingCost;
                                //
                                //}

                                var paymentRequest = {
                                    currencyCode: '{{$PRODUCTION_CURRENCYCODE}}',
                                    countryCode: '{{$PRODUCTION_COUNTRYCODE}}',
                                    // requiredShippingContactFields: ['email'],
                                    //requiredShippingContactFields: ['postalAddress','email', 'name', 'phone'],
                                    //requiredBillingContactFields: ['postalAddress','email', 'name', 'phone'],, {label: 'P&P', amount: runningPP }
                                    lineItems: [{label: subTotalDescr, amount: runningAmount }],
                                    total: {
                                        label: '{{$PRODUCTION_DISPLAYNAME}}',
                                        amount: runningTotal()
                                    },
                                    supportedNetworks: ['amex', 'masterCard', 'visa','mada' ],
                                    merchantCapabilities: [ 'supports3DS', 'supportsEMV',
                                        'supportsCredit',
                                        'supportsDebit']
                                    //merchantCapabilities: [ 'supports3DS', 'supportsEMV', 'supportsCredit', 'supportsDebit' ]
                                };

                                var session = new ApplePaySession(6, paymentRequest);

                                // Merchant Validation
                                session.onvalidatemerchant = function (event) {
                                    document.getElementById("info").innerHTML  = "onvalidatemerchant";
                                    logit(event);
                                    var promise = performValidation(event.validationURL);
                                    promise.then(function (merchantSession) {
                                        document.getElementById("info").innerHTML  = "Session get"+JSON.stringify(merchantSession);
                                        session.completeMerchantValidation(merchantSession);
                                        document.getElementById("info").innerHTML  = "Session"+JSON.stringify(merchantSession);
                                    });
                                }
                                
                                


                                function performValidation(valURL) {
                                    document.getElementById("info").innerHTML  = "performValidation";
                                    return new Promise(function(resolve, reject) {

                                        // $.ajax({
                                        //     url: 'https://alreemboutique.com/api/validateMarchent?u=' + valURL,
                                        //     type: "GET",
                                        //     headers: {
                                        //         'Access-Control-Allow-Origin':'*',
                                        //     },
                                        //     // data: options,
                                        //     // dataType : 'json',
                                        //     contentType: "application/json; charset=utf-8",
                                        //     success: function(data) {
                                        //         console.log("response of perform validation : "+JSON.stringify(data));
                                        //         //console.log("response of perform validation1 : "+data);
                                        //         //alert("Success"+data);
                                        //         // data = JSON.parse(data);
                                        //         document.getElementById("info").innerHTML  = "performValidationDone";
                                        //         document.getElementById("info").innerHTML  = data + valURL;
                                        //         console.log("object before resolve"+JSON.parse(data));
                                        //         var obj = JSON.parse(data);
                                        //         console.log("object before resolve"+obj);
                                        //
                                        //         resolve(obj);
                                        //
                                        //         //alert("Success"+data);
                                        //     },
                                        //     error: function(data) {
                                        //         document.getElementById("info").innerHTML  = data + valURL;
                                        //         console.log('failed');
                                        //         resolve("failed");
                                        //     }
                                        // });

                                        var xhr = new XMLHttpRequest();
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState == XMLHttpRequest.DONE) {
                                                document.getElementById("info").innerHTML  = "done:"+xhr.responseText;
                                                logit(this.responseText);
                                                str = this.responseText;

                                                str = str.replace(/1\s*$/, "");
                                                logit(str);
                                                var data = JSON.parse(str);

                                                logit(data);
                                                resolve(data);
                                            }
                                        }
                                        xhr.onload = function() {
                                            //var data = JSON.parse(this.responseText);
                                            //logit(data);
                                            document.getElementById("info").innerHTML  = this.responseText + valURL;

                                            document.getElementById("info").innerHTML  = this.responseText + valURL;
                                        };
                                        
                                        xhr.onerror = reject;
                                        xhr.open('GET', '/api/validateMarchent?u=' + valURL);
                                        xhr.send();

                                    });
                                }

                                session.onshippingcontactselected = function(event) {
                                    logit('starting session.onshippingcontactselected');
                                    logit('NB: At this stage, apple only reveals the Country, Locality and 4 characters of the PostCode to protect the privacy of what is only a *prospective* customer at this point. This is enough for you to determine shipping costs, but not the full address of the customer.');
                                    logit(event);

                                    getShippingOptions( event.shippingContact.countryCode );

                                    var status = ApplePaySession.STATUS_SUCCESS;
                                    var newShippingMethods = shippingOption;
                                    var newTotal = { type: 'final', label: '{{$PRODUCTION_DISPLAYNAME}}', amount: runningTotal() };
                                    var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];

                                    session.completeShippingContactSelection(status, newShippingMethods, newTotal, newLineItems );


                                }

                                session.onshippingmethodselected = function(event) {
                                    logit('starting session.onshippingmethodselected');
                                    logit(event);

                                    getShippingCosts( event.shippingMethod.identifier, true );

                                    var status = ApplePaySession.STATUS_SUCCESS;
                                    var newTotal = { type: 'final', label: '{{$PRODUCTION_DISPLAYNAME}}', amount: runningTotal() };
                                    var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];

                                    session.completeShippingMethodSelection(status, newTotal, newLineItems );


                                }

                                session.onpaymentmethodselected = function(event) {
                                    document.getElementById("info").innerHTML  = "onpaymentmethodselected";
                                    logit('starting session.onpaymentmethodselected');
                                    logit(event);

                                    var newTotal = { type: 'final', label: '{{$PRODUCTION_DISPLAYNAME}}', amount: runningTotal() };
                                    var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];

                                    session.completePaymentMethodSelection( newTotal, newLineItems );


                                }
                                

                                session.onpaymentauthorized = function (event) {
                                    document.getElementById("info").innerHTML  = "onpaymentauthorized";
                                    logit('starting session.onpaymentauthorized');
                                    logit('NB: This is the first stage when you get the *full shipping address* of the customer, in the event.payment.shippingContact object');
                                    logit(event);

                                    var promise = sendPaymentToken(event.payment.token);
                                    promise.then(function (success) {
                                        var status;
                                        if (success){
                                            status = ApplePaySession.STATUS_SUCCESS;
                                            document.getElementById("applePay").style.display = "none";
                                            // document.getElementById("success").style.display = "block";
                                        } else {
                                            status = ApplePaySession.STATUS_FAILURE;
                                        }

                                        logit( "result of sendPaymentToken() function =  " + success );
                                        session.completePayment(status);
                                    });
                                }
                                

                                function sendPaymentToken(paymentToken) {
                                    document.getElementById("info").innerHTML  = "sendPaymentToken";
                                    return new Promise(function(resolve, reject) {




                                        //payment request call
                                        //var countryshr=document.getElementById("country").value;
                                        {{--var data = {--}}
                                        {{--    udf5: paymentToken,--}}
                                        {{--    _token:"{{csrf_token()}}"--}}
                                        {{--};--}}


                                        {{--const jsonString = JSON.stringify(data);--}}
//alert(jsonString);
//                                         const xhr = new XMLHttpRequest();
//
//                                         xhr.onload = function(){
//                                             const serverResponse = document.getElementById("serverResponse");
//                                             serverResponse.innerHTML = this.responseText;
//
//                                         };
//
//                                         xhr.open("POST","https://alreemboutique.com/api/index");
//                                         xhr.setRequestHeader("content-type", "application/json");
//                                         xhr.send(jsonString);

                                        var paytoken = JSON.stringify(paymentToken);
                                        document.getElementById("udf5").value=paytoken;

                                        document.getElementById("orderForm").submit();

                                        logit('starting function sendPaymentToken()');
                                        logit(paymentToken);

                                        logit("this is where you would pass the payment token to your third-party payment provider to use the token to charge the card. Only if your provider tells you the payment was successful should you return a resolve(true) here. Otherwise reject;");
                                        logit("defaulting to resolve(true) here, just to show what a successfully completed transaction flow looks like");

                                        if ( debug == true )
                                            resolve(true);
                                        else
                                            reject;
                                    });
                                }

                                session.oncancel = function(event) {
                                    logit('starting session.cancel');
                                    logit(event);
                                }

                                session.begin();
                            };

                            function logit( data ){

                                if( debug == true ){
                                    console.log(data);
                                }

                            };
                        </script>





                        <!--apple pay end-->
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="row cart-footer">

    </div>
</div>
