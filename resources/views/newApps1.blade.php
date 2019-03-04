<table id="keywords" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
                          <th width="50px"><input type="checkbox" id="master"></th> 
		                  <th><span>Created Date</span></th>
		                 @if($emp->AJV_DEP_ID === '1' || $emp->AJV_DEP_ID === '9')
		                  <th><span>Resend to CO before</span></th>
		                 @endif    
                          <th><span>Full Name</span></th>
                          <th><span>Phone</span></th>
                          <th><span>Email</span></th>
                          <th><span>Source</span></th>
		                  <th><span>SA</span></th>
                          <th><span>CO</span></th>
		                  <th><span>Action</span></th>
				</tr>
			     </thead>
                       @if($gefData != null)
			     <tbody>
                              @foreach ($gefData as $retrive)
			<tr>
                         <td><input type="checkbox" class="sub_chk" data-id="{{$retrive->gef_phone}}"></td> 
                         <td>{{ $retrive->created_at }}</td>
                     <?php 
                         $user = Auth::user();
                         $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
                     ?>               
		            @if($emp->AJV_DEP_ID === '1' || $emp->AJV_DEP_ID === '9')
                     <?php 
                     
                        if($retrive->created_at === $retrive->updated_at){
                           $date = date('Y-m-d', strtotime('+10 days', strtotime(date($retrive->created_at))));
                        } else {
                           $date = date('Y-m-d', strtotime('+10 days', strtotime(date($retrive->updated_at))));
                        }   
                     ?>   
                        @if($retrive->gef_service_assigned_to != null)
                         <td><div class="blink2"><span1>{{$date}}</span1></div></td>
                        @else
                         <td></td>
                        @endif 
                    @endif
                         <td>{{ $retrive->gef_f_name . ' ' . $retrive->gef_l_name }}</td>
                         <td>{{ $retrive->gef_phone }}</td>
                         <td>{{ $retrive->gef_email }}</td>
                     @if($retrive->gef_source != null)  
                         <td>{{ $retrive->gef_source}}</td>
                     @else
                         <td>{{ 'No Source info ' }}</td>
                     @endif     
                         @if($user != null)    
                            @if($emp->AJV_DEP_ID == '2' || $emp->AJV_DEP_ID == '4' || $emp->AJV_DEP_ID == '9')
                              @if($retrive->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_assigned_to)->first();?>                              
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Uploaded by you</td>
                              @endif                             
                              @if($retrive->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td>CO not assigned</td>
                              @endif  
                               <td>	
                               {!! Form::model($retrive, ['method' => 'GET','route' => ['serviceView', $retrive->gef_phone],'target' => '_blank']) !!}
                               {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                               {{ Form::close() }}									 
                               </td>
                           @else
                              @if($retrive->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_assigned_to)->first();?>
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Yet to be assigned</td>                     
                              @endif
                              @if($retrive->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td></td>
                              @endif                               
                               <td>	
                               {!! Form::model($retrive, ['method' => 'GET','route' => ['leadView', $retrive->gef_phone],'target' => '_blank']) !!}
                                <input name="refresh" value="1" type="hidden">
                               {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                               {{ Form::close() }}									 
                               </td>
                           @endif 
                         @endif 	
                        </tr>
                         @endforeach 
                      </tbody>
                     @endif 
                     </table>
                <hr>
               {{ $gefData->links() }}   