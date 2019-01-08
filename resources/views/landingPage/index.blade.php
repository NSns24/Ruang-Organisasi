@extends('layout.index')

@section('title')
    RuangMeeting    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/dropdown/css/style.css') }}">

    <style>
        #btn-register:hover {
            color: #000000;
        }
    </style>
@endsection

@section('main')
    <section class="menu cid-rcxJEkoQuc" once="menu" id="menu2-27">
        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-toggleable-sm bg-color transparent">
            <div class="menu-logo">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <img src="{{ asset('assets/image/icon/logo.png') }}" style="height: 4.5rem;">  
                    </span>
                    <span class="navbar-caption-wrap"><span class="navbar-caption text-primary display-5">RuangMeeting</span></span>
                </div>
            </div>
        </nav>
    </section>

    <section class="header6 cid-rchrHo7Duo mbr-fullscreen" data-bg-video="https://www.youtube.com/watch?v=CfUGjK6gGgs" id="header6-h">
        <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(0, 0, 0);"></div>

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="mbr-white col-md-10">
                    <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">Ruang Meeting</h1>
                    <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
                        A place for you and your team to manage an event without spending too much effort, to organize your event properly, and finally make your jobs easier.
                        <br>
                        In the end, your event will be a big success.
                    </p>
                    <div class="mbr-section-btn align-center">
                        <a class="btn btn-md btn-primary display-4" data-toggle="modal" data-target="#modal-login">Login</a>
                        <a class="btn btn-md btn-white-outline display-4" data-toggle="modal" data-target="#modal-register" id="btn-register">Register</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
            <a href="#next">
                <i class="mbri-down mbr-iconfont"></i>
            </a>
        </div>
    </section>

    <section class="features1 cid-rchrbSzk2h" id="features1-a">
        <div class="container">
            <div class="media-container-row">
                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3">
                        <span class="mbr-iconfont mbri-growing-chart"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title py-3 mbr-fonts-style display-5">Increase Your Success</h4>
                        <p class="mbr-text mbr-fonts-style display-7">Your events will be a big success and will be organized properly with RuangMeeting. Your productivity will increase rapidly.</p>
                    </div>
                </div>

                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3">
                        <span class="mbr-iconfont mbri-clock"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title py-3 mbr-fonts-style display-5">Saving Your Time</h4>
                        <p class="mbr-text mbr-fonts-style display-7">With RuangMeeting, your time to manage your events will be saved. Many things will be organized by RuangMeeting.</p>
                    </div>
                </div>

                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-img pb-3">
                        <span class="mbr-iconfont mbri-devices"></span>
                    </div>
                    <div class="card-box">
                        <h4 class="card-title py-3 mbr-fonts-style display-5">Anytime Anywhere</h4>
                        <p class="mbr-text mbr-fonts-style display-7">You can manage your meeting, schedule, and finally your events freely, anytime and anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-md btn-info display-4" href="{{ url('about-us') }}">About US</a>
            </div>
        </div>
    </section>
    
    <!-- Modal Login -->
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <form action="{{ url('login') }}" method="POST" id="form-login">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        </div>

                        @if($errors->login->has('email'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->login->first('email') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        @if($errors->login->has('password'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->login->first('password') }}
                            </div>
                        @endif

                        @if(session('errorLogin'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('errorLogin') }}
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modalRegister" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <form action="{{ url('user') }}" method="POST" id="form-register" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        </div>

                        @if($errors->register->has('email'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('email') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                        </div>

                        @if($errors->register->has('name'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('name') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        @if($errors->register->has('password'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('password') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>

                        @if($errors->register->has('confirm_password'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('confirm_password') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" value="{{ old('contact_number') }}">
                        </div>

                        @if($errors->register->has('contact_number'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('contact_number') }}
                            </div>
                        @endif
                
                        <div class="form-group">
                            <label for="image"><b>Profile Picture</b></label>
                            <input type="file" name="profile_picture" id="image">
                        </div>

                        @if($errors->register->has('profile_picture'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->register->first('profile_picture') }}
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/page/dropdown/js/script.min.js') }}"></script>
    <script src="{{ asset('assets/page/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/page/ytplayer/jquery.mb.ytplayer.min.js') }}"></script>
    <script src="{{ asset('assets/page/vimeoplayer/jquery.mb.vimeo_player.js') }}"></script>
    <script src="{{ asset('assets/page/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/page/theme/js/script.js') }}"></script>
    
    <script type="text/javascript">
        $(function() {
            @if($errors->hasBag('login') || session('errorLogin'))
                $('#modal-login').modal({
                    show: true
                });
            @elseif($errors->hasBag('register'))
                $('#modal-register').modal({
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
                    title: '{{ session("success") }}',
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ url("project") }}';
                });
            @elseif(session('expired'))
                Swal({
                    type: 'warning',
                    title: '{{ session("expired") }}'
                });
            @endif

            $('a[data-target="#modal-login"]').on('click', () => {
                $('#form-login').find('input[type!="hidden"]').val('');
                $('#form-login').find('.alert').remove();
            });

            $('a[data-target="#modal-register"]').on('click', () => {
                $('#form-register').find('input[type!="hidden"]').val('');
                $('#form-register').find('.alert').remove();
            });
        });
    </script>
@endsection