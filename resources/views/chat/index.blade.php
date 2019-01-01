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
                            <a class="nav-link mbr-fonts-style active show display-7" role="tab" data-toggle="tab" href="#tabs4-2e_tab0" aria-selected="true">Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mbr-fonts-style active show display-7" role="tab" data-toggle="tab" href="#tabs4-2e_tab1" aria-selected="true">Personal</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane in active" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 chat-panel" id="chat-group">
                                    <div class="body">
                                        <div class="mesgs">
                                            <div class="msg_history">
                                                @foreach($chats as $chat)
                                                    @if($loop->index == 0 || $chats[$loop->index - 1]->getDate() != $chat->getDate())
                                                        <span class="time_date date">
                                                            {{ $chat->getDate() }}
                                                        </span>
                                                    @endif

                                                    @if($chat->user_from == auth()->id())
                                                        <div class="outgoing_msg">
                                                            <div class="sent_msg">
                                                                <p>
                                                                    {{ $chat->chat_message }}
                                                                </p>
                                                                <span class="time_date">
                                                                    {{ $chat->getTime() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @else 
                                                        <div class="incoming_msg">
                                                            <div class="received_msg">
                                                                <div class="received_withd_msg">
                                                                    <span class="chat-from">
                                                                        <img src="{{ asset('assets/image/user/'.$chat->userFrom->profile_picture) }}" class="rounded-circle" width="40">
                                                                        {{ $chat->userFrom->name }}
                                                                    </span>
                                                                    <p>
                                                                        {{ $chat->chat_message }}
                                                                    </p>
                                                                    <span class="time_date">
                                                                        {{ $chat->getTime() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
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
                                <div class="col-md-12" id="dropdown-friends">
                                    <select class="form-control" id="select-friend">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
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

    @include('layout.socket')

    <script>
        $(function(){
            let latestDate = '{{ $chats->last()->getDate() }}';
            $('#user-msg-group').val('');

            $('#btn-send-group').on('click', () => {
                if($.trim($('#user-msg-group').val()) != '') {
                    $.ajax({
                        method: 'POST',
                        url: '{{ url('chat/send_message_group') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            project_id: {{ $project->id }},
                            chat: $.trim($('#user-msg-group').val())
                        },
                        success: (data) => { 
                            if(data.date != latestDate) {
                                $('#chat-group .msg_history').append('<span class="time_date date">' + data.date + '</span>'
                                );
                            }

                            $('#chat-group .msg_history').append('<div class="outgoing_msg">' + 
                                '<div class="sent_msg">' +
                                '<p>' + data.chat_message + '</p>' +
                                '<span class="time_date">' + 
                                data.time + '</span>' + 
                                '</div></div>'
                            );

                            $('#chat-group .msg_history').animate({
                                scrollTop: $('#chat-group .msg_history')[0].scrollHeight
                            }, 1000);
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

            Echo.private('chat.{{ $project->id }}.group')
            .listen('.chat', (data) => {
                console.log(data);
            });

            function newChat(chat) {
                $('.msg_history').append('<div class="incoming_msg">' + 
                    '<div class="received_msg">' +
                    '<div class="received_withd_msg">' +
                    '<p>' + chat.chat_message + '</p>' +
                    '<span class="time_date">' +  + ' | ' +  + '</span>' + 
                    '</div></div></div>'
                );
            }
        });
    </script>
@endsection
  