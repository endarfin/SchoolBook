
@foreach($groupSubjects as $subject)
    <option value="{{$subject->subject_id}}" {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}> {{$subject->Subject->name}}</option>
@endforeach
