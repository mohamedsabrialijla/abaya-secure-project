

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
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


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
        <form class="form-horizontal" method="post" id="orderForm" action="{{route('apple.action',$order->id)}}">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <div class="panel panel-info">
                    <div class="panel-heading">الطلب</div>
                    <div class="panel-body">





                        <div class="form-group">
                            <div class="col-md-6 col-xs-12">
                                <strong>المجموع</strong>
                                <input type="text" name="amount" class="form-control" value="{{$order->total}}" disabled/>
                            </div>
                            <div class="span1"></div>

                        </div>


                        <!--End Tokenization -->
                        <!--apple pay token-->
                        <div class="form-group" style="display:none">
                            <div class="col-md-6 col-xs-12">
                                <strong>UDF5 Apple Pay Token:</strong>
                                <input type="text" name="udf5" id="udf5" class="form-control" value="" />
                            </div>
                            <div class="span1"></div>

                        </div>
                        <!-- end apple pay token-->

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                            </div>
                        </div>
                        <!--apple pay start-->
                        <div>
                            <button type="button" id="applePay"></button>
                            <p style="display:none" id="got_notactive">ApplePay is possible on this browser, but not currently activated.</p>
                            <p style="display:none" id="notgot">ApplePay is not available on this browser</p>
                            <p style="display:none" id="success">Test transaction completed, thanks. <a href="<?=$_SERVER["SCRIPT_URL"]?>">reset</a></p>
                        </div>
                        <script type="text/javascript">

                            var debug = <?=DEBUG?>;

                            if (window.ApplePaySession) {
                                var merchantIdentifier = '{{$PRODUCTION_MERCHANTIDENTIFIER}}';
                                var promise = ApplePaySession.canMakePaymentsWithActiveCard(merchantIdentifier);
                                promise.then(function (canMakePayments) {
                                    if (canMakePayments) {
                                        document.getElementById("applePay").style.display = "block";
                                        logit('hi, I can do ApplePay');
                                    } else {
                                        document.getElementById("got_notactive").style.display = "block";
                                        logit('ApplePay is possible on this browser, but not currently activated.');
                                    }
                                });
                            } else {
                                logit('ApplePay is not available on this browser');
                                document.getElementById("notgot").style.display = "block";
                            }

                            document.getElementById("applePay").onclick = function(evt) {

                                var runningAmount 	= 1;
                                var runningPP		= 0; getShippingCosts('domestic_std', true);
                                var runningTotal	= function() { return runningAmount + runningPP; }
                                var shippingOption = "";

                                var subTotalDescr	= "Test Goodies";

                                function getShippingOptions(shippingCountry){
                                    logit('getShippingOptions: ' + shippingCountry );
                                    if( shippingCountry.toUpperCase() == "{{$PRODUCTION_COUNTRYCODE}}" ) {
                                        shippingOption = [{label: 'Standard Shipping', amount: getShippingCosts('domestic_std', true), detail: '3-5 days', identifier: 'domestic_std'},{label: 'Expedited Shipping', amount: getShippingCosts('domestic_exp', false), detail: '1-3 days', identifier: 'domestic_exp'}];
                                    } else {
                                        shippingOption = [{label: 'International Shipping', amount: getShippingCosts('international', true), detail: '5-10 days', identifier: 'international'}];
                                    }

                                }

                                function getShippingCosts(shippingIdentifier, updateRunningPP ){

                                    var shippingCost = 0;

                                    switch(shippingIdentifier) {
                                        case 'domestic_std':
                                            shippingCost = 0;
                                            break;
                                        case 'domestic_exp':
                                            shippingCost = 0;
                                            break;
                                        case 'international':
                                            shippingCost = 0;
                                            break;
                                        default:
                                            shippingCost = 0;
                                    }

                                    if (updateRunningPP == true) {
                                        runningPP = shippingCost;
                                    }

                                    logit('getShippingCosts: ' + shippingIdentifier + " - " + shippingCost +"|"+ runningPP );

                                    return shippingCost;

                                }

                                var paymentRequest = {
                                    currencyCode: '{{$PRODUCTION_CURRENCYCODE}}',
                                    countryCode: '{{$PRODUCTION_COUNTRYCODE}}',
                                    requiredShippingContactFields: ['postalAddress'],
                                    //requiredShippingContactFields: ['postalAddress','email', 'name', 'phone'],
                                    //requiredBillingContactFields: ['postalAddress','email', 'name', 'phone'],
                                    lineItems: [{label: subTotalDescr, amount: runningAmount }, {label: 'P&P', amount: runningPP }],
                                    total: {
                                        label: '{{$PRODUCTION_DISPLAYNAME}}',
                                        amount: runningTotal()
                                    },
                                    supportedNetworks: ['amex', 'masterCard', 'visa','mada' ],
                                    merchantCapabilities: [ 'supports3DS']
                                    //merchantCapabilities: [ 'supports3DS', 'supportsEMV', 'supportsCredit', 'supportsDebit' ]
                                };

                                var session = new ApplePaySession(1, paymentRequest);

                                // Merchant Validation
                                session.onvalidatemerchant = function (event) {
                                    logit(event);
                                    var promise = performValidation(event.validationURL);
                                    promise.then(function (merchantSession) {
                                        session.completeMerchantValidation(merchantSession);
                                    });
                                }


                                function performValidation(valURL) {
                                    return new Promise(function(resolve, reject) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.onload = function() {
                                            var data = JSON.parse(this.responseText);
                                            logit(data);
                                            resolve(data);
                                        };
                                        xhr.onerror = reject;
                                        xhr.open('GET', 'apple_pay_comm.php?u=' + valURL);
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
                                    logit('starting session.onpaymentmethodselected');
                                    logit(event);

                                    var newTotal = { type: 'final', label: '{{$PRODUCTION_DISPLAYNAME}}', amount: runningTotal() };
                                    var newLineItems =[{type: 'final',label: subTotalDescr, amount: runningAmount }, {type: 'final',label: 'P&P', amount: runningPP }];

                                    session.completePaymentMethodSelection( newTotal, newLineItems );


                                }

                                session.onpaymentauthorized = function (event) {

                                    logit('starting session.onpaymentauthorized');
                                    logit('NB: This is the first stage when you get the *full shipping address* of the customer, in the event.payment.shippingContact object');
                                    logit(event);

                                    var promise = sendPaymentToken(event.payment.token);
                                    promise.then(function (success) {
                                        var status;
                                        if (success){
                                            status = ApplePaySession.STATUS_SUCCESS;
                                            document.getElementById("applePay").style.display = "none";
                                            document.getElementById("success").style.display = "block";
                                        } else {
                                            status = ApplePaySession.STATUS_FAILURE;
                                        }

                                        logit( "result of sendPaymentToken() function =  " + success );
                                        session.completePayment(status);
                                    });
                                }

                                function sendPaymentToken(paymentToken) {
                                    return new Promise(function(resolve, reject) {




                                        //payment request call
                                        //var countryshr=document.getElementById("country").value;
                                        var data = {
                                            udf5: paymentToken
                                        };


                                        const jsonString = JSON.stringify(data);
//alert(jsonString);
                                        const xhr = new XMLHttpRequest();

                                        xhr.onload = function(){
                                            const serverResponse = document.getElementById("serverResponse");
                                            serverResponse.innerHTML = this.responseText;

                                        };

                                        xhr.open("POST","payment.php");
                                        xhr.setRequestHeader("content-type", "application/json");
                                        xhr.send(jsonString);

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
//alert("shradha-session start");
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

</div>
