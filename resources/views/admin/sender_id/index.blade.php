@extends('layouts.layout1')
@section('content')
<div class="col-8">
   
    <div class="card p-3">
        
<div class="d-flex justify-content-between px-5">
    <h4>SMS Sender ID</h4>
    @foreach ($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

</div>
        <div class="col-12 p-3">
            <form action="{{route('senderid.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <input placeholder="Sender ID" name="name" type="text" class="form-control">
                    </div>
                   
                    <div class="col-2">
                        <input type="submit" class="btn btn-info text-white">
                    </div>
                </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table no-wrap">
                <thead>
                    <tr>
                        <th class="border-top-0">#</th>
                        <th class="border-top-0">Name</th>
                        <th class="border-top-0">Status</th>
                        <th class="border-top-0">Created At</th>
                        <th class="border-top-0">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($senders as $sender)
                    <tr>
                        <td>1</td>
                        <td class="txt-oflo">{{$sender->name}}</td>
                        <td class="txt-oflo">{{$sender->status}}</td>
                        <td class="txt-oflo">{{$sender->created_at}}</td>
                        <td class="txt-oflo"><a class="btn btn-danger text-white" href="{{route('admin.senderid.delete',$sender->id)}}">Remove</a></td>
                        <td class="txt-oflo"><a class="btn btn-info text-white" href="{{route('admin.senderid.edit',$sender->id)}}">{{$sender->status=='ACTIVE'?"Approved":"Approve"}}</a></td>
                        
                    </tr>
                    @endforeach
                   
                    
                </tbody>
            </table>
        </div>

 
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Sender ID</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('group.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">SenderName</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  
                </div>
                
                
                <button type="submit" class="btn btn-info">Save</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
@endsection