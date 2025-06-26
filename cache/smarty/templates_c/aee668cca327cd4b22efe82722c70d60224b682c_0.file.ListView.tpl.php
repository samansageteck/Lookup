<?php
/* Smarty version 4.5.3, created on 2025-06-26 11:01:22
  from 'C:\wamp64\www\NewInstance-26-06-2025\SuiteCRM-7.14.6\include\SugarFields\Fields\Base\ListView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_685d28823c51f1_09215574',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aee668cca327cd4b22efe82722c70d60224b682c' => 
    array (
      0 => 'C:\\wamp64\\www\\NewInstance-26-06-2025\\SuiteCRM-7.14.6\\include\\SugarFields\\Fields\\Base\\ListView.tpl',
      1 => 1750928987,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685d28823c51f1_09215574 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\NewInstance-26-06-2025\\SuiteCRM-7.14.6\\include\\Smarty\\plugins\\function.sugar_fetch.php','function'=>'smarty_function_sugar_fetch',),));
?>

<?php echo smarty_function_sugar_fetch(array('object'=>$_smarty_tpl->tpl_vars['parentFieldArray']->value,'key'=>$_smarty_tpl->tpl_vars['col']->value),$_smarty_tpl);?>

<?php }
}
