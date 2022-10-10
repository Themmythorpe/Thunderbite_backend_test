@extends('backstage.templates.backstage')

@section('tools')

        <a href="{{ route('backstage.symbols.create') }}" class="button-create">Create symbol</a>

@endsection

@section('content')
    @if( $symbol->count() > 0)
                <div class="grid grid-cols-5 gap-4 items-start py-2 border-b border-gray-100 mt-5">
                    <div class="col-span-1 font-semibold">Name</div>
                    <div class="col-span-1 font-semibold">Image Popup</div>
                </div>
                @foreach ($symbol as $value)
                    <div class="grid grid-cols-5 gap-4 items-start py-2 border-b border-gray-100">
                        <div class="col-span-1">{{  $value->name}}</div>
                        <div class="col-span-1"><img src="{{$value->symbol_image }}" class="img-responsive w-16"  /> </div>
                    </div>
                @endforeach
            @endif
@endsection
