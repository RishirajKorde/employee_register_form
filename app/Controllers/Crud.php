<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Controller;

class Crud extends Controller
{
    public function index()
    {
        return view('employee_crud');
    }

    public function fetchAll()
    {
        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();
        return $this->response->setJSON($employees);
    }

    public function create()
    {
        $employeeModel = new EmployeeModel();

        // Fetch data from the request
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mob' => $this->request->getPost('mob'),
            'address' => $this->request->getPost('address'),
            'dob' => $this->request->getPost('dob'),
        ];

        // Check if a record with the same name, email, or mobile number already exists
        $existingEmployee = $employeeModel->where('name', $data['name'])
            ->orWhere('email', $data['email'])
            ->orWhere('mob', $data['mob'])
            ->first();

        if ($existingEmployee) {
            return $this->response->setJSON(['status' => 'Duplicate entry: Name, Email, or Mobile number already exists']);
        }

        // Insert the new employee record
        $employeeModel->insert($data);
        return $this->response->setJSON(['status' => 'Employee created successfully']);
    }


    public function update($id)
    {
        $employeeModel = new EmployeeModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mob' => $this->request->getPost('mob'),
            'address' => $this->request->getPost('address'),
            'dob' => $this->request->getPost('dob'),


        ];
        $employeeModel->update($id, $data);
        return $this->response->setJSON(['status' => 'Employee updated successfully']);
    }

    public function delete($id)
    {
        $employeeModel = new EmployeeModel();
        $employeeModel->delete($id);
        return $this->response->setJSON(['status' => 'Employee deleted successfully']);
    }

    public function fetchSingle($id)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($id);
        return $this->response->setJSON($employee);
    }
}
