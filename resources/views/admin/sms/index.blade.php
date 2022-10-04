@extends('layouts.layout1')
@section('content')
<div class="row">
  <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="white-box">
          <div class="d-md-flex mb-3">
              <h5 class="box-title mb-0">SMS Deliveries</h5>
              <div class="col-md-8 col-sm-8 col-xs-10 ms-auto">
                  <form action="">
                 <div class="d-flex">
                  <select class="form-select shadow-none  border-top m-1" name="status">
                      <option>Status</option>
                      <option value="PENDING">PENDING</option>
                      <option value="DELIVERED">DELIVERED</option>
                      
                  </select>
                  <input class="form-control m-1 datepicker" type="text" name="start" data-date-format="yyyy-mm-dd" placeholder="Start Date">
                  <input class="form-control m-1 datepicker" type="text" name="end" data-date-format="yyyy-mm-dd" placeholder="End Date">
                  <input class="form-control m-1" type="text" name="textform" placeholder="Search">
                  <button type="submit" class="btn btn-info text-white ">Search</button>
                 
                  
                 </div>
              </form>
              </div>
          </div>
          <div class="table-responsive">
              <table class="table no-wrap">
                  <thead>

                      <tr>
                          <th class="border-top-0">#</th>
                          <th class="border-top-0">Sender ID</th>
                          <th class="border-top-0">Name</th>
                          <th class="border-top-0">Phone</th>
                          <th class="border-top-0">Message</th>
                          <th class="border-top-0">status</th>
                          <th class="border-top-0">DataTime</th>
                         
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($sms as $sm )
                      <tr>
                          <td>{{$sm->id}}</td>
                          <td class="txt-oflo">{{$sm->sender}}</td>
                          <td class="txt-oflo">{{$sm->contact_name}}</td>
                          <td>{{$sm->contact_phone}}</td>
                          <td class="txt-oflo">{{$sm->message}}</td>
                          <td><span class="text-success">{{$sm->status}}</span></td>
                          <td><span class="text-success">{{$sm->created_at}}</span></td>
                          
                      </tr>
                      @endforeach
                     
                      
                     
                  </tbody>
              </table>
              <div class="container" >
                  {{ $sms->links() }}
              </div>
          </div>
      </div>
  </div>
</div>

@endsection