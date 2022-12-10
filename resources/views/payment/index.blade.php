@extends('layouts.layout1')
@section('content')
    <!-- Secondary menu
                  ============================================= -->
     <div class="bg-primary  z-index-0">
        <div class="container d-flex justify-content-center">
            <ul class="nav nav-pills alternate nav-lg border-bottom-0 nav nav-pills nav-lg" id="pillsmyTab" role="tablist">
                @if($banks[1]->status =="ACTIVE")
                <li class="nav-item"> <a class="nav-link fw-600 " id="calbanks" href="#calbank" role="tab"
                        data-bs-toggle="tab" aria-controls="calbank" aria-selected="true">CALBANK</a></li>
                       @endif
                        @if($banks[2]->status =="ACTIVE")
                        <li class="nav-item"> <a class="nav-link fw-600" id="ubas" href="#uba" role="tab" data-bs-toggle="tab"
                        aria-controls="uba" aria-selected="true">UBA</a></li> 
                        @endif
                        @if($banks[0]->status =="ACTIVE")
                        <li class="nav-item"> <a class="nav-link fw-600 " id="zeniths" href="#zenith" role="tab" data-bs-toggle="tab"
                        aria-controls="zenith" aria-selected="true">ZENITH BANK</a></li>
                        
                        @endif
@if($banks[3]->status =="ACTIVE")

    <li class="nav-item"> <a class="nav-link " id="gcbs" href="#gcb" role="tab" data-bs-toggle="tab"
        aria-controls="gcb" aria-selected="true">GCB</a></li>

@endif
            </ul>
        </div>
    </div>  

<div class="container my-1">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
        @foreach ($errors->all() as $error)
        <div class="card py-2 px-3">
            <p class="text-danger  fw-600">{{ $error }}</p>
        </div>
                                     
                                    @endforeach
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
     </div>
     </div>
    
