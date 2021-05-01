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

                            @foreach ($animals as $animal)

                                @php
                                    
                                    $requestStatus = false;
                                    $message = '';
                                    
                                    if (Auth::user()->role !== 1) {
                                        if ($animal->userid === Auth::user()->id) {
                                            $message = '
                                                                                    <div class="alert alert-success">
                                                                                    <strong>Approved</strong>
                                                                                    </div>';
                                            $requestStatus = true;
                                        } else {
                                            // // if ($animal->userid !== 1) {
                                            // //     continue;
                                            // }
                                            foreach ($adoptionData as $adoptrequest) {
                                                if ($adoptrequest->pendingUsers === '1' && $adoptrequest->animalid === $animal->id) {
                                                    $message = '
                                                                                    <div class="alert alert-secondary">
                                                                                    <strong>Pending</strong>
                                                                                    </div>';
                                                    $requestStatus = true;
                                                    break;
                                                } elseif ($adoptrequest->deniedUsers === '1' && $adoptrequest->animalid === $animal->id) {
                                                    $message = '
                                                                                    <div class="alert alert-danger">
                                                                                    <strong>Denied</strong>
                                                                                    </div>';
                                                    $requestStatus = true;
                                                    break;
                                                } elseif ($adoptrequest->pendingUsers === '0' && $adoptrequest->deniedUsers === '0' && $adoptrequest->animalid === $animal->id) {
                                                    $message = '
                                                                                    <div class="alert alert-success">
                                                                                    <strong>Adopted</strong>
                                                                                    </div>';
                                                    $requestStatus = true;
                                                    break;
                                                }
                                              

                                               
                                            }
                                            
                                          
                                        }
                                    } elseif ($animal->userid === 1) {
                                        $message = '<div class="alert alert-info">
                                                                            <strong>Available for adoption</strong>
                                                                            </div>';
                                    } else {
                                        $message = '<div class="alert alert-success">
                                                                            <strong>Adopted</strong>
                                                                            </div>';
                                     
                                    }
                                @endphp

                                <tr>
                                    @php
                                        if ($requestStatus === false && $animal->userid !== 1) {

                                            continue;
                                            }

                                    @endphp
                                    <td>
                                        @php
                                        
                                            if ($message !== '') {
                                                echo $message;
                                                $message = '';
                                            }
  
                                        @endphp


                                        @if ($animal->userid === 1 && Auth::user()->role !== 1 && $requestStatus === false)

                                            <form method="POST" action="{{ route('adoptionData') }}">
                                                @csrf

                                                <input type="hidden" id="animalid" name="animalid"
                                                    value="<?php echo $animal->id; ?>">
                                                <input type="hidden" id="userid" name="userid"
                                                    value="<?php echo $user; ?>">
                                                <button type="submit" class="btn btn-primary">
                                                    Adoption Request
                                                </button>
                                            </form>

                                        @endif

                                    </td>


                                    <td> {{ $animal->name }} </td>
                                    <td> {{ $animal->DOB }} </td>
                                    <td> {{ $animal->description }} </td>
                                    <td>
                                        @foreach ($images as $img)
                                            @php
                                                
                                                if ($img->animalid !== $animal->id) {
                                                    continue;
                                                }
                                            @endphp
                                            <img src="{{ asset('/storage/images/' . $img->name)  }}" width="120px" height="120px"
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
