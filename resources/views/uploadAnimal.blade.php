@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Submit a new Animal</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('animalData') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name of animal</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="animaldescription"
                                    class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" id="animaldescription" name="animaldescription" rows="4" cols="50"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="DOB" class="col-md-4 col-form-label text-md-right">Date of birth</label>

                                <div class="col-md-6">
                                    <input type="date" id="DOB" name="DOB" min="1900-01-02" max="<?php echo date('Y-m-d');?>">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-8">
                                    <button class="btn btn-primary">
                                        Save
                                    </button>

                                </div>
                            </div>
                        </form>

                          {{-- show success message on successful upload --}}
                          @if ($message = Session::get('success')) 
                              <div class="alert alert-success" style = "margin-top: 5rem">
                                <form action="{{ route('uploadImage') }}" method="get">
                                    <input type="hidden" name="animalid" value="{{ Session::get('animalid')}}">
                                    <label for="animalid"></label>
                                    <button class="btn btn-primary" type ="submit" id="animalid" name="animal" value= "{{ Session::get('animalid')}}">
                                        Click here to upload images</button>  
                                 </form>
                                 {{-- send the animal id to url --}}
                                <strong>{{ $message }}</strong>
                              </div>
                          @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection