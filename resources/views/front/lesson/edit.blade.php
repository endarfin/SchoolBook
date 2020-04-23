@extends('template')
@section('content')

    <form action="{{ route('updateCurrentLesson') }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
    @include('alert')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">Card for edit</div>
                        <div class="float-right">
                            <a class="btn btn-success btn-sm"
                               href="{{ route('showCurrentLesson') }}">Create lesson</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div><b>Group:</b> {{$lesson->groups->name}}</div>
                        <div><b>Subject:</b> {{$lesson->subject->name}}</div>
                        <div><b>Data:</b> @php echo date('d-m-Y', strtotime($lesson->date_event)); @endphp </div>
                        <div><b>Period:</b> {{$lesson->timelessons->time}}</div>
                    </div>
                    @if(!empty($journals))
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>Students</th>
                            <th>  <div> Marks
                                    <button type="submit" class="btn btn-danger btn-sm">Save</button>
                                </div> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <td>{{$journal->users->surname}} {{$journal->users->name}}</td>
                                <td>
{{--                                    <input name=data[mark][] type="text" class="form-control"--}}
{{--                                           value="{{$journal->mark}}">--}}

                                    <select name=data[mark][] id="mark" class="form-control-sm">
                                        <option value="{{$journal->mark}}" selected>{{$journal->mark}}</option>
                                        <option value=" "></option>
                                        <option value="n">n</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                    <input type="hidden" name=data[lessons_id][] value="{{ $journal->lessons_id }}">
                                    <input type="hidden" name=data[student_id][] value="{{ $journal->student_id }}">
                                    <input type="hidden" name=data[id][] value="{{ $journal->id }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @endif

                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
