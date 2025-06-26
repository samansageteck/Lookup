<?php
/* Smarty version 4.5.3, created on 2025-06-26 11:00:13
  from 'C:\wamp64\www\NewInstance-26-06-2025\SuiteCRM-7.14.6\include\utils\recaptcha_disabled.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_685d283dcbba09_95976293',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'def01a964d40af43bf3961d4384647fd35776f22' => 
    array (
      0 => 'C:\\wamp64\\www\\NewInstance-26-06-2025\\SuiteCRM-7.14.6\\include\\utils\\recaptcha_disabled.tpl',
      1 => 1750928988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685d283dcbba09_95976293 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>

  /**
   * Login Screen Validation
   */
  function validateAndSubmit() {
      generatepwd();
    }

  /**
   * Password reset screen validation
   */
  function validateCaptchaAndSubmit() {
      document.getElementById('username_password').value = document.getElementById('new_password').value;
      document.getElementById('ChangePasswordForm').submit();
    }
<?php echo '</script'; ?>
>
<?php }
}
