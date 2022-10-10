@csrf


@include('backstage.partials.forms.text', [
    'field' => 'name',
    'label' => 'Name',
    'value' => old('name') ?? $campaign->name,
])

@include('backstage.partials.forms.select', [
    'field' => 'timezone',
    'label' => 'Timezone',
    'value' => old('timezone') ?? $campaign->timezone,
    'options' => $campaign->getAvailableTimezones(),
])

@include('backstage.partials.forms.text', [
    'field' => 'games_frequency',
    'label' => 'Games Frequency',
    'value' => old('games_frequency') ?? $campaign->games_frequency,
])

@include('backstage.partials.forms.text', [
    'field' => 'games_allowed',
    'label' => 'Games Allowed',
    'value' => old('games_allowed') ?? $campaign->games_allowed,
])

@include('backstage.partials.forms.text', [
    'field' => 'three_matches',
    'label' => 'Three Matches',
    'value' => old('three_points') ?? $campaign->three_matches,
])

@include('backstage.partials.forms.text', [
    'field' => 'four_matches',
    'label' => 'Four Matches',
    'value' => old('four_points') ?? $campaign->four_matches,
])

@include('backstage.partials.forms.text', [
    'field' => 'five_matches',
    'label' => 'Five Matches',
    'value' => old('five_points') ?? $campaign->five_matches,
])



@include('backstage.partials.forms.starts-ends', [
    'starts_at' => old('starts_at') ?? ($campaign->starts_at === null ? $campaign->starts_at : $campaign->starts_at->format('d-m-Y H:i:s')),
    'ends_at' => old('ends_at') ?? ($campaign->ends_at === null ? $campaign->ends_at : $campaign->ends_at->format('d-m-Y H:i:s')),
])

@include('backstage.partials.forms.submit')
