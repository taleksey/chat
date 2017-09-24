$('document').ready(function () {
    var alertMessage = $('#alert-message'),
        createUser = $('#create-user'),
        createMessage = $('#create-message')
    ;
    $(document).on("beforeSubmit", "#create-user", function () {
        var form = $(this);
        if (form.find('.has-error').length)
        {
            return false;
        }

        $.post(form.attr('action'), form.serialize())
            .done(function (data) {
                if (alertMessage.is('visible')) {
                    alertMessage.hide();
                }

                if (data.success) {
                    form.hide();
                    createMessage.show();
                    var tableNickList = $('#table-nick-list');
                    tableNickList.find('tr.list-group-item-info').removeClass('list-group-item-info');
                    if (data.create) {
                        tableNickList.append('<tr class="list-group-item-info" id="user-' + data.user.id +'"><td>' + data.user.nick + '</td><td>' + data.user.city +'</td></tr>')
                    } else {
                        tableNickList.find('#user-' + data.user.id).addClass('list-group-item-info');
                    }
                }
            })
            .fail(function (data) {
                alertMessage.html(data.responseText).show();
            })
        ;

        return false; // Cancel form submitting.
    });

    $(document).on("beforeSubmit", "#form-create-message", function () {
        var form = $(this), tableMessageList = $('#table-message-list'), height;
        if (form.find('.has-error').length){
            return false;
        }

        $.post(form.attr('action'), form.serialize())
            .done(function (data) {
                if (data.success) {
                    tableMessageList.append('<tr><td class="col-md-3 nick-message">' +
                        '<span><strong>' + data.chat.nick + '</strong></span></td>' +
                        '<td class="col-md-9"><p><strong>'  + data.chat.createdTime + '</strong></p>' + data.chat.message +
                    '</td></tr>');
                    $('html, body').animate({scrollTop: $("#table-message-list").get(0).scrollHeight}, 2000);
                    CKEDITOR.instances['chat-message'].setData('');
                }
            })
            .fail(function (data) {
                if (data.status === 403) {
                    createUser.show();
                    createMessage.hide();
                }
            })
        ;

        return false;
    });
});