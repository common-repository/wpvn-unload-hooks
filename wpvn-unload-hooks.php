<?php
/*
Plugin Name: WPVN - Unload Hooks
Plugin URI: http://link2caro.net/read/wpvn-unload-hooks/
Description: This plugin helps you know how hooks are called and let you unload actions/filters (this is useful when you want to unload, not deactive, plugins based on user-agent, themes or whatever you want) - by a memeber of WordPressVN.
Version: 0.9.2
Author: CA RO
Author URI: http://link2caro.net/donate/
*/

/***** Examples *****/
//cr_hook_remove('aki',false,true);
//cr_hook_remove(array('aki','','','widget'),false,true);
//cr_hook_list();
//cr_hook_list('wp_head');

/**
 * Remove an action or a filter
 * @param array $hooks_to_find Names of the filters/actions, to avoid incident, this is case-sensitive
 * @param boolean $exact Find exact names? if not use 'strpos'
 * @param boolean $display Display the result, if not return boolean for one filter/action
 * or array of boolean for array of filters/actions (return $result[filter/action_name]=true/false)
 * @param boolean $detail Display detail of the filter/action hierarchy
 * @return mixed void or boolean/array of boolean
 */
function cr_hook_remove($hooks_to_find = array(), $exact = false, $display = false, $detail = false) {
	if(!is_array($hooks_to_find))
		$hooks_to_find = array($hooks_to_find);
	$hooks_to_find = array_filter($hooks_to_find,'is_not_empty');
	$output = '<b>Try to remove:</b> '.implode(',',$hooks_to_find).'<br/>'."\n";
	if($display) echo $output;
	$result = '';
	foreach($GLOBALS['wp_filter'] as $wheretohook=>$wheretohook_) :
		foreach($wheretohook_ as $hookpriority=>$hookpriority_) :
			foreach($hookpriority_ as $hookelement=>$hookelement_) :
				foreach($hooks_to_find as $hook_to_find) :
					if((!$exact && FALSE !== strpos($hookelement,$hook_to_find)) || ($exact && $hookelement==$hook_to_find)) {
						if(remove_action($wheretohook,$hookelement,$hookpriority)) :
							$output .= '<b>Removed</b>: '.$wheretohook.' > '.$hookpriority.' > '.$hookelement;
							if($display) echo '<b>Removed</b>: '.$wheretohook.' > '.$hookpriority.' > '.$hookelement;
							($exact) ? $result = true : $result[$hookelement] = true;
						else :
							$output .= '<b>Failed to remove</b>: '.$hookelement;
							if($display) echo '<b>Failed to remove</b>: '.$hookelement;
							($exact) ? $result = false : $result[$hookelement] = false;
						endif;
						if($display && $detail) {
							echo ' : ';
							print_r($hookelement_);
						}
						$output .= '<br/>'."\n";
						if($display) echo '<br/>'."\n";
					}
				endforeach;
			endforeach;
		endforeach;
	endforeach;
	return $result;
}

/**
 * List all actions or filters that are present on page or List all actions or filters hooked to the requested hook
 * @param array $hookname Names of the hook
 * @param boolean $display Display the result, if not return the output string
 * @param boolean $detail Display detail of the filter/action hierarchy
 * @return mixed void or string
 */
function cr_hook_list($hookname = array(), $display = true, $detail = false) {
	$output = '<b>Hooks:</b><br/>'."\n";
	if($display) echo $output;
	if(!is_array($hookname))
		$hookname = array($hookname);
	$hookname = array_filter($hookname,'is_not_empty');
	foreach($GLOBALS['wp_filter'] as $wheretohook=>$wheretohook_) :
		if(!empty($hookname) && !in_array($wheretohook,$hookname))
			continue;

		foreach($wheretohook_ as $hookpriority=>$hookpriority_) :
			foreach($hookpriority_ as $hookelement=>$hookelement_) :
				$output .= $wheretohook.' > '.$hookpriority.' > '.$hookelement;
				if($display) echo $wheretohook.' > '.$hookpriority.' > '.$hookelement;
				if($display && $detail) {
					echo ' : ';
					print_r($hookelement_);
				}
				$output .= '<br/>'."\n";
				if($display) echo '<br/>'."\n";
			endforeach;
		endforeach;
	endforeach;
	return $output;
}

function is_not_empty ($element) {
	return !empty($element);
}
?>