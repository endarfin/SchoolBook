$(document).ready(function () {

    $('#type').change(function() {
        if($(this).val() === "2")
        {
            $("tr#subj").show();
            $("tr#group").hide();
        }
        if($(this).val() === "1")
        {
            $("tr#group").show();
            $("tr#subj").hide();
        }
        if($(this).val() === "3")
        {
            $("tr#group").hide();
            $("tr#subj").hide();
        }

    });
});
