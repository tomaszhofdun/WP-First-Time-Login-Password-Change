<?php

declare(strict_types=1);
class FTLPC_Ajax
{
    public function __construct()
    {
        \add_action('init', [$this, 'ftlpc_ajax_fun']);
    }

    public function ftlpc_ajax_fun(): void
    {
        \add_action('wp_ajax_ftlpc_plugin_switcher', [$this, 'ftlpc_plugin_switcher']);
        \add_action('wp_ajax_nopriv_ftlpc_login', [$this, 'ftlpc_login']);
    }

    public function ftlpc_plugin_switcher(): void
    {
        // Save value if plugin is active in database
        $nonce = \sanitize_text_field($_POST['nonce']);

        if (!\wp_verify_nonce($nonce, 'ftlpc-plugin-switcher-nonce')) {
            \wp_send_json('NONCE');

            return;
        }
        \update_site_option('ftlpc_plugin_active', $_POST['optionValue']);
        \wp_send_json('SUCCESS');
    }

    public function ftlpc_login(): void
    {
        $option = \sanitize_text_field($_POST['option']);
        switch ($option) {
            case 'ftlpc_Submit_new_pass':
                $this->ftlpc_Submit_new_pass();
                break;
        }
    }

    public function ftlpc_Submit_new_pass(): void
    {
        $nonce = \sanitize_text_field($_POST['nonce']);
        if (!\wp_verify_nonce($nonce, 'ftlpcresetformnonce')) {
            \wp_send_json('ERROR');

            return;
        }
        $Newpass = $_POST['Newpass'];
        $Newpass2 = $_POST['Newpass2'];
        $OldPass = $_POST['OldPass'];
        $user_id = \sanitize_text_field($_POST['user_id']);
        global $wpdb;
        $user = \get_user_by('ID', $user_id);
        $user_pass = $user->data->user_pass;
        $user_name = $user->data->user_login;
        if (!\wp_check_password($OldPass, $user_pass, $user_id)) {
            echo 'OLDPASSWORD_NOTMATCH';
            exit;
        }
        if ($Newpass != $Newpass2) {
            echo 'PASS_NOT_MATCH';
            exit;
        }

        if ($Newpass == $Newpass2) {
            $result = ftlpc_Utility::validate_password($Newpass2);
            if ('VALID' != $result) {
                echo $result;
                exit;
            }

            \wp_set_password($Newpass, $user_id);
            \update_user_meta($user_id, 'ftlpc_first_reset', 'true');

            $info = [];
            $info['user_login'] = $user_name;
            $info['user_password'] = $Newpass;
            $info['remember'] = true;

            $user_signon = \wp_signon($info, false);

            if (\is_wp_error($user_signon)) {
                echo \json_encode(['loggedin' => false, 'message' => __('Wrong username or password.', 'first-time-login-password-change')]);
            } else {
                echo 'Login';
            }
            exit;
        }
    }
}
new FTLPC_Ajax();
