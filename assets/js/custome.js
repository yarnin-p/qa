$(document).ready(function () {
    
    /* Avtice Menu*/
    $("#menu_" + active_menu).addClass('active');
    $("#menu-no-sub__" + active_menu).addClass('active');
    // $("#menu_" + active_menu).parent().addClass('active');
    $("#menu_" + active_menu).parent().parent().addClass('open');




    /* Tooltip mouse hover */
    $('[data-toggle="tooltip"]').tooltip({placement: "top", html: true});

    $('[rel="popover"]').popover({
        container: 'body',
        placement: "bottom",
        html: true,
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
            return clone;
        }
    }).click(function (e) {
        // e.preventDefault();
    });

    /* Modal delete */
    $('.btn_delete').click(function () {
        $('#delete_link').val($(this).attr('data-href'));
        if ($(this).attr('disabled') != 'disabled') {
            $('#modal_delete').modal('show');
        }
    });

    $('#confirm_delete').click(function () {
        var link = $('#delete_link').val();
        if (link != '') {
            window.location.href = link;
        }
    });

    $('#btn_modal_success').click(function () {
        var cur_url = window.location.href;
        var url_arr = cur_url.split("#");
        window.location.href = url_arr[0];
    });

    $('#btn_modal_fail').click(function () {
        var cur_url = window.location.href;
        var url_arr = cur_url.split("#");
        window.location.href = url_arr[0];
    });

    /* Modal success */
    if (window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        if (hash === "save_complete") {
            $('#modal_success').modal('show');
        }

        if (hash === "save_fail") {
            $('#modal_fail').modal('show');
        }

        // hash found
    }

    $("#btn_advanced_search").click(function () {
        $("#advanced_search").slideToggle("slow", function () {
            if ($("#advanced_search").is(':hidden')) {
                console.log('is hide');
                $(".form_search .input-group .input-sm").removeAttr("disabled");
                $(".form_search .input-group .btn-sm").removeAttr("disabled");
                $('input[name=search_type]').val(0)
            } else {
                console.log('is show');
                $(".form_search .input-group .input-sm").attr("disabled", "");
                $(".form_search .input-group .btn-sm").attr("disabled", "");
                $('input[name=search_type]').val(1)
            }
        });
    });

    $('.input-list').keypress(function (e) {
        var keycode = e.keyCode || e.which;
        if (keycode == '13') {
            var url = $(this).attr('data-href');
            var id = $(this).attr('data-id');
            var key = $(this).attr('data-key');
            var value = $(this).val();
            var index = $('.input-list').index(this) + 1;
            update_input(url, id, key, value, index);
        }
    });

    $('.input-list').focusout(function () {
        var url = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        var key = $(this).attr('data-key');
        var value = $(this).val();
        var input = $('input[data-id=' + id + ']');

        update_input_out_focus(url, id, key, value, input);
    });

    $('.input-list').keyup(function (e) {
        if (e.keyCode == 27) {
            $(this).blur();
        }

        if (e.keyCode == 9) {
            e.preventDefault();

            var tabindex = $(this).attr('tabindex');
            var SearchInput = $(this);
            SearchInput.val(SearchInput.val());
            var strLength = SearchInput.val().length;
            SearchInput.focus();
            SearchInput[0].setSelectionRange(strLength, strLength);
        }
    });

    // goto top
    if ($('.back-to-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.back-to-top').addClass('show');
                } else {
                    $('.back-to-top').removeClass('show');
                }
            };

        backToTop();

        $(window).on('scroll', function () {
            backToTop();
        });

        $('.back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 500);
        });
    }

    /* focus first input page index after insert */
    if (state_insert_row == '1') {
        $('.table-striped').find('input:first').focus();
    }

});

$(document).on('change', '#limit', function () {
    var url = updateQueryStringParameter(window.location.href, 'limit', $(this).val());
    window.location = updateQueryStringParameter(url, 'page', 1);
});

$(document).on('click', '.get_all_data', function () {
    var link = $(this).attr('data-href');
    window.location.href = link;
});

/* Insert And Update Save Form*/
function save_form() {
    $("#dataForm").removeAttr("onsubmit");
    $("#dataForm").ajaxForm({
        dataType: 'json',
        beforeSubmit: function () {
            $.LoadingOverlay("show", {
                zIndex: 9999
            });
        },
        success: function (data) {
            if (data === 'success') {
                $.LoadingOverlay("hide");
                window.location.href = url_ajax + "#save_complete";
            } else {
                console.log(data);
            }
        }
    });
}

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}

function change_status(obj, id) {
    var status = '0';
    if (obj.checked) {
        status = '1';
    }

    $.get(url_ajax + 'change_status/' + id + '/' + status, function () {
        console.log("change status success.");
    });
}

function change_status_school_type(obj, id) {
    var status = '0';
    if (obj.checked) {
        status = '1';
    }

    $.get(url_ajax + 'change_status_school_type/' + id + '/' + status, function () {
        console.log("change status success.");
    });
}

function change_status_school(obj, id) {
    var status = '0';
    if (obj.checked) {
        status = '1';
    }

    $.get(url_ajax + 'change_status_school/' + id + '/' + status, function () {
        console.log("change status success.");
    });
}


function change_status_video(obj, id) {
    var status = '0';
    if (obj.checked) {
        status = '1';
    }

    $.get(url_ajax + 'change_status_video/' + id + '/' + status, function () {
        console.log("change status success.");
    });
}

function change_status_exam(obj, id) {
    var status = '0';
    if (obj.checked) {
        status = '1';
    }

    $.get(url_ajax + 'change_status_exam/' + id + '/' + status, function () {
        console.log("change status success.");
    });
}

function choice_img(files_id) {
    $("#" + files_id).click();
}

function preview_image(event, obj) {
    var output = document.getElementById('show_' + obj.id);
    output.src = URL.createObjectURL(event.target.files[0]);
}

function update_input(url, id, key, value, index) {
    $.LoadingOverlay("show", {
        zIndex: 9999
    });
    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id,
            key: key,
            value: value
        },
        dataType: "json",
        success: function (response) {
            $.LoadingOverlay("hide");
            var tabindex = $('.input-list').eq(index).attr('tabindex');
            var SearchInput = $('input[tabindex=' + tabindex + ']');
            SearchInput.val(SearchInput.val());
            var strLength = SearchInput.val().length;
            SearchInput.focus();
            SearchInput[0].setSelectionRange(strLength, strLength);
        }
    });
}

function update_input_out_focus(url, id, key, value, input) {
    $.LoadingOverlay("show", {
        zIndex: 9999
    });

    $.ajax({
        url: url,
        type: "GET",
        data: {
            id: id,
            key: key,
            value: value
        },
        dataType: "json",
        success: function (response) {
            $.LoadingOverlay("hide");
        }
    });
}

function choice_file(id) {
    $("#" + id).click();
}

function getFileData(obj) {
    var file = obj.files[0];
    if (typeof file !== "undefined") {
        $("#file_name_" + obj.id).val(file.name);
        $("#file_name_" + obj.id).parent().parent().parent().removeClass('has-error')
        $("#file_name_" + obj.id + '-error').remove();
    } else {
        $("#file_name_" + obj.id).val('');
    }
}

/* ctrl+i Insert Data */
document.onkeydown = insert_row;
function insert_row(e) {
    var evtobj = window.event ? event : e
    if (evtobj.keyCode == 73 && evtobj.ctrlKey) {
        $.LoadingOverlay("show", {
            zIndex: 9999
        });

        $.ajax({
            url: url_ajax + "/insert_row",
            type: "GET",
            dataType: "json",
            success: function (response) {
                window.location.reload();
            }
        });
    }
}

