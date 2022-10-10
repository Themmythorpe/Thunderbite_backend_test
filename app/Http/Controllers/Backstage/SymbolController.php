<?php

namespace App\Http\Controllers\Backstage;

use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backstage\Symbol\StoreRequest;


class SymbolController extends Controller
{
    public function index()
    {
        $symbol = Symbol::where('user_id', auth()->user()->id)->get();
        return view('backstage.symbols.index', compact('symbol'));
    }

    public function create()
    {
        $symbol = new Symbol();
        // Return the view

        return view('backstage.symbols.create', compact('symbol'));
    }

    public function store(StoreRequest $request)
    {
        // Validation
        $data = $request->validated();
        $symbol_count = Symbol::where('user_id', auth()->user()->id)->count();

        if($symbol_count >= 10){
            session()->flash('info', 'You can not add more than 10 symbols!');
            return redirect('/backstage/symbols');
        }

        $data['symbol_image'] = uploadDocument($request->file('symbol_image'));
        $data['user_id'] = auth()->user()->id;
        $symbol = Symbol::create($data);

        return redirect('/backstage/symbols');
    }

}
