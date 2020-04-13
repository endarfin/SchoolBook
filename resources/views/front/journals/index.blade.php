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
                            <th>Id</th>
                            <th>Data</th>
                            <th>Mark</th>
                            <th>Students</th>
                            <th>Groups</th>
                            <th>Subjects</th>

                        </tr>


                        </thead>
                        <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <th scope="row">{{ $journal->id }}</th>
                                <td>{{ $journal->date }}</td>
                                <td>{{ $journal->mark }}</td>
                                <td>{{ $journal->NameStudent }}</td>
                                <td>{{ $journal->NameGroup }}</td>
                                <td>{{ $journal->subjects}}</td>

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
