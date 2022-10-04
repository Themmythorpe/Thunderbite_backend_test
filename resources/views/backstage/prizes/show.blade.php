@extends('backstage.templates.backstage')

@section('tools')

    @if( auth()->user()->isAdmin() )
    <a href="{{ route('backstage.prizes.create') }}" class="button-create">Create prize</a>
    <a href="{{ route('backstage.prizes.edit', $prize->id) }}" class="button-create">Edit prize</a>
    @endif
@endsection

@section('content')
    <div id="card" class="bg-white shadow-lg mx-auto rounded-b-lg">
        <div class="px-10 pt-4 pb-8">
            @include('backstage.partials.forms.text', [
                'label' => 'Customer Level',
                'field' => 'Customer Level',
                'value' => $prize->name,
            ])

            @include('backstage.partials.forms.text', [
                'label' => 'Redirect URL desktop',
                'field' => 'Redirect URL desktop',
                'value' => $prize->redirect_desktop,
            ])

            @include('backstage.partials.forms.text', [
                'label' => 'Redirect URL mobile',
                'field' => 'Redirect URL mobile',
                'value' => $prize->redirect_mobile,
            ])

            @includeWhen($activeCampaign->segmentation, 'backstage.partials.forms.select', [
                'label' => 'Customer Segment',
                'value' =>  $prize->customer_segmentation->name ?? '',
            ])
            @if( $prize->prizes->count() > 0)
                <div class="grid grid-cols-5 gap-4 items-start py-2 border-b border-gray-100 mt-5">
                    <div class="col-span-1 font-semibold">Prize Type</div>
                    <div class="col-span-1 font-semibold">Prize Amount</div>
                    <div class="col-span-1 font-semibold">Image Popup</div>
                    <div class="col-span-1 font-semibold">Points Band</div>
                    <div class="col-span-1 font-semibold">Message</div>
                </div>
                @foreach ($prize->prizes as $value)
                    <div class="grid grid-cols-5 gap-4 items-start py-2 border-b border-gray-100">
                        <div class="col-span-1">{{ $prize->name}}</div>
                        <div class="col-span-1">{{ $value->prizeamount}}</div>
                        <div class="col-span-1"><img src="{{env('DO_CDN_URL'). $value->popup_image }}" class="img-responsive w-16"  /> </div>
                        <div class="col-span-1">{{ $prize->weight}}</div>
                        <div class="col-span-1">{{ $value->message }}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
