     

 <table id="keywords" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
                                 <th width="50px"><input type="checkbox" id="master2"></th> 
				 <th><span>First Name</span></th>
				 <th><span>Phone</span></th>
				 <th><span>Email</span></th>
				 <th><span>Nationality</span></th>
				 <th><span>Location</span></th>
				 <th><span>Assigned To</span></th>
				 <th><span>Action</span></th>
				</tr>
			     </thead>
                       @if($dropped != null)

			     <tbody>
                              @foreach ($dropped as $retrive5)
			<tr>
                         <td><input type="checkbox" class="sub_chk2" data-id="{{$retrive5->gef_phone}}"></td> 
                         <td>{{ $retrive5->gef_f_name }}</td>
                         <td>{{ $retrive5->gef_phone }}</td>
                         <td>{{ $retrive5->gef_email }}</td>
                         <td>{{ $retrive5->gef_nationality }}</td>
                         <td>{{ $retrive5->gef_location }}</td>
                         <?php $user = Auth::user();?>
                         @if($user != null)    
                             <?php $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();?>
                            @if($emp->AJV_DEP_ID == '2')
                              @if($retrive5->gef_service_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive5->gef_service_assigned_to)->first();?>
                               <td class="lalign">{{ $emp->AJV_EMP_Fname }} {{ $emp->AJV_EMP_Lname }}</td>
                              @else
                               <td>Yet to be assigned</td>
                              @endif   
                               <td>	
                               {!! Form::model($retrive5, ['method' => 'GET','route' => ['serviceView', $retrive5->gef_phone]]) !!}
                               {{ Form::submit('View / Edit', ['class' => 'btn btn-success']) }}
                               {{ Form::close() }}									 
                               </td>
                           @else
                              @if($retrive5->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive5->gef_assigned_to)->first();?>
                               <td class="lalign">{{ $emp->AJV_EMP_Fname }} {{ $emp->AJV_EMP_Lname }}</td>
                              @else
                               <td>Yet to be assigned</td>                     
                              @endif
                               <td>	
                               {!! Form::model($retrive5, ['method' => 'GET','route' => ['leadView', $retrive5->gef_phone],'target' => '_blank']) !!}
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
               {{ $dropped->fragment('dropped')->links() }}   
