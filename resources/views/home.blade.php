@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('save.answer')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <strong>{{$question->question}}?</strong><br>
                                <input type="radio" value="a" name="ans"> : (A)<small style="margin-left: 10px;">{{$question->a}}</small><br>
                                <input type="radio" value="b" name="ans"> : (B)<small style="margin-left: 10px;">{{$question->b}}</small><br>
                                <input type="radio" value="c" name="ans"> : (C)<small style="margin-left: 10px;">{{$question->question}}</small><br>
                                <input type="radio" value="d" name="ans"> : (D)<small style="margin-left: 10px;">{{$question->question}}</small><br>
                                <input hidden name="dbans" value="{{$question->ans}}">
                                <input hidden name="ques_id" value="{{$question->id}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection