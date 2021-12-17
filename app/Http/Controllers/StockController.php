<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Flower;
use App\Models\Stock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $stocks = Stock::all();

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStockRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStockRequest $request)
    {
        try {
            Stock::create($request->all());
        } catch (QueryException $e) {
            return redirect()->route('stocks.index')->with('status', 'Deze stock bestaat al.');
        }

        return redirect()->route('stocks.index')->with('status', 'Stock succesvol aangemaakt.');
    }

    /**
     * Display the specified resource.
     *
     * @return Application|Factory|View
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', ['stock' => $stock]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Stock $stock
     * @return Application|Factory|View
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStockRequest $request
     * @param Stock $stock
     * @return RedirectResponse
     */
    public function update(UpdateStockRequest $request, Stock $stock): RedirectResponse
    {
        if ($request->name == $stock->name) {
            return redirect()->route('stocks.index')->with('status', 'Er is niks veranderd.');
        }
        $stock->update($request->all());

        return redirect()->route('stocks.index')->with('status', 'stock succesvol aangepast.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stock $stock
     * @return RedirectResponse
     */
    public function destroy(Stock $stock): RedirectResponse
    {
        $stock->delete();
        $stock->flowers()->delete();
        $stock->flowers()->detach();

        return redirect()->route('stocks.index')->with('status', 'Stock Succesvol verwijderd.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stock $stock
     * @return Application|Factory|View
     */
    public function flowers(Stock $stock)
    {
        return view('stocks.flowers', compact('stock'));
    }
}
