var submit,
    validation_text_ru = eval(lang_form['FORM_CHECK']),
    validation_phone = eval(lang_form['FORM_CHECK_2']),
    validation_email = eval(lang_form['FORM_CHECK_3']);

function initprForm(JS_OBJECT) {
    var prForm = $('.prForm'),
        TEXT_RU = prForm.find('.text-ru'),
        EMAIL = prForm.find('input[name=EMAIL]'),
        PHONE = prForm.find('input[name=PHONE]'),
        PERSONAL_DATA = prForm.find('input[name=confirm-privacy]'),
        UPDATE_CAPTCHA = prForm.find('.update-captcha'),
        BUTTON = prForm.find('button[type=submit]'),
        CAPTCHA_SID = prForm.find('input[name=captcha_sid]'),
        CAPTCHA_IMG = prForm.find('.captcha-img');

    prForm.on('focus', 'input, textarea', function () {
        if ($(this).hasClass('novalid')) $(this).removeClass('novalid');
    })
        .on('change', 'input,select', function () {
            if ($(this).hasClass('novalid')) $(this).removeClass('novalid');
        })
        .on('click', '.update-captcha', function () {
            $.ajax({
                dataType: 'json',
                url: JS_OBJECT.AJAX_CAPTCHA_PATH,
                beforeSend: function () {
                    if (UPDATE_CAPTCHA.hasClass('rotate'))
                        UPDATE_CAPTCHA.removeClass('rotate');
                    else
                        UPDATE_CAPTCHA.addClass('rotate');
                }
            })
                .success(function (data) {
                    CAPTCHA_SID.attr('value', data.RESULT.capCode);
                    CAPTCHA_IMG.attr('src', data.RESULT.capSrc);
                });
        })
        .submit(function (event) {
            submit = true;
            $(this).find('.required').each(function () {
                if ($(this).val() == '') {
                    $(this).addClass('novalid');
                    submit = false;
                }
            });
            PERSONAL_DATA.each(function () {
                validationPersonalData($(this));
            });
            TEXT_RU.each(function () {
                validationField($(this), validation_text_ru);
            });
            PHONE.each(function () {
                validationField($(this), validation_phone);
            });
            EMAIL.each(function () {
                validationField($(this), validation_email);
            });
            if (submit) $(this).ajaxSubmit({
                dataType: 'json',
                data: {DATA: JS_OBJECT},
                beforeSubmit: function () {
                    BUTTON.attr('disabled', 'disabled');
                    BUTTON.text(PRYMERY_SEND_FORM);
                },
                success: function (data) {
                    if (data.ERROR == '') {
                        $(this).clearForm();
                        $.fancybox.close(true);
                        $.fancybox.open($('<div/>', {
                            class: 'success-message',
                            html: '<div class="modal-content text-center"><div class="title">' + JS_OBJECT.TRUE_MESSAGE + '</div><div class="action"><a href="javascript:void(0)" class="close_fancy adp-btn adp-btn--danger adp-btn-lg text-sm font-bold">'+PRYMERY_BACK_FORM+'</a></div></div></div>'
                        }),{padding:0});
                        if (typeof ym !== 'undefined')
                            ym(JS_OBJECT.YA_COUNTER_ID, 'reachGoal', JS_OBJECT.GOAL_METRIKA);
                        if (typeof gtag !== 'undefined')
                            gtag('event', JS_OBJECT.GOAL_ANALITICS, {});
                    }
                    else {
                        $(this).find('input[name=captcha_word]').addClass('novalid');
                    }
                    CAPTCHA_SID.attr('value', data.RESULT.capCode);
                    CAPTCHA_IMG.attr('src', data.RESULT.capSrc);
                    BUTTON.text(JS_OBJECT.BUTTON);
                    BUTTON.attr('disabled', false);
                    $('.close_fancy').on('click',function () {
                        $.fancybox.close(true);
                    })
                }
            });
            event.preventDefault();
        });
    function validationField(object, patern) {
        if (object.val() != '' && object.val() != ' ' && !patern.test(object.val())) {
            object.addClass('novalid');
            submit = false;
        }
    }
    function validationPersonalData(object) {
        if(object.val() != 'on'){
            object.addClass('novalid');
            submit = false;
        }
    }
}