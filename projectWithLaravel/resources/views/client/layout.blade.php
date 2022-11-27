{{-- Header --}}
@include('client.head')
{{-- Header --}}

{{-- Nav-bar --}}
@include('client.main-top')
{{-- Nav-bar --}}

{{-- Search --}}
@include('client.search')
{{-- Search --}}

{{-- Title-box --}}
@include('client.title-box')
{{-- Title-box --}}


@yield('content')

{{-- end --}}
@include('client.end')
{{-- end --}}

{{-- Footer --}}
@include('client.foot')
{{-- Footer --}}