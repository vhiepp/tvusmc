<h2 class="h4 text-success font-weight-bold mb-4" id="blogs">
    <span>{{ $header }}</span>
</h2>

@if (count($blogs) == 0)
    <span class="text-muted">
        <small>
            <i>
                Không có bài viết nào
            </i>
        </small>
    </span>
@endif

{!! view('client.components.list', [
    'data' => $blogs,
    'url' => 'blogs',
    'page' => 1,
]) !!}