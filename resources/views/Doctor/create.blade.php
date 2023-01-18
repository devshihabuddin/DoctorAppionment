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
                <h3 class="card-title">Create Doctor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('doctors.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                          <label for="inputEmail4" class="form-label">Department</label>
                          <select name="department_id" id="" class="form-control" required>
                            <option value="">select department</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="" class="form-label">Doctor Name:</label>
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputPassword4"  placeholder="abc..">
                          
                        </div>
                        <div class="form-group">
                          <label for="" class="form-label">Doctor Phone:</label>
                          <input type="integer" name="phone" class="form-control @error('phone') is-invalid @enderror" id="inputPassword4" placeholder="+88 0">
                          
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2" class="form-label">Fee </label>
                          <input type="integer" name="fee" class="form-control @error('fee') is-invalid @enderror" placeholder="00.00">
                          
                        </div>
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" name="status" value="1" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                              Active
                            </label>
                            
                          </div>
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

<!-- <div class="col-8">
<form class="row g-3">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Department</label>
    <select name="department_id" id="" class="form-control" >
      <option value="">select department</option>
       @foreach($departments as $department)
          <option value="{{$department->id}}">{{$department->name}}</option>
       @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label for="" class="form-label">Doctor Name:</label>
    <input type="text" name="name" class="form-control" id="inputPassword4"  placeholder="abc..">
  </div>
  <div class="col-md-6">
    <label for="" class="form-label">Doctor Phone:</label>
    <input type="integer" name="phone" class="form-control" id="inputPassword4" placeholder="+88 0">
  </div>
  <div class="col-md-6">
    <label for="inputAddress2" class="form-label">Fee </label>
    <input type="integer" class="form-control" placeholder="00.00">
  </div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">submit</button>
  </div>
</form>
</div> -->
@endsection