@extends('template')
@section('content')

            <div class="card">
                <div class="card-header">
                    <div class="float-rigth">
                        <div>Journal</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <div>Subject:</div>
                        <div>Group:</div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Groups</th>
                            <th>StudentsName</th>
                            <th>StudentsSurename</th>
                            <th>Mark</th>

                        </tr>


                        </thead>
                        <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <th scope="row">{{ $journal->date }}</th>
                                <td>{{ $journal->group }}</td>
                                <td>{{ $journal->studentName }}</td>
                                <td>{{ $journal->studentSurename }}</td>
                                <td>{{ $journal->mark}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>

            <div class="float-right">
                <a class="btn btn-outline-info btn-sm"
                   href="{{ route('admin.users.index') }}">Back</a>
                <button type="submit" class="btn btn-outline-info btn-sm">Save</button>
            </div>

@endsection
