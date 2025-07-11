<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="map-container flex-fill d-flex flex-column">
    <aside class="sidebar shadow rounded m-3">
        <div class="d-flex align-items-center gap-2 ps-1 pe-3 py-2 border-bottom shadow-sm">
            <button onclick="javascript:toggleSidebar()" class="btn" type="button">
                <svg width="20" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352" />
                </svg>
            </button>
            <span class="fw-medium ">Daftar Lokasi</span>
        </div>
        <div id="listSidebar" class="list-group list-group-flush flex-fill overflow-y-auto">
            <?php foreach ($cctv_list as $cctv): ?>
                <a href="#" class="list-group-item d-flex align-items-center gap-2" onclick="javascript:onClickMarker('<?= $cctv['nama'] ?>', '<?= $cctv['jalan'] ?>', '<?= $cctv['video_src'] ?>', '<?= $cctv['status_online'] ?>')">
                    <svg width="30" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                        <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                        <path d="M216.32 334.44l114.45-69.14a10.89 10.89 0 000-18.6l-114.45-69.14a10.78 10.78 0 00-16.32 9.31v138.26a10.78 10.78 0 0016.32 9.31z" />
                    </svg>
                    <div>
                        <p class="m-0 p-0"><?= $cctv['nama'] ?></p>
                        <?php if (isset($cctv['jalan'])): ?>
                            <p class="m-0 p-0 text-secondary"><small><?= $cctv['jalan'] ?></small></p>
                        <?php endif ?>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </aside>

    <div id="map" class="map h-100 flex-fill"></div>

    <div class="modal fade" id="videoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="videoModalLabel">Pantauan Lalu Lintas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 player-body">
                    <video controls id="video" class="w-100"></video>
                    <div id="videoOffline" class="d-none flex-column justify-content-center align-items-center">
                        <svg width="48" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path d="M93.72 183.25C49.49 198.05 16 233.1 16 288c0 66 54 112 120 112h184.37M467.82 377.74C485.24 363.3 496 341.61 496 312c0-59.82-53-85.76-96-88-8.89-89.54-71-144-144-144-26.16 0-48.79 6.93-67.6 18.14" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M448 448L64 64" />
                        </svg>
                        <div class="mt-2">CCTV sedang offline</div>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <div id="deskripsiVideo">
                        <div class="d-flex align-items-start gap-2">
                            <svg width="30" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                                <path d="M216.32 334.44l114.45-69.14a10.89 10.89 0 000-18.6l-114.45-69.14a10.78 10.78 0 00-16.32 9.31v138.26a10.78 10.78 0 0016.32 9.31z" />
                            </svg>
                            <div>
                                <p id="judulVideo" class="m-0 p-0 fw-medium mt-1">Judul</p>
                                <div id="lokasiVideoDiv" class="none">
                                    <div class="d-flex align-items-center gap-1 mt-1">
                                        <svg width="18" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                            <path d="M256 48c-79.5 0-144 61.39-144 137 0 87 96 224.87 131.25 272.49a15.77 15.77 0 0025.5 0C304 409.89 400 272.07 400 185c0-75.61-64.5-137-144-137z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                            <circle cx="256" cy="192" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                                        </svg>
                                        <p id="lokasiVideo" class="m-0 p-0 fs-6 text-secondary">Lokasi</p>
                                    </div>
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

<?= $this->section('js') ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>

<script type="text/javascript">
    const cctvData = JSON.parse('<?= json_encode($cctv_list) ?>');

    const map = L.map('map').setView(new L.LatLng(-7.446090067540411, 112.71768320856496), 13);
    map.panBy([-200, 0]);
    map.zoomControl.setPosition('bottomright');

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    createMarker();

    function createMarker() {
        if (!cctvData) return;

        cctvData.forEach((data) => {
            if (data.visible && data.latitude && data.longitude) {
                L.marker([data.latitude, data.longitude])
                    .addTo(map)
                    .on('click', (e) => onClickMarker(data.nama, data.jalan, data.video_src, data.status_online))

            }
        })
    }

    function onClickMarker(nama, jalan, videoSrc, statusOnline) {
        document.getElementById("judulVideo").innerText = nama;

        if (jalan) {
            document.getElementById("lokasiVideoDiv").style.display = 'block';
            document.getElementById("lokasiVideo").innerText = jalan;
        }

        if (statusOnline) {
            document.getElementById('video').style.display = 'block';
            document.getElementById('videoOffline').classList.remove('d-flex');
            document.getElementById('videoOffline').classList.add('d-none');
        } else {
            document.getElementById('video').style.display = 'none';
            document.getElementById('videoOffline').classList.remove('d-none');
            document.getElementById('videoOffline').classList.add('d-flex');
        }

        const videoModal = new bootstrap.Modal('#videoModal')
        videoModal.show();

        playVideo(videoSrc);
    }

    function playVideo(videoSrc) {
        const video = document.getElementById('video');

        if (Hls.isSupported()) {
            const hls = new Hls({
                "enableWorker": true,
                "lowLatencyMode": true,
                "backBufferLength": 90
            });

            hls.on(Hls.Events.ERROR, function(event, data) {
                console.log(event, data);
            });

            hls.loadSource(`/proxy?url=${btoa(videoSrc)}`);
            hls.attachMedia(video);

            video.play();

        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            video.src = videoSrc;
        }
    }

    function toggleSidebar() {
        const listSidebar = document.getElementById('listSidebar');
        if (listSidebar.classList.contains('d-none')) {
            listSidebar.classList.remove('d-none');
            map.panBy([-200, 0]);
        } else {
            listSidebar.classList.add('d-none');
            map.panBy([200, 0]);
        }
    }
</script>
<?= $this->endSection() ?>