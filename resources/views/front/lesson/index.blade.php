@extends('template')
@section('content')
    <div class="container-fluid">
        <div clas="row">
            <div class="card w-100">
                <div class="card-header">
                    <div class="float-left">
                        <div>Journal</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class = "card-title">
                    <div class="form-row">
                        <form action="{{ route('showCurrentLesson') }}" class="form-inline">

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

                            <select name="number" id="number" class="form-control" required>
                                <option value="">{{ __('Select lesson') }} </option>
                                @foreach ($lessons as $lesson)
                                    <option
                                        value="{{$lesson->number}}"
                                        @if((!empty($lesson_number)) && ($lesson->number == $lesson_number)) selected @endif>№ {{$lesson->number}} : {{$lesson->time}} </option>
                                @endforeach
                            </select>&nbsp;

                            <button type="submit" class="btn btn-danger">Select</button>
                        </form>
                    </div>
                </div>
                </div>
                <table class="table table-bordered table-hover table-responsive">

                </table>

            </div>
        </div>
    </div>
@endsection
