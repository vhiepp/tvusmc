<h2 class="h4 text-success font-weight-bold mb-4" id="events">
    <span>{{ $header }}</span>
</h2>

@if (count($events) == 0)
    <span class="text-muted">
        <small>
            <i>
                Hiện tại vẫn chưa có sự kiện nào
            </i>
        </small>
    </span>
@endif

{!! view('client.components.list', [
    'data' => $events,
    'url' => 'events',
]) !!}