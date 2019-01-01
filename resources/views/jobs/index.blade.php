@extends('layout.index')

@section('title')
    Jobs - {{ $project->project_name }}  
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">

    <style>
        #content5-1x {
            background-image: url('{{ asset("assets/image/background/projectList_header.jpg") }}');
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
    </style>
@endsection

@section('main')
    <section class="menu cid-rcxFbLACFP" once="menu" id="menu1-1s">  
        @include('layout.navbar')
    </section>

    <section class="mbr-section content5 cid-rcxFLsfFqk mbr-parallax-background" id="content5-1x">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 col-md-8">
                    <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1">
                        Jobs
                    </h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">
                        Pleasure in the job puts perfection in the work. ~ Aristotle
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="progress-bars1 cid-rcxFvkC2tU" id="progress-bars1-1v">
        <div id="calendar"></div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/page/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/page/dropdown/js/script.min.js') }}"></script>
    <script src="{{ asset('assets/page/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/page/parallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/page/theme/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    @include('layout.socket')

    <script>
        $(function() {
            $('#calendar').fullCalendar({
                defaultView: 'month'
            });
        }); 
    </script>
@endsection