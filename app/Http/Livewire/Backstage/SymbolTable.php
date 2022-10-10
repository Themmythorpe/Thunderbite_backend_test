<?php

namespace App\Http\Livewire\Backstage;

use App\Models\Symbol;

class SymbolTable extends TableComponent
{
    public $sortField = 'created_at';

    public function render()
    {
        $columns = [
            [
                'title' => 'name',
                'sort' => true,
            ],

            [
                'title' => 'game_id',
                'sort' => true,
            ],

            [
                'title' => 'image',
                'attribute' => 'symbol_image',
                'sort' => true,

            ],

        ];

        return view('livewire.backstage.table', [
            'columns' => $columns,
            'resource' => 'symbols',
            'rows' => Symbol::where('user_id', auth()->user()->id)
            ->orderBy($this->sortField, $this->sortAsc ? 'DESC' : 'ASC')
                ->paginate($this->perPage),
        ]);
    }
}
