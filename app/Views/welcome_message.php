<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Employee Registration</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Employee Management</h2>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position">
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="employeeTable">
                <?php foreach($employees as $employee): ?>
                    <tr>
                        <td><?= $employee['name']; ?></td>
                        <td><?= $employee['email']; ?></td>
                        <td><?= $employee['mobile_no']; ?></td>
                        <td><?= $employee['position']; ?></td>
                        <td><?= $employee['salary']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="<?= $employee['id']; ?>">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $employee['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // AJAX to Add Employee
    $('#employeeForm').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '<?= site_url('/employee/store') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.success);
                location.reload();
            }
        });
    });

    // AJAX to Edit Employee
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('/employee/edit/') ?>' + id,
            type: 'GET',
            success: function(employee) {
                $('#name').val(employee.name);
                $('#email').val(employee.email);
                $('#mobile_no').val(employee.mobile_no);
                $('#position').val(employee.position);
                $('#salary').val(employee.salary);
                $('#employeeForm').attr('action', '<?= site_url('/employee/update/') ?>' + id);
                $('#addEmployeeModal').modal('show');
            }
        });
    });

    // AJAX to Delete Employee
    $('.delete-btn').click(function() {
        var id = $(this).data('id');
        if(confirm('Are you sure you want to delete this employee?')) {
            $.ajax({
                url: '<?= site_url('/employee/delete/') ?>' + id,
                type: 'POST',
                success: function(response) {
                    alert(response.success);
                    location.reload();
                }
            });
        }
    });
</script>
</body>
</html>
