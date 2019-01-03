 <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm bg-color transparent">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>
    <div class="menu-logo">
        <div class="navbar-brand">
            <span class="navbar-logo">
                <img src="{{ asset('assets/image/icon/logo.png') }}" style="height: 4.5rem;">
            </span>
            <span class="navbar-caption-wrap">
                <a class="navbar-caption text-white display-5" href="{{ url('project/'.$project->id) }}">RuangOrganisasi</a>
            </span>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="{{ url('meeting') }}">
                    <span class="mbri-laptop mbr-iconfont mbr-iconfont-btn"></span>
                    Meeting
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="{{ url('chat/'.$project->id) }}">
                    <span class="mbri-chat mbr-iconfont mbr-iconfont-btn"></span>
                    Chats
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="{{ url('jobs/'.$project->id) }}">
                    <span class="mbri-contact-form mbr-iconfont mbr-iconfont-btn"></span>
                    Jobs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="{{ url('logout') }}">
                    <span class="mbri-logout mbr-iconfont mbr-iconfont-btn"></span>
                    Log Out
                </a>
            </li>
        </ul>
    </div>
</nav>