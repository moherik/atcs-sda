<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .icon-box-light {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border-radius: 50%;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .custom-link {
        color: #212529;
        text-decoration: none;
        transition: color 0.15s ease-in-out;
    }
    .custom-link:hover {
        color: #0d6efd;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="flex-fill bg-light py-5">
    <div class="container py-4">
        
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark mb-2">Tentang Kami</h2>
                    <p class="text-secondary fs-5">Dinas Perhubungan Kabupaten Sidoarjo</p>
                </div>

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex flex-column gap-4">
                            
                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-cursor-fill"></i>
                                </div>
                                <div class="fs-5 text-dark">
                                    Jl. Raya Candi No.107, Gelam, Kec. Candi, Kabupaten Sidoarjo, Jawa Timur 61271
                                </div>
                            </div>
                            
                            <hr class="m-0 text-muted" style="opacity: 0.15">

                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-printer-fill"></i>
                                </div>
                                <div class="fs-5">
                                    <a href="tel:0318941114" class="custom-link">(031) 8941114</a>
                                </div>
                            </div>
                            
                            <hr class="m-0 text-muted" style="opacity: 0.15">

                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-telephone-outbound-fill"></i>
                                </div>
                                <div class="fs-5">
                                    <a href="tel:0318941114" class="custom-link">(031) 8941114</a>
                                </div>
                            </div>
                            
                            <hr class="m-0 text-muted" style="opacity: 0.15">

                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-envelope-paper-fill"></i>
                                </div>
                                <div class="fs-5">
                                    <a href="mailto:dishub@sidoarjokab.go.id" class="custom-link">dishub@sidoarjokab.go.id</a>
                                </div>
                            </div>

                            <hr class="m-0 text-muted" style="opacity: 0.15">
                            
                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-pin-map-fill"></i>
                                </div>
                                <div class="fs-5">
                                    <a href="https://maps.app.goo.gl/9hbGQkruSWjFMraJA" target="_blank" class="custom-link">Lokasi</a>
                                </div>
                            </div>

                            <hr class="m-0 text-muted" style="opacity: 0.15">
                            
                            <div class="d-flex align-items-center gap-4">
                                <div class="icon-box-light">
                                    <i class="bi bi-bar-chart-fill" style="transform: rotate(90deg); display: inline-block;"></i>
                                </div>
                                <div class="fs-5">
                                    <a href="https://ikm.sidoarjokab.go.id/opd/114" target="_blank" class="custom-link">e-SKM</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
<?= $this->endSection() ?>
