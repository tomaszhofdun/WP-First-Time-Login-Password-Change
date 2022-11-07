<?php declare(strict_types=1);

function ftlpc_reset_pass_form($user): void
{
    $user_id = $user->ID;
    $ftlpc_logo = FTLPC_PLUGIN_URL . DIRECTORY_SEPARATOR . 'assets/images/szafirek-logo.png'; ?>

    <html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <?php
    \wp_print_scripts('jquery-core');
    \wp_register_style('custom-login', \plugins_url('assets/dist/styles.css', \dirname(__FILE__)));
    \wp_print_styles('custom-login'); ?>
    </head>
    <body class="ftlpc_reset_pass">
        <div class="container">
            <div class="row w-100 d-flex justify-content-center align-items-center main_div">
                <div class="col-12 col-md-10 col-xxl-10 ">
                    <div class="py-3 px-2">
                        <center class="my-5"><a href="<?= \home_url(); ?>"><?= '<img style="width:300px; height:auto;display: inline;"src="' . \esc_url_raw($ftlpc_logo) . '">'; ?></a></center>
                        <div class="ftlpc_reset_pass__header-alert alert alert-danger my-5" role="alert">
                            <?php _e('Reset Password for', 'first-time-login-password-change'); ?><strong><?php echo ' ' . $user->user_nicename;
    echo ' '; ?></strong><?php _e('Make sure you have a strong password', 'first-time-login-password-change'); ?>
                        </div>
                        <div class="row mx-auto">
                            <div class="col-md-6 mx-auto">
                                <form class="ftlpc_my_form">
                                    <div class="mb-3">
                                        <label for="Current Password" class="ftlpc_form_label"><?php _e('Current Password', 'first-time-login-password-change'); ?></label>
                                        <input type="Password" class="ftlpc_input_password_field" id="ftlpc_old_pass" name="OldPass" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="New Password" class="ftlpc_form_label ftlpc_form_value"><?php _e('New Password', 'first-time-login-password-change'); ?></label>
                                        <i class="fas fa-eye" onclick="ftlpc_myFunction()"></i></label>
                                        <input type="Password" class="ftlpc_input_password_field" id="ftlpc_new_pass1" name="Newpass" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="Confirm Password" class="ftlpc_form_label ftlpc_form_value"><?php _e('Confirm Password', 'first-time-login-password-change'); ?></label>
                                        <input type="Password" class="ftlpc_input_password_field" id="ftlpc_new_pass2" name="Newpass2">
                                        
                                    </div>
                                    <div class="my-3">
                                        <button disabled class="btn btn-block btn-lg btn-success ftlpcbtn-primary btn-md ftlpc_form_value" type="button" id="ftlpc_save_pass">
                                            <small> <i class="far fa-user pr-2"></i> <?php _e('CHANGE PASSWORD', 'first-time-login-password-change'); ?> </small>
                                        </button>
                                    </div>
                                    <input type="hidden" name="NONCE" value="<?= \wp_create_nonce('ftlpcresetformnonce'); ?>">
                                    <input type="hidden" name="user_id" value="<?= \esc_html($user_id); ?>">
                                </form>
                            </div>
                            <div class="ftlpc_reset_pass__requirements col-md-6 mx-auto">
                                <div class="ftlpc_pass_require"><?php _e('NEW PASSWORD REQIREMENTS', 'first-time-login-password-change'); ?></div>
                                <div id="ftlpc_digit_entered" class="ftlpc_invalid fa fa-times" style="display:block"><?php _e(' Atleast 8 charactersth', 'first-time-login-password-change'); ?></div>
                                <div id="ftlpc_number" class="ftlpc_invalid fa fa-times" style="display:block"><?php _e(' Atleast one numeric digit (0,9)', 'first-time-login-password-change'); ?></div>
                                <div id="ftlpc_lower_letter" class="ftlpc_invalid fa fa-times" style="display:block"><?php _e(' Atleast one lower case letter', 'first-time-login-password-change'); ?></div>
                                <div id="ftlpc_upper_letter" class="ftlpc_invalid fa fa-times" style="display:block"><?php _e(' Atleast one upper case letter', 'first-time-login-password-change'); ?></div>
                                <div id="ftlpc_special_symbol" class="ftlpc_invalid fa fa-times" style="display:block"><?php _e(' Atleast one special character (@ # $ %)', 'first-time-login-password-change'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ftlpc_message"></div>
        <?php
    \wp_register_script('ftlpc-script', \plugins_url('assets/dist/scripts.js', \dirname(__FILE__)), ['wp-i18n'], false,
        true);
    \wp_enqueue_script('ftlpc-script');
    \wp_set_script_translations('ftlpc-script', 'first-time-login-password-change',  FTLPC_PLUGIN_PATH . 'lang/');
    \wp_localize_script('ftlpc-script','ajax_object',
        [
            'ajaxurl' => \admin_url('admin-ajax.php'),
            'redirecturl' => \home_url(),
        ]
    ); 
    \wp_print_scripts('ftlpc-script');
    ?>
    </body>
    </html>
<?php
} ?>