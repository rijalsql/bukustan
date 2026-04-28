<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -1px;
    }

    /* Notification Card Styling */
    .inbox-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        gap: 1.2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .inbox-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }

    /* Icon Indicator */
    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.25rem;
    }

    /* Variasi warna berdasarkan subjek (otomatis) */
    .bg-info-soft { background-color: #eff6ff; color: #2563eb; }
    .bg-warning-soft { background-color: #fffbeb; color: #d97706; }
    .bg-danger-soft { background-color: #fef2f2; color: #dc2626; }

    .message-content {
        flex-grow: 1;
    }

    .message-subject {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
        font-size: 1.05rem;
    }

    .message-body {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 0.75rem;
    }

    .message-meta {
        font-size: 0.8rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Close/Delete Button Custom */
    .btn-delete-msg {
        position: absolute;
        top: 1rem;
        right: 1rem;
        color: #cbd5e1;
        transition: 0.2s;
        padding: 5px;
        border-radius: 8px;
    }

    .btn-delete-msg:hover {
        color: #ef4444;
        background: #fee2e2;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        border: 2px dashed #e2e8f0;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
        display: block;
    }
</style>

<div class="page-header">
    <h2 class="page-title">Kotak Pesan</h2>
    <p class="text-muted">Pemberitahuan resmi dan informasi penting terkait aktivitas perpustakaan Anda.</p>
</div>

<div class="container-fluid p-0">
    <?php if (empty($pesan)) : ?>
        <div class="empty-state">
            <i class="bi bi-envelope-open"></i>
            <h5 class="fw-bold text-dark">Belum ada pesan</h5>
            <p class="text-muted">Kotak masuk Anda kosong. Semua pemberitahuan akan muncul di sini.</p>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($pesan as $p) : 
                    // Logika sederhana untuk menentukan warna icon berdasarkan kata kunci subjek
                    $subjek = $p['subjek'] ?? 'Tanpa Subjek';
                    $bg_class = 'bg-info-soft';
                    $icon_class = 'bi-info-circle-fill';

                    if (stripos($subjek, 'denda') !== false || stripos($subjek, 'telat') !== false) {
                        $bg_class = 'bg-warning-soft';
                        $icon_class = 'bi-exclamation-triangle-fill';
                    } elseif (stripos($subjek, 'penting') !== false || stripos($subjek, 'blokir') !== false) {
                        $bg_class = 'bg-danger-soft';
                        $icon_class = 'bi- megaphone-fill';
                    }
                ?>
                    <div class="inbox-card mb-3">
                        <a href="<?= base_url('inbox-anggota/hapus/' . ($p['id_inbox'] ?? $p['id'])) ?>" 
                           class="btn-delete-msg" 
                           onclick="return confirm('Hapus pesan ini?')"
                           title="Hapus pesan">
                            <i class="bi bi-trash3"></i>
                        </a>

                        <div class="icon-wrapper <?= $bg_class ?>">
                            <i class="bi <?= $icon_class ?>"></i>
                        </div>

                        <div class="message-content">
                            <h5 class="message-subject"><?= $subjek ?></h5>
                            <p class="message-body">
                                <?= $p['pesan'] ?? 'Isi pesan tidak terbaca' ?>
                            </p>
                            <div class="message-meta">
                                <i class="bi bi-clock"></i>
                                <?= date('d F Y', strtotime($p['tanggal'] ?? 'now')) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="col-lg-4 d-none d-lg-block">
                <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; background: #2563eb; color: white;">
                    <h6 class="fw-bold"><i class="bi bi-lightbulb me-2"></i> Tips Perpustakaan</h6>
                    <p class="small mb-0" style="opacity: 0.9;">
                        Selalu cek kotak pesan secara berkala untuk menghindari keterlambatan pengembalian buku dan denda yang menumpuk.
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>