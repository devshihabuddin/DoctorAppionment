@extends('admin')
@section('content')
<section class="content-wrapper">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Appionments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('doctors.index')}}">All Doctor</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row ">       
            <div class="col-sm-4">
                <div class="card bg-gray">
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Appionment Date</label>
                                <input type="date" name="date" class="form-control" id="date" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Department</label>
                                <select class="form-control" name="department_id" id="department">
                                    <option value="">select department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select Doctor</label>
                                <select class="form-control" id="doctor">
                                    <option value="">select doctor</option>
                                </select>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <div class="mb-3" >
                                <label for="exampleInputEmail1" class="form-label">Fee</label>
                                <select name="" id="fee">
                                
                                </select>
                            </div>                          
                            <button type="button" id="add" class="btn btn-primary">Add</button>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="show_data" border="1">
                            <thead>
                                <tr>                              
                                <th scope="col">App.Date</th>
                                <th scope="col">Department</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                <td id="d1"></td>
                                <td id="d2"></td>
                                <td id="d3"></td>
                                <td id="d4"></td>
                                <td></td>
                                </tr> -->
                            </tbody>
                        </table><br>

                        <div class="card bg-gray">
                            <div class="card-body">             
                                <form>
                                   <label class="form-label" for="">Patient Information</label>
                                    <div class="row">
                                        <div class=" col-4">
                                            <input type="text" id="patient_name" class="form-control" placeholder="Parient Name" aria-describedby="emailHelp">
                                        </div>
                                        <div class=" col-4">
                                            <input type="integer" id="patient_phone" class="form-control" placeholder="Parient phone number" aria-describedby="emailHelp">
                                        </div>
                                    </div> <br>   
                                    <label class="form-label" for="">Payment</label>                               
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="integer" id="total_fee" class="form-control" placeholder="Total fee" aria-describedby="emailHelp">
                                        </div>
                                        <div class="col-4">
                                            <input type="integer" id="paid_amount" class="form-control" placeholder="Paid amount" aria-describedby="emailHelp">
                                        </div>
                                    </div><br>
                                    <button type="button"  id="saveData" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@push('js')
<!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->

<!--get doctor from department -->
<script>
    $(document).ready(function(){
        $('#department').change(function(){
            let d_id=$(this).val();
            //alert(d_id);
            $.ajax({
                url:'/getDoctor',
                type:'post',
                data:'d_id='+d_id+'&_token={{csrf_token()}}',
                success:function(result){
                    $('#doctor').html(result)
                }
            });
        });
    });
</script>
<!--get fee from doctor -->
<script>
    $(document).ready(function(){
        $('#doctor').change(function(){
            let doctor_id = $(this).val();
           // alert(doctor_id);
           $.ajax({
            url:'/getFee',
            type:'post',
            data:'doctor_id='+doctor_id+'&_token={{csrf_token()}}',
            success:function(result){
                $('#fee').html(result)
            }
           });
        });
    });
</script>
<!-- get data from 1st card add on click button -->
<script>
        //on click button event code...
        $('#add').on('click',function(){
        var date        = $('#date').val();
        var department  = $('#department').val();
        var doctor      = $('#doctor').val();
        var fee         = $('#fee').val();
        var count       = $('#show_data tr').length;

            if(date !="" && fee !=""){
                $('#show_data tbody').append('<tr><td>'+date+'</td><td>'+department+'</td><td>'+doctor+'</td><td id="taka">'+fee+'</td><td><a href="javascript:void(0);" class="delData"><i class="fa fa-trash"></i></a></td></tr>');
            }        
        });

        //on click delete event code...
        $(document).on('click','.delData',function(){
            $(this).parent().parent().remove();
            $('#show_data tbody tr').each(function(i){
                $($(this).find('td')[0]).html(i+1);
            });
        });


        //save all Data 
        $('#saveData').on('click',function(){
            // $('#add').on('click',function(){
            //     $(this).attr('disabled', true);
            //     $(this).val('submited');
            // });
        var date        = $('#date').val();
        var department  = $('#department').val();
        var doctor      = $('#doctor').val();
        var fee         = $('#fee').val();
        var patient_name = $('#patient_name').val();
        var patient_phone = $('#patient_phone').val();
        var total_fee = $('#total_fee').val();
        var paid_amount = $('#paid_amount').val();


        $.ajax({
            type:'post',
            dataType:'json',
            data:{date:date,department:department,doctor:doctor,fee:fee,patient_name:patient_name,patient_phone:patient_phone,total_fee:total_fee,paid_amount:paid_amount,},
            url:'/appionment/store',
            success:function(data){
                console.log('Successfully data added');
            }
        });
        });
</script>

@endpush