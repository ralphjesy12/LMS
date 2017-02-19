<div class="section profile-heading content">
    <div class="columns">
        <div class="column is-2">
            <div class="image is-128x128 avatar">
                <img src="{{ Auth::user()->infos()->where('key','avatar')->value('value') ?: 'https://www.gravatar.com/avatar/' . md5( Auth::user()->email ) . '?d=retro' }}">
            </div>
        </div>
        <div class="column is-4 name">
            <p>
                <span class="title is-bold">{{ Auth::user()->name }}</span><br>
                <span class="subtitle is-4">{{ Auth::user()->roles()->first()->display_name }}</span>
                {{-- <span class="button is-primary is-outlined follow">Follow</span> --}}
            </p>
            <a href="{{ url('account') }}" class="is-link">Edit Profile</a>
            <p class="tagline">
                {{ Auth::user()->infos()->where('key','address')->value('value') ?: '' }}<br>
                {{ Auth::user()->infos()->where('key','contact')->value('value') ?: '' }}
            </p>
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
            <!-- <li class="link  {{ $tab=='activity' ? 'is-active' : '' }}"><a href="{{ url('teacher') }}"><span class="icon"><i class="fa fa-rss"></i></span> <span>Activity</span></a></li> -->
            <li class="link  {{ $tab=='subjects' ? 'is-active' : '' }}"><a href="{{ url('teacher/subjects') }}"><span class="icon"><i class="fa fa-book"></i></span> <span>Subjects</span></a></li>
            <li class="link  {{ $tab=='students' ? 'is-active' : '' }}"><a href="{{ url('teacher/students') }}"><span class="icon"><i class="fa fa-users"></i></span> <span>Students</span></a></li>
            <li class="link  {{ $tab=='exams' ? 'is-active' : '' }}"><a href="{{ url('teacher/exams') }}"><span class="icon"><i class="fa fa-list"></i></span> <span>Exams</span></a></li>
            <li class="link  {{ $tab=='quizzes' ? 'is-active' : '' }}"><a href="{{ url('teacher/quizzes') }}"><span class="icon"><i class="fa fa-file-text-o"></i></span> <span>Quizzes</span></a></li>
        </ul>
    </div>
</div>
