
@foreach($teachers as $teacher)
    <option value="{{$teacher->user_id}}" {{ old('user_id') == $teacher->user_id ? 'selected' : '' }}>
        {{$teacher->user->name}} {{$teacher->user->surname}}</option>
@endforeach
