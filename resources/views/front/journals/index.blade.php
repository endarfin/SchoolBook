@extends('template')
@section('content')

            <div class="card">
                <div class="card-header">
                    <div class="float-rigth">
                        <div>Schedule</div>
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
                            <th rowspan="2">Students</th>
                            <th>...</th>
                        </tr>
                        <tr>
                            <th>....</th>
                        </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
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
