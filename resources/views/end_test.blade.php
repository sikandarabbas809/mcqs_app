@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Quiz') }}</div>
                <div class="card-body">
                   <label>Correct answer : <small>{{$result->correct_answer}}</small></label><br>
                   <label>Wrong answer : <small>{{$result->wrong_answer}}</small></label><br>
                   <label>Result : <small>{{$result->correct_answer}} / {{$result->correct_answer + $result->wrong_answer}}</small></label> <br>
                    <a href="{{route('home')}}"  class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection