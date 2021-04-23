@extends('layouts.layout')
@section('title', $title)
@section('content')
 
  <section class="content">
        <div class="row">
          <div class="col-md-12">
            <h2>{{$title}}</h2>
            
          </div>
        </div>
      
          <div class="row">
            <div class="col-xs-12">
               @if($friends->count()>0)
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
                      
                    </tr>
                    @foreach($friends as $friend)
                    @if(\Auth::user()->id!=$friend->sender_id)
                    @php
                    $user=$friend->sender;
                    @endphp
                    @else
                    @php
                    $user=$friend->receiver;
                    @endphp
                    @endif

                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{ $user->user_gender}} 
                     </td>
                      
                      <td>
                        @if(@$user->img)
                        <img height="100" width="100" src="{{ asset('public/images/'.$user->img)}}">
                    @endif
                     @if($friend->status==1)
                    <span class="td_{{$user->id}}">
                     <a href="#" class="btn btn-success" onclick="accept_request('{{$user->id}}','accept');">Accept Request</a>
                      <a href="#" class="btn btn-danger" onclick="accept_request('{{$user->id}}','reject');">Reject Request</a>
                    </span> @endif
                  </td>

                   
                    </tr>
                    @endforeach
                  </table>

                </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                  {{ $friends->links() }}
                </div>
              </div>
              @else
                  <div class="box">
                <div class="box-header">
                  
                 
                    
                     <h2>No record found</h2>
                     
                   
                  </div>
                </div>
              </div>
              @endif
              </div><!-- /.box -->
            </div>

          </div>
        </section><!-- /.content -->
      @stop
      @push('scripts')
      <script type="text/javascript">
        
        
        function accept_request(id,status){
          
        $.ajax({
           type:'POST',
           url:"{{ route('accept_request') }}",
           data:{sender_id:id,"_token": "{{ csrf_token() }}",status:status},
           success:function(data){
              
              $('.td_'+id).html('<p>'+data.msg+'</p>')
           },
           error:function(data){
           //  alert(data.msg);
           }
        });
  
        }

    
      </script>
      @endpush