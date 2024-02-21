<?php

function base_url($url = "")
{
    global $config;
    return $config['base_url'] . $url;
}
function redirect($url = '?')
{
    if (!empty($url)) {
        header("Location: {$url}");
    }
}
