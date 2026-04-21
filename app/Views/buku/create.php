<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Crimson+Text:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --hp-gold: #ffc500;
        --hp-red: #740001;
        --hp-ink: #2b2b2b;
        --hp-parchment: #f4e1d2;
    }

    .ministry-container {
        padding: 40px 20px;
    }

    .hp-card {
        background-color: var(--hp-parchment);
        background-image: url('https://www.transparenttextures.com/patterns/parchment.png');
        border: 4px double #3d2b1f;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        border-radius: 0;
    }

    .hp-card-header {
        background: var(--hp-red) !important;
        border-bottom: 4px double var(--hp-gold);
        text-align: center;
        padding: 20px;
    }

    .hp-card-header h4 {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-gold);
        letter-spacing: 2px;
        margin: 0;
        text-transform: uppercase;
    }

    .hp-label {
        font-family: 'MedievalSharp', cursive;
        color: var(--hp-red);
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    /* Input Style ala Dokumen Tua */
    .hp-form-control {
        background: rgba(255, 255, 255, 0.3);
        border: none;
        border-bottom: 2px solid #3d2b1f;
        border-radius: 0;
        padding: 10px 5px;
        font-family: 'Crimson Text', serif;
        font-size: 1.2rem;
        color: var(--hp-ink);
        transition: 0.3s;
    }

    .hp-form-control:focus {
        background: rgba(255, 255, 255, 0.5);
        border-bottom-color: var(--hp-red);
        box-shadow: none;
        outline: none;
    }

    /* Custom Styling for Select */
    select.hp-form-control {
        cursor: pointer;
    }

    /* Tombol Sihir */
    .btn-magic {
        font-family: 'MedievalSharp', cursive;
        padding: 12px 25px;
        border-radius: 0;
        transition: 0.4s;
        text-transform: uppercase;
        border: 2px solid #3d2b1f;
        font-weight: bold;
    }

    .btn-save {
        background: var(--hp-red);
        color: var(--hp-gold);
        border-color: var(--hp-gold);
    }

    .btn-save:hover {
        background: #900000;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(116, 0, 1, 0.4);
    }

    .btn-cancel {
        background: #d2b48c;
        color: #3d2b1f;
    }

    .btn-cancel:hover {
        background: #c1a37b;
        transform: translateY(-2px);
    }

    .helper-text {
        font-family: 'Crimson Text', serif;
        font-style: italic;
        color: #5d4037;
    }

    hr {
        border-top: 2px double #3d2b1f;
        opacity: 0.5;
    }
</style>

<div class="container ministry-container">
    <div class="card hp-card">
        <div class="card-header hp-card-header">
            <h4><i class="fas fa-quill-pen me-2"></i> New Grimmoire Registration</h4>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="hp-label">Title of Scroll</label>
                        <input type="text" name="judul" class="form-control hp-form-control" placeholder="Enter book title..." required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="hp-label">The Author / Wizard</label>
                        <input type="text" name="penulis" class="form-control hp-form-control" placeholder="Wizard name..." required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="hp-label">Magic Category</label>
                        <select name="kategori" class="form-control hp-form-control" required>
                            <option value="">-- Select Category --</option>
                            <option value="Kitab">📜 Ancient Script (Kitab)</option>
                            <option value="Novel">📖 Wizarding Tales (Novel)</option>
                            <option value="Cerita">🎭 Fables (Cerita)</option>
                            <option value="Ilmu">🧪 Potion & Spells (Ilmu)</option>
                            <option value="Teknik">⚒️ Magical Craft (Teknik)</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="hp-label">Stock Quantity</label>
                        <input type="number" name="stok" class="form-control hp-form-control" placeholder="0" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="hp-label">Daily Penalty (Galleons/Rp)</label>
                        <input type="number" name="denda_per_hari" class="form-control hp-form-control" value="2000" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="hp-label">Visual Representation (Cover)</label>
                        <input type="file" name="foto" class="form-control hp-form-control" accept="image/*" style="border-bottom: none; background: transparent;">
                        <small class="helper-text">*Accepted: jpg, png. Max: 2MB. Make it magical.</small>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-end gap-3">
                    <a href="<?= base_url('buku') ?>" class="btn btn-magic btn-cancel">
                        <i class="fas fa-times me-1"></i> Discard
                    </a>
                    <button type="submit" class="btn btn-magic btn-save">
                        <i class="fas fa-check-double me-1"></i> Register Scroll
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>