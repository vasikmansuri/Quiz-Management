@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test</div>

                    <div class="card-body">
                        @if ($userHasStartedTest == 1)
                            <p>You have already started the test.</p>
                            <p>Remaining Questions:</p>
                            <ul>
                                @foreach ($remainingQuestions as $question)
                                    <li>{{ $question->question }}</li>
                                @endforeach
                            </ul>
                        @elseif($userHasStartedTest == 2)
                            <p>Your test has been submitted successfully.</p>
                        @else
                            <p>You have not started the test yet.</p>
                            <form action="{{ route('users.start.test') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Start Test</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
