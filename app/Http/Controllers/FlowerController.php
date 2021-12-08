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
        dd($stock);
        $request->file('photo_url')->storePublicly('public/images');

        $photo_url = $request->file('photo_url')->hashName();
        $flower = new Flower;
        $flower->name = $request->name;
        $flower->photo_url = $photo_url;
        $flower->save();

        $flower->stocks()->attach($stock, $request->validate(['total' => 'required|integer']));

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
        return view('flowers.show', compact('flower'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Flower $flower
     * @return Application|Factory|View
     */
    public function edit(Stock $stock, Flower $flower)
    {
        return view('flowers.edit', ['stock' => $stock, 'flower' => $flower]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFlowerRequest $request
     * @param Flower $flower
     * @return Response
     */
    public function update(UpdateFlowerRequest $request, Flower $flower): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stock $stock
     * @param Flower $flower
     * @return RedirectResponse
     */
    public function destroy(Stock $stock, Flower $flower): RedirectResponse
    {

        $flower->delete();

        return redirect()->route('flowers.index', ['stock' => $stock, 'flower' => $flower]);
    }
}
