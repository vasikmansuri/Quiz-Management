@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test</div>

                    <div class="card-body">
                        <div id="question-container">
                            <p>{{ $question->question }}</p>
                            <form id="answer-form">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                @foreach(json_decode($question->options) as $key => $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer" id="option{{ $key }}" value="{{ str_replace('option','',$key) }}">
                                        <label class="form-check-label" for="option{{ $key }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-primary mt-3" onclick="submitAnswer()">Submit Answer</button>
                            </form>
                        </div>
                        <div id="timer-container">
                            <p id="timer">Time Left: <span id="timer-value">0:00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const timerValueElement = document.getElementById('timer-value');
        let timerInterval;
        questionTime({{ $question->time_limit }});
        function questionTime(timeLeft){
             timerInterval = setInterval(() => {
                console.log('vasik',timeLeft)
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerValueElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (timeLeft <= 0) {
                    submitAnswer();
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerValueElement.textContent = 'Time\'s Up!';
                    submitAnswer();
                }
            }, 1000);
        }
        async function submitAnswer() {
            const formData = new FormData(document.getElementById('answer-form'));
            const response = await fetch('{{ route("users.submit.answer") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            });

            if (response.ok) {
                const responseData = await response.json();
                handleResponse(responseData);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    timer: 3000
                });
            }
        }

        function handleResponse(responseData) {
            if (responseData.question) {
                const options = JSON.parse(responseData.options);

                const optionsHtml = Object.values(options).map((option, index) => `
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="option${index+1}" value="${index+1}">
                        <label class="form-check-label" for="option${index}">
                            ${option}
                        </label>
                    </div>
                `).join('');

                document.getElementById('question-container').innerHTML = `
                    <p>${responseData.question}</p>
                    <form id="answer-form">
                        @csrf
                <input type="hidden" name="question_id" value="${responseData.id}">
                        <div class="form-group">${optionsHtml}</div>
                        <button type="button" class="btn btn-primary mt-3" onclick="submitAnswer()">Submit Answer</button>
                    </form>
                `;
               clearInterval(timerInterval);
                timeLeft = responseData.time_limit;
                questionTime(timeLeft)
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Test completed!',
                    timer: 3000
                });
                window.location.href = "{{route('users.question')}}";
            }
        }
    </script>
@endpush
