<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlowerRequest;
use App\Http\Requests\UpdateFlowerRequest;
use App\Models\Flower;
use App\Models\Stock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FlowerController extends Controller
{
    protected $total;
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
//        $total =  DB::table('flower_stock')->select('total')->where('flower_id', $flower->id)->first();

        $flowers = Flower::all();
        return view('stocks.show', ['flowers' => $flowers]);
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
        try {
            $request->file('photo_url')->storePublicly('public/images');

            $photo_url = $request->file('photo_url')->hashName();
            $flower = new Flower;
            $flower->name = $request->name;
            $flower->photo_url = $photo_url;
            $flower->save();

            $flower->stocks()->attach($stock, $request->validate(['total' => 'required|integer']));
        } catch (QueryException $e) {
            return redirect()->route('stock.flowers', ['stock' => $stock])->with('status', 'Er is iets mis gegaan tijdens het aanmaken van deze bloem.');
        }

        return redirect()->route('stocks.show', ['stock' => $stock])->with('status', 'Bloem succesvol toegevoegd');
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
        $total =  DB::table('flower_stock')->select('total')->where('flower_id', $flower->id)->first();

        return view('flowers.edit', ['stock' => $stock, 'flower' => $flower, 'total' => $total]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFlowerRequest $request
     * @param Stock $stock
     * @param Flower $flower
     * @return RedirectResponse
     */
    public function update(UpdateFlowerRequest $request, Stock $stock, Flower $flower): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $path = 'storage/images/' . $flower->photo_url;
            if (File::exists($path)) {
                File::delete($path);
                $flower->stocks()->detach($stock, $stock->id);
            }
            $request->file('photo_url')->storePublicly('public/images');

            $photo_url = $request->file('photo_url')->hashName();

            $flower->photo_url = $photo_url;
            $flower->fill($validated);

            $flower->stocks()->attach($stock->id, ['total' => $validated['total']]);

            $flower->save();

            return redirect()->route('stocks.show', ['stock' => $stock])->with('status', 'succesvol bewerkt');

        } catch (QueryException $e) {
            return redirect()->route('stocks.show', ['stock' => $stock])->with('status', 'Er is iets mis gegaan tijdens het bewerken van deze bloem.');
        }
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
        try {
            $path = 'storage/images/' . $flower->photo_url;
            if (File::exists($path)) {
                File::delete($path);
            }
            $flower->stocks()->detach($stock, $flower->id);
            $flower->delete();
        } catch (QueryException $e) {
            return redirect()->route('stocks.show', ['stock' => $stock])->with('status', 'Er ging wat fout tijdens het verwijderen van de bloem.');
        }

        return redirect()->route('stocks.show', ['stock' => $stock])->with('status', 'Bloem succesvol verwijderd.');
    }
}
