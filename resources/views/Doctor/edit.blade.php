@extends('admin')
@section('content')
<section class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Doctor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('doctors.update',$doctor->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                          <label for="inputEmail4" class="form-label">Department</label>
                          <select name="department_id" id="" class="form-control" required>
                            <option value="">select department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}" @if($department->id == $doctor->department_id) selected @endif>{{$department->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="" class="form-label">Doctor Name:</label>
                          <input type="text" name="name" value="{{$doctor->name}}" class="form-control @error('name') is-invalid @enderror" id="inputPassword4"  placeholder="abc..">
                          
                        </div>
                        <div class="form-group">
                          <label for="" class="form-label">Doctor Phone:</label>
                          <input type="integer" name="phone" value="{{$doctor->phone}}" class="form-control @error('phone') is-invalid @enderror" id="inputPassword4" placeholder="+88 0">
                          
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2" class="form-label">Fee </label>
                          <input type="integer" name="fee" value="{{$doctor->fee}}" class="form-control @error('fee') is-invalid @enderror" placeholder="00.00">
                          
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection