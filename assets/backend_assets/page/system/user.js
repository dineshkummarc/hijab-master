$(document).ready(function(){
    $('#px-system-user-form').validate({
        ignore: [],
        rules: {                                            
            username: {
                required: true,
                remote:
                {
                    url: 'admin_system/user_check_username',
                    type: "post",
                    data:
                    {
                        username: function()
                        {
                            return $('#px-system-user-form #px-system-user-form-username').val();
                        },
                        id : function()
                        {
                            return $('#px-system-user-form #px-system-user-form-id').val();
                        }
                    }
                }
            },
            password: {
                required: true
            },
            confirm_password: {
                equalTo: '#px-system-user-form-password'
            },
            email: {
                required : true,
                email : true,
                remote:
                {
                    url: 'admin_system/user_check_email',
                    type: "post",
                    data:
                    {
                        email: function()
                        {
                            return $('#px-system-user-form #px-system-user-form-email').val();
                        },
                        id : function()
                        {
                            return $('#px-system-user-form #px-system-user-form-id').val();
                        }
                    }
                }
            },
            id_usergroup: {
                required : true
            }
        },
        messages: {
            email:
            {
                required: "Please enter your email address.",
                email: "Please enter a valid email address.",
                remote: jQuery.validator.format("{0} is already taken.")
            },
            username:
            {
                required: "Please enter your username.",
                remote: jQuery.validator.format("{0} is already taken.")
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-system-user-form .alert-warning').removeClass('hidden');
            $('#px-system-user-form .alert-success').addClass('hidden');
            $('#px-system-user-form .alert-danger').addClass('hidden');
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    $('#px-system-user-form .alert-warning').addClass('hidden');
                    if(response.status == 'ok'){
                        $('#px-system-user-form .alert-success').removeClass('hidden').children('span').text(response.msg);
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-system-user-form .alert-danger').removeClass('hidden').children('span').text(response.msg);	
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
    $('#px-system-user-message-form').validate({
        ignore: [],
        rules: {                                            
            id: {
                required: true
            }
        },
        submitHandler: function(form) {
            var target = $(form).attr('action');
            $('#px-system-user-message-form .msg-status').text('Deleting data');
            $.ajax({
                url : target,
                type : 'POST',
                dataType : 'json',
                data : $(form).serialize(),
                success : function(response){
                    if(response.status == 'ok'){
                        $('#px-system-user-message-form .msg-status').text('Delete Success...');
                        window.location.href = response.redirect;
                    }
                    else
                        $('#px-system-user-message-form .msg-status').text('Delete Failed');		
                },
                error : function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus, errorThrown);
                }
            });
        }
    });
    $('.btn-add').click(function(){
        var target_form = $(this).attr('data-target-form');
        $('#px-system-user-form').attr('action',target_form);
        $('#px-system-user-form-id').val('');
        $('#px-system-user-form-username').val('');
        $('#px-system-user-form-password').val('');
        $('#px-system-user-form-confirm-password').val('');
        $('#px-system-user-form-realname').val('');
        $('#px-system-user-form-email').val('');
        $('#px-system-user-form-id-usergroup option').removeAttr('selected');
        $('#px-system-user-modal').modal('show');
    });
    $('body').delegate('.btn-edit','click',function(){
        var target_form = $(this).attr('data-target-form');
        var target = $(this).attr('data-target-get');
        var id = $(this).attr('data-target-id');
        $('#px-system-user-form').attr('action',target_form);
        $.ajax({
            url : target,
            type : 'POST',
            dataType : 'json',
            data : {
                'id':id
            },
            success : function(response){
                $('#px-system-user-form-id').val(response.data.row.id);
                $('#px-system-user-form-username').val(response.data.row.username);
                $('#px-system-user-form-password').val(response.data.row.password);
                $('#px-system-user-form-confirm-password').val(response.data.row.password);
                $('#px-system-user-form-realname').val(response.data.row.realname);
                $('#px-system-user-form-email').val(response.data.row.email);
                $('#px-system-user-form-id-usergroup option[value="'+response.data.row.id_usergroup+'"]').prop('selected',true);
                $('#px-system-user-modal').modal('show');
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert(textStatus, errorThrown);
            }
        });
    });
    $('body').delegate('.btn-delete','click',function(){
        var id = $(this).attr('data-target-id');
        $('#px-system-user-message-form input[name="id"]').val('');
        $('#px-system-user-message-form input[name="id"]').val(id);
        $('#px-system-user-message-box').addClass('open');
    });
    $('#px-system-user-modal').on('hidden.bs.modal', function (e) {
        $('#px-system-user-form').validate().resetForm();
    });
    $('#px-system-user-modal').on('shown.bs.modal', function (e) {
        $('#px-system-user-form').validate().resetForm();
    });
})