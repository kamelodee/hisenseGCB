@extends('layouts.layout1')
@section('content')
<div class="col-8">
   
    <div class="card p-3">
        
<div class="d-flex justify-content-between px-5">
    <h4>SMS Groups</h4>
    @foreach ($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<div><a class="btn btn-info text-white" href="{{route('contacts')}}">Add contact</a> </div>
</div>
        <div class="col-12 p-3">
            <form action="{{route('group.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <input placeholder="Group Name" name="name" type="text" class="form-control">
                    </div>
                    <div class="col-6">
                        <input placeholder="Descrption" name="description" type="text" class="form-control">
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
                        <th class="border-top-0">Description</th>
                        <th class="border-top-0">Created At</th>
                        <th class="border-top-0">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td>1</td>
                        <td class="txt-oflo">{{$group->name}}</td>
                        <td>{{$group->description}}</td>
                        <td class="txt-oflo">{{$group->created_at}}</td>
                        <td class="txt-oflo"><a class="btn btn-danger text-white" href="{{route('admin.group.delete',$group->id)}}">Remove</a></td>
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
          <h5 class="modal-title" id="exampleModalLabel">Create Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('group.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Group Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Description</label>
                  <textarea name="description" class="form-control"  id="description" cols="30" rows="5">description</textarea>
                
                </div>
                
                <button type="submit" class="btn btn-info text-white">Save</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info text-white" data-bs-dismiss="modal">Close</button>
       
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
@endsection