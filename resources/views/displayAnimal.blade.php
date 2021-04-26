@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Animals') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Adoption Status </th>
                        <th> Name </th>
                        <th> DOB </th>
                        <th> Description </th>
                        <th>Images </th>
                        
                    
                        </tr>
                        </thead>
                        <tbody>
                           
                        @foreach($animals as $animal)

                        <tr>

                        <td> 
                            @foreach ($adoptionData as $adoptionRequest)

                            @php
                                echo ($adoptionRequest->pendingUsers);
                            @endphp
                        @if (intval($adoptionRequest->pendingUsers) === 1)
                            <p>
                                pending...
                            </p>

                        @elseif (intval($adoptionRequest->deniedUsers) === 1)
                        <p> Denied!

                        </p>
                        @elseif ($animal->userid === 1 && $adoptionRequest->userid !== $animal->userid)

                        <p>Available</p>

                            @if (Auth::user()->role !== 1)
                            
                            <div class="form-group">

                                <div class="col-md-8">
                                    <form method="POST" action="{{ route('adoptionData') }}">
                                        @csrf
                                        
                                    <input type="hidden" id="animalid" name="animalid" value="<?php echo $animal->id ?>">
                                    <input type="hidden" id="userid" name="userid" value="<?php echo $user ?>">
                                    <button type="submit" class="btn btn-primary">
                                        Adoption Request
                          </button> 
                                </form>
                            @endif
                        @endif
                        @endforeach
                            
   
                       
                       </td>
                      
                        <td> {{$animal->name }} </td>
                        <td> {{$animal->DOB }} </td>
                        <td> {{$animal->description}} </td>
                        <td> @foreach ($images as $img)
                            @php
                                //only show the images which match the id of tha animal
                                if ($img->animalid !== $animal->id) {
                                    continue;
                                }
                            @endphp
                            <img src="{{ asset('/storage/images/' . $img->name) }}"
                                alt="{{ $img->name }}" />
                        @endforeach
                       
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


