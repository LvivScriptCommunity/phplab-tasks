<?php

function pagination($airports, $name, $state, $sort, $per_page = 5, $page = 1)
{
    $total = count($airports);
    $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $lastpage = ceil($total / $per_page);
    $pagination = "";

    for ($counter = 1; $counter <= $lastpage; $counter++):
        if ($counter == $page) {
            $pagination .= "<li class='page-item active'><a class='current page-link page-item'>$counter</a></li>";
        } else if (isset($name) && isset($state)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_first_letter=$name&filter_by_state=$state&sort=$sort'>$counter</a></li>";
        } else if (isset($state)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_state=$state&sort=$sort'>$counter</a></li>";
        } else if (isset($name)) {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&filter_by_first_letter=$name&sort=$sort'>$counter</a></li>";
        } else {
            $pagination .= "<li class='page-item'><a class='page-link' href='?page=$counter&sort=$sort'>$counter</a></li>";
        }
    endfor;

    return $pagination;
}

