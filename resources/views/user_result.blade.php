@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User Report') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Sr#') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Correct Answer') }}</th>
                                <th scope="col">{{ __('Wrong Answer') }}</th>
                                <th scope="col">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($response as $respons)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $respons->name }}</td>
                                <td>{{$respons->correct_answer}}</td>
                                <td>{{$respons->wrong_answer}}</td>
                                <td>{{$respons->correct_answer}}/{{$respons->correct_answer + $respons->wrong_answer}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $response->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection