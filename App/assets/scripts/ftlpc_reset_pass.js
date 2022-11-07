const { __ } = wp.i18n

jQuery(document).ready(function () {
  jQuery('#ftlpc_new_pass1').keyup(function () {
    let pswd = jQuery(this).val()
    let flag = 0

    if (pswd.length >= 8) {
      flag++
      jQuery('#ftlpc_digit_entered')
        .removeClass('ftlpc_invalid fa fa-times')
        .addClass('ftlpc_valid fa fa-check ')
    } else {
      jQuery('#ftlpc_digit_entered')
        .removeClass('ftlpc_valid fa fa-check')
        .addClass('ftlpc_invalid fa fa-times')
    }

    if (pswd.match(/[0-9]/)) {
      flag++
      jQuery('#ftlpc_number')
        .removeClass('ftlpc_invalid fa fa-times')
        .addClass('ftlpc_valid fa fa-check')
    } else {
      jQuery('#ftlpc_number')
        .removeClass('ftlpc_valid fa fa-check')
        .addClass('ftlpc_invalid fa fa-times')
    }

    if (pswd.match(/[A-Z]/)) {
      flag++
      jQuery('#ftlpc_upper_letter')
        .removeClass('ftlpc_invalid fa fa-times')
        .addClass('ftlpc_valid fa fa-check')
    } else {
      jQuery('#ftlpc_upper_letter')
        .removeClass('ftlpc_valid fa fa-check')
        .addClass('ftlpc_invalid fa fa-times')
    }

    if (pswd.match(/[a-z]/)) {
      flag++
      jQuery('#ftlpc_lower_letter')
        .removeClass('ftlpc_invalid fa fa-times')
        .addClass('ftlpc_valid fa fa-check')
    } else {
      jQuery('#ftlpc_lower_letter')
        .removeClass('ftlpc_valid fa fa-check')
        .addClass('ftlpc_invalid fa fa-times')
    }

    if (pswd.match(/[@#$%&*()_+{:;'/><,.}]/)) {
      flag++
      jQuery('#ftlpc_special_symbol')
        .removeClass('ftlpc_invalid fa fa-times')
        .addClass('ftlpc_valid fa fa-check')
    } else {
      jQuery('#ftlpc_special_symbol')
        .removeClass('ftlpc_valid fa fa-check')
        .addClass('ftlpc_invalid fa fa-times')
    }

    if (flag === 5) {
      $('#ftlpc_save_pass').prop('disabled', false)
    } else {
      $('#ftlpc_save_pass').prop('disabled', true)
    }
  })
})
function ftlpc_myFunction() {
  var x = document.getElementById('ftlpc_new_pass2')
  var y = document.getElementById('ftlpc_new_pass1')

  if (x.type === 'password' && y.type === 'password') {
    x.type = 'text'
    y.type = 'text'
  } else {
    x.type = 'password'
    y.type = 'password'
  }
}

jQuery('#ftlpc_new_pass2').keypress(function (e) {
  if (e.which == 13) {
    ftlpc_submit()
  }
})
jQuery('#ftlpc_save_pass').click(function (e) {
  ftlpc_submit()
})

function ftlpc_submit() {
  var nonce = jQuery("input[name ='NONCE']").val()
  var data = {
    action: 'ftlpc_login',
    option: 'ftlpc_Submit_new_pass',
    optionValue: 'ftlpc_save_pass',
    nonce: nonce,
    user_id: jQuery("input[name='user_id']").val(),
    OldPass: jQuery("input[name='OldPass']").val(),
    Newpass: jQuery("input[name ='Newpass']").val(),
    Newpass2: jQuery("input[name ='Newpass2']").val(),
  }
  jQuery.post(ajax_object.ajaxurl, data, function (response) {
    var response = response.replace(/\s+/g, ' ').trim()
    if (response == 'PASS_NOT_MATCH') {
      Moppm_error_msg(
        __(
          'Your Entered and ReEnter Password does not match',
          'first-time-login-password-change',
        ),
      )
    } else if (response == 'ERROR') {
      Moppm_error_msg(
        __(
          'An unknow error occured. please try again later!',
          'first-time-login-password-change',
        ),
      )
    } else if (response == 'OLDPASSWORD_NOTMATCH') {
      Moppm_error_msg(
        __('Old password did not match', 'first-time-login-password-change'),
      )
    } else if (response == 'Login') {
      Moppm_success_msg(
        __(
          'Your Password is successfully changed',
          'first-time-login-password-change',
        ),
      )
      document.location.href = ajax_object.redirecturl
    } else {
      Moppm_error_msg(response)
    }
  })
}
function Moppm_error_msg(error) {
//   jQuery('.ftlpc_reset_pass__header-alert').empty()
  var msg =
    "<div id='notice_div' class='ftlpc_overlay_error alert alert-danger'><div class='popup_text'>&nbsp; &nbsp; " +
    error +
    '</div></div>'
  jQuery('.ftlpc_reset_pass__header-alert').after(msg)
  window.onload = Moppm_nav_popup()
}
function Moppm_nav_popup() {
//   document.getElementById('notice_div').style.width = '40%'
//   document.getElementById('notice_div').style.height = '10%'
  setTimeout(function () {
    jQuery('#notice_div').fadeOut('slow')
  }, 3000)
}
function Moppm_success_msg(success) {
//   jQuery('.ftlpc_reset_pass__header-alert').empty()
  var msg =
    "<div id='notice_div' class='ftlpc_overlay_success'><div class='popup_text'>&nbsp; &nbsp; " +
    success +
    '</div></div>'
  jQuery('.ftlpc_reset_pass__header-alert').after(msg)
  window.onload = Moppm_nav_popup()
}
