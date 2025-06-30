<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

/*
 * Created on Jul 18, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 function get_body(&$ss, $vardef)
 {
     $multi = false;
     $radio = false;
     if (isset($vardef['type']) && $vardef['type'] == 'multienum') {
         $multi = true;
     }
        
     $selected_options = "";
     if ($multi && !empty($vardef['default'])) {
         $selected_options = unencodeMultienum($vardef['default']);
     } else {
         if (isset($vardef['default'])) {
             $selected_options = $vardef['default'];
         }
     }

     $edit_mod_strings = return_module_language($GLOBALS['current_language'], 'EditCustomFields');

     if (!empty($_REQUEST['type']) && $_REQUEST['type'] == 'radioenum') {
         $edit_mod_strings['LBL_DROP_DOWN_LIST'] = $edit_mod_strings['LBL_RADIO_FIELDS'];
         $radio = true;
     }
     $package_strings = array();
     if (!empty($_REQUEST['view_package'])) {
         $view_package = $_REQUEST['view_package'];
         if ($view_package != 'studio') {
             require_once('modules/ModuleBuilder/MB/ModuleBuilder.php');
             $mb = new ModuleBuilder();
             $module =& $mb->getPackageModule($view_package, $_REQUEST['view_module']);
             $lang = $GLOBALS['current_language'];
             //require_once($package->getPackageDir()."/include/language/$lang.lang.php");
             $module->mblanguage->generateAppStrings(false);
             $package_strings = $module->mblanguage->appListStrings[$lang.'.lang.php'];
         }
     }
    
     global $app_list_strings;
     $my_list_strings = $app_list_strings;
     $my_list_strings = array_merge($my_list_strings, $package_strings);
     foreach ($my_list_strings as $key=>$value) {
         if (!is_array($value)) {
             unset($my_list_strings[$key]);
         }
     }
     $dropdowns = array_keys($my_list_strings);
    //  Adding a default empty list
     $dropdowns[] = '';
     sort($dropdowns);
    //  $default_dropdowns = array();
    $default_dropdowns = [];
     if (!empty($vardef['options']) && !empty($my_list_strings[$vardef['options']])) {
         $default_dropdowns = $my_list_strings[$vardef['options']];
     } else {
         //since we do not have a default value then we should assign the first one.
        //  $key = $dropdowns[0];
        //  $default_dropdowns = $my_list_strings[$key];
       
            foreach ($dropdowns as $key) {
                if (!empty($key) && isset($my_list_strings[$key])) {
                    $default_dropdowns = $my_list_strings[$key];
                    break;
                }
}

     }
    
     $selected_dropdown = '';
     if (!empty($vardef['options'])) {
         $selected_dropdown = $vardef['options'];
     }
     $show = true;
     if (!empty($_REQUEST['refresh_dropdown'])) {
         $show = false;
     }
     $relatedModules = get_related_modules();

     $ss->assign('dropdowns', $relatedModules);
     $ss->assign('default_dropdowns', $default_dropdowns);
     $ss->assign('selected_dropdown', $selected_dropdown);
     $ss->assign('show', $show);
     $ss->assign('selected_options', $selected_options);
     $ss->assign('multi', isset($multi) ? $multi: false);
     $ss->assign('radio', isset($radio) ? $radio: false);
     $ss->assign('dropdown_name', (!empty($vardef['options']) ? $vardef['options'] : ''));

     require_once('include/JSON.php');
     $json = new JSON();
     $ss->assign('app_list_strings', "''");
     return $ss->fetch('custom/modules/DynamicFields/templates/Fields/Forms/LookupDropdown.tpl');
 }
 
function get_related_modules()
{
    $currentModule = get_current_module_name();
    return fetch_related_modules($currentModule);
}

function get_current_module_name()
{
    return clean_string($_REQUEST['view_module'] ?? 'Unknown');
}

function fetch_related_modules($currentModule)
{
    require_once('data/BeanFactory.php');
    require_once('include/utils.php');

    $bean = BeanFactory::newBean($currentModule);
    if (!$bean) {
        return ["Could not load bean for: $currentModule"];
    }

    $relatedModules = [];

    foreach ($bean->field_defs as $field => $def) {
        if (!empty($def['type']) && $def['type'] === 'link') {
            // Try to load the relationship
            if ($bean->load_relationship($field)) {
                $rel = $bean->$field;

                if (!empty($rel) && method_exists($rel, 'getRelatedModuleName')) {
                    $relatedModule = $rel->getRelatedModuleName();
                    if (!in_array($relatedModule, $relatedModules)) {
                        $relatedModules[] = $relatedModule;
                    }
                }
            }
        }
    }

    return $relatedModules;
}


function get_package_strings()
{
    $package_strings = [];
    if (!empty($_REQUEST['view_package']) && $_REQUEST['view_package'] != 'studio') {
        require_once('modules/ModuleBuilder/MB/ModuleBuilder.php');
        $mb = new ModuleBuilder();
        $module = $mb->getPackageModule($_REQUEST['view_package'], $_REQUEST['view_module']);
        $lang = $GLOBALS['current_language'];
        $module->mblanguage->generateAppStrings(false);
        $package_strings = $module->mblanguage->appListStrings[$lang . '.lang.php'];
    }
    return $package_strings;
}
