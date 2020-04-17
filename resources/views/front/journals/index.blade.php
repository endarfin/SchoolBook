@extends('template')
@section('content')
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {!! $errors->first() !!}
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">
        <div clas="row">
            <div class="card w-100">
                <div class="card-header">
                    <div class="float-left">
                        <div>Journal TODAY: {{ date('d-m-Y') }}</div>
                    </div>
                    <div class="float-right">
                        <div>
                        <a class="btn btn-outline-danger btn-sm"
                           href="{{ route('admin.users.index') }}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title">
                    </div>
                    <form action="{{ route('front.journals.index') }}">
                        <div class="form-row">
                            <div class="col">

                                <select name="group_id" id="groups" class="custom-select" method="post" required>
                                    <option value="" selected>{{ __('Select group') }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="subject_id" id="subjects" class="custom-select" required>
                                    <option value="" selected>{{ __('Select subject') }}</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-info">Select
                                </button>
                                <br>
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(!empty($_GET))
                        <div>Group: {{$groupName}}</div>
                        <div>Subject: {{$subjectName}}</div>

                        <table class="table table-bordered table-hover table-responsive">
                            @php
                                echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Student</th>';
                                    for ($i = 0; $i < $days; $i++) {
                                        echo '<th>'.date("Y-m-d H:i:s", $day[$i]).'</th>';
                                    }
                                    echo '</tr>';
                                echo '</thead>';
                                    echo '<tbody>';
                                        foreach ($schedule as $key => $value) {
                                            echo '<td>'.$user[$key].'</td>';
                                            for ($i = 0; $i < $days; $i++) {
                                                if (empty($value[$day[$i]])) {
                                                    echo '<td> </td>';
                                                } else echo '<td>'.$value[$day[$i]].'</td>';
                                            }
                                            echo "</tr>";
                                        }
                                        echo '</tbody>';
                            @endphp
                        </table>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
