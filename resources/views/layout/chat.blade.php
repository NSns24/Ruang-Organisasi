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