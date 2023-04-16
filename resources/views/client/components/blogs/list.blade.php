<h2 class="h4 text-success font-weight-bold mb-4">
    <span>{{ $header }}</span>
</h2>

{!! view('client.components.list', [
    'data' => $blogs,
    'url' => 'blogs',
]) !!}