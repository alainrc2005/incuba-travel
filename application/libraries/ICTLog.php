<?php

/**
 * Created by PhpStorm.
 * User: aramirez
 * Date: 5/6/2017
 * Time: 1:10 PM
 */
class CI_ICTLog
{
    protected $_file_ext;
    protected $_log_path;

    function __construct() {
        $config =& get_config();
        $this->_log_path = ($config['log_path'] !== '') ? $config['log_path'] : APPPATH . 'logs/';
        $this->_file_ext = (isset($config['log_file_extension']) && $config['log_file_extension'] !== '')
            ? ltrim($config['log_file_extension'], '.') : 'php';

        file_exists($this->_log_path) OR mkdir($this->_log_path, 0755, TRUE);
    }

    public function write_log($msg) {
        $filepath = $this->_log_path . 'ict-' . date('Y-m-d') . '.' . $this->_file_ext;
        $message = '';

        if (!file_exists($filepath)) {
            if ($this->_file_ext === 'php') {
                $message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
            }
        }

        if (!$fp = @fopen($filepath, 'ab'))  return FALSE;

        flock($fp, LOCK_EX);

        $date = date('Y-m-d H:i:s');
        $message .= $date . ' --> ' . $msg . "\n";

        for ($written = 0, $length = strlen($message); $written < $length; $written += $result) {
            if (($result = fwrite($fp, substr($message, $written))) === FALSE) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);
        return TRUE;
    }
}