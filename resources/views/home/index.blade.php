@extends('layout.index')

@section('title')
    Home - {{ $project->project_name }}  
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/as-pie-progress/css/progress.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.2/rangeslider.min.css">

    <style type="text/css">
        #info3-17 {
            background-image: url('{{ asset("assets/image/background/home_header.jpg") }}');
        }

        #features16-13 {
            padding-top: 0;
        }

        .item-caption {
            height: 95px;
        }
    </style>
@endsection

@section('main')
    <section class="menu cid-rcxBvFvNhY" once="menu" id="menu1-18">
        @include('layout.navbar')
    </section>

    <section class="mbr-section info3 cid-rcxBjNEEjS" id="info3-17">
        <div class="container">
            <div class="row justify-content-center">
                <div class="media-container-column title col-12 col-md-10">
                    <h2 class="align-left mbr-bold mbr-white pb-3 mbr-fonts-style display-2 text-uppercase">
                        {{ $project->project_name }}
                    </h2>
                    <h3 class="mbr-section-subtitle align-left mbr-light mbr-white pb-3 mbr-fonts-style display-5">
                        @if($project->project_description == null)
                            There is no description for this project
                        @else
                            {{ $project->project_description }}
                        @endif
                    </h3>
                    <p class="mbr-text align-left mbr-white mbr-fonts-style display-7">
                        This project was created by {{ ($project->user_id == auth()->id()) ? 'YOU' : strtoupper($project->user->name) }}, and had deadline on {{ $project->getDate() }}
                    </p>
                    <div class="mbr-section-btn align-left py-4">
                        <a class="btn btn-primary display-4" href="{{ url('project') }}">Projects List</a>
                        @if($project->user_id == auth()->id())
                            <a class="btn btn-white-outline display-4" href="{{ url('project/delete_project/'.$project->id) }}">Delete Project</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="progress-bars3 cid-rcxAYIM1CR" id="progress-bars3-15">
        <div class="container">
            <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
                Project Progress Bar
            </h2>

            <h3 class="mbr-section-subtitle mbr-fonts-style display-5">
                This project is currently at the {{ $project->project_progress }}% level for completion.
            </h3>
        
            <div class="media-container-row pt-5 mt-2">
                <div class="card p-3 align-center"></div>

                <div class="card p-3 align-center">
                    <div class="wrap">
                        <div class="pie_progress progress2" role="progressbar" id="progress" data-goal="{{ $project->project_progress }}">
                            <p class="pie_progress__number mbr-fonts-style display-5"></p>
                        </div>
                    </div> 
                    <div class="mbr-crt-title pt-3">
                        <h4 class="card-title py-2 mbr-fonts-style display-5">
                            Works done
                        </h4>

                        @if($project->user_id == auth()->id())
                            <p>Change Current Progress : <span id="slider-value"></span></p>
                            <input type="range" min="0" max="100" value="{{ $project->project_progress }}" id="slider">
                            <br>
                            <button type="button" class="btn btn-sm btn-primary" id="btn-slider-update">Update</button>
                        @endif
                    </div>                 
                </div>

                <div class="card p-3 align-center"></div>                
            </div>
        </div>
    </section>

    <section class="features16 cid-rcxAUacCgK" id="features16-13">
        <div class="container align-center">
            <h2 class="pb-3 mbr-fonts-style mbr-section-title display-2">
                THIS PROJECT'S AWESOME TEAM
            </h2>

            <div class="row media-row">
                @if($project->user_id == auth()->id())
                    <div class="team-item col-lg-3 col-md-6" data-target="#modal-new-member" data-toggle="modal" style="cursor: pointer;">
                        <div class="item-image">
                            <img src="{{ asset('assets/image/icon/add_team.png') }}">
                        </div>
                        <div class="item-caption py-3">
                            <div class="item-name px-2">
                                <p class="mbr-fonts-style display-5">
                                    Add Project Member
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="team-item col-lg-3 col-md-6">
                    <div class="item-image">
                        <img src="{{ asset('assets/image/user/'.$project->user->profile_picture) }}">
                    </div>
                    <div class="item-caption py-3">
                        <div class="item-name px-2">
                            <p class="mbr-fonts-style display-5">
                                {{ ($project->user_id == auth()->id()) ? 'YOU' : strtoupper($project->user->name) }} 
                            </p>
                        </div>
                        <div class="item-role px-2">
                            <p>Project Leader</p>
                        </div>
                    </div>
                </div>
                @foreach($project->projectDetails as $team) 
                    <div class="team-item col-lg-3 col-md-6">
                        <div class="item-image">
                            <img src="{{ asset('assets/image/user/'.$team->user->profile_picture) }}">
                        </div>
                        <div class="item-caption py-3">
                            <div class="item-name px-2">
                                <p class="mbr-fonts-style display-5">
                                    {{ ($team->user->id == auth()->id()) ? 'YOU' : strtoupper($team->user->name) }} 
                                </p>
                            </div>
                            <div class="item-role px-2">
                                <p>Project Member</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>    
        </div>
    </section>

    @if($project->user_id == auth()->id())
        <!-- Modal New Member -->
        <div class="modal fade" id="modal-new-member" tabindex="-1" role="dialog" aria-labelledby="modalNewMember" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ url('project/new_member') }}" method="POST" id="form-new-member">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email New Member" value="{{ old('email') }}">
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Send Invitation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script src="{{ asset('assets/page/dropdown/js/script.min.js') }}"></script>
    <script src="{{ asset('assets/page/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/page/as-pie-progress/jquery-as-pie-progress.min.js') }}"></script>
    <script src="{{ asset('assets/page/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/page/theme/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.2/rangeslider.min.js"></script>

    @include('layout.socket')

    <script type="text/javascript">
        $(function() {
            $('#slider').rangeslider({
                polyfill : false,
                onSlide: (position, value) => {
                    $('#slider-value').html(value + '%');
                }
            });

            $('#slider').val('{{ $project->project_progress }}').change();
            
            @if(session('updateProgress'))
                $('#progress-bars3-15')[0].scrollIntoView({
                    behavior: 'instant', 
                    block: 'center'
                });
            @elseif($errors->any())
                $('#features16-13')[0].scrollIntoView({
                    behavior: 'smooth', 
                    block: 'end'
                });

                setTimeout(() => {
                    $('#modal-new-member').modal({
                        show: true
                    });
                }, 1000);
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

            $('#btn-slider-update').on('click', () => {
                $.ajax({
                    method: 'POST',
                    url: '{{ url('project/update_progress') }}',
                    data: {
                        progress: $('#slider').val(),
                        project_id: '{{ $project->id }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: () => {
                        window.location.href = '{{ url('project/'.$project->id) }}';
                    },
                    error: (xhr) => {
                        Swal({
                            type: 'error',
                            title: 'Error while processing data'
                        });
                    }
                });
            });

            $('div[data-target="#modal-new-member"]').on('click', () => {
                $('#form-new-member').find('input[type!="hidden"]').val('');
                $('#form-new-member').find('.alert').remove();
            });
        });
    </script>
@endsection