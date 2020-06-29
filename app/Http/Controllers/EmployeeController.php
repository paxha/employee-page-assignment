<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'shifts.*' => ['required', 'exists:shifts,id'],
            'name' => ['required', 'string', 'max:191'],
            'father_name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
        ]);

        DB::beginTransaction();
        try {
            $employee = Employee::create($request->all());
            $employee->shifts()->attach($request->shifts);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->route('employee.index')->with('status', "Employee failed to create.");
        }

        return redirect()->route('employee.index')->with('status', "Employee ($employee->name) successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit')->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'shifts.*' => ['required', 'exists:shifts,id'],
            'name' => ['required', 'string', 'max:191'],
            'father_name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
        ]);

        DB::beginTransaction();
        try {
            $employee->update($request->all());
            $employee->shifts()->sync($request->shifts);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->route('employee.index')->with('status', "Employee failed to update.");
        }

        return redirect()->route('employee.index')->with('status', "Employee ($employee->name) successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Employee $employee)
    {
        $name = $employee->name;

        $employee->delete();

        return redirect()->route('employee.index')->with('status', "Employee ($name) successfully deleted.");
    }
}
