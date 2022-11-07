<?php declare(strict_types=1); ?>

<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php
    \wp_print_scripts('jquery-core');
?>
</head>

<body class="ftlpc_body">
    <div class="container">
        <div class="row w-100 d-flex justify-content-center align-items-center main_div">
            <div class="col-12">
                <div class="ftlpc_reset_body py-3 px-2">
                    <center><?= '<img style="width:350px;display: inline;"src="' . \esc_url_raw(FTLPC_LOGO_URL) . '">'; ?></center>
                    <h2 class="text-center my-3 text-capitalize" style="color:black; margin-left:15px; font-size:35px;"> <span> First Time Login Password Change</span> </h2>
                    <div class="row mx-auto">
                        <div class=" col-10  mx-auto">
                            <form class="ftlpc_my_form">
                                <div class="mb-3">
                                    <input id="ftlpc_plugin_active" type="checkbox" <?= 'true' === \get_site_option('ftlpc_plugin_active') ? 'checked' : ''; ?>><label style="margin-left:5%;"><?php _e('Enable force change password', 'first-time-login-password-change'); ?></label>
                                </div>
                                <div class="my-3">
                                    <button class="btn btn-lg  btn-success btn-md ftlpc_form_value" type="button" id="ftlpc_save_pass">
                                        <small style="display: flex; align-items: center;"> <i class="far fa-save pr-2" style="font-size: 28px"></i> <?php _e('Save Settings', 'first-time-login-password-change'); ?> </small>
                                    </button>
                                </div>
                                <input type="hidden" name="NONCE" value="<?= \wp_create_nonce('ftlpc-plugin-switcher-nonce'); ?>">
                            </form>
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
    \wp_localize_script(
        'ftlpc-script',
        'ajax_object',
        [
            'ajaxurl' => \admin_url('admin-ajax.php'),
        ]
    );
    \wp_print_scripts('ftlpc-script');



?>
</body>
</html>