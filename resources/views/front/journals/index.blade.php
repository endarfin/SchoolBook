@extends('template')
@section('content')
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-danger" role="alert">
                    <button type="submit" class="close" data-dismiss="alert" aria-label="Close">
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
                        <div>Journal</div>
                    </div>
                    <div class="float-right">
                        <div>
                            <form action="{{ route('front.journals.post') }}" method="post">
                                @csrf
                                <button type="submit" name ='delta1' value="{{5}}" class="btn btn-outline-dark btn-sm"><<<</button>
                                <button type="submit" name ='delta2' value="{{5}}" class="btn btn-outline-dark btn-sm" >>>></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-title">
                    </div>
                    <form action="{{ route('front.journals.index') }}">
                        <div class="form-row">
                            <div class="col">

                                <select name="group_id" id="group_id" class="custom-select" required>
                                    <option value="" selected>{{ __('Select group') }}</option>
                                    @foreach ($groups as $group)
                                        <option value="{{$group->id}}"
                                                @if((!empty($group_id)) && ($group->id == $group_id)) selected @endif>{{$group->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="subject_id" id="subject_id" class="custom-select" required>
                                    <option value="">{{ __('Select subject') }} </option>
                                    @foreach ($subjects as $subject)
                                        <option
                                            value="{{$subject->id}}"
                                            @if((!empty($subject_id)) && ($subject->id == $subject_id)) selected @endif>{{$subject->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <input type="date" name="periodBegin" max="2120-12-31"
                                       min="2020-01-01" class="form-control"
                                       @if(!empty($periodBegin)) value="{{$periodBegin}}" @else value="{{ date('Y-m-d', strtotime("-7 day")) }}" @endif required>

                            </div>
                            <div class="col">
                                <input type="date" name="periodEnd" max="2120-12-31"
                                       min="2020-01-01" class="form-control"
                                       @if(!empty($periodEnd)) value="{{$periodEnd}}" @else value="{{ date('Y-m-d',(time()+3*60*60)) }}" @endif required>

                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-info">Select
                                </button>
                                <br>
                            </div>
                        </div>
                    </form>
                    <br>
                    @if(!empty($days)&&!empty($day)&&!empty($schedule)&&!empty($users))
                        <table class="table table-bordered table-hover table-responsive">
                            @php
                                echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Student</th>';
                                    for ($i = 0; $i < $days; $i++) {

                                        echo '<th>'.date_create($day[$i])->Format('d.m').'</th>';
                                    }
                                    echo '</tr>';
                                echo '</thead>';
                                    echo '<tbody>';
                                        foreach ($schedule as $key => $value) {
                                            echo '<td>'.$users[$key].'</td>';
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
