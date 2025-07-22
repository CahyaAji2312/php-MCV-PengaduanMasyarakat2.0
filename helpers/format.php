<?php
function formatTanggal($datetime) {
    return date('d M Y H:i', strtotime($datetime)) . ' WIB';
}
