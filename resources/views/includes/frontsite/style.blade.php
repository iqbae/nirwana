<link rel="preconnect" href="{{ url('https://fonts.googleapis.com') }}" />
<link rel="preconnect" href="{{ url('https://fonts.gstatic.com') }}" crossorigin />
<link href="{{ url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet') }}"/>

<link rel="stylesheet" href="{{ asset('/assets/frontsite/style.css') }}" />
<style>
    /* CSS untuk menghilangkan scrollbar */
    #specialist-container {
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* Internet Explorer 10+ */
    }
    
    #specialist-container::-webkit-scrollbar {
        display: none; /* Safari and Chrome */
    }
    
    /* CSS untuk teks satu baris */
    .specialist-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
