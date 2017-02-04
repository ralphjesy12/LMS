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
                </div>
            </div>
        </div>
        <div class="box">
            <table class="table">
                <thead>
                    <th> </th>
                    <th>Student's Name</th>

                    @foreach ($subjects as $key => $subject)
                        <th> {{ $subject->title }} </th>
                    @endforeach
                    <th> Average </th>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <td> {{ str_pad($student->id,5,'0',STR_PAD_LEFT) }} </td>
                            <td> {{ $student->name }} </td>
                            @foreach ($subjects as $key => $subject)
                                <th> {{ $student->grade()->where('subject_id','=',$subject->id)->value('grade') ?: '-' }} </th>
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
