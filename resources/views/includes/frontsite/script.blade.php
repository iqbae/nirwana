{{--  favicon  --}}
<link rel="icon" href="{{ asset('/assets/frontsite/images/favicon.ico') }}">
<script defer src="{{ url('https://unpkg.com/alpinejs@3.8.0/dist/cdn.min.js') }}"></script>
<script>
    const container = document.getElementById('specialist-container');

    let scrollAmount = 0;
    let scrollStep = 1; // Kecepatan scroll, semakin tinggi angkanya semakin cepat scroll-nya
    
    function autoScroll() {
        scrollAmount += scrollStep;
        container.scrollLeft = scrollAmount;
    
        // Mengulangi scroll dari awal setelah mencapai akhir
        if (container.scrollLeft >= container.scrollWidth - container.clientWidth) {
            scrollAmount = 0;
        }
    
        requestAnimationFrame(autoScroll);
    }
    
    // Memulai scroll otomatis
    autoScroll();  
</script>