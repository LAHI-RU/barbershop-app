<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Http\Requests\BarberRequest;
use Illuminate\Support\Facades\Storage;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barbers = Barber::latest()->paginate(10);
        return view('admin.barbers.index', compact('barbers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barbers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarberRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('barbers', 'public');
        }

        Barber::create($data);

        return redirect()->route('barbers.index')->with('success', 'Barber added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barber $barber)
    {
        return view('admin.barbers.show', compact('barber'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barber $barber)
    {
        return view('admin.barbers.edit', compact('barber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarberRequest $request, Barber $barber)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($barber->image_url) {
                Storage::disk('public')->delete($barber->image_url);
            }
            $data['image_url'] = $request->file('image')->store('barbers', 'public');
        }

        $barber->update($data);

        return redirect()->route('barbers.index')->with('success', 'Barber updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barber $barber)
    {
        if ($barber->image_url) {
            Storage::disk('public')->delete($barber->image_url);
        }
        
        $barber->delete();

        return redirect()->route('barbers.index')->with('success', 'Barber deleted successfully.');
    }
}
