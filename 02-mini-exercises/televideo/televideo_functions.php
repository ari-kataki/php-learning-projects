<?php



function getPageNumber() {
    if (isset($_GET['page']) && $_GET['page'] !== '') {
        return intval($_GET['page']);
    }
    return 100;
}


function isValidPage($page) {
    return ($page >= 100 && $page <= 800);
}


function formatPageNumber($page) {
    return str_pad($page, 3, '0', STR_PAD_LEFT);
}


function getTelevideoImageUrl($page) {
    $pageFormatted = formatPageNumber($page);
    return "https://www.televideo.rai.it/televideo/pub/tt4web/Nazionale/page-{$pageFormatted}.png";
}
?>
