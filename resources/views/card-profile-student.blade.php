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
            <p class="tagline">The users profile bio would go here, of course. It could be two lines</p>
        </div>
        <div class="column is-2 followers has-text-centered">
            <p class="stat-val">129k</p>
            <p class="stat-key">Subjects</p>
        </div>
        <div class="column is-2 following has-text-centered">
            <p class="stat-val">2k</p>
            <p class="stat-key">Lessons</p>
        </div>
        <div class="column is-2 likes has-text-centered">
            <p class="stat-val">29</p>
            <p class="stat-key">Students</p>
        </div>
    </div>
</div>
<div class="profile-options content">
    <div class="tabs is-fullwidth">
        <ul>
            <li class="link  {{ $tab=='activity' ? 'is-active' : '' }}"><a href="{{ url('home') }}"><span class="icon"><i class="fa fa-rss"></i></span> <span>Activity</span></a></li>
            <li class="link  {{ $tab=='subjects' ? 'is-active' : '' }}"><a href="{{ url('home/subjects') }}"><span class="icon"><i class="fa fa-book"></i></span> <span>Subjects</span></a></li>
            <li class="link  {{ $tab=='lessons' ? 'is-active' : '' }}"><a href="{{ url('home/lessons') }}"><span class="icon"><i class="fa fa-tasks"></i></span> <span>Lessons</span></a></li>
            <li class="link  {{ $tab=='students' ? 'is-active' : '' }}"><a href="{{ url('home/students') }}"><span class="icon"><i class="fa fa-users"></i></span> <span>Students</span></a></li>
            <li class="link  {{ $tab=='exams' ? 'is-active' : '' }}"><a href="{{ url('home/exams') }}"><span class="icon"><i class="fa fa-list"></i></span> <span>Exams</span></a></li>
            <li class="link  {{ $tab=='quizzes' ? 'is-active' : '' }}"><a href="{{ url('home/quizzes') }}"><span class="icon"><i class="fa fa-file-text-o"></i></span> <span>Quizzes</span></a></li>
        </ul>
    </div>
</div>
