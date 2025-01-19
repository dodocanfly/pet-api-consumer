<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Services\PetService;

class PetController extends Controller
{
    public function __construct(
        private PetService $petService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create', $this->petService->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetRequest $request)
    {
        try {
            $petId = $this->petService->create($request->toDto());
        } catch (\Throwable $exception) {
            return redirect()->route('pets.create')->withErrors($exception->getMessage())->withInput();
        }

        return redirect()->route('pets.index')->with('success', 'Pet added successfully [ID: ' . $petId . ']');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->showForm($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return $this->showForm($id, 'edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PetRequest $request, int $id)
    {
        try {
            $petId = $this->petService->update($request->toDto());
        } catch (\Throwable $exception) {
            return redirect()->route('pets.edit')->withErrors($exception->getMessage())->withInput();
        }

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully [ID: ' . $petId . ']');
    }

    /**
     * Display the specified resource.
     */
    public function delete(int $id)
    {
        return $this->showForm($id, 'delete');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->petService->delete($id);
        } catch (\Throwable $exception) {
            return redirect()->route('pets.delete', $id)->withErrors($exception->getMessage());
        }

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully [ID: ' . $id . ']');
    }

    private function showForm(int $id, string $action = 'show')
    {
        try {
            $pet = $this->petService->getById($id);
        } catch (\Throwable $exception) {
            return redirect()->route('pets.index')->withErrors($exception->getMessage());
        }

        $viewAction = in_array($action, ['show', 'edit', 'delete']) ? $action : 'show';

        return view('pets.' . $viewAction, $this->petService->getFormData($pet));
    }
}
