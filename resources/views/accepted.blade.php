                                 
<table id="keywords" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
				 <th><span>First Name</span></th>
				 <th><span>Phone</span></th>
				 <th><span>Email</span></th>
				 <th><span>Nationality</span></th>
				 <th><span>Location</span></th>
				 <th><span>SA</span></th>
				 <th><span>CO</span></th>
				 <th><span>Action</span></th>
				</tr>
			     </thead>
			     <tbody>
                        @foreach ($accepted as $retrive4)
			<tr>
                         <td>{{ $retrive4->gef_f_name }}</td>
                         <td>{{ $retrive4->gef_phone }}</td>
                         <td>{{ $retrive4->gef_email }}</td>
                         <td>{{ $retrive4->gef_nationality }}</td>
                         <td>{{ $retrive4->gef_location }}</td>
                         <?php $user = Auth::user();?>
                         @if($user != null)    
                             <?php $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();?>
                            @if($emp->AJV_DEP_ID == '2')
                              <?php $emp1  = employee::where('AJV_EMP_Email','=',$retrive4->gef_service_assigned_to)->first();?>                        
                              @if($retrive4->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive4->gef_assigned_to)->first();?>                              
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Uploaded by you</td>
                              @endif                             
                              @if($retrive4->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive4->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td>CO not assigned</td>
                              @endif
                              <td>	
                                 {!! Form::model($retrive4, ['method' => 'GET','route' => ['serviceView', $retrive4->gef_phone]]) !!}
                                 {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                 {{ Form::close() }}									 
                               </td>	
                            @else
                              @if($retrive4->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive4->gef_assigned_to)->first();?>
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Yet to be assigned</td>                     
                              @endif
                              @if($retrive4->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive4->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td></td>
                              @endif   
                              <td>	
                                 {!! Form::model($retrive4, ['method' => 'GET','route' => ['leadView', $retrive4->gef_phone],'target' => '_blank']) !!}
                                 <input name="refresh" value="1" type="hidden">
                                 {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                                 {{ Form::close() }}									 
                               </td>                              
                          @endif
                         @endif
                        </tr>
                         @endforeach 
                      </tbody>

                     </table>
                <hr>
               {{ $accepted->fragment('accepted')->links() }}   
