<?php
/**
*
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-6-30
*/
class SysuserModel extends ModelBase{
	var $_name ='sysuser';
	var $_tablename = 'sys_user';
	
	var $_relations = array(
			'belong_one_pgroup'	=>	array(
					'table'	=>	'sys_permission_group',
					'alias'	=>	'B',
					'on'	=>	'A.pgroup_id = B.pgroup_id',
					'type'	=>	C::MODEL_RE_TYPE_LEFT
			)
	);
	
	function get_user($username,$security){
		return $this->get_one(array(
					'fields'	=>	'A.*,B.pgroup_name',
					'where'	=>	array(
								'user_name'	=>	$username,
								'security'	=>	$security
							),
					'join'	=>	'belong_one_pgroup'
				));
	}
	
}