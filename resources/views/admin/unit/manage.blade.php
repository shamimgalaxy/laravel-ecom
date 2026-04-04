@extends('admin.master')
@section('body')

<div class="row mt-3">
   <div class="col-12">

    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Table</h4>
                                <h6 class="card-subtitle">Unit Data table </h6>
                                <div class="table-responsive m-t-40">
                                    <p class="text-center text-success">{{ session('message') }}</p>
                                    <table id="myTable" class="table table-striped border">
                                        <thead>
                                           
                                            
                                            
                                            <tr>
                                                <th>SL No</th>
                                                <th>Unit Name</th>
                                                <th>Unit Code</th>
                                                <th>Unit Description</th>
                                              
                                                <th>Action</th>
                                            </tr>

                                           
                                        </thead>
                                        <tbody>
                                             @foreach ($units as $unit)
                                            <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $unit->name }}</td>
    <td>{{ $unit->code }}</td>
    <td>{{ $unit->description }}</td>
    
    
    <td>
        <a href="{{ route('unit.edit',$unit->id) }}" class="btn btn-success btn-sm">
            <i class="ti-reddit"></i>
        </a>
        <a href="{{ route('unit.delete', $unit->id) }}" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Are you sure you want to delete this unit? This cannot be undone.')">
    <i class="ti-trash"></i>
</a>
    </td>
</tr>

 @endforeach
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

   </div>
</div>

@endsection