<?php
function is_firefox() {
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $agent = $_SERVER['HTTP_USER_AGENT'];
    }
    
    return strlen(strstr($agent, 'Firefox')) > 0;
}