<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $departments = Department::all();
        return view('department.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('department.create');
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
            'name' => ['required', 'string', 'max:191', 'unique:departments,name'],
            'short_name' => ['required', 'string', 'max:3', 'unique:departments,short_name'],
        ]);

        $department = Department::create($request->all());

        return redirect()->route('department.index')->with('status', "Department ($department->name) successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Department $department
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Department $department)
    {
        return view('department.edit')->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'short_name' => ['required', 'string', 'max:3'],
        ]);

        if ($request->name !== $department->name) {
            $request->validate([
                'name' => ['unique:departments,name']
            ]);
        }

        if ($request->short_name !== $department->short_name) {
            $request->validate([
                'name' => ['unique:departments,short_name']
            ]);
        }

        $department->update($request->all());

        return redirect()->route('department.index')->with('status', "Department ($department->name) successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department)
    {
        $name = $department->name;

        $department->delete();

        return redirect()->route('department.index')->with('status', "Department ($name) successfully deleted.");
    }
}
