@extends('layouts.app')

@section('content')
    <div class="container profile ">

        @include('card-profile-teacher',[
            'tab' => 'activity'
        ])

        <div class="box content">
            <!-- Main container -->
            <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <p class="subtitle is-5">
                            <strong>123</strong> posts
                        </p>
                    </div>
                    <div class="level-item">
                        <p class="control has-addons">
                            <input class="input" type="text" placeholder="Find a post">
                            <button class="button">
                                Search
                            </button>
                        </p>
                    </div>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <p class="level-item"><strong>All</strong></p>
                    <p class="level-item"><a>Published</a></p>
                    <p class="level-item"><a>Drafts</a></p>
                    <p class="level-item"><a>Deleted</a></p>
                    <p class="level-item"><a class="button is-success">New</a></p>
                </div>
            </nav>
        </div>

        <div class="spacer"></div>

        <div class="columns">
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
            </div>
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
            </div>
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
            </div>
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://placehold.it/300x225" alt="">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="content">
                            <span class="tag is-dark">#webdev</span>
                            <strong class="timestamp">2 d</strong>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item">Save</a>
                        <a class="card-footer-item">Edit</a>
                        <a class="card-footer-item">Delete</a>
                    </footer>
                </div>
                <br>
            </div>

        </div>
    </div>
@endsection
