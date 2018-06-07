 /* ============================================================
 * jquery.validate.binding.js 第三方注册绑定验证
 * ============================================================
 * Copyright 74cms.
 * ============================================================ */

(function($) {
    'use strict';

    var verifyPhoto = false;
    // 注册时检测手机号是否存在
    var regularMobile = qscms.regularMobile;
    $('.J_regcontent_box input[name=mobile]').keyup(function () {
        var currentValue = $(this).val();
        if (currentValue.length == 11) {
            if(regularMobile.test(currentValue) && !remoteValid(currentValue,this)) {
                disapperTooltip("remind", "该手机号已存在！");
                $('#J_getverificode').addClass('btn_disabled').prop('disabled', !0);
            } else {
                $('#J_getverificode').removeClass('btn_disabled').prop('disabled', 0);
            }
        } else {
            $('#J_getverificode').removeClass('btn_disabled').prop('disabled', 0);
        }
    });
    // 检测账号是否存在
    function remoteValid(value, element) {
        var result = false, eletype = element.name;
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=ajax_check',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { type: eletype, param: value },
            success: function(json) {
                if (json && json.status) {
                    result = true;
                } else {
                    result = false;
                }
            }
        });
        return result;
    }
    // 获取验证码
    $('#J_getverificode').die().live('click', function () {
        var mobileValue = $.trim($('.J_regcontent_box input[name=mobile]').val());
        if (mobileValue == '') {
            disapperTooltip("remind", "请输入手机号码");
            $('.J_regcontent_box input[name=mobile]').focus();
            return false;
        }
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            disapperTooltip("remind", "请输入正确的手机号码");
            $('.J_regcontent_box input[name=mobile]').focus();
            return false;
        }
        if (eval(qscms.smsTatus)) {
            if (eval(qscms.varify_mobile) && eval(qscms.captcha_open)) {
                $('.geetest_panel').remove();
                $.ajax({
                    url: qscms.root+'?m=Home&c=captcha&t=' + (new Date()).getTime(),
                    type: "get",
                    dataType: "json",
                    success: function (data) {
                        initGeetest({
                            gt: data.gt,
                            challenge: data.challenge,
                            offline: !data.success,
                            new_captcha: data.new_captcha,
                            product: 'bind'
                        }, function(captchaObj) {
                            captchaObj.appendTo("#bindCaptchaBox");
                            captchaObj.onSuccess(function() {
                                var captChaResult = captchaObj.getValidate();
                                $('#J_getverificode').val('发送中...').addClass('btn_disabled').prop('disabled', !0);
                                var mobileValue = $.trim($('.J_regcontent_box input[name=mobile]').val());
                                $.ajax({
                                    url: qscms.root + '?m=Home&c=Members&a=reg_send_sms',
                                    cache: false,
                                    async: false,
                                    type: 'post',
                                    dataType: 'json',
                                    data: { mobile: mobileValue,geetest_challenge: captChaResult.geetest_challenge,geetest_validate: captChaResult.geetest_validate,geetest_seccode: captChaResult.geetest_seccode},
                                    success: function(result) {
                                        if (result.status) {
                                            disapperTooltip("success", "验证码已发送，请注意查收");
                                            // 开始倒计时
                                            var countdown = 180;
                                            function settime() {
                                                if (countdown == 0) {
                                                    $('#J_getverificode').val('获取验证码').removeClass('btn_disabled').prop('disabled', 0);
                                                    countdown = 180;
                                                    return;
                                                } else {
                                                    $('#J_getverificode').val('重新发送' + countdown + '秒').addClass('btn_disabled').prop('disabled', !0);
                                                    countdown--;
                                                }
                                                setTimeout(function() {
                                                    settime()
                                                },1000)
                                            }
                                            settime();
                                        } else {
                                            $('#J_getverificode').val('获取验证码').removeClass('btn_disabled').prop('disabled', 0);
                                            disapperTooltip("remind", result.msg);
                                        }
                                    }
                                });
                            });
                            captchaObj.onReady(function () {
                                $("#btnBindCheck").click();
                            });
                            $('#btnBindCheck').click(function () {
                                captchaObj.verify();
                            })
                            captchaObj.getValidate();
                        });
                    },
                    error:function(data){
                        disapperTooltip("remind", data['responseText']);
                    }
                });
            } else {
                topSendSms();
            }
        } else {
            disapperTooltip("remind", "短信未开启");
        }
    })
    // 发送验证码
    function topSendSms() {
        $('#J_getverificode').val('发送中...').addClass('btn_disabled');
        var mobileValue = $.trim($('.J_regcontent_box input[name=mobile]').val());
        $.ajax({
            url: qscms.root + '?m=Home&c=Members&a=reg_send_sms',
            cache: false,
            async: false,
            type: 'post',
            dataType: 'json',
            data: { mobile: mobileValue},
            success: function(result) {
                if (result.status) {
                    disapperTooltip("success", "验证码已发送，请注意查收");
                    // 开始倒计时
                    var countdown = 180;
                    function settime() {
                        if (countdown == 0) {
                            $('#J_getverificode').val('获取验证码').removeClass('btn_disabled').prop('disabled', 0);
                            countdown = 180;
                            return;
                        } else {
                            $('#J_getverificode').val('重新发送' + countdown + '秒').addClass('btn_disabled').prop('disabled', !0);
                            countdown--;
                        }
                        setTimeout(function() {
                            settime()
                        },1000)
                    }
                    settime();
                } else {
                    $('#J_getverificode').val('获取验证码').removeClass('btn_disabled').prop('disabled', 0);
                    disapperTooltip("remind", result.msg);
                }
            }
        });
    }
    // 注册验证
    $('#btnBindRegister').die().live('click', function () {
        var mobileValue = $.trim($('.J_regcontent_box input[name=mobile]').val());
        var mobileCodeValue = $.trim($('.J_regcontent_box input[name=mobile_vcode]').val());
        if (mobileValue == '') {
            disapperTooltip("remind", "请输入手机号码");
            $('.J_regcontent_box input[name=mobile]').focus();
            return false;
        }
        if (mobileValue != "" && !regularMobile.test(mobileValue)) {
            disapperTooltip("remind", "请输入正确的手机号码");
            $('.J_regcontent_box input[name=mobile]').focus();
            return false;
        }
        if (mobileCodeValue == '') {
            disapperTooltip("remind", "请输入手机验证码");
            $('.J_regcontent_box input[name=mobile_vcode]').focus();
            return false;
        }
        var dataValue = {mobile: mobileValue, mobile_vcode: mobileCodeValue, utype: $('.J_u_type').val(), reg_type: $('.J_regcontent_box input[name=reg_type]').val(),org:$('.J_regcontent_box input[name="org"]').val()};
        if ($('.J_u_type').val() == '1') {
            var companyNameValue = $.trim($('.J_regcontent_box input[name=companyname]').val());
            var contactValue = $.trim($('.J_regcontent_box input[name=contact]').val());
            if (companyNameValue == '') {
                disapperTooltip("remind", "请输入企业名称");
                $('.J_regcontent_box input[name=companyname]').focus();
                return false;
            }
            if (contactValue == '') {
                disapperTooltip("remind", "请输入企业联系人");
                $('.J_regcontent_box input[name=contact]').focus();
                return false;
            }
            dataValue['companyname'] = companyNameValue;
            dataValue['contact'] = contactValue;
        }
        if(eval($('.J_regcontent_box input[name="register_password_open"]').val())){
            var password = $.trim($('.J_passwordalert_group input[name=password]').val());
            var passwordVerify = $.trim($('.J_passwordalert_group input[name=passwordVerify]').val());
            if (password == '') {
                disapperTooltip("remind", "请输入帐户密码");
                $('.J_passwordalert_group input[name=password]').focus();
                return false;
            }
            if (passwordVerify == '') {
                disapperTooltip("remind", "请输入确认密码");
                $('.J_passwordalert_group input[name=passwordVerify]').focus();
                return false;
            }
            if(password.length<6 || password.length>16){
                disapperTooltip("remind", "密码长度要求为6-16个字符");
                $('.J_passwordalert_group input[name=password]').focus();
                return false;
            }
            if(password != passwordVerify){
                disapperTooltip("remind", "两次输入的密码不一致");
                $('.J_passwordalert_group input[name=passwordVerify]').focus();
                return false;
            }
            dataValue['password'] = password;
            dataValue['passwordVerify'] = passwordVerify;
        }
        $('#btnBindRegister').val('注册中...').prop('disabled', !0);
        $.ajax({
            url: qscms.root+'?m=Home&c=Members&a=register',
            type: 'POST',
            dataType: 'json',
            data: dataValue,
            success: function (data) {
                if(data.status == 1){
                    window.location.href = data.data.url;
                }else{
                    $('#btnBindRegister').val('立即注册').prop('disabled', 0);
                    disapperTooltip("remind", data.msg);
                }
            },
            error:function(data){
                $('#btnBindRegister').val('立即注册').prop('disabled', 0);
                disapperTooltip("remind", data.msg);
            }
        });
    })
})(jQuery);