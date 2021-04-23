@extends('layouts.layout')
@section('title', 'Users List')
@section('content')
 
  <section class="content">
        <div class="row">
          <div class="col-md-12">
            <h2>Users List</h2>
            
          </div>
        </div>
      
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                  <div class="box-tools">
                    <div class="input-group">
                     
                     
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                     
                      <th>Image</th>
                       <th>Action </th>
                    </tr>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{ $user->user_gender}}</td>
                      
                      <td>
                        @if(@$user->img)
                        <img height="100" width="100" src="{{ asset('public/images/'.$user->img)}}">
                    @endif</td>
                    <td class="td_{{$user->id}}">
                      @if($user->check_request==0)
                      <a href="#" class="btn btn-primary" onclick="send_request({{$user->id}});">Send Request</a>
                      @elseif($user->check_request==1)
                      <p>Request Sent</p>
                      @elseif($user->check_request==2)
                      <a href="#" class="btn btn-success" onclick="accept_request({{$user->id}},'accept');">Accept Request</a>
                       <a href="#" class="btn btn-danger" onclick="accept_request({{$user->id}},'reject');">Reject Request</a>
                      @elseif($user->check_request==3)
                      <p>Friend</p>
                      @else
                      <p>Rejected</p>
                      @endif
                    </td>
                    </tr>
                    @endforeach
                  </table>

                </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                  {{ $users->links() }}
                </div>
              </div>
              </div><!-- /.box -->
            </div>

          </div>
        </section><!-- /.content -->
      @stop
      @push('scripts')
      <script type="text/javascript">
        
        function send_request(id){
          
        $.ajax({
           type:'POST',
           url:"{{ route('sendrequest') }}",
           data:{receiver_id:id,"_token": "{{ csrf_token() }}",},
           success:function(data){
              
              $('.td_'+id).html('<p>Request Sent...</p>')
           },
           error:function(data){
             alert(data.msg);
           }
        });
  
        }
        function accept_request(id,status){
          
        $.ajax({
           type:'POST',
           url:"{{ route('accept_request') }}",
           data:{sender_id:id,"_token": "{{ csrf_token() }}",status:status},
           success:function(data){
              
              $('.td_'+id).html('<p>'+data.msg+'</p>')
           },
           error:function(data){
             alert(data.msg);
           }
        });
  
        }

    
      </script>
      @endpush