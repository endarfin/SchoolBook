@extends('template')
@section('content')

{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <div class="float-rigth">--}}
{{--                        <div>Journal</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="card-title">--}}
{{--                        <div>Subject: {{$lesson->subject->name}}</div>--}}
{{--                        <div>Group: {{$lesson->groups->name}}</div>--}}
{{--                    </div>--}}
{{--                    <table class="table table-bordered table-hover">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th rowspan="2">Student's List</th>--}}
{{--                            <th colspan="2">{{date("Y-m-d H:i", $lesson->date_event)}}</th>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>Attend</th>--}}
{{--                            <th>Marks</th>--}}
{{--                        </tr>--}}

{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($journals as $journal)--}}
{{--                            <tr>--}}
{{--                                <th scope="row">{{$journal->studentSurname }} {{ $journal->studentName}}</th>--}}
{{--                                <td>{{ $journal->exist}}</td>--}}
{{--                                <td>{{ $journal->mark}}</td>--}}

{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <br>--}}

{{--            <div class="float-right">--}}
{{--                <a class="btn btn-outline-info btn-sm"--}}
{{--                   href="{{ route('admin.users.index') }}">Back</a>--}}
{{--                <button type="submit" class="btn btn-outline-info btn-sm">Save</button>--}}
{{--            </div>--}}

@endsection
