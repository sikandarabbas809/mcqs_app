@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
                <div class="card-header">{{ __('Question') }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ __('Add Question') }}</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('QUESTION No') }}</th>
                                <th scope="col">{{ __('QUESTION') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($response as $respons)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $respons->question }}</td>
                                <td>
                                    <form action="{{ route('questions.delete',$respons->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this employee?') }}')">{{ __('Delete') }}</button>
                                    </form>
                                </td>
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


<!---- START ADD QUESTION MODEL ---->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question</label>
                                <input type="text" name="question" class="form-control" placeholder="Enter Question" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>A</label>
                                <input type="text" name="opt_a" class="form-control" placeholder="Enter Option A" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>B</label>
                                <input type="text" name="opt_b" class="form-control" placeholder="Enter Option B" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>C</label>
                                <input type="text" name="opt_c" class="form-control" placeholder="Enter Option C" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>D</label>
                                <input type="text" name="opt_d" class="form-control" placeholder="Enter Option D" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Correct Answer</label>
                                <select class="form-control" name="correct_ans" required>
                                    <option value="">Select Correct Answer</option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!----- END MODEL ------->
@endsection