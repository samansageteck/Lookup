<?php
/* Smarty version 4.5.3, created on 2025-06-29 09:53:16
  from 'C:\wamp64\www\NewInstance-26-06-2025\SuiteCRM-7.14.6\modules\ModuleBuilder\tpls\assistantJavascript.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_68610d0ca5bc16_33691046',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a16503198c20f45a03bbaeea071c3f27df9f2c8' => 
    array (
      0 => 'C:\\wamp64\\www\\NewInstance-26-06-2025\\SuiteCRM-7.14.6\\modules\\ModuleBuilder\\tpls\\assistantJavascript.tpl',
      1 => 1750928990,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68610d0ca5bc16_33691046 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>

if(typeof(Assistant)!="undefined" && Assistant.mbAssistant){
	//Assistant.mbAssistant.render(document.body);

<?php if ($_smarty_tpl->tpl_vars['userPref']->value) {?>
	Assistant.processUserPref("<?php echo $_smarty_tpl->tpl_vars['userPref']->value;?>
");
<?php }
if ($_smarty_tpl->tpl_vars['assistant']->value['key'] && $_smarty_tpl->tpl_vars['assistant']->value['group']) {?>
	Assistant.mbAssistant.setBody(SUGAR.language.get('ModuleBuilder','assistantHelp').<?php echo $_smarty_tpl->tpl_vars['assistant']->value['group'];?>
.<?php echo $_smarty_tpl->tpl_vars['assistant']->value['key'];?>
);
<?php }?>

	if(Assistant.mbAssistant.visible){
		Assistant.mbAssistant.show();
		}
}

<?php echo '</script'; ?>
><?php }
}
