@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card">
                    <div class="card-header">Upload new image</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('uploadImage') }}">
                            @csrf

                            <div class="form-group row">
                                <input type="file" id="file" name="file">
 
                            </div>

                            <div class="form-group row">
                                
                                <input type="hidden" id="animalid" name="animalid" value="<?php echo $_GET['animal']; ?>">
                                
 
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-8">
                                    <button class="btn btn-primary">
                                        Submit
                                    </button>
                                    
                                    @if ($message = Session::get('success')) 
                              <div class="alert alert-success" style = "right: 25rem; margin-top: 2rem;">
                                 {{-- send the animal id to url --}}
                                <strong>{{ $message }}</strong>
                              </div>
                          @endif

                                </div>
                            </div>
                        </form>
@endsection


