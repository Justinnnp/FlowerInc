<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlowerRequest;
use App\Http\Requests\UpdateFlowerRequest;
use App\Models\Flower;
use App\Models\Stock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Stock $stock)
    {
        return view('flowers.index', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(Stock $stock)
    {
        return view('flowers.create', compact('stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFlowerRequest $request
     * @param Stock $stock
     * @return RedirectResponse
     */
    public function store(StoreFlowerRequest $request, Stock $stock): RedirectResponse
    {
        $flower = Flower::create($request->validate(['name' => 'required|string', 'photo_url' => 'required|string']));

        $stock->flowers()->save($flower);

        return redirect()->route('flowers.index', ['stock' => $stock]);
    }

    /**
     * Display the specified resource.
     *
     * @param Flower $flower
     * @return Application|Factory|View
     */
    public function show(Flower $flower)
    {
        dd($flower);
        return view('flowers.show', compact('flower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Flower $flower
     * @return Response
     */
    public function edit(Flower $flower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateFlowerRequest $request
     * @param Flower $flower
     * @return Response
     */
    public function update(UpdateFlowerRequest $request, Flower $flower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Flower $flower
     * @return Response
     */
    public function destroy(Flower $flower)
    {
        //
    }
}
