const { __ } = wp.i18n

jQuery('#ftlpc_save_pass').click(function (e) {
  ftlpc_submit()
})

function ftlpc_submit() {
  jQuery('#ftlpc_message').empty()
  var checked = jQuery('#ftlpc_plugin_active').is(':checked')

  var nonce = jQuery("input[name ='NONCE']").val()
  var data = {
    action: 'ftlpc_plugin_switcher',
    option: 'plugin_active',
    optionValue: checked,
    nonce: nonce,
  }
  jQuery.post(ajax_object.ajaxurl, data, function (response) {
    var response = response.replace(/\s+/g, ' ').trim()
    if (response == 'SUCCESS') {
      Ftlpc_success_msg(
        __('Settings saved', 'first-time-login-password-change'),
      )
    } else if (response == 'NONCE') {
      Ftlpc_error_msg(
        __('Error in form authentication', 'first-time-login-password-change'),
      )
    } else {
      Ftlpc_error_msg(
        __('Unexpected error, please try again','first-time-login-password-change' ),
      )
    }
  })
}
function Ftlpc_error_msg(error) {
  jQuery('#ftlpc_message').empty()
  var msg = `<div class="alert alert-danger" role="alert">${error}</div>`

  jQuery('#ftlpc_message').append(msg)
}
function Ftlpc_success_msg(success) {
  jQuery('#ftlpc_message').empty()

  var msg = `<div class="alert alert-success" role="alert">${success}</div>`
  jQuery('#ftlpc_message').append(msg)
}
