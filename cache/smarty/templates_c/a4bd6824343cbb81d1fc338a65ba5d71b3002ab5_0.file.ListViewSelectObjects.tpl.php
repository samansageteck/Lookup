<?php
/* Smarty version 4.5.3, created on 2025-06-26 11:01:17
  from 'C:\wamp64\www\NewInstance-26-06-2025\SuiteCRM-7.14.6\themes\SuiteP\include\ListView\ListViewSelectObjects.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_685d287d130187_92660234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4bd6824343cbb81d1fc338a65ba5d71b3002ab5' => 
    array (
      0 => 'C:\\wamp64\\www\\NewInstance-26-06-2025\\SuiteCRM-7.14.6\\themes\\SuiteP\\include\\ListView\\ListViewSelectObjects.tpl',
      1 => 1750928992,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685d287d130187_92660234 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="selectedRecords label hidden"><?php echo $_smarty_tpl->tpl_vars['APP']->value['LBL_LISTVIEW_SELECTED_OBJECTS'];?>
</div><div class="selectedRecords value hidden"><?php echo $_smarty_tpl->tpl_vars['TOTAL_ITEMS_SELECTED']->value;?>
</div>
<input type='hidden' id='selectCountTop' name='selectCount[]' value='<?php echo $_smarty_tpl->tpl_vars['TOTAL_ITEMS_SELECTED']->value;?>
' />

<?php echo '<script'; ?>
>

    $(document).ready(function () {
        setInterval(function () {
            sListView.toggleSelected();
        }, 100);
    });

<?php echo '</script'; ?>
><?php }
}
