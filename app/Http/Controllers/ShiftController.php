<?php

namespace App\Http\Controllers;

use App\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shifts = Shift::all();

        return view('shift.index')->with('shifts', $shifts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('shift.create');
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
            'name' => ['required', 'string', 'max:191'],
            'start' => ['required'],
            'end' => ['required'],
        ]);

        $shift = Shift::create($request->all());

        return redirect()->route('shift.index')->with('status', "Shift ($shift->name) successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Shift $shift
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Shift $shift
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Shift $shift)
    {
        return view('shift.edit')->with('shift', $shift);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Shift $shift
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'start' => ['required'],
            'end' => ['required'],
        ]);

        $shift->update($request->all());

        return redirect()->route('shift.index')->with('status', "Shift ($shift->name) successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Shift $shift
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shift $shift)
    {
        $name = $shift->name;

        $shift->delete();

        return redirect()->route('shift.index')->with('status', "Shift ($name) successfully deleted.");
    }
}
