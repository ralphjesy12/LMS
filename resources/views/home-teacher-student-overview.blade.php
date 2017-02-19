@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'students'
        ])

        <div class="spacer"></div>
        <div class="box">
            <div class="container">
                <div class="content">
                    <a href="{{ url('teacher/student/create') }}" class="button is-primary">Add Student</a>
                    <p class="control is-pulled-right">
                        <span class="select">
                            <select id="select-section">
                                <option>All Sections</option>
                                @foreach ($sections as $key => $section)
                                    <option {{ isset($_GET['section']) && $section->value === $_GET['section'] ? 'selected' : '' }}>{{ $section->value }}</option>
                                @endforeach
                            </select>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="box table-overflow">
            <table class="table">
                <thead>
                    <!-- <th> </th> -->
                    <th>Student's Name</th>
                    <th>Section</th>

                    @foreach ($subjects as $key => $subject)
                        <th> {{ $subject->title }} </th>
                    @endforeach
                    <th> Average </th>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <!-- <td> {{ str_pad($student->id,5,'0',STR_PAD_LEFT) }} </td> -->
                            <td> {{ $student->name }} </td>
                            <td> {{ $student->infos()->where('key','section')->value('value') ?: '-' }} </td>
                            @foreach ($subjects as $key => $subject)
                                <td> {{ $student->grade()->where('subject_id','=',$subject->id)->value('grade') ?: '-' }} </td>
                            @endforeach
                            <td> {{  number_format($student->grade()->avg('grade'),2) }}% </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($students->hasPages())
            <div class="box">
                {{ $students->links('vendor.pagination.simple-bulma') }}
            </div>
        @endif
    </div>
@endsection
