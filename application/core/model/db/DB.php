<?php
/**
 * 
 * @param unknown_type $config
 * @return CI_DB_mysql_driver
 */
function &DB($config)
{
	$db = false;
	$dbdriver = $config['dbdriver'];
	$file = CORE_PATH . '/model/db/drivers/' . $dbdriver . '/'.$dbdriver . '_driver.php';
	if(is_file($file)){
		require_once CORE_PATH . '/model/db/DB_driver.php';
		require_once CORE_PATH . '/model/db/DB_query_builder.php';
		require_once CORE_PATH . '/model/db/DB_result.php';
		require_once CORE_PATH . '/model/db/DB_cache.php';
		require_once CORE_PATH . '/model/db/DB_forge.php';
		require_once CORE_PATH . '/model/db/DB_utility.php';
		require_once $file;
		$class_name = 'CI_DB_'.$dbdriver.'_driver';
		$db = new $class_name($config);
		$db->initialize();
	}
	return $db;
}
