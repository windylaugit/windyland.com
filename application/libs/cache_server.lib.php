<?php
/**
* 数据缓存类,基于PHP文件存储的形式建立数据缓存
* 
* @copyright(c) 2015
* @author AndyLau <i@windyland.com>
* @package 
* @version V1.0.1
* @date 2015-8-19
*/

class Cache_serverLib extends Object
{
    /* 缓存目录 */
    var $_cache_dir = './';
    
    /* 缓存子目录数量 */
    var $_cache_dir_num = 500;
    
    function __construct(){
    	$config = cc()->config->get('cache_server');
    	$this->_cache_dir_num = $config['dir_num'];
    	$this->set_cache_dir($config['path']);
    }
    
  
    
    /**
     * 
     * @param string $type	key类型：post、page、category、tag、sidebar
     * @param mixed $id	the ID value of current page
     */
    function create_key($type='post',$id='0'){
    	return $type.'_data_of_id_'.$id;
    }
    
    function set($key, $value, $ttl = 0)
    {
        if (!$key)
        {
            return false;
        }
        $cache_file = $this->_get_cache_path($key);
        $cache_data = "<?php\r\n/**\r\n *  @Created By Windyland.com CacheServer Library\r\n *  @Time:" . date('Y-m-d H:i:s') . "\r\n */";
        $cache_data .= $this->_get_expire_condition(intval($ttl));
        $cache_data .= "\r\nreturn " . var_export($value, true) .  ";\r\n";
        $cache_data .= "\r\n?>";

        return file_put_contents($cache_file, $cache_data, LOCK_EX);
    }
    function &get($key)
    {
		$data = false;
        $cache_file = $this->_get_cache_path($key);
        if (!is_file($cache_file))
        {
            return $data;
        }
        $data = include($cache_file);

        return $data;
    }
    function clear()
    {
        $dir = dir($this->_cache_dir);
        while (false !== ($item = $dir->read()))
        {
            if ($item == '.' || $item == '..' || substr($item, 0, 1) == '.')
            {
                continue;
            }
            $item_path = $this->_cache_dir . '/' . $item;
            if (is_dir($item_path))
            {
                wl_rmdir($item_path);
            }
            else
            {
                @unlink($item_path);
            }
        }

        return true;
    }
    function delete($key)
    {
        $cache_file = $this->_get_cache_path($key);
		$ret = @unlink($cache_file);
        return $ret;
    }
    function set_cache_dir($path)
    {
        $this->_cache_dir = $path;
    }
    function _get_expire_condition($ttl = 0)
    {
        if (!$ttl)
        {
            return '';
        }

        return "\r\n\r\n" . 'if(filemtime(__FILE__) + ' . $ttl . ' < time())return false;' . "\r\n";
    }
    function _get_cache_path($key)
    {
        $dir = str_pad(abs(crc32($key)) % $this->_cache_dir_num, 4, '0', STR_PAD_LEFT);
        wl_mkdir($this->_cache_dir . '/' . $dir);
        return $this->_cache_dir . '/' . $dir .  '/' . $this->_get_file_name($key);
    }
    function _get_file_name($key)
    {
        return md5($key) . '.cache.php';
    }
}

