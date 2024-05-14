@extends('layout.master')
@section('content')
    <div class="container mt-4">
        @if (session()->has('success'))
            <div class="alert alert-success">
                @if(is_array(session('success')))
                    <ul>
                        @foreach (session('success') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('success') }}
                @endif
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-error">
                @if(is_array(session('error')))
                    <ul>
                        @foreach (session('error') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('error') }}
                @endif
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Questions Management</h5>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addQuestionModal">
                    Add Question
                </button>
            </div>
            <div class="card-body">
                <table id="questionTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Question</th>
                        <th>Time Limit</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalCard" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editQuestionForm">
                        <input type="hidden" id="edit_question_id" name="edit_question_id">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" id="edit_question" name="edit_question" required>
                        </div>
                        <div class="form-group">
                            <label for="option1">Option 1</label>
                            <input type="text" class="form-control" id="edit_option1" name="edit_option1" required>
                        </div>
                        <div class="form-group">
                            <label for="option2">Option 2</label>
                            <input type="text" class="form-control" id="edit_option2" name="edit_option2" required>
                        </div>
                        <div class="form-group">
                            <label for="option3">Option 3</label>
                            <input type="text" class="form-control" id="edit_option3" name="edit_option3" required>
                        </div>
                        <div class="form-group">
                            <label for="option4">Option 4</label>
                            <input type="text" class="form-control" id="edit_option4" name="edit_option4" required>
                        </div>
                        <div class="form-group">
                            <label for="correct_option">Correct Option</label>
                            <select class="form-control" id="edit_correct_option" name="edit_correct_option" required>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time_limit">Time Limit (in seconds)</label>
                            <input type="number" min="1" class="form-control" id="edit_time_limit" name="edit_time_limit" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addQuestionForm">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="option1">Option 1</label>
                            <input type="text" class="form-control" id="option1" name="option1" required>
                        </div>
                        <div class="form-group">
                            <label for="option2">Option 2</label>
                            <input type="text" class="form-control" id="option2" name="option2" required>
                        </div>
                        <div class="form-group">
                            <label for="option3">Option 3</label>
                            <input type="text" class="form-control" id="option3" name="option3" required>
                        </div>
                        <div class="form-group">
                            <label for="option4">Option 4</label>
                            <input type="text" class="form-control" id="option4" name="option4" required>
                        </div>
                        <div class="form-group">
                            <label for="correct_option">Correct Option</label>
                            <select class="form-control" id="correct_option" name="correct_option" required>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                                <option value="4">Option 4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time_limit">Time Limit (in seconds)</label>
                            <input type="number" min="1" class="form-control" id="time_limit" name="time_limit" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>

        $(document).ready(function () {
            var table = $('#questionTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('questions.index') }}",
                    "type": "GET"
                },
                "columns": [
                    {"data": "question"},
                    {"data": "time_limit"},
                    {"data": "action"}

                ]
            });
            $(document).on('click', '#editQuestionModal', function (e) {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: 'questions/' + id + '/edit',
                    success: function (data) {
                        $("#edit_question").val(data.data.question)
                        var options = JSON.parse(data.data.options);

                        $("#edit_option1").val(options.option1);
                        $("#edit_question_id").val(data.data.id);
                        $("#edit_option2").val(options.option2);
                        $("#edit_option3").val(options.option3);
                        $("#edit_option4").val(options.option4);
                        $("#edit_time_limit").val(data.data.time_limit);
                        $("#edit_correct_option").val(data.data.correct_option);
                        $("#editModalCard").modal('show')
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message
                        });
                    }
                });
            });

            $('#addQuestionForm').validate({
                rules: {
                    question: {
                        required: true
                    },
                    option1: {
                        required: true
                    },
                    option2: {
                        required: true
                    },
                    option3: {
                        required: true
                    },
                    option4: {
                        required: true
                    },
                    option5: {
                        required: true
                    },

                },
                messages: {
                    question: {
                        required: "Please enter question"
                    },
                    option1: {
                        required: "Please enter option 1"
                    },
                    option2: {
                        required: "Please enter option 2"
                    },
                    option3: {
                        required: "Please enter option 3"
                    },
                    option4: {
                        required: "Please enter option 4"
                    },

                    time_limit: {
                        required: "Please enter valid time limit for question"
                    }
                },
                submitHandler: function (form) {

                    var formData = $(form).serialize();

                    $.ajax({
                        type: 'POST',
                        url: '{{route("questions.store")}}', // Specify your controller route
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            }).then(function() {
                                table.ajax.reload();
                                $("#addQuestionModal").modal('hide');
                                $('#addQuestionForm').trigger("reset");
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON.message
                            });
                        }
                    });
                }
            });

            $('#editQuestionForm').validate({
                rules: {
                    edit_question: {
                        required: true
                    },
                    edit_option1: {
                        required: true
                    },
                    edit_option2: {
                        required: true
                    },
                    edit_option3: {
                        required: true
                    },
                    edit_option4: {
                        required: true
                    },
                    edit_option5: {
                        required: true
                    },

                },
                messages: {
                    edit_question: {
                        required: "Please enter question"
                    },
                    edit_option1: {
                        required: "Please enter option 1"
                    },
                    edit_option2: {
                        required: "Please enter option 2"
                    },
                    edit_option3: {
                        required: "Please enter option 3"
                    },
                    edit_option4: {
                        required: "Please enter option 4"
                    },

                    edit_time_limit: {
                        required: "Please enter valid time limit for question"
                    }
                },
                submitHandler: function (form) {
                    var formData = $(form).serialize();
                    console.log(formData)
                    $.ajax({
                        url: "questions/" + $("#edit_question_id").val(),
                        type: "PUT",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            $('#addModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Question updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                           table.ajax.reload();
                            $("#editModalCard").modal('hide')

                        },
                        error: function (xhr, status, error) {
                            var errorMessage = xhr.responseJSON.message;
                            console.error(errorMessage);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON.message
                            });
                        }
                    });
                }
            });

            $(document).on('click',"#deleteQuestion",function(e){

                e.preventDefault();
                var form = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete this question!',
                    icon: 'warning',
                    closeModal: false,
                    allowOutsideClick: false,
                    closeOnConfirm: false,
                    closeOnCancel: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: 'questions/' + form ,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON.message
                                });
                            }
                        });
                    } else {
                        Swal.fire("Your account is safe.");
                    }
                });
            })

        })

    </script>
@endpush
