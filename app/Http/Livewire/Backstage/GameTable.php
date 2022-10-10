<?php

namespace App\Http\Livewire\Backstage;

use App\Models\Game;
use App\Http\Controllers\Backstage\GameController;

class GameTable extends TableComponent
{
    public $sortField = 'revealed_at';
    public $filter1;
    public $filter2;
    public $filter3;
    public $filter4;

    public function render()
    {

        $columns = [
            [
                'title' => 'account',
                'sort' => true,
            ],

            [
                'title' => 'prize_id',
                'attribute' => 'prize_id',
                'sort' => true,
            ],

            [
                'title' => 'title',
                'attribute' => 'name',
                'sort' => true,
            ],
            [
                'title' => 'points',
                'attribute' => 'points',
                'sort' => true,
            ],

            [
                'title' => 'revealed at',
                'attribute' => 'revealed_at',
                'sort' => true,
            ],
        ];
        return view('livewire.backstage.table', [
            'columns' => $columns,
            'resource' => 'games',
            'rows' => Game::filter($this->filter1, $this->filter2, $this->filter3,$this->filter4)
                ->orderBy($this->sortField, $this->sortAsc ? 'DESC' : 'ASC')
                ->paginate($this->perPage),
        ]);
    }

    public function exportCSV()
    {
        $games = Game::filter($this->filter1, $this->filter2, $this->filter3,$this->filter4)
            ->orderBy($this->sortField, $this->sortAsc ? 'DESC' : 'ASC')
            ->get();

            dd( $games);

        $fileName = 'games.csv';

                 $headers = array(
                     "Content-type"        => "text/csv",
                     "Content-Disposition" => "attachment; filename=$fileName",
                     "Pragma"              => "no-cache",
                     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                     "Expires"             => "0"
                 );

                 $columns = array('PrizeID', 'Account', 'Points', 'Revealed At');

                 $callback = function() use($games, $columns) {
                     $file = fopen('php://output', 'w');
                     fputcsv($file, $columns);

                     foreach ($games as $game) {
                         $row['PrizeID']  = $game->prize_id;
                         $row['Account']    = $game->account;
                         $row['Points']    = $game->points;
                         $row['Revealed At']  = $game->revealed_at;

                         fputcsv($file, array($row['PrizeID'], $row['Account'], $row['Points'], $row['Revealed At']));
                     }

                     fclose($file);
                 };

                 return response()->stream($callback, 200, $headers);
    }
}
