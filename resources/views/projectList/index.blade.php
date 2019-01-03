@extends('layout.index')

@section('title')
    Projects List
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/gallery/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

    <style>
        #content5-1z {
            background-image: url('{{ asset("assets/image/background/projectList_header.jpg") }}');
        }

        .img-project {
            width: 60% !important;
            height:60%;
            object-fit: contain;
        }

        .carousel-caption {
            top: 0;
        }

        .carousel-caption h4 {
            color: #000000;
            margin: 10px 0;
        }
    </style>
@endsection 

@section('main')
    <section class="mbr-section content5 cid-rcxG03AaCJ mbr-parallax-background" id="content5-1z">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 col-md-8 text-center">
                    <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1">
                        YOUR PROJECTS LIST
                    </h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">
                        "If you don't know where you are going. How can you expect to get there?" ~ Basil S. Walsh 
                    </h3>
                    <a class="btn btn-info display-4 text-center" href="{{ url('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="mbr-gallery mbr-slider-carousel cid-rcxycnYb9J" id="gallery3-p">
        <div>
            <div>
                <div class="mbr-gallery-row">
                    <div class="mbr-gallery-layout-default">
                        <div>
                            <div>
                                <!-- new project -->
                                <div class="mbr-gallery-item mbr-gallery-item--p0" data-video-url="false">
                                    <div data-target="#modal-new-project" data-toggle="modal">
                                        <img src="{{ asset('assets/image/icon/add_file.png') }}">
                                        <span class="icon-plus"></span>
                                    </div>
                                </div>

                                @foreach($projects as $project)
                                    <div class="mbr-gallery-item mbr-gallery-item--p0" data-video-url="false">
                                        <div href="#lb-gallery3-p" data-slide-to="{{ $loop->index }}" data-toggle="modal">
                                            <img src="{{ asset('assets/image/project/'.$project->project_image) }}">
                                            <span class="icon-focus"></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- Lightbox -->

                <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery3-p">
                    <div class="modal-dialog" id="modal-project">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="carousel-inner">
                                    @foreach($projects as $project)
                                        <div class="carousel-item @if($loop->index == 0) active @endif">
                                            <img src="{{ asset('assets/image/background/projectList.png') }}">

                                            <div class="carousel-caption">
                                                <img src="{{ asset('assets/image/project/'.$project->project_image) }}" class="img-project">

                                                <h4 class="display-2">
                                                    {{ $project->project_name }}
                                                    -
                                                    @if($project->user_id == auth()->id())
                                                        By You
                                                    @else 
                                                        By {{ $project->user->name }}
                                                    @endif
                                                </h4>

                                                <a class="btn btn-sm btn-primary" href="{{ url('project/'.$project->id) }}">Open Project</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery3-p">
                                    <span class="mbri-left mbr-iconfont" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery3-p">
                                    <span class="mbri-right mbr-iconfont" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <a class="close" role="button" data-dismiss="modal">
                                    <span class="sr-only">Close</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="countdown2 cid-rcxzYl6Cn3" id="countdown2-x">
        <div class="container">
            <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
                Countdown
            </h2>
            <h3 class="mbr-section-subtitle align-center mbr-fonts-style display-5">
                @if($projects->first() && $projects->first()->project_deadline > date('Y-m-d'))
                    Your Closest Project Deadline
                @else
                    No Undergoing Project
                @endif
            </h3>
        </div>
        <div class="container pt-5 mt-2">
            <div class=" countdown-cont align-center p-4">
                <div class="event-name align-left mbr-white ">
                    <h4 class="mbr-fonts-style display-5">
                        @if($projects->first() && $projects->first()->project_deadline > date('Y-m-d'))
                            {{ strtoupper($projects->first()->project_name) }} Project
                        @else
                            -
                        @endif
                    </h4>
                </div>
                <div class="countdown align-center py-2" data-due-date="{{ ($projects->first()) ? $projects->first()->project_deadline : "" }}"></div>
                <div class="daysCountdown" title="Days"></div>
                <div class="hoursCountdown" title="Hours"></div>
                <div class="minutesCountdown" title="Minutes"></div>
                <div class="secondsCountdown" title="Seconds"></div>
                <div class="event-date align-left mbr-white">
                    <h5 class="mbr-fonts-style display-7">
                        @if($projects->first() && $projects->first()->project_deadline > date('Y-m-d'))
                            {{ $projects->first()->getDate() }} -
                        @endif
                        NS
                    </h5>
                </div>
            </div>
        </div>
    </section>

    <section>
        <!-- Modal New Project -->
        <div class="modal fade" id="modal-new-project" tabindex="-1" role="dialog" aria-labelledby="modalNewProject" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ url('project') }}" method="POST" id="form-new-project" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="project-name">Project Name <span class="required">*</span></label>
                                <input type="text" name="project_name" class="form-control" placeholder="Project Name" value="{{ old('project_name') }}">
                            </div>

                            @if($errors->has('project_name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('project_name') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="project-deadline">Project Deadline <span class="required">*</span></label>
                                <input type="text" name="project_deadline" id="project-deadline" class="form-control" placeholder="Deadline" value="{{ old('project_deadline') }}" readonly>
                            </div>

                            @if($errors->has('project_deadline'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('project_deadline') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="project-description">Project Description</label>
                                <textarea class="form-control" name="project_description" rows="3" placeholder="Description">{{ old('project_description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="project-image"><b>Project Image</b> <span class="required">*</span></label>
                                <input type="file" name="project_image">
                            </div>

                            @if($errors->has('project_image'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('project_image') }}
                                </div>
                            @endif

                            @if($errors->has('currProject'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('currProject') }}
                                </div>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/page/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/page/parallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/page/masonry/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/page/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/page/countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/page/bootstrapcarouselswipe/bootstrap-carousel-swipe.js') }}"></script>
    <script src="{{ asset('assets/page/theme/js/script.js') }}"></script>
    <script src="{{ asset('assets/page/gallery/player.min.js') }}"></script>
    <script src="{{ asset('assets/page/gallery/script.js') }}"></script>
    <script src="{{ asset('assets/page/slidervideo/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    @include('layout.socket')

    <script type="text/javascript">
        $(function() {
            @if($errors->any())
                $('#modal-new-project').modal({
                    show: true
                });
            @elseif(session('error'))
                Swal({
                    type: 'error',
                    title: '{{ session("error") }}'
                });
            @elseif(session('success')) 
                Swal({
                    type: 'success',
                    title: '{{ session("success") }}'
                });
            @endif

            $('#project-deadline').datetimepicker({
                format: "YYYY-MM-DD",
                widgetPositioning: {
                    horizontal: 'left',
                    vertical: 'bottom'
                },
                ignoreReadonly: true,
                useCurrent: false,
                minDate: moment().add(1, 'd').startOf('d')
            });

            $('div[data-target="#modal-new-project"]').on('click', () => {
                $('#form-new-project').find('input[type!="hidden"]').val('');
                $('#form-new-project').find('.alert').remove();
            });
        });
    </script>
@endsection