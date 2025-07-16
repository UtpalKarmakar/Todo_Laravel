@extends('layouts.FrontendLayouts')

@section('content')
    <div class="container text-center my-3">
        <div class="col-lg-5 my-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    Add Todo
                </div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf
                        <input name="title" value="{{ old('title') }}" type="text" placeholder="Todo Title....." class="form-control my-3">
                        @error('title')
                            <p class="text-start text-danger">{{ $message }}</p>
                        @enderror

                        <label for="" class="d-block">
                            <p class=" my-3 text-start">Publish date</p>
                            <input name="date" value="{{ old('date') }}" type="date" class="form-control">
                            @error('date')
                                <p class="text-start text-danger">{{ $message }}</p>
                            @enderror
                        </label>


                        <textarea name="description" class="form-control  my-3" placeholder="Add a description..">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-start text-danger">{{ $message }}</p>
                        @enderror

                        <button class="btn btn-primary w-100  my-3" type="submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
