<?php
function status_badge($status) {
    $map = [
        'Diajukan' => 'warning',
        'Diverifikasi' => 'info',
        'Diproses' => 'primary',
        'Ditindaklanjuti' => 'secondary',
        'Selesai' => 'success',
        'Ditolak' => 'danger'
    ];
    $class = $map[$status] ?? 'secondary';
    return "<span class="badge badge-$class">".htmlspecialchars($status)."</span>";
}

function generate_ticket() {
    return 'WC-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));
}
?>