<?php

declare(strict_types=1);
class Ftlpc_Utility
{
    public static function validate_password($password)
    {
        $length_pass = \strlen($password);
        if (!\preg_match('#[0-9]+#', $password)) {
            return __('New Password must contain numeric value', 'first-time-login-password-change');
        }
        if (!\preg_match('/[a-z]/', $password)) {
            return __('New Password must contain lower case letter', 'first-time-login-password-change');
        }
        if (!\preg_match('/[A-Z]/', $password)) {
            return __('New Password must contain upper case letter', 'first-time-login-password-change');
        }

        if (!\preg_match("/[@#$\\%&\\*()_+{:;'\\><,.}]/", $password)) {
            return __('New Password must contain Special character', 'first-time-login-password-change');
        }
        if ($length_pass < 8) {
            return \sprintf(__('New Password must conain atleast %1$d characters ', 'first-time-login-password-change'), 8);
        }

        return 'VALID';
    }

    public static function check_password_score($password)
    {
        $score = 0;
        if (\strlen($password) > 7) {
            $score = $score + 2;
        }
        if (\preg_match('/[a-z]/', $password)) {
            $score++;
        }
        if (\preg_match('/[A-Z]/', $password)) {
            $score++;
        }
        if (\preg_match('#[0-9]+#', $password)) {
            $score++;
        }
        if (\preg_match("/[@#$\\%&\\*()_+{:;'\\><,.}]/", $password)) {
            $score++;
        }
        if (\strlen($password) > 12) {
            $score = $score + 2;
        }
        if (\strlen($password) > 17) {
            $score = $score + 2;
        }

        return $score;
    }
}
