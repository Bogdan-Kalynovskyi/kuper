<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


//  ===========================


if (!IS_ADMIN && $POOO) {

    $temp = ($USER) ? ($USER['id']) : "INET_ATON('{$_SERVER['REMOTE_ADDR']}')";

    $db->query("INSERT INTO " . MY_PRF . "stat (time, click, search, ip) VALUES
					('" . time() . "', {$POOO['id']}, " . a(strip_all($POOO['title'])) . ", $temp)");


}


if (!IS_ADMIN) {


    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; // The referer

    if (empty($referer)) {
        return;
    }


    $arr = parse_url($MY_URL); //маємо надію що завжди включено http:// bodya
    $_host = preg_replace("~ˆ[w]{0,3}\.(. )~i", "\\1", $arr['host']);
    $arr1 = parse_url($referer); //маємо надію що завжди включено http:// bodya
    $_host1 = preg_replace("~ˆ[w]{0,3}\.(. )~i", "\\1", $arr1['host']);
//bodya це шоб не шукати ПОДСТРОКУ? www	

    if (strpos($_host1, $_host) !== false) {
        return;
    } // bodya debug this!


    $referer = a(bmc_myurlencode($referer));

    $ref_time = time();

    $ref_page = a(bmc_myurlencode(str_replace($differ, '', $_SERVER['PHP_SELF'])));


    //ахуэнна ідея тільки першу входження реалызуй всюзи up_pic.php bodya
    /*echo"'{$_SERVER['SERVER_NAME']}',$ref_page,
                '{$MY_URL}',
                '$referer',
                    '{$_host}',---- $_host1";*/

    $db->query("INSERT INTO " . MY_PRF . "ref (time, ip, url, page) VALUES (
			$ref_time,
			INET_ATON('{$_SERVER['REMOTE_ADDR']}'),
			$referer,
			$ref_page)");

}

?>
