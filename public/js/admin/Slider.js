$(document).ready(function () {
    $('#profile-tab').on('click', function () {
        $('.is_published').children().remove();
        let url = $('#url').val().trim();
        $.ajax({
            url: url + '/admin/ajaxSliderProfile/',
            type: 'GET',
            cache: false,
            success: function (data) {
                if (data.status == 'true') {
                    let len = data.result.length;
                    for (let i = 0; i < len; i++) {
                        let www = `<div class="card bg-dark text-white">
                                            <div style="visibility: hidden">${data.result[i].id}</div>
                                            <img src="${url}/${data.result[i].url}" class="card-img">
                                       </div>`;
                        $('.is_published').append(www);
                    }
                } else if (data.status == 'false') {
                    $('#false').html('');
                    $('#false').show();
                    setTimeout(function () {
                        $("#false").hide('slow');
                    }, 3000);
                    $('#false').append(data.msg);
                }
            }
        });
    });

    $('#home-tab').on('click', function () {
        $('.published').children().remove();
        let url = $('#url').val().trim();
        $.ajax({
            url: url + '/admin/ajaxSliderIndex/',
            type: 'GET',
            cache: false,
            success: function (data) {
                if (data.status == 'true') {
                    let len = data.result.length;
                    for (let i = 0; i < len; i++) {
                        let www = `<div class="card bg-dark text-white">
                                            <div style="visibility: hidden">${data.result[i].id}</div>
                                            <img src="${url}/${data.result[i].url}" class="card-img">
                                       </div>`;
                        $('.published').append(www);
                    }
                } else if (data.status == 'false') {
                    $('#false').html('');
                    $('#false').show();
                    setTimeout(function () {
                        $("#false").hide('slow');
                    }, 3000);
                    $('#false').append(data.msg);
                }
            }
        });
    });

    $('.col-md-8').on('mouseenter', 'img', function () {
        let www = ` <div class="card-img-overlay">
                                <button type="button" id="change" class="btn btn-primary btn-lg">Изменить статус</button>
                                <button type="button" id="delete" class="btn btn-secondary btn-lg">Удалить</button>
                            </div>`,
            div = $(this).parent();
        div.append(www);
        let a = $(this).parent().find('.card-img-overlay');
        setTimeout(function () {
            a.remove();
        }, 4000);

        $(this).parent().find('.card-img-overlay').on('click', '#change', function () {
            let id = $(this).parents('.card.bg-dark.text-white').children().first().text(),
                url = $('#url').val().trim(),
                parents = $(this).parents('.published'),
                status = '',
                div = $(this).parents('.card.bg-dark.text-white');
            if (parents.length == 1) {
                status = 1;
            } else {
                status = 0;
            }
            $.ajax({
                url: url + '/admin/Slider/' + id,
                type: 'PATCH',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {_method: 'PATCH', 'change': status},
                dataType: 'json',
                cache: false,
                success: function (data) {
                    if (data.status == 'true') {
                        div.animate({height: "hide"}, 1000, function () {
                            div.remove();
                        });
                    } else if (data.status == 'false') {
                        $('#false').html('');
                        $('#false').show();
                        setTimeout(function () {
                            $("#false").hide('slow');
                        }, 3000);
                        $('#false').append(data.msg);
                    }
                }
            });
        });
        $(this).parent().find('.card-img-overlay').on('click', '#delete', function () {
            let id = $(this).parents('.card.bg-dark.text-white').children().first().text(),
                url = $('#url').val().trim(),
                div = $(this).parents('.card.bg-dark.text-white');
            $.ajax({
                url: url + '/admin/Slider/' + id,
                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {_method: 'DELETE', 'id': id,},
                dataType: 'json',
                cache: false,
                beforeSend: function () {
                    div.prev().prop('disable', true);
                },
                success: function (data) {
                    div.prev().prop('disable', false);
                    if (data.status == 'true') {
                        $('#true').html('');
                        $('#true').show();
                        $('#true').append(data.msg);
                        setTimeout(function () {
                            $("#true").hide('slow');
                        }, 3000);
                        div.animate({height: "hide"}, 1000, function () {
                            div.remove();
                        });
                    } else if (data.status == 'false') {
                        $('#false').html('');
                        $('#false').show();
                        setTimeout(function () {
                            $("#false").hide('slow');
                        }, 3000);
                        $('#false').append(data.msg);
                    }
                }
            });
        });
    });
});
