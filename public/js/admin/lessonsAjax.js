
$(function() {
    $('#group').click(function() {
        $('#subject').find('option').remove(); //удаление старых данных
        $('#teacher').find('option').remove(); //удаление старых данных
        $('#subject').html('<option>Не выбрано</option>');
        $('#teacher').html('<option>Не выбрано</option>');
    });
});

$(function() {
    $("#group").change(function() {
        let subjects = $(this).val();
        $.ajax({
            type:'POST',
            url:'/ajaxGroupSubjects',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: 'id='+subjects,
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('#subject').append(data.view);
            },
        });
    });
});


$(function() {
    $('#subject').click(function() {
        $('#teacher').find('option').remove(); //удаление старых данных
        $('#teacher').html('<option>Не выбрано</option>');
    });
    $("#subject").change(function() {
        let teacher = $(this).val();
        $.ajax({
            type:'POST',
            url:'/ajaxTeachersSubjects',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            data: 'id='+teacher,
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('#teacher').append(data.view);
            },
        });
    });
});


