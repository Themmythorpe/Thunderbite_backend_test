@extends('backstage.templates.backstage')


@section('content')
    <div id="card" class="bg-white shadow-lg mx-auto rounded-b-lg">
        <div class="px-10 pt-4 pb-8">
            <h1>Export Games to CSV</h1>
            <form method="POST" action="{{ route('backstage.games.export') }}" enctype="multipart/form-data">
            @csrf
                @include('backstage.partials.forms.text', [
                    'field' => 'filter1',
                    'label' => 'Account',
                    'value' => old('filter1') ,
                ])

                 @include('backstage.partials.forms.number', [
                    'field' => 'filter2',
                    'label' => 'Prize ID',
                    'value' => old('filter2') ,
                ])

                @include('backstage.partials.forms.datetime', [
                    'field' => 'filter4',
                    'label' => 'Revealed From',
                    'value' => old('filter4'),
                ])

                @include('backstage.partials.forms.datetime', [
                    'field' => 'filter3',
                    'label' => 'Revealed To',
                    'step' => 1,
                    'value' => old('filter3'),
                ])

                @include('backstage.partials.forms.export')

            </form>
        </div>
    </div>
@endsection