</div>

    <div class="tab-content my-3" id="pillsmyTabContent">
        @if($banks[1]->status =="ACTIVE")
        <div class="tab-pane fade " id="calbank" role="tabpanel" aria-labelledby="calbanks">
            <!-- Content
                  ============================================= -->
            <div id="content" class="py-4">
                <div class="container">



                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
                            <div class="bg-white shadow-sm rounded  p-4">
                                <h3 class="text-5 fw-600 mb-3 mb-sm-4 text-center">CALBANK</h3>
                                <hr>
                                <h3 class="text-center text-3 fw-400 mb-3 mb-sm-4">Customer Details</h3>
                                <hr class="">
                                 
                                <form id="form-send-money" method="post" action="{{ route('payments.pay') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="payerName" class="form-label">Full Name</label>
                                        <input required type="text" name="name" value="" class="form-control"
                                            data-bv-field="payerName" id="payerName" required=""
                                            placeholder="Enter Name">
                                    </div>


                                    @can('Access All')
                                        <div class="mb-3">
                                            <label for="inputCountry" class="form-label">Showrooms</label>
                                            <select class="form-select" id="inputCountry" name="showroom">
                                                @foreach ($showrooms as $s)
                                                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    @endcan
                                    <div class="mb-3">
                                        <label for="emailID" class="form-label">Phone</label>
                                        <input type="text" required name="phone" value="" class="form-control"
                                            data-bv-field="emailid" id="emailID" required=""
                                            placeholder="Enter Phone Number">
                                    </div>




                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">GHC</span>
                                            <input step="any" min="0" required name="amount" type="number"
                                                class="form-control" data-bv-field="amount" id="amount"
                                                placeholder="00.00">

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Order Number</label>
                                        <div class="input-group">

                                            <input required name="order_code" type="text" class="form-control"
                                                data-bv-field="amount" id="2amount">

                                        </div>
                                    </div>


                                    <div class="d-grid mt-4"><button type="submit"
                                            class="btn btn-primary">Continue</button></div>
                                </form>
                                <!-- Request Money Form end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content end -->
        </div>
        @endif
        @if($banks[2]->status =="ACTIVE")
        <div class="tab-pane fade show " id="uba" role="tabpanel" aria-labelledby="ubas">
            <!-- Content
                  ============================================= -->
            <div id="content" class="py-4">
                <div class="container">



                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
                            <div class="bg-white shadow-sm rounded p-4 mb-4">
                                <h3 class="text-5 fw-600 mb-3 mb-sm-4 text-center">UBA</h3>
                                <hr>
                                <h3 class="text-center text-3 fw-400 mb-3 mb-sm-4">Customer Details</h3>

                                <!-- Request Money Form
                            ============================================= -->
                                <form id="form-send-money" method="post" action="{{ route('transactions.uba.pay') }}">

                                    @csrf
                                    <div class="mb-3">
                                        <label for="payerName" class="form-label">Full Name</label>
                                        <input type="text" value="" class="form-control"
                                            data-bv-field="payerName" id="payerName" required="" name="name"
                                            placeholder="Enter Full Name">
                                    </div>


                                    <div class="mb-3">
                                        <label for="emailID" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="" class="form-control"
                                            data-bv-field="emailid" id="emailID" required=""
                                            placeholder="Enter Phone Number">
                                    </div>


                                    @can('Access All')
                                        <div class="mb-3">
                                            <label for="inputCountry" class="form-label">Showrooms</label>
                                            <select class="form-select" id="inputCountry" name="showroom">
                                                @foreach ($showrooms as $s)
                                                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    @endcan


                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">GHC</span>
                                            <input type="text" name="amount" class="form-control"
                                                data-bv-field="amount" id="amount" placeholder="00.00">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Order Number</label>
                                        <div class="input-group">

                                            <input required name="order_code" type="text" class="form-control"
                                                data-bv-field="amount" id="2amount">

                                        </div>
                                    </div>
                                    <div class="d-grid mt-4"><button class="btn btn-primary">Continue</button></div>
                                </form>
                                <!-- Request Money Form end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content end -->
        </div>
        @endif
        @if($banks[0]->status =="ACTIVE")
        <div class="tab-pane fade show active" id="zenith" role="tabpanel" aria-labelledby="zeniths">

            <div id="content" class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
                            <div class="bg-white shadow-sm rounded  p-4 mb-4">
                                <h3 class="text-5 fw-400 mb-3 mb-sm-4 text-center">ZENITH BANK </h3>
                                <hr>
                                <h3 class="text-center text-3 fw-400 mb-3 mb-sm-4">Customer Details</h3>
                                <hr class="">
                                <!-- Request Money Form
                            ============================================= -->
                                
                                <form id="form-send-money_" action="{{route('payments.zenith')}}" method="POST">
                                    @csrf
                                   
                                    <div class="mb-3">
                                        <label for="payerName" class="form-label">Full Name</label>
                                        <input type="text" value="" class="form-control"
                                            data-bv-field="payerName" id="payerName" required="" name="name"
                                            placeholder="Enter Full Name">
                                    </div>


                                    <div class="mb-3">
                                        <label for="emailID" class="form-label">Phone</label>
                                        <input type="text" value="" class="form-control"
                                            data-bv-field="emailid" id="emailID" required=""
                                            placeholder="Enter Phone Number" name="phone">
                                    </div>


                                    @can('Access All')
                                        <div class="mb-3">
                                            <label for="inputCountry" class="form-label">Showrooms</label>
                                            <select class="form-select" id="inputCountry" name="showroom">
                                                @foreach ($showrooms as $s)
                                                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    @endcan


                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">GHC</span>
                                            <input type="text" name="amount" class="form-control"
                                                data-bv-field="amount" id="amount" placeholder="00.00">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Order Number</label>
                                        <div class="input-group">

                                            <input required name="order_code" type="text" class="form-control"
                                                data-bv-field="amount" id="2amount">

                                        </div>
                                    </div>
                                    <div class="d-grid mt-4"><button class="btn btn-primary">Continue</button></div>
                               
                                </form>
                                <!-- Request Money Form end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content end -->
        </div>
