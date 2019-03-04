               <table id="keywords" cellspacing="0" cellpadding="0">
                  <thead>
                    <tr>
                      <th width="50px"><input type="checkbox" id="master1"></th> 
                      <th><span>Call Update</span></th>
                      <th><span>Full Name</span></th>
                      <th><span>Phone</span></th>
                      <th><span>Email</span></th>
                      <th><span>Status</span></th>
                      <th><span>SA</span></th>
                      <th><span>CO</span></th>
                      <th><span>Action</span></th>
                    </tr>
                  </thead>
                  <tbody>
                          @foreach ($gefData2 as $retrive2)
                    <tr>
                      <td><input type="checkbox" class="sub_chk1" data-id="{{$retrive2->gef_phone}}"></td>
                      <?php 

                        $callToday = App\enquiry::where('gef_phone','=',$retrive2->gef_phone)->whereDate('updated_at', '=', \Carbon\Carbon::today()->toDateString())->first();

                      ?>
                     @if($callToday != null)
                        <td><div class="blink"><span1>{{ 'Today' }}</span1></div></td>
                     @else
                      <td>{{ ' ' }}</td> 
                     @endif
                      <td>{{ $retrive2->gef_f_name . ' ' . $retrive2->gef_l_name }}</td>
                      <td>{{ $retrive2->gef_phone }}</td>
                      <td>{{ $retrive2->gef_email }}</td>
                     <?php 
                         $user = Auth::user();
                         $emp = App\employee::where('AJV_EMP_Email', '=', $user->email)->first();
                     ?>                      
                   @if($user != null)    
                      @if($emp->AJV_DEP_ID == '2' || $emp->AJV_DEP_ID == '4' || $emp->AJV_DEP_ID == '9')
                      <td>{{ $retrive2->gef_up_app_status }}</td>
                              @if($retrive2->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_assigned_to)->first();?>                              
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Uploaded by you</td>
                              @endif                             
                              @if($retrive2->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td>CO not assigned</td>
                              @endif  
                               <td>	
			  {!! Form::model($retrive2, ['method' => 'GET','route' => ['serviceView', $retrive2->gef_phone],'target' => '_blank']) !!}
			  {{ Form::submit('Edit', ['class' => 'btn btn-success']) }}
                          {{ Form::close() }}									 
		        </td>	
                      @else
                        <td>{{ $retrive2->gef_up_lead_status }}</td>
                              @if($retrive2->gef_assigned_to != null)
                               <?php $emp  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_assigned_to)->first();?>
                               <td>{{ $emp->AJV_EMP_shortName }}</td>
                              @else
                               <td>Yet to be assigned</td>                     
                              @endif
                              @if($retrive2->gef_service_assigned_to != null)
                               <?php $co  = App\employee::where('AJV_EMP_Email','=',$retrive2->gef_service_assigned_to)->first();?>
                               <td>{{ $co->AJV_EMP_shortName }}</td>
                              @else
                               <td></td>
                              @endif                         
                        <td>	
			  {!! Form::model($retrive2, ['method' => 'GET','route' => ['leadView', $retrive2->gef_phone],'target' => '_blank']) !!}
                              <input name="refresh" value="1" type="hidden">
			  {{ Form::submit('Edit', ['class' => 'btn btn-success']) }}
                          {{ Form::close() }}									 
		        </td>	
                     @endif
                   @endif  
                    </tr>
                @endforeach 
            </tbody>
          </table>
                <hr>
               {{ $gefData2->links() }}   
