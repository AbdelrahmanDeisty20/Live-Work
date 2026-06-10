
@php
    $PageData = \App\Models\Page::pluck('value', 'key');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aetheria System Dashboard - Creative administrative interface control.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $PageData['site_name'] }} | Creative System Control</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Link to dashboard stylesheet -->
    @unless(View::hasSection('is-login'))
        <link rel="stylesheet" href="{{ secure_asset('assets/dashboard/style.css') }}">
    @endunless
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('extra-styles')
</head>
<body>