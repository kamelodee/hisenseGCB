@extends('layouts.layout1')
@section('content')
<div class="col-8">
   
    <div class="card p-3">
        

        <h2>Contacts</h2>
        @foreach ($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Manual Entry</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Bulk Upload</button>
                 
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="col-10 p-3">
                        <form action="{{route('contact.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <input placeholder="Full Name" name="full_name" type="text" class="form-control">
                                </div>
                                <div class="col-3">
                                    <input placeholder="Phone Number" name="phone" type="text" class="form-control">
                                </div>
                                <div class="col-3">
                                    <select name="group" id="" class="form-control">
                                        <option value="">Select Group</option>  
                                        @foreach ($groups as $group)
                                        
                                        <option value="{{$group->id}}">{{$group->name}}</option>  
                                        @endforeach
                                     
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="submit" class="btn btn-info text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="col-10 p-3">
                        <form action="{{route('contact.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <input placeholder="import excel" name="import" type="file" class="form-control">
                                </div>
                                <div class="col-3">
                                    <select name="group" id="" class="form-control">
                                        <option value="">Select Group</option>  
                                        @foreach ($groups as $group)
                                       
                                        <option value="{{$group->id}}">{{$group->name}}</option>  
                                        @endforeach
                                     
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="submit" value="Upload" class="btn btn-info text-white">
                                </div>
                            </div>
                        </form>
                        <p class="p-2"><a href="{{asset('assets/uploads.csv')}}" download><i class="fas fa-cloud-download-alt"></i> Click here  </a>to download sample</p>
                    </div>
                </div>
                
              </div>
       
        <div class="table-responsive">
            <table class="table no-wrap">
                <thead>
                    <tr>
                        <th class="border-top-0">#</th>
                        <th class="border-top-0">Name</th>
                        <th class="border-top-0">Phone</th>
                        {{-- <th class="border-top-0">Group</th> --}}
                        <th class="border-top-0">Ceated At</th>
                        <th class="border-top-0">Action</th>
                        {{-- <th class="border-top-0">Delete</th> --}}
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $contacts as  $contact)
                    <tr>
                        <td>{{$contact->id}}</td>
                        <td class="txt-oflo">{{$contact->full_name}}</td>
                        <td>{{$contact->phone}}</td>
                     
                        <td><span class="text-success">{{$contact->created_at}}</span></td>
                        <td class="txt-oflo"><a class="btn btn-danger text-white" href="{{route('admin.contact.delete',$contact->id)}}">Remove</a></td>
                        {{-- <td><a href="{{route('contact.delete',$contact->id)}}" class="btn btn-danger "><i class="fas fa-trash p-2"></i>Remove</a></td> --}}
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
          <h5 class="modal-title" id="exampleModalLabel">Add contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('contact.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Full Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Phone</label>
                 <input type="text" class="form-control" name="phone">
                
                </div>
                
                <button type="submit" class="btn btn-info">Save</button>
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