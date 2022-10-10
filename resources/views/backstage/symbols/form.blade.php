@csrf

@include('backstage.partials.forms.text', [
    'field' => 'name',
    'label' => 'Name',
    'value' => old('name') ?? $symbol->name,
])

@include('backstage.partials.forms.file', [
    'field' => 'symbol_image',
    'label' => 'Image',
    'value' => old('name') ?? $symbol->symbol_image,
])

@includeWhen(empty($disabled), 'backstage.partials.forms.submit')
