<?php

declare(strict_types=1);
echo '<div class="wrap">
			<div id ="moppm_message"></div>
				<div>
                <img  style="float:left;margin-top:5px;width:50px;" src="' . \esc_url(FTLPC_LOGO_URL) . '">
                </div>
				<h1>' . FTLPC_APP_NAME . ' </h1>';
echo '<br><br><br>';
echo '<a id="ftlpc_menu" class="nav-tab ' . \esc_html('ftlpc_settings' == $active_tab
    ? 'nav-tab-active' : '') . '" href="' . \esc_url($settings_url) . '">' . __('Settings', 'first-time-login-password-change') . '</a>';

echo '<a id="ftlpc_reports" class="nav-tab ' . \esc_html('ftlpc_advanced' == $active_tab
    ? 'nav-tab-active' : '') . '" href="' . \esc_url($advanced_url) . '">' . __('Advanced', 'first-time-login-password-change') . '</a>';
