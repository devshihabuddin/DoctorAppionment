@extends('admin')
@push('css')
    
@endpush
@section('content')
<div class="content-wrapper">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Doctors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a class="btn btn-sm btn-info" href="{{route('doctors.create')}}">Create Doctor</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Fee</th>                   
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($doctors as $key=>$row)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->department->name}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->fee}}</td>
                    <td>
                        <input type="checkbox" data-id="{{$row->id}}" class="toggle-class" data-onstyle="success"
                        data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="Inactive"
                        {{$row->status ? 'checked' : ''}}>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{route('doctors.edit',$row->id)}}"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteDoctor({{ $row->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="delete-form-{{ $row->id }}" action="{{route('doctors.destroy',$row->id)}}" method="POST" style="display:none;" >
                        @csrf
                        @method('DELETE')
                        </form>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Doctor Name</th>
                    <th>Department</th>
                    <th>Phone</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
             
              <!-- /.card-body -->
    </div>
</div>

@endsection
@push('js')
<script>
    $(function(){
        $('.toggle-class').change(function(){
            var status = $(this).prop('checked')== true ? 1 : 0;
            var row_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data:{'status': status,'row_id': row_id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
        });
    });
</script>

<!-- sweetaleart -->
<script type="text/javascript">
                function deleteDoctor(id){

                    const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            }
            })

                }
    </script>
@endpush

