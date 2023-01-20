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
      </div>
    </section>
    <div class="container-fluid">
        <div class="row ">       
            <div class="col-sm-4">
                <div class="card bg-gray">
                    <div class="card-body">
                        
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
                                            <input type="integer" id="totalFeeAmount" class="form-control" placeholder="Total fee" aria-describedby="emailHelp">
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
    </div>
</section>
@endsection
@push('js')
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
    function calculateTotalFeeAmount()
    {
        let totalFeeAmount = 0;
        $('.fee').each(function(){
            totalFeeAmount += Number($(this).text());
        });
        $('#totalFeeAmount').val(totalFeeAmount.toFixed(2));
    }
        //on click button event code...
        $('#add').on('click',function(){
        var date        = $('#date').val();
        var department  = $('#department').find('option:selected').text();
        var doctor      = $('#doctor').find('option:selected').text();
        var fee         = $('#fee').val();
        var count       = $('#show_data tr').length;

            if(date !="" && fee !=""){
                $('#show_data tbody').append('<tr><td>'+date+'</td><td>'+department+'</td><td>'+doctor+'</td><td class="fee">'+fee+'</td><td><a href="javascript:void(0);" class="delData"><i class="fa fa-trash"></i></a></td></tr>');
                calculateTotalFeeAmount();
                $('#date').val('');
                $('#department').val('');
                $('#doctor').empty().append('<option value="">select doctor</option>');
                $('#fee').empty();
            }        
        });

        //on click delete event code...
        $(document).on('click','.delData',function(){
            $(this).parent().parent().remove();
            calculateTotalFeeAmount();
        });


        //save all Data 
        $('#saveData').on('click',function(){
            
            var table_data = [];
            //use .each to get all the data
            $('#show_data tr').each(function(row,tr){
                var sub ={
                 'date'          : $(tr).find('td:eq(0)').text(),
                 'doctor'        : $(tr).find('td:eq(2)').text(),
                 'patient_name'  : $('#patient_name').val(),
                 'patient_phone' : $('#patient_phone').val(),
                 'paid_amount'   : $('#paid_amount').val(),
                 'totalFeeAmount': $('#totalFeeAmount').val(),
                };
                table_data.push(sub);
            });
            

            console.log(table_data);

        // $.ajax({
        //     type:'post',
        //     dataType:'json',
        //     data:{date:date,doctor_id:doctor_id,patient_name:patient_name,patient_phone:patient_phone,totalFeeAmount:totalFeeAmount,paid_amount:paid_amount},
        //     url:'/appionment/store',
        //     success:function(data){
        //         console.log('Successfully data added');
        //     }
        // });
    });
</script>

@endpush