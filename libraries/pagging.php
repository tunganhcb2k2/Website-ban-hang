<?php
function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul class='list-item clearfix'>";
   
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page) {
            $active = "active";
        }
        $str_pagging .=  "<li class='{$active}'><a href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
   
    $str_pagging .=  "</ul>";
    return $str_pagging;
}
