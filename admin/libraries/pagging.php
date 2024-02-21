<?php
function get_pagging($num_page, $page, $base_url = "")
{
    $str_pagging = "<ul class='pagination'>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .=  "<li class='page-item'><a class='page-link' aria-label='Previous' href='{$base_url}&page={$page_prev}' title=''><span aria-hidden='true'>Trước</span></a></li>";
    }
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page){
            $active = "active";
        } 
        $str_pagging .=  "<li class='page-item {$active}'><a class='page-link' href=\"{$base_url}&page={$i}\">{$i}</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .=  "<li class='page-item'><a class='page-link' aria-label='Next' href='{$base_url}&page={$page_next}' title=''><span aria-hidden='true'>Sau</span></a></li>";
    }
    $str_pagging .=  "</ul>";
    return $str_pagging;
}
?>
<!-- <ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="" aria-label="Previous">
            <span aria-hidden="true">Trước</span>
        </a>
    </li>
    <li class="page-item"><a class="page-link" href="?mod=users&controllers=team&page=1">1</a></li>
    <li class="page-item">
        <a class="page-link" href="" aria-label="Next">
            <span aria-hidden="true">Sau</span>
        </a>
    </li>
</ul> -->