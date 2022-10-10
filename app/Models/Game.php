<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'prize_id', 'account', 'revealed_at', 'points'];

    protected $dates = [
        'revealed_at',
    ];

    public static function filter($filter1 = null, $filter2 = null, $filter3 = null, $filter4= null)
    {
        $query = self::query();
        $campaign = Campaign::find(session('activeCampaign'));

        self::filterDates($query, $campaign);

        if ($data =  $filter1 ?? request('filter1')) {
            $query->where('account', 'like', $data.'%');
        }

        if ($data =  $filter2 ?? request('filter2')) {
            $query->where('prize_id', $data);
        }

        if ($data = $filter3 ?? request('filter3')) {
            $query->where('revealed_at', '>=', $data);
        }

        if ($data = $filter4 ?? request('filter4')) {
            $query->where('revealed_at', '<=', $data);
        }

        $query->leftJoin('prizes', 'prizes.id', '=', 'games.prize_id')
            ->select('games.id','games.points', 'account', 'prize_id', 'revealed_at', 'prizes.name')
            ->where('games.campaign_id', $campaign->id);


        return $query;
    }

    private static function filterDates($query, $campaign): void
    {
        if (($data = request('date_start')) || ($data = Carbon::now()->subDays(6))) {
            $data = Carbon::parse($data)->setTimezone($campaign->timezone)->toDateTimeString();
            $query->where('games.revealed_at', '>=', $data);
        }
        if (($data = request('date_end')) || ($data = Carbon::now())) {
            $data = Carbon::parse($data)->setTimezone($campaign->timezone)->toDateTimeString();
            $query->where('games.revealed_at', '<=', $data);
        }
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
