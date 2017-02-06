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
        <a href="{{ url('teacher/subjects') }}" class="column is-2 followers has-text-centered">
            <p class="stat-val">{{ $totalSubjects }}</p>
            <p class="stat-key">Subjects</p>
        </a>
        <a href="{{ url('teacher/subjects') }}" class="column is-2 following has-text-centered">
            <p class="stat-val">{{ $totalLessons }}</p>
            <p class="stat-key">Lessons</p>
        </a>
        <a href="{{ url('teacher/students/overview') }}" class="column is-2 likes has-text-centered">
            <p class="stat-val">{{ $totalStudents }}</p>
            <p class="stat-key">Students</p>
        </a>
    </div>
</div>
<div class="profile-options content">
    <div class="tabs is-fullwidth">
        <ul>
            <li class="link  {{ $tab=='teachers' ? 'is-active' : '' }}"><a href="{{ url('principal') }}"><span class="icon"><i class="fa fa-user"></i></span> <span>Teachers</span></a></li>
            <li class="link  {{ $tab=='subjects' ? 'is-active' : '' }}"><a href="{{ url('principal/subjects') }}"><span class="icon"><i class="fa fa-book"></i></span> <span>Subjects</span></a></li>
            <li class="link  {{ $tab=='students' ? 'is-active' : '' }}"><a href="{{ url('principal/students') }}"><span class="icon"><i class="fa fa-users"></i></span> <span>Students</span></a></li>
        </ul>
    </div>
</div>
