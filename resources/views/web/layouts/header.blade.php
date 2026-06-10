@php
    $PageData = \App\Models\Page::pluck('value', 'key');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cyber-Constellation Portfolio - Sophisticated interactive full-stack architecture design.">
    <title>{{ $PageData['site_name'] }} | Creative Full-Stack Engineer</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <!-- Custom Cursor Elements -->
    <div class="custom-cursor" id="custom-cursor"></div>
    <div class="custom-cursor-dot" id="custom-cursor-dot"></div>

