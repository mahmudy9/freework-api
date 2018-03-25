
function delete_job(url , id)
{
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#modall').modal('show');

    $('#savebtn').click(function(e){
        e.preventDefault();

        $.ajax({
            type : 'POST',
            
            url: url+'/'+id,

            data: {},

            success : function()
                        {
                            $('#modall').modal('hide');
                            $('#'+id).remove();
                        },

            error : function()
                        {
                            $('#modall').modal('hide');
                            alert('error occured');
                        }
        });
    })
}


function applyforjob(url, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#modall').modal('show');

    $('#savebtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',

            url: url + '/' + id,

            data: {},

            success: function () {
                $('#' + id).replaceWith('<p>You applied for job</p>');
            },

            error: function () {
                alert('error occured');
            }
        });
    })
}


function approvejob(url , id)
{
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#modal2').modal('show');
    $('#savebtn').click(function(e){
        e.preventDefault();
    
        $.ajax({
            type: 'POST',
            
            url : url+'/'+id,

            data: {},

            success : function()
                        {
                            $('#modal2').modal('hide');
                            $('#'+id).remove();
                        },

            error : function()
                        {
                            $('#modal2').modal('hide');
                            alert('error occured');
                        }
        });
    });
}


function disapprovejob(url , id)
{


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#modal2').modal('show');
    $('#savebtn').click(function(e){
        e.preventDefault();
    
        $.ajax({
            type: 'POST',

            url: url + '/' + id,

            data: {},

            success: function () {
                $('#modal2').modal('hide');
                $('#' + id).remove();
            },

            error: function () {
                $('#modal2').modal('hide');
                alert('error occured');
            }
        });
    });
}



function refuse_request(url , id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#modall').modal('show');
    $('#savebtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',

            url: url + '/' + id,

            data: {},

            success: function () {
                $('#modall').modal('hide');
                $('#' + id).remove();
            },

            error: function () {
                $('#modall').modal('hide');
                alert('error occured');
            }
        });
    });
}


function cancel_request(url, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#modall').modal('show');
    $('#savebtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',

            url: url + '/' + id,

            data: {},

            success: function () {
                $('#modall').modal('hide');
                $('#' + id).remove();
            },

            error: function () {
                $('#modall').modal('hide');
                alert('error occured');
            }
        });
    });
}


function delete_contact(url , id)
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#modal2').modal('show');
    $('#savebtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',

            url: url + '/' + id,

            data: {},

            success: function () {
                $('#modal2').modal('hide');
                $('#' + id).remove();
            },

            error: function () {
                $('#modal2').modal('hide');
                alert('error occured');
            }
        });
    });
}