@endif
@if($banks[3]->status =="ACTIVE")
        {{-- gcb --}}
        <div class="tab-pane fade" id="gcb" role="tabpanel" aria-labelledby="gcbs">
            <!-- Content
                  ============================================= -->
            <div id="content" class="py-4">
                <div class="container">



                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-5 mx-auto">
                            <div class="bg-white shadow-sm rounded  p-4 mb-4">
                                <h3 class="text-5 fw-400 mb-3 mb-sm-4 text-center">GCB</h3>
                                <hr>
                                <h3 class="text-center text-3 fw-400 mb-3 mb-sm-4">Customer Details</h3>

                                <!-- Request Money Form
                            ============================================= -->
                                <form id="form-send-money" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="payerName" class="form-label">Full Name</label>
                                        <input type="text" value="" class="form-control"
                                            data-bv-field="payerName" id="payerName" required="" name="name"
                                            placeholder="Enter Full Name">
                                    </div>


                                    <div class="mb-3">
                                        <label for="emailID" class="form-label">Phone</label>
                                        <input type="text" value="" class="form-control"
                                            data-bv-field="emailid" id="emailID" required=""
                                            placeholder="Enter Phone Number">
                                    </div>


                                    @can('Access All')
                                        <div class="mb-3">
                                            <label for="inputCountry" class="form-label">Showrooms</label>
                                            <select class="form-select" id="inputCountry" name="showroom">
                                                @foreach ($showrooms as $s)
                                                    <option value="{{ $s->name }}">{{ $s->name }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    @endcan


                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">GHC</span>
                                            <input type="text" name="amount" class="form-control"
                                                data-bv-field="amount" id="amount" placeholder="00.00">

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Order Number</label>
                                        <div class="input-group">

                                            <input required name="order_code" type="text" class="form-control"
                                                data-bv-field="amount" id="2amount">

                                        </div>
                                    </div>
                                    <div class="d-grid mt-4"><button class="btn btn-primary">Continue</button></div>
                               
                                </form>
                                <!-- Request Money Form end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Content end -->
        </div>




    </div>
    <!-- Secondary menu end -->
@endsection
@section('script')
    <script type="text/javascript">
        $('#zsubmit').on('click', function(qs) {

            qs.preventDefault()
            let name = $('#zname').val()
            let amunt = $('#zamount').val()
            let phone = $('#zphone').val()
            let order_no = $('#zorder').val()
            postpayment(amunt)



        })




        function postpayment(amount) {

            data = {
                userName: 'testuser',
                passWord: 'testuser',
                recordId: '103',
                accountNumber: '1010101111',
                amount: amount,
                extraData: [{
                        FieldName: 'field1',
                        FieldValue: 'value1'
                    },
                    {
                        fieldName: 'field2',
                        fieldValue: 'value2'
                    },
                    {
                        fieldName: 'field3',
                        fieldValue: 'value3'
                    }
                ]
            };

            var requestData = JSON.stringify(data);
            $.ajax({
                type: 'POST',
                contentType: "application/json;charset=utf-8",
                url: 'https://realtime.zenithbank.com.gh/realtimenotification/api/Bankpaymentdata',
                data: requestData,
                success: function(returnData) {
                    returnData.addHeader("Access-Control-Allow-Origin", "*")
                    console.log(returnData)
                    // processresult(returnData);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr, ajaxOptions)
                    alert('failed ' + thrownError);
                },
                processData: false,
                async: true
            });
        }


        $(document).ready(function() {



            function putJson() {
                data = {
                    userName: 'testuser',
                    passWord: 'testuser',
                    recordId: '103',
                    accountNumber: '4090109299',
                    amount: '202.20',
                    extraData: [{
                            FieldName: 'field1',
                            FieldValue: 'value1'
                        },
                        {
                            fieldName: 'field2',
                            fieldValue: 'value2'
                        },
                        {
                            fieldName: 'field3',
                            fieldValue: 'value3'
                        }
                    ]
                };
                var postData = JSON.stringify(data);

                $.ajax({
                    type: 'PUT',
                    contentType: "application/json;charset=utf-8",
                    url: ' https://realtime.zenithbank.com.gh/realtimenotification/api/Bankpaymentdata',
                    data: postData,
                    success: function(returnData) {
                        processresult(returnData);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert('failed ' + thrownError);
                    },
                    processData: false,
                    async: false
                });
            }

            function deleteJson() {
                data = {
                    userName: 'testuser',
                    passWord: 'testuser',
                    recordId: '103',
                };
                var postData = JSON.stringify(data);
                $.ajax({
                    type: 'DELETE',
                    contentType: "application/json;charset=utf-8",
                    url: ' https://realtime.zenithbank.com.gh/realtimenotification/api/Bankpaymentdata',
                    data: postData,
                    success: function(returnData) {
                        processresult(returnData);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert('failed ' + thrownError);
                    },
                    processData: false,
                    async: false
                });
            }
            $('#btnPostJson').click(function() {
                postJson();
            });
            $('#btnPut').click(function() {
                putJson();
            });
            $('#btnDelete').click(function() {
                deleteJson();
            });


            function processresult(returnData) {
                $.each(returnData, function(indx, statistics) {
                    alert(indx + " : " + statistics);

                });
            }
        })
    </script>
@endsection
