@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Animals') }}</div>


                @if ($message = Session::get('message')) 
                <div class="alert alert-success" style = "margin-top: 5rem">
                   {{-- send the animal id to url --}}
                  <strong>{{ $message }}</strong>
                </div>
            @endif

            
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                            <th> user Id</th>
                            <th> user emial</th>
                            <th> Animal name</th>
                            <th> Status </th>
                            
                           
                       
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingRequests as $request)

                             
                                
                                <?php
                                
                                $animalid = 1;

                                foreach ($users as $user) {
                                    if ($user->id === $request->userid) {
                                        echo '<td>' . $user->name . '</td>';
                                        echo '<td>' . $user->email . '</td>';
                                        break;
                                    }
                                    else {
                                        continue;
                                    }
                                    
                                }

                                foreach ($animals as $animal) {
                                    if ($animal->id === $request->animalid) {
                                        echo '<td>' . $animal->name . '</td>';
                                        $animalid = $animal->userid;
                                       
                                        break;
                                    }
                                    else {
                                        continue;
                                    }
                                    
                                }
                                
                                ?>

                              
                                <td>

                                    @if ($request->pendingUsers === '1')

                                    Pending..

                                        
                                    @endif
                                
                                    
                                        <form method="POST" action="{{ route('modifyRequest') }}">
                                            @csrf
                              
                                        <input name="userid" type="hidden" value = "{{$request->userid}}"  > 
                                        <input name="animalid" type="hidden" value = "{{$request->animalid}}"  >
                                       
                                        <button name="myRequest" value="false" class="btn btn-danger">Deny</button>

                                        @if ($animalid === 1)
                                        <button name="myRequest" value="true" class="btn btn-success">Approve</button>  

                                        @endif
                                       
                                        </form>
                                
                                </td>

                                
                                </td>   
                             
                           
                            </tr>
                            @endforeach
                            </tbody>
                       </table>


                </div>
            </div>
        
    </div>
</div>
@endsection




