
$(function() {
    $("#button").click(function() {
        let url = $('#url').val().trim(),
            id = $('#lessons').val().trim(),
            group_id = $('#group').val().trim(),
            subject_id = $('#subject').val().trim(),
            user_id = $('#teacher').val().trim(),
            class_room_id = $('#classRoom').val().trim(),
            lesson = $('#lesson').val().trim(),
            date_event = $('#date').val().trim();
        $.ajax({
            url:url+'/admin/Lessons/'+id,
            type:'PATCH',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: { _method: 'PATCH', 'group_id': group_id, 'subject_id': subject_id,
                'user_id': user_id, 'class_room_id': class_room_id, 'lesson': lesson, 'date_event':date_event},
            dataType: 'json',
            cache: false,
            beforeSend: function(){
                $('#button').prop('disable', true);
            },
            success: function (data) {
                $('#button').prop('disable', false);
                if (data.status == 'true'){
                    $('#true').html('');
                    $('#true').show();
                    setTimeout(function() { $("#true").hide('slow'); }, 3000);
                    $('#true').append(data.msg);
                    console.log(data);
                }else if(data.status == 'false'){
                    $('#false').html('');
                    $('#false').show();
                    setTimeout(function() { $("#false").hide('slow'); }, 3000);
                    $('#false').append(data.msg);
                }
            },
        });
    });
});