// Validate tap multi language
function validate_tap(element) {
    $(element).click(function () {
        var isValid = false;
        $("#dataForm input[type='text'], #dataForm input[type='file'], #dataForm input[type='email'], #dataForm input[type='number'], #dataForm input[type='url'], #dataForm textarea, #dataForm select").each(function (index) {
            if (typeof $(this).attr("data-rule-required") !== "undefined") {
                var elm_id = $(this).attr("id");
                console.log(elm_id);
                var tab_cur = $("#" + elm_id).parent().parent().parent().attr('id');
                console.log(tab_cur);
                if ($("#" + elm_id).val() === "") {
                    var error_msg = '<span id="' + elm_id + '-error" class="help-block">' + $("#" + elm_id).attr("data-msg-required") + '</span>';
                    if ($("#" + elm_id).parent().attr("class") !== "has-error") {
                        $("#" + elm_id).parent().addClass("has-error");
                    }
                    if ($("#" + elm_id).next().attr("class") !== "help-block") {
                        $("#" + elm_id).after(error_msg);
                    }
                    $('.tab-th li').removeClass('active');
                    $('#dataForm .tab-content .tab-pane').removeClass('in active');

                    $('#' + tab_cur).addClass('in active');
                    $("a[href='#" + tab_cur + "']").parent().addClass('has-error');

                    $("#" + elm_id).focus();

                    isValid = true;
                }
            }
            $("#" + elm_id).keyup(function () {
                if ($("#" + elm_id).val() != "") {
                    $("#" + elm_id).parent().removeClass("has-error");
                    $("a[href='#" + tab_cur + "']").parent().removeClass("has-error");
                    $("a[href='#" + tab_cur + "']").parent().addClass("active");
                    $("#" + elm_id).next().remove('.help-block');
                    isValid = false;
                }
            });

            /*$("#" + elm_id).change(function () {
             $("#" + elm_id).parent().find(".text-danger-required").remove();

             isValid = false;
             });*/


            if (isValid) {
                return false;
            }
        });

        if (!isValid) {
            $("#dataForm").submit();
        }
    });


}



function update_sort(val){
    var order = $("#sort_no_"+val).val();
    var data = { product_id:val , order:order }
    $.ajax({
        url: url_ajax + 'update_sort_no',
        type: "post",
        async: false,
        data: data,
        dataType:"json",
        success: function (res) {
        }
    });

    //window.location.reload(true);
    window.location.href =window.location.href;
}


// Validate tap cat
function validate_tap_cat(element) {
    console.log(element);
    $(element).click(function () {
        var isValid = false;
        $("#dataForm input[type='text'], #dataForm input[type='file'], #dataForm input[type='email'], #dataForm input[type='number'], #dataForm input[type='url'], #dataForm textarea, #dataForm select").each(function (index) {
            if (typeof $(this).attr("data-rule-required") !== "undefined") {
                var elm_id = $(this).attr("id");
                console.log(elm_id);
                var tab_cur = $("#" + elm_id).parent().parent().parent().parent().attr('id');
                console.log(tab_cur);
                if ($("#" + elm_id).val() === "") {
                    var error_msg = '<span id="' + elm_id + '-error" class="help-block">' + $("#" + elm_id).attr("data-msg-required") + '</span>';
                    if ($("#" + elm_id).parent().parent().attr("class") !== "has-error") {
                        $("#" + elm_id).parent().parent().addClass("has-error");
                    }
                    if ($("#" + elm_id).next().attr("class") !== "help-block") {
                        $("#" + elm_id).after(error_msg);
                    }
                    $('.tab-th li').removeClass('active');
                    $('#dataForm .tab-content .tab-pane').removeClass('in active');

                    $('#' + tab_cur).addClass('in active');
                    $("a[href='#" + tab_cur + "']").parent().addClass('has-error');

                    $("#" + elm_id).focus();

                    isValid = true;
                }
            }

            $("#" + elm_id).keyup(function () {
                if ($("#" + elm_id).val() != "") {
                    $("#" + elm_id).parent().removeClass("has-error");
                    $("a[href='#" + tab_cur + "']").parent().removeClass("has-error");
                    $("a[href='#" + tab_cur + "']").parent().addClass("active");
                    $("#" + elm_id).next().remove('.help-block');
                    isValid = false;
                }
            });

            /*$("#" + elm_id).change(function () {
             $("#" + elm_id).parent().find(".text-danger-required").remove();

             isValid = false;
             });*/


            if (isValid) {
                return false;
            }
        });

        if (!isValid) {
            $("#dataForm").submit();
        }
    });


}