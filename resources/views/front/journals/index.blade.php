@extends('template')
@section('content')
    @include('alert')
    <div class="container-fluid">
        <div clas="row">
            <div class="card w-100">
                <div class="card-header">
                    <div class="float-left">
                        <div>Journal</div>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-success"
                           href="{{ route('showCurrentLesson') }}">Start lesson</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <form action="{{ route('front.journals.index') }}" class="form-inline">

                            <select name="group_id" id="group_id" class="form-control" required>
                                <option value="" selected>{{ __('Select group') }}</option>
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}"
                                            @if((!empty($group_id)) && ($group->id == $group_id)) selected @endif>{{$group->name}}
                                    </option>
                                @endforeach
                            </select>&nbsp;

                            <select name="subject_id" id="subject_id" class="form-control" required>
                                <option value="">{{ __('Select subject') }} </option>
                                @foreach ($subjects as $subject)
                                    <option
                                        value="{{$subject->id}}"
                                        @if((!empty($subject_id)) && ($subject->id == $subject_id)) selected @endif>{{$subject->name}} </option>
                                @endforeach
                            </select>&nbsp;

                            <input type="date" name="periodBegin" max="2120-12-31"
                                   min="2020-01-01" class="form-control"
                                   @if(!empty($periodBegin)) value="{{$periodBegin}}"
                                   @else value="{{ date('Y-m-d', strtotime("-7 day")) }}" @endif required>&nbsp;

                            <input type="date" name="periodEnd" max="2120-12-31"
                                   min="2020-01-01" class="form-control"
                                   @if(!empty($periodEnd)) value="{{$periodEnd}}"
                                   @else value="{{ date('Y-m-d',(time()+3*60*60)) }}" @endif required>&nbsp;

                            <button type="submit" class="btn btn-outline-info">Select</button>
                        </form>
                        @if(!empty($dates)&&!empty($schedule)&&!empty($users)&&!empty($period))
                        <div class="col">
                            <div class="float-right">
                                <form action="{{ route('front.journals.post') }}" method="post">
                                    @csrf
                                    <button type="submit" name="submit_key" value="back" class="btn btn-outline-primary btn-sm"><<<
                                    </button>
                                    <button type="submit" name="submit_key" value="forward" class="btn btn-outline-primary btn-sm">>>>
                                    </button>
                                    <input type="hidden" name="group_id" value="{{ $group_id }}">
                                    <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                                    <input type="hidden" name="periodBegin" value="{{ $periodBegin }}">
                                    <input type="hidden" name="periodEnd" value="{{ $periodEnd }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <table class="table table-bordered table-hover table-responsive">
                        @php
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>Student</th>';
                                    foreach ($dates as $date) {
                                        echo '<th>'.date_create($date->date_event)->Format('d.m').' №'.$date->lesson.'</th>';
                                    }
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                foreach ($schedule as $key => $value) {
                                    echo '<td>'.$users[$key].'</td>';
                                    foreach ($value as $key1 =>$value1) {
                                        for ($i = 0; $i < count($period); $i++) {
                                            if ((array_key_exists($period[$i],$value1)) && (!empty($value1[$period[$i]]))) {
                                                echo '<td>'.$value1[$period[$i]].'('.$period[$i].')'.'</td>';
                                            }
                                            elseif ((array_key_exists($period[$i],$value1)) && (empty($value1[$period[$i]]))) {
                                                echo '<td></td>';
                                            }
                                            elseif (!(array_key_exists($period[$i],$value1))) { continue; }
                                        }
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
@endsection
