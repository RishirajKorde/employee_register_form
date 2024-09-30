<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 20px;
        }

        .modal-body input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Employee Registration Form</h1>

        <div class="card">
            <div class="card-header">
                <h5>Add New Employee</h5>
            </div>
            <div class="card-body">
                <div id="employee-form">
                    <input type="hidden" id="employee-id">
                    <div class="mb-3">
                        <label for="Name">Name :</label><br>
                        <input type="text" id="name" class="form-control" placeholder="Enter the Name" required>
                    </div>

                    <div class="mb-3">
                        <label for="Email">Email :</label><br>

                        <input type="email" id="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mob">Mobile No :</label><br>

                        <input type="text" id="mob" class="form-control" placeholder="Enter Mobile Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" id="dob" class="form-control" placeholder="DOB" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address :</label><br>

                        <input type="text" id="address" class="form-control" placeholder="Enter address" required>
                    </div>
                    <button id="create-btn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Employee List</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>

                            <th>Mobile</th>
                            <th>DOB</th>

                            <th>Address</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee-list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Employee -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editEmployeeModalLabel">Edit and Update Employee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal-employee-id">
                    <div class="mb-3">
                        <label for="name">Name :</label><br>

                        <input type="text" id="modal-name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email :</label><br>

                        <input type="email" id="modal-email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mob">Mobile :</label><br>

                        <input type="text" id="modal-mob" class="form-control" placeholder="mob" required>
                    </div>
                    <div class="mb-3">

                        <label for="modal-dob" class="form-label">Date of Birth</label>
                        <input type="date" id="modal-dob" class="form-control" placeholder="DOB" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address :</label><br>

                        <input type="text" id="modal-address" class="form-control" placeholder="address" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="update-btn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            fetchAllEmployees();

            function showAlert(message, type) {
                let alertBox = `
                    <div class="fixed top-5 right-5 z-50">
                        <div class="bg-${type}-100 border border-${type}-400 text-${type}-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">${message}</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-${type}-500" role="button" onclick="$(this).parent().remove();" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path d="M10 9.586l-4.293-4.293-1.414 1.414L8.586 10l-4.293 4.293 1.414 1.414L10 10.414l4.293 4.293 1.414-1.414L11.414 10l4.293-4.293-1.414-1.414z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                `;
                $('body').append(alertBox);
                setTimeout(() => {
                    $('.fixed').remove();
                }, 3000);
            }

            function fetchAllEmployees() {
                $.ajax({
                    url: "<?= base_url('Crud/fetchAll') ?>",
                    type: "GET",
                    success: function(response) {
                        let employees = response;
                        let rows = '';
                        employees.forEach(employee => {
                            rows += `
                                <tr>
                                    <td>${employee.id}</td>
                                    <td>${employee.name}</td>
                                    <td>${employee.email}</td>
                                    <td>${employee.mob}</td>
                                    <td>${employee.dob}</td>

                                    <td>${employee.address}</td>

                                    <td>
                                        <button class="btn btn-warning btn-edit" data-id="${employee.id}">Edit</button>
                                        <button class="btn btn-danger btn-delete" data-id="${employee.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employee-list').html(rows);
                    }
                });
            }
            $('#create-btn').click(function() {
                let name = $('#name').val();
                let email = $('#email').val();
                let mob = $('#mob').val();
                let address = $('#address').val();
                let dob = $('#dob').val();

                $.ajax({
                    url: "<?= base_url('Crud/create') ?>",
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        mob: mob,
                        address: address,
                        dob: dob
                    },
                    success: function(response) {
                        if (response.status === 'Duplicate entry: Name, Email, or Mobile number already exists') {
                            showAlert(response.status, 'red');
                        } else {
                            showAlert('Employee successfully added!', 'green');
                            fetchAllEmployees();
                            // Reset the input fields after successful addition
                            $('#name').val('');
                            $('#email').val('');
                            $('#mob').val('');
                            $('#address').val('');
                            $('#dob').val('');
                        }
                    }
                });
            });


            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `<?= base_url('Crud/fetchSingle/') ?>${id}`,
                    type: "GET",
                    success: function(response) {
                        let employee = response;
                        $('#modal-employee-id').val(employee.id);
                        $('#modal-name').val(employee.name);
                        $('#modal-email').val(employee.email);
                        $('#modal-mob').val(employee.mob);
                        $('#modal-address').val(employee.address);
                        $('#modal-dob').val(employee.dob);


                        $('#editEmployeeModal').modal('show');
                    }
                });
            });

            $('#update-btn').click(function() {
                let id = $('#modal-employee-id').val();
                let name = $('#modal-name').val();
                let email = $('#modal-email').val();
                let mob = $('#modal-mob').val();
                let address = $('#modal-address').val();


                $.ajax({
                    url: `<?= base_url('Crud/update/') ?>${id}`,
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        mob: mob,
                        address: address

                    },
                    success: function(response) {
                        showAlert('Employee updated successfully!', 'yellow');
                        fetchAllEmployees();
                        $('#editEmployeeModal').modal('hide');
                    }
                });
            });

            $(document).on('click', '.btn-delete', function() {
                let id = $(this).data('id');
                if (confirm('Are you sure you want to delete this employee?')) {
                    $.ajax({
                        url: `<?= base_url('Crud/delete/') ?>${id}`,
                        type: "POST",
                        success: function(response) {
                            showAlert('Employee deleted successfully!', 'red');
                            fetchAllEmployees();
                        }
                    });
                }
            });
        });
    </script>

    <!-- Bootstrap 5 JS for Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>