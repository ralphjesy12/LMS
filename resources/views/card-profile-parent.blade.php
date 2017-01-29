<div class="section profile-heading content">
    <div class="columns">
        <div class="column is-2">
            <div class="image is-128x128 avatar">
                <img src="https://www.gravatar.com/avatar/{{ md5( Auth::user()->email ) }}?d=retro">
            </div>
        </div>
        <div class="column is-4 name">
            <p>
                <span class="title is-bold">{{ Auth::user()->name }}</span><br>
                <span class="subtitle is-4">{{ Auth::user()->roles()->first()->display_name }}</span>
                {{-- <span class="button is-primary is-outlined follow">Follow</span> --}}
            </p>
            <p class="tagline"></p>
        </div>
    </div>
</div>
<div class="profile-options content">
    <div class="tabs is-fullwidth">
        <ul>
            <li class="link  {{ $tab=='activity' ? 'is-active' : '' }}"><a href="{{ url('parent') }}"><span class="icon"><i class="fa fa-rss"></i></span> <span>Dashboard</span></a></li>
            <li class="link  {{ $tab=='lessons' ? 'is-active' : '' }}"><a href="{{ url('parent/lessons') }}"><span class="icon"><i class="fa fa-book"></i></span> <span>Lessons</span></a></li>
            <li class="link  {{ $tab=='exams' ? 'is-active' : '' }}"><a href="{{ url('parent/exams') }}"><span class="icon"><i class="fa fa-list"></i></span> <span>Exams</span></a></li>
            <li class="link  {{ $tab=='quizzes' ? 'is-active' : '' }}"><a href="{{ url('parent/grades') }}"><span class="icon"><i class="fa fa-file-text-o"></i></span> <span>Grades</span></a></li>
        </ul>
    </div>
</div>
