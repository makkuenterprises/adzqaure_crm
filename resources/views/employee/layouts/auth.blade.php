<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{asset('employee/css/app.css')}}">

    {{-- Title --}}
    <title>Team Member Panel </title>

    {{-- Script --}}
    <script defer src="{{asset('employee/js/app.js')}}"></script>

</head>
<body>

    {{-- Main (Start) --}}
    <main class="h-auto w-full bg-slate-200">
        <section class="h-[125vh] w-full flex justify-center items-center">

            <div class="md:w-1/4">
                @yield('auth-card')
            </div>

        </section>
    </main>
    {{-- Main (End) --}}

</body>
</html>