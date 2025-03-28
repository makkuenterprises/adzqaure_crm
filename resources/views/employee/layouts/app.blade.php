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

</head>

<body>


    @include('employee.common.modal-dialog')

    {{-- Main (Start) --}}
    <main>

        {{-- Sidebar --}}
        @include('employee.common.sidebar')

        {{-- Panel --}}
        <section id="panel-section">
            <div class="panel-dark-background"></div>
            <div class="panel-container">
                <header class="panel-header">
                    <div>
                        @yield('panel-header')
                    </div>
                    <div class="flex md:space-x-5 sm:space-x-3">
                        <button onclick="$('#sidebar').toggleClass('active')"><i data-feather="menu" class="w-7 h-7 stroke-white fill-white"></i></button>
                        @include('employee.common.profile-dropdown')
                    </div>
                </header>
                <section class="panel-body">
                    
                    @yield('panel-body')

                </section>
            </div>
        </section>

    </main>
    {{-- Main (End) --}}

    {{-- Script --}}
    <script defer src="{{asset('employee/js/app.js')}}"></script>

    @yield('panel-script')

    @yield('panel-modal')

   

</body>

</html>
