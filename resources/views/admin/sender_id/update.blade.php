@extends('layouts.layout1')
@section('content')
<div class="col-6">
   
    <div class="card p-3">
 <form action="{{route('admin.senderid.update')}}" method="POST">
<input type="hidden" name="senderid" value="{{$senderid->id}}">
<h1>Are you sure you want to Approve {{$senderid->name}}</h1>
@csrf
<input type="submit" class="btn btn-success text-white" value="YES">
<a href="{{route('admin.senderids')}}" class="btn btn-info text-white"> NO</a>
</form>
    </div>
</div>

@endsection