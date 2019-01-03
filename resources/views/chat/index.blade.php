@extends('layout.index')

@section('title')
    Chat - {{ $project->project_name }}  
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/page/dropdown/css/style.css') }}">

    <style type="text/css">
        #content5-2d {
            background-image: url('{{ asset("assets/image/background/projectList_header.jpg") }}');
        }

        .chat-panel {
            margin-top: 30px;
            border: 1px solid #79d8f0;
        }

        .chat-panel .body {
            height: 400px;
            width: 400px;
        }

        .chat-panel .footer {
            text-align: left;
            padding: 10px 10px;
        }

        .chat-panel .type_msg {
            border-top: 1px solid #c4c4c4;
            border-bottom: 1px solid #c4c4c4;
            position: relative;
        }

        .chat-panel .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
        }

        .chat-panel .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: medium none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }

        .chat-panel .top_spac { 
            margin: 0;
            padding-top: 5px;
            font-size: 12px;
        }

        .chat-panel .mesgs {
            float: left;
            padding: 20px 15px 0 0;
            width: 100%;
        }

        .chat-panel .msg_history {
            height: 350px;
            overflow-y: auto;
        }

        .chat-panel .received_msg {
            display: inline-block;
            padding: 0 0 0 10px;
            vertical-align: top;
            width: 92%;
            margin-bottom: 10px;
        }

        .chat-panel .received_withd_msg p {
            background: #ebebeb none repeat scroll 0 0;
            border-radius: 3px;
            color: #646464;
            font-size: 14px;
            margin: 0;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }

        .chat-panel .received_withd_msg { 
            width: 57%;
        }

        .chat-panel .time_date {
            color: #747474;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
        }

        .chat-panel .outgoing_msg { 
            overflow: hidden; 
            margin-bottom: 10px;
        }

        .chat-panel .sent_msg p {
            background: #05728f none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 14px;
            margin: 0; color:#fff;
            padding: 5px 10px 5px 12px;
            width:100%;
        }

        .chat-panel .sent_msg {
            float: right;
            width: 46%;
        }

        .chat-panel .date {
            text-align: center;
            margin: 8px 0;
        }

        .chat-panel .chat-from {
            color: #2a8396;
            display: block;
            font-size: 12px;
            margin-bottom: 8px;
        }

        #friend-list {
            margin-top: 30px;
        }
    </style>
@endsection

