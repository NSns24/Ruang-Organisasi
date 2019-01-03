@extends('layout.index')

@section('title')
    Jobs - {{ $project->project_name }}  
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

    <style>
        #content5-1x {
            background-image: url('{{ asset("assets/image/background/projectList_header.jpg") }}');
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }

        #btn-assign-job {
            float: right;
            color: white;
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
        @if($project->id == auth()->id())
            <a class="btn btn-md btn-primary display-4" data-toggle="modal" data-target="#modal-assign-job" id="btn-assign-job">Assign Job</a>
            <br style="clear: both;">

            <!-- Modal Login -->
            <div class="modal fade" id="modal-assign-job" tabindex="-1" role="dialog" aria-labelledby="modalAssignJob" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Assign Job</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>

                        <form action="{{ url('jobs/store') }}" method="POST" id="form-assign-job">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="job-description">Job Description <span class="required">*</span></label>
                                    <textarea name="job_description" class="form-control" rows="3" placeholder="Description">{{ old('job_description') }}</textarea>
                                </div>
    
                                @if($errors->has('job_description'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('job_description') }}
                                    </div>
                                @endif
    
                                <div class="form-group">
                                    <label for="job-start">Job Start <span class="required">*</span></label>
                                    <input type="text" name="job_start" id="job-start" class="form-control" placeholder="Job Start" value="{{ old('job_start') }}" readonly>
                                </div>

                                @if($errors->has('job_start'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('job_start') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="job-end">Job End <span class="required">*</span></label>
                                    <input type="text" name="job_end" id="job-end" class="form-control" placeholder="Job End" value="{{ old('job_end') }}" readonly>
                                </div>

                                @if($errors->has('job_end'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('job_end') }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="assign-to">Assign to <span class="required">*</span></label>
                                    <select class="form-control" name="assign_to" id="ddl-assign-to">
                                        <option value="">Select Your Friend</option>
                                        @foreach($friends as $friend)
                                            @if(old('assign_to') == $friend->user->id)
                                                <option value="{{ $friend->user->id }}" selected>{{ $friend->user->name }}</option>
                                            @else
                                                <option value="{{ $friend->user->id }}">{{ $friend->user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                @if($errors->has('assign_to'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first('assign_to') }}
                                    </div>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif  
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
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    @include('layout.socket')

    <script>
        $(function() {
            let projectDate = moment('{{ $events->last()["start"] }}');

            @if($errors->any())
                $('#modal-assign-job').modal({
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

            $('#job-start').datetimepicker({
                format: "YYYY-MM-DD",
                widgetPositioning: {
                    horizontal: 'left',
                    vertical: 'bottom'
                },
                ignoreReadonly: true,
                useCurrent: false,
                minDate: moment().startOf('d')
            });

            $('#job-end').datetimepicker({
                format: "YYYY-MM-DD",
                widgetPositioning: {
                    horizontal: 'left',
                    vertical: 'bottom'
                },
                ignoreReadonly: true,
                useCurrent: false,
                minDate: moment().startOf('d')
            });

            $('#calendar').fullCalendar({
                themeSystem: 'bootstrap4',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek'
                },
                eventLimit: true,
                events: @json($events),
                eventRender: (eventObj, $el) => {
                    $el.popover({
                        title: eventObj.title,
                        content: eventObj.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body'
                    });
                },
                editable: true,
                eventDrop: (event, delta, revertFunc) => {
                    if(moment(event.start.format()) > projectDate || moment(event.start.format()) < moment().startOf('d')) {
                        revertFunc();
                    }
                    else {
                        $.ajax({
                            method: 'POST',
                            url: '{{ url("jobs/change_schedule") }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                project_id: {{ $project->id }},
                                user_id: event.user,
                                job_id: event.job,
                                job_start: event.start.format(),
                                job_end: (event.end != null) ? event.end.format() : event.start.format()
                            },
                            error: (xhr) => {
                                revertFunc();
                            }
                        });
                    }
                },
                eventClick: (event) => {
                    Swal({
                        title: 'Do you want to delete this event ?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                method: 'POST',
                                url: '{{ url("jobs/delete_job") }}',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    project_id: {{ $project->id }},
                                    job_id: event.job
                                },
                                success: () => {
                                    Swal({
                                        type: 'success',
                                        title: 'Success Delete'
                                    });

                                    $('#calendar').fullCalendar('removeEvents', event._id);
                                },
                                error: (xhr) => {
                                    Swal({
                                        type: 'error',
                                        title: 'Error while processing data'
                                    });
                                }
                            });
                        }
                    });
                }
            });

            $('a[data-target="#modal-assign-job"]').on('click', () => {
                $('#form-assign-job').find('input[type!="hidden"]').val('');
                $('#form-assign-job').find('.alert').remove();
                $('#form-assign-job #ddl-assign-to').val('');
                $('#form-assign-job').find('textarea').val('');
            });
        }); 
    </script>
@endsection