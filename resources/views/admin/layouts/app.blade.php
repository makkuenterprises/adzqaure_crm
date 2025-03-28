<!DOCTYPE html>
<html lang="en">

<head>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('admin/css/app.css?v=4') }}">
    @yield('css')
    {{-- Title --}}
    <title>Admin Panel </title>


    @yield('panel-head')



</head>

<body>

    @if (auth()->user()->status)

        @include('admin.common.modal-dialog')

        {{-- Main (Start) --}}
        <main>

            {{-- Top Navigation --}}
            @include('admin.common.navigation')

            {{-- Panel --}}
            <section id="panel-section">
                <div class="panel-dark-background"></div>
                <div class="panel-container">
                    <header class="panel-header">
                        <div>
                            @yield('panel-header')
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
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script>
            let height = document.getElementById('top-navigation').clientHeight;
            console.log(height);
            document.getElementById('panel-section').style.paddingTop = `${height}px`;
        </script>

        @yield('panel-script')

        @if (session('message'))
            <script defer>
                swal({
                    icon: "{{ session('message')['status'] }}",
                    title: "{{ session('message')['title'] }}",
                    text: "{{ session('message')['description'] }}",
                });
            </script>
        @endif
    @else
        <main class="h-screen w-full flex items-center justify-center">
            <h1 class="text-2xl font-semibold text-admin-ascent">Your Access is Blocked</h1>
        </main>
    @endif

</body>

</html>
