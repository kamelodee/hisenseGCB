

  <form id="form-send-money" method="post" action="{{route('bank.store')}}">
    @csrf
    @foreach ($banks as $bank )
    <div class="form-check">
        <input class="form-check-input" type="radio" name="bank" id="exampleRadios1" value="{{$bank->id}}" {{$bank->status =="ACTIVE"?'checked':''}}>
        <label class="form-check-label" for="exampleRadios1">
         {{$bank->name}}
        </label>
      </div>
      @endforeach
   
   
   
   
    <div class="d-grid mt-4"><button type="submit" class="btn btn-primary">Submit</button></div>
  </form>