@section('main')
    <section class="menu cid-rcy7yL9oXO" once="menu" id="menu1-2c">
        @include('layout.navbar')
    </section>

    <section class="mbr-section content5 cid-rcy7zj2yez mbr-parallax-background" id="content5-2d">
        <div class="container">
            <div class="media-container-row">
                <div class="title col-12 col-md-8">
                    <h2 class="align-center mbr-bold mbr-white pb-3 mbr-fonts-style display-1">
                        CHAT
                    </h2>
                    <h3 class="mbr-section-subtitle align-center mbr-light mbr-white pb-3 mbr-fonts-style display-5">
                        "You prove to people that you don’t pay attention to their words when they see that you don’t remember what they tell you earlier." ~ Israelmore Ayivor, Shaping the dream 
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="tabs4 cid-rcy7GJhTgB" id="tabs4-2e">
        <div class="container">
            <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                Your Personal and Group Chat
            </h2>
            <div class="media-container-row mt-5 pt-3">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mbr-fonts-style active show display-7" role="tab" data-toggle="tab" href="#tabs4-2e_tab0" aria-selected="true" id="group-tab">Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mbr-fonts-style active show display-7" role="tab" data-toggle="tab" href="#tabs4-2e_tab1" aria-selected="true" id="personal-tab">Personal</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane in active" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 chat-panel" id="chat-group">
                                    <div class="body">
                                        <div class="mesgs">
                                            <div class="msg_history">
                                                @include('layout.chat')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <div class="type_msg">
                                            <div class="input_msg_write">
                                                <input type="text" class="write_msg" id="user-msg-group" placeholder="Type a message" />
                                                <button class="msg_send_btn" type="button" id="btn-send-group"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <p class="text-center top_spac">
                                            Design by Sunil Rajput
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12" id="friend-list">
                                    <select class="form-control" id="select-friend">
                                        <option value="">Select Your Friend</option>
                                        @if($project->user->id != auth()->id())
                                            <option value="{{ $project->user->id }}">{{ $project->user->name }} ({{ $project->user->email }})</option>
                                        @endif
                                        
                                        @foreach($friends as $friend)
                                            <option value="{{ $friend->id }}">{{ $friend->name }} ({{ $friend->email }})</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 chat-panel" id="chat-personal">
                                    <div class="body">
                                        <div class="mesgs">
                                            <div class="msg_history"></div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <div class="type_msg">
                                            <div class="input_msg_write">
                                                <input type="text" class="write_msg" id="user-msg-personal" placeholder="Type a message" />
                                                <button class="msg_send_btn" type="button" id="btn-send-personal"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        <p class="text-center top_spac">
                                            Design by Sunil Rajput
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/page/dropdown/js/script.min.js') }}"></script>
    <script src="{{ asset('assets/page/touchswipe/jquery.touch-swipe.min.js') }}"></script>
    <script src="{{ asset('assets/page/parallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/page/mbr-tabs/mbr-tabs.js') }}"></script>
    <script src="{{ asset('assets/page/smoothscroll/smooth-scroll.js') }}"></script>
    <script src="{{ asset('assets/page/theme/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>

    @include('layout.socket')

    <script>
        $(function(){
            let latestDate = moment('{{ ($chats->last()) ? $chats->last()->getDate() : "" }}');
            let latestDatePersonal = '';
            
            $('#user-msg-group').val('');
            scrollGroupChat();

            function scrollGroupChat() {
                $('#chat-group .msg_history').animate({
                    scrollTop: $('#chat-group .msg_history')[0].scrollHeight
                }, 1000);
            }

            function scrollPersonalChat() {
                $('#chat-personal .msg_history').animate({
                    scrollTop: $('#chat-personal .msg_history')[0].scrollHeight
                }, 1000);
            }

            $('#user-msg-group').on('keyup', (e) => {
                if(e.keyCode == 13) {
                    $('#btn-send-group').trigger('click');
                }
            });

            $('#user-msg-personal').on('keyup', (e) => {
                if(e.keyCode == 13) {
                    $('#btn-send-personal').trigger('click');
                }
            });

            $('#btn-send-group').on('click', () => {
                if($.trim($('#user-msg-group').val()) != '') {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url("chat/send_message_group") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            project_id: {{ $project->id }},
                            chat: $.trim($('#user-msg-group').val())
                        },
                        success: (data) => { 
                            if(latestDate == '' || moment(data.date).diff(latestDate, 'days') != 0) {
                                $('#chat-group .msg_history').append('<span class="time_date date">' + data.date + '</span>'
                                );
                                latestDate = moment(data.date);
                            }

                            $('#chat-group .msg_history').append('<div class="outgoing_msg">' + 
                                '<div class="sent_msg">' +
                                '<p>' + data.chat_message + '</p>' +
                                '<span class="time_date">' + 
                                data.time + '</span>' + 
                                '</div></div>'
                            );

                            scrollGroupChat();
                        },
                        error: function(xhr) {
                            Swal({
                                type: 'error',
                                title: 'Error while processing data'
                            });
                        }
                    }); 

                    $('#user-msg-group').val('');
                }
            });

            $('#btn-send-personal').on('click', () => {
                if($.trim($('#user-msg-personal').val()) != '' && $('#select-friend').val() != '') {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url("chat/send_message_personal") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            project_id: {{ $project->id }},
                            chat: $.trim($('#user-msg-personal').val()),
                            user_to: $('#select-friend').val()
                        },
                        success: (data) => { 
                            if(latestDatePersonal == '' || moment(data.date).diff(latestDatePersonal, 'days') != 0) {
                                $('#chat-personal .msg_history').append('<span class="time_date date">' + data.date + '</span>'
                                );
                                latestDatePersonal = moment(data.date);
                            }

                            $('#chat-personal .msg_history').append('<div class="outgoing_msg">' + 
                                '<div class="sent_msg">' +
                                '<p>' + data.chat_message + '</p>' +
                                '<span class="time_date">' + 
                                data.time + '</span>' + 
                                '</div></div>'
                            );

                            scrollPersonalChat();
                        },
                        error: function(xhr) {
                            Swal({
                                type: 'error',
                                title: 'Error while processing data'
                            });
                        }
                    }); 

                    $('#user-msg-personal').val('');
                }
            });

            $('#personal-tab').on('click', () => {
                $('#select-friend').val('').trigger('change');
            });

            $('#group-tab').on('click', () => {
                setTimeout(() => {
                    scrollGroupChat();
                }, 300);
            });

            $('#select-friend').on('change', () => {
                if($('#select-friend').val() == '') {
                    $('#chat-personal .msg_history').html('');
                    $('#user-msg-personal').prop('disabled', true);
                    $('#btn-send-personal').prop('disabled', true);
                    $('#btn-send-personal').css('cursor', 'not-allowed');
                }
                else {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url("chat/get_message_personal") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            project_id: {{ $project->id }},
                            user_id: $('#select-friend').val()
                        },
                        success: (data) => { 
                            $('#chat-personal .msg_history').html(data);
                            latestDatePersonal = moment($('#chat-personal .date').last().html());
                        },
                        error: function(xhr) {
                            Swal({
                                type: 'error',
                                title: 'Error while processing data'
                            });
                        }
                    });

                    $('#user-msg-personal').prop('disabled', false);
                    $('#btn-send-personal').prop('disabled', false);
                    $('#btn-send-personal').css('cursor', 'pointer');
                }

                scrollPersonalChat();
            });

            Echo.private('chat.{{ $project->id }}.0')
            .listen('.chat', (data) => {
                newChatGroup(data.chat, data.date, data.time);
            });

            Echo.private('chat.{{ $project->id }}.{{ auth()->id() }}')
            .listen('.chat', (data) => {
                newChatPersonal(data.chat, data.date, data.time);
            });

            function newChatPersonal(chat, date, time) {
                if(latestDatePersonal == '' || moment(date).diff(latestDatePersonal, 'days') != 0) {
                    $('#chat-personal .msg_history').append('<span class="time_date date">' + date + '</span>'
                    );
                    latestDatePersonal = moment(date);
                }

                let imageUrl = '{{ asset("assets/image/user") }}' + '/' + chat.user_from.profile_picture;

                $('#chat-personal .msg_history').append('<div class="incoming_msg">' + 
                    '<div class="received_msg">' +
                    '<div class="received_withd_msg">' +
                    '<span class="chat-from">' +
                    '<img src="' + imageUrl + '" width="40">' +
                    chat.user_from.name + '</span>' +
                    '<p>' + chat.chat_message + '</p>' +
                    '<span class="time_date">' + time + '</span>' + 
                    '</div></div></div>'
                );

                scrollPersonalChat();
            }

            function newChatGroup(chat, date, time) {
                if(latestDate == '' || moment(date).diff(latestDate, 'days') != 0) {
                    $('#chat-group .msg_history').append('<span class="time_date date">' + date + '</span>'
                    );
                    latestDate = moment(date);
                }

                let imageUrl = '{{ asset("assets/image/user") }}' + '/' + chat.user_from.profile_picture;

                $('#chat-group .msg_history').append('<div class="incoming_msg">' + 
                    '<div class="received_msg">' +
                    '<div class="received_withd_msg">' +
                    '<span class="chat-from">' +
                    '<img src="' + imageUrl + '" width="40">' +
                    chat.user_from.name + '</span>' +
                    '<p>' + chat.chat_message + '</p>' +
                    '<span class="time_date">' + time + '</span>' + 
                    '</div></div></div>'
                );

                scrollGroupChat();
            }
        });
    </script>
@endsection
  