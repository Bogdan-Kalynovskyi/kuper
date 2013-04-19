<?php
	if(!defined('IN_BMC')) 
		die("Access Denied!");


// ====================
// Ban an IP
// Modded in 3.1
function get_real_ip()
{
global $REMOTE_ADDR;
global $HTTP_X_FORWARDED_FOR, $HTTP_X_FORWARDED, $HTTP_FORWARDED_FOR, $HTTP_FORWARDED;
global $HTTP_VIA, $HTTP_X_COMING_FROM, $HTTP_COMING_FROM;
global $HTTP_SERVER_VARS, $HTTP_ENV_VARS;
// Get some server/environment variables values
if(empty($REMOTE_ADDR))
    {
    if(!empty($_SERVER)&&isset($_SERVER['REMOTE_ADDR']))
        {
        $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
        }
    elseif(!empty($_ENV)&&isset($_ENV['REMOTE_ADDR']))
        {
        $REMOTE_ADDR = $_ENV['REMOTE_ADDR'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['REMOTE_ADDR']))
        {
        $REMOTE_ADDR = $HTTP_SERVER_VARS['REMOTE_ADDR'];
        }
    elseif(!empty($HTTP_ENV_VARS)&&isset($HTTP_ENV_VARS['REMOTE_ADDR']))
        {
        $REMOTE_ADDR = $HTTP_ENV_VARS['REMOTE_ADDR'];
        }
    elseif(@getenv('REMOTE_ADDR'))
        {
        $REMOTE_ADDR = getenv('REMOTE_ADDR');
        }
    } // end if
if(empty($HTTP_X_FORWARDED_FOR))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
        $HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED_FOR']))
        {
        $HTTP_X_FORWARDED_FOR = $_ENV['HTTP_X_FORWARDED_FOR'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR']))
        {
        $HTTP_X_FORWARDED_FOR = $HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_FORWARDED_FOR']))
        {
        $HTTP_X_FORWARDED_FOR = $HTTP_ENV_VARS['HTTP_X_FORWARDED_FOR'];
        }
    elseif(@getenv('HTTP_X_FORWARDED_FOR'))
        {
        $HTTP_X_FORWARDED_FOR = getenv('HTTP_X_FORWARDED_FOR');
        }
    } // end if
if(empty($HTTP_X_FORWARDED))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED']))
        {
        $HTTP_X_FORWARDED = $_SERVER['HTTP_X_FORWARDED'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED']))
        {
        $HTTP_X_FORWARDED = $_ENV['HTTP_X_FORWARDED'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED']))
        {
        $HTTP_X_FORWARDED = $HTTP_SERVER_VARS['HTTP_X_FORWARDED'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_FORWARDED']))
        {
        $HTTP_X_FORWARDED = $HTTP_ENV_VARS['HTTP_X_FORWARDED'];
        }
    elseif(@getenv('HTTP_X_FORWARDED'))
        {
        $HTTP_X_FORWARDED = getenv('HTTP_X_FORWARDED');
        }
    } // end if
if(empty($HTTP_FORWARDED_FOR))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED_FOR']))
        {
        $HTTP_FORWARDED_FOR = $_SERVER['HTTP_FORWARDED_FOR'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_FORWARDED_FOR']))
        {
        $HTTP_FORWARDED_FOR = $_ENV['HTTP_FORWARDED_FOR'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_FORWARDED_FOR']))
        {
        $HTTP_FORWARDED_FOR = $HTTP_SERVER_VARS['HTTP_FORWARDED_FOR'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_FORWARDED_FOR']))
        {
        $HTTP_FORWARDED_FOR = $HTTP_ENV_VARS['HTTP_FORWARDED_FOR'];
        }
    elseif(@getenv('HTTP_FORWARDED_FOR'))
        {
        $HTTP_FORWARDED_FOR = getenv('HTTP_FORWARDED_FOR');
        }
    } // end if
if(empty($HTTP_FORWARDED))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED']))
        {
        $HTTP_FORWARDED = $_SERVER['HTTP_FORWARDED'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_FORWARDED']))
        {
        $HTTP_FORWARDED = $_ENV['HTTP_FORWARDED'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_FORWARDED']))
        {
        $HTTP_FORWARDED = $HTTP_SERVER_VARS['HTTP_FORWARDED'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_FORWARDED']))
        {
        $HTTP_FORWARDED = $HTTP_ENV_VARS['HTTP_FORWARDED'];
        }
    elseif(@getenv('HTTP_FORWARDED'))
        {
        $HTTP_FORWARDED = getenv('HTTP_FORWARDED');
        }
    } // end if
if(empty($HTTP_VIA))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_VIA']))
        {
        $HTTP_VIA = $_SERVER['HTTP_VIA'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_VIA']))
        {
        $HTTP_VIA = $_ENV['HTTP_VIA'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_VIA']))
        {
        $HTTP_VIA = $HTTP_SERVER_VARS['HTTP_VIA'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_VIA']))
        {
        $HTTP_VIA = $HTTP_ENV_VARS['HTTP_VIA'];
        }
    elseif(@getenv('HTTP_VIA'))
        {
        $HTTP_VIA = getenv('HTTP_VIA');
        }
    } // end if
if(empty($HTTP_X_COMING_FROM))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_X_COMING_FROM']))
        {
        $HTTP_X_COMING_FROM = $_SERVER['HTTP_X_COMING_FROM'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_X_COMING_FROM']))
        {
        $HTTP_X_COMING_FROM = $_ENV['HTTP_X_COMING_FROM'];
        }
    elseif(!empty($HTTP_SERVER_VARS) && isset($HTTP_SERVER_VARS['HTTP_X_COMING_FROM']))
        {
        $HTTP_X_COMING_FROM = $HTTP_SERVER_VARS['HTTP_X_COMING_FROM'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_X_COMING_FROM']))
        {
        $HTTP_X_COMING_FROM = $HTTP_ENV_VARS['HTTP_X_COMING_FROM'];
        }
    elseif(@getenv('HTTP_X_COMING_FROM'))
        {
        $HTTP_X_COMING_FROM = getenv('HTTP_X_COMING_FROM');
        }
    } // end if
if(empty($HTTP_COMING_FROM))
    {
    if(!empty($_SERVER) && isset($_SERVER['HTTP_COMING_FROM']))
        {
        $HTTP_COMING_FROM = $_SERVER['HTTP_COMING_FROM'];
        }
    elseif(!empty($_ENV) && isset($_ENV['HTTP_COMING_FROM']))
        {
        $HTTP_COMING_FROM = $_ENV['HTTP_COMING_FROM'];
        }
    elseif(!empty($HTTP_COMING_FROM) && isset($HTTP_SERVER_VARS['HTTP_COMING_FROM']))
        {
        $HTTP_COMING_FROM = $HTTP_SERVER_VARS['HTTP_COMING_FROM'];
        }
    elseif(!empty($HTTP_ENV_VARS) && isset($HTTP_ENV_VARS['HTTP_COMING_FROM']))
        {
        $HTTP_COMING_FROM = $HTTP_ENV_VARS['HTTP_COMING_FROM'];
        }
    elseif(@getenv('HTTP_COMING_FROM'))
        {
        $HTTP_COMING_FROM = getenv('HTTP_COMING_FROM');
        }
    } // end if
// Gets the default ip sent by the user
if(!empty($REMOTE_ADDR))
    {
    $direct_ip = $REMOTE_ADDR;
    }
// Gets the proxy ip sent by the user
$proxy_ip='';
if(!empty($HTTP_X_FORWARDED_FOR))$proxy_ip = $HTTP_X_FORWARDED_FOR;
elseif(!empty($HTTP_X_FORWARDED))$proxy_ip = $HTTP_X_FORWARDED;
elseif(!empty($HTTP_FORWARDED_FOR))$proxy_ip = $HTTP_FORWARDED_FOR;
elseif(!empty($HTTP_FORWARDED))$proxy_ip = $HTTP_FORWARDED;
elseif(!empty($HTTP_VIA))$proxy_ip = $HTTP_VIA;
elseif(!empty($HTTP_X_COMING_FROM))$proxy_ip = $HTTP_X_COMING_FROM;
elseif(!empty($HTTP_COMING_FROM))$proxy_ip = $HTTP_COMING_FROM;
// Returns the true IP if it has been found, else FALSE
if (empty($proxy_ip))
    {
    // True IP without proxy
    return $direct_ip;
    }
else
    {
    $is_ip = preg_match('/^([0-9]{1,3}\.){3,3}[0-9]{1,3}/', $proxy_ip, $regs);
    if($is_ip && (count($regs) > 0))
        {
        // True IP behind a proxy
        return $regs[0];
        }
    else
        {
        // Can't define IP: there is a proxy but we don't have
        // information about the true IP
        return FALSE;
        }
    } // end if... else...
}












	function uuidv4() {
    return sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',

  
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

 
      mt_rand(0, 0xffff),
 
      mt_rand(0, 0xffff),

 
      mt_rand(0, 0xffff),
 
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
  }
	
	

?>