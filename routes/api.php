<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Department;

// 1. Criar, Listar, Atualizar, Deletar funcionarios

Route::post('/employees', function (Request $request) {
    $employee = new Employee();
    $employee->name = $request->input('name');
    $employee->email = $request->input('email');
    $employee->department_id = $request->input('department_id');
    $employee->save();
    return response()->json($employee);
});

Route::get('/employees', function () {
    return response()->json(Employee::all());
});

Route::get('/employees/{id}', function ($id) {
    return response()->json(Employee::findOrFail($id));
});

Route::patch('/employees/{id}', function (Request $request, $id) {
    $employee = Employee::findOrFail($id);
    $employee->update($request->all());
    return response()->json($employee);
});

Route::delete('/employees/{id}', function ($id) {
    Employee::destroy($id);
    return response()->json(null, 204);
});

// 2. Criar, Listar, Atualizar, Deletar departamentos

Route::post('/departments', function (Request $request) {
    $department = new Department();
    $department->name = $request->input('name');
    $department->save();
    return response()->json($department, 201);
});

Route::get('/departments', function () {
    return response()->json(Department::all());
});

Route::get('/departments/{id}', function ($id) {
    return response()->json(Department::findOrFail($id));
});

Route::patch('/departments/{id}', function (Request $request, $id) {
    $department = Department::findOrFail($id);
    $department->update($request->all());
    return response()->json($department);
});

Route::delete('/departments/{id}', function ($id) {
    Department::destroy($id);
    return response()->json(null, 204);
});

// 3. Listar funcionarios com departamentos

Route::get('/employees-departments', function () {
    return response()->json(Employee::with('department')->get());
});

// 4. Listar departamentos com funcionarios

Route::get('/departments-employees', function () {
    return response()->json(Department::with('employees')->get());
});

// 5. Listar departamento de um funcionario

Route::get('/employees/{id}/department', function ($id) {
    $employee = Employee::with('department')->findOrFail($id);
    return response()->json($employee->department);
});

// 6. Listar funcionarios de um departamento

Route::get('/departments/{id}/employees', function ($id) {
    $department = Department::with('employees')->findOrFail($id);
    return response()->json($department->employees);
});