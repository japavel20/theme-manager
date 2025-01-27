@foreach($cssFiles as $cssFile)
    <link href="{{ $cssFile }}" rel="stylesheet" type="text/css" />
@endforeach

@stack('css')