             
              <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th width="50px"><input type="checkbox" id="master"></th> 
                      <th><span>Full Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Email</span></th>
                      <th><span>Source</span></th>
		      <th><span>Assigned To</span></th>
		      <th><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($gefData as $retrive)
                    <tr>
                      <td><input type="checkbox" class="sub_chk" data-id="{{$retrive->gef_phone}}"></td> 
                      <td>{{ $retrive->gef_f_name . ' ' . $retrive->gef_l_name }}</td>
                      <td>{{ $retrive->gef_phone }}</td>
                      <td>{{ $retrive->gef_email }}</td>
                     @if($retrive->gef_source != null)  
                      <td>{{ $retrive->gef_source}}</td>
                     @else
                      <td>{{ 'No Source info ' }}</td>
                     @endif 
                       @if($user != null)    
                        <?php $emp4 = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();?>
                         @if($emp4->AJV_DEP_ID == '2')
                          @if($retrive->gef_service_assigned_to != null)
                           <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_service_assigned_to)->first();?>
                           <td></td>
                          @else
                           <td>{{ $retrive->gef_service_assigned_to }}</td>
                          @endif
                            <td>            
                             {!! Form::model($retrive, ['method' => 'GET','route' => ['serviceView', $retrive->gef_phone],'target' => '_blank']) !!}
                             {{ Form::submit('View', ['class' => 'btn btn-success']) }}
                             {{ Form::close() }}
                            </td> 
                         @else
                          @if($retrive->gef_assigned_to != null)
                           <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_assigned_to)->first();?>
                           <td>{{ $emp->AJV_EMP_Fname }} {{ $emp->AJV_EMP_Lname }}</td>
                          @else
                           <td>{{ $retrive->gef_assigned_to }}</td>
                          @endif
                            <td>            
                             {!! Form::model($retrive, ['method' => 'GET','route' => ['leadView', $retrive->gef_phone],'target' => '_blank']) !!}
                              <input name="refresh" value="1" type="hidden">
                             {{ Form::submit('View', ['class' => 'btn btn-success']) }}
                             {{ Form::close() }}
                            </td> 
                         @endif 
                       @endif   
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <hr>
               {{ $gefData->fragment('newApps')->links() }} 
