

{{-- <div class="form-desc mb-5">  
</div> --}}


<div class="card p-3">
    <div class="d-flex">
        
        <h5 class="form-header">
            <a href="javascript:void()" class="btn btn-primary float-right btn-sm" onclick="Adduser()"><i class="os-icon os-icon-plus-square"></i>  Add </a>
        </h5>
        <h5 class="mx-3">Users</h5>
    </div>
    <div class="col-md-5 col-lg-6 col-sm-12">
        <div class="input-group  input-group-sm">
            
            <input type="text" id="usersearch" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <span class="input-group-text">Search</span>
          </div>
    </div>
<div class="table-responsive mt-2">

    <table id="dataTable1" width="100%" class="table table-striped table-hover">
        <thead class="table-dark_">
            <tr>
                <th class="border-top-0 text-white_">#</th>
                <th class="border-top-0 text-white_">Name</th>
                <th class="border-top-0 text-white_">Showroom</th>
                <th class="border-top-0 text-white_">Phone</th>
               
               
                <th class="border-top-0 text-white_">Ceated At</th>
                <th class="border-top-0 text-white_">Action</th>
               
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php if(!empty($list)): ?>
            <?php foreach($list as $item): ?>
            <tr>
                <td>{{$item->id}}</td>
                <td><a href="#" class="text-primary">{{$item->name}}</a></td>
                <td>{{$item->showroom}}</td>
                <td>{{$item->phone}}</td>
               
                     <td>{{$item->created_at}}</td>
                
                <td>
                    <a onclick="Edit({{$item->id}})" class="btn btn-primary btn-sm text-white" href="javascript:void()">Edit</a>
                   
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="d-flex">
        {!! $list->links() !!}
    </div>
</div>
</div>