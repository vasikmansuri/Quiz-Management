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
                <h5 class="card-title">Users Management</h5>
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addModal">
                    Add User
                </button>
            </div>
            <div class="card-body">
                <table id="usersTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Question Attempt</th>
                        <th>Correct Attempt</th>
                        <th>email</th>
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
                    <form id="editForm">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="edit_email" readonly name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#editModal', function (e) {
                var id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/admin/edit-user/' + id,
                    success: function (data) {
                        $("#edit_first_name").val(data.data.first_name)
                        $("#edit_last_name").val(data.data.last_name)
                        $("#edit_password").val(data.data.password)
                        $("#edit_email").val(data.data.email)
                        $("#edit_user_id").val(data.data.id)
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
            var table = $('#usersTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('admin.users') }}",
                    "type": "GET"
                },
                "columns": [
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "attempted_questions"},
                    {"data": "correct_answers"},
                    {"data": "email"},
                    {"data": "action"}

                ]
            });
            $('#addForm').validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                        minlength: "First name must be at least 2 characters long"
                    },
                    last_name: {
                        required: "Please enter your last name",
                        minlength: "Last name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 6 characters long"
                    }
                },
                submitHandler: function (form) {
                    var formData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('admin.add.users') }}",
                        type: "POST",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            $('#addModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User added successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#usersTable').DataTable().ajax.reload();

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

            $('#editForm').validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                        minlength: "First name must be at least 2 characters long"
                    },
                    last_name: {
                        required: "Please enter your last name",
                        minlength: "Last name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    }
                },
                submitHandler: function (form) {
                    var formData = $(form).serialize();
                    $.ajax({
                        url: "{{ route('admin.update.users') }}",
                        type: "POST",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log(response)
                            $('#addModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'User updated successfully!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#usersTable').DataTable().ajax.reload();
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

        })

    </script>
@endpush
