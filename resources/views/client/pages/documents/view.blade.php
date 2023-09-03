@extends('client.master')

@section('head')

    <meta name="description" content="{{ $document['title'] }}">

    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{ $document['thumb'] }}"/>
    <meta property="og:title" content="{{ $document['title'] }}"/>
    <meta property="og:description" content="{{ $document['title'] }}"/>
    <meta property="og:url" content="{{ route('client.documents', [
                                            'slug' => $document['slug']
                                        ]) }}"/>

    <link rel="stylesheet" href="/assets/css/loading.css">
    <link rel="stylesheet" href="/assets/css/style-content.css">
@endsection

@section('header')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0&appId=248551038101480&autoLogAppEvents=1" nonce="p4pyyugH"></script>
    <div class="container mt-3">
        @include('client.components.btn.previous')
    </div>
@endsection

@section('content')
    <div class="section section-typography pt-4">


        <div class="container">

            <h1 class="font-weight-bold mb-0" style="font-size: 2.2rem">
                {{ $document['title'] }}
            </h1>

            <div class="text-dark mb-3 d-flex justify-content-between">
                <small>
                    <i class="ni ni-calendar-grid-58"></i>
                    {{
                        $document['created_at']->day . '/' . $document['created_at']->month . '/' . $document['created_at']->year
                    }}
                </small>
                <div
                    class="fb-share-button"
                    data-href="{{route('client.documents', ['slug' => $document['slug']])}}"
                    data-layout="button_count"
                    data-size="small">
                        <a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
            </div>

            <hr class="mt-2">
            <div class="ck-content">
                {!! $document['content'] !!}
            </div>

            <div>
                <h6 style="font-weight: bold;">File đính kèm:</h6>
                @foreach ($document->files as $index => $file)
                    <p style="font-weight: bold; padding-left: .4rem">
                        [{{$index + 1}}] <a style="text-decoration: revert; padding-left: .3rem" href="{{$file['file_url']}}" target="_blank">{{$file['filename']}}</a>
                    </p>
                @endforeach
            </div>

            <div class="mt-4">
                <a class="d-flex align-items-center ">
                    <span class="avatar avatar-xs mr-2">
                        <img alt="avatar" class="rounded" src="{{ $document->user['avatar'] }}">
                    </span>
                    <span class="text-dark font-weight-bold">
                        {{ $document->user['name'] }}
                    </span>

                </a>
            </div>


            <hr class="mt-2">
            <h2 class="h5 text-success font-weight-bold mb-4">
                <span>Bình luận</span>
            </h2>
            <div class="fb-comments"
                data-href="{{route('client.documents', ['slug' => $document['slug']])}}"
                data-width="100%" data-numposts="3">
            </div>
            <hr class="mt-2">
            <div class="row">

                <div class="col-md-6" style="position: relative; min-height: 543px" id="documents">

                    <h2 class="h4 text-success font-weight-bold mb-4">
                        <span>DS / Văn bản khác</span>
                    </h2>

                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
<script src="https://unpkg.com/react@18/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js" crossorigin></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<style>
    .pagination {
        position: absolute;
        bottom: -6px;
        left: 15px;
        right: 15px;
    }
    .text-clip {
        display: block;
        max-width: calc(100% - 20px);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>

<script type="text/babel">

    const { useState, useMemo} = React;

    const Document = (props) => {
        return (
            <a className="col-md-12 mb-2 list-item" href={"/van-ban/" + props.slug}>
                <div className="thumb">
                    <img src={ props.thumb } alt="Raised image" className="rounded shadow-lg" />
                </div>
                <div className="content">
                    <div className="col-12 title" title={ props.title }>
                        <span className="text-dark text-clip" >
                            { props.title }
                        </span>
                    </div>
                    <div className="col-12">
                        <span className="text-muted">
                            <small>
                                { props.date }, có {props.fileCount} file đính kèm.
                            </small>
                        </span>
                    </div>
                </div>
            </a>
        );
    }

    const Documents = (props) => {
        const [documents, setdocuments] = useState([]);
        const [loading, setLoading] = useState(true);
        const [pageUrl, setPageUrl] = useState({pre: '#', next: '#'});
        const [url, setUrl] = useState('/api/documents');

        useMemo(() => {
            axios(
                {
                    url,
                    params: {
                        paginate: 5
                    },
                    method: 'get',
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(function (response) {
                    setdocuments(response.data.data);
                    setPageUrl({
                        pre: response.data.prev_page_url,
                        next: response.data.next_page_url
                    });
                    setLoading(false);
                })
                .catch(e => {
                    setLoading(false);
                })
        }, [url])

        const handlePageUrl = (url) => {
            setUrl(url);
            if (url) {
                setLoading(true);
            }
        }

        return (
            <span>
                <h2 className="h4 text-success font-weight-bold mb-4">
                    <span>DS / Văn bản khác</span>
                </h2>
                <div className="row blogs-list">
                    {
                        documents.map(document => (
                            <Document
                                slug={document.slug}
                                thumb={document.thumb}
                                title={document.title}
                                date={document.post_at}
                                fileCount={document.files_count}
                            />
                        ))
                    }
                    {
                        loading && (<div className="spinnerIconWrapper ">
                                        <div className="spinnerIcon"></div>
                                    </div>)
                    }


                </div>
                <div className="row mt-2 pagination">
                    <div className="col-12">
                        <nav aria-label="Page navigation example">
                            <ul className="pagination justify-content-center">

                                {pageUrl.pre && <li className="page-item" title="trước" onClick={() => handlePageUrl(pageUrl.pre)}>
                                    <span className="page-link no-loader" >
                                        <i className="fa fa-angle-left"></i>
                                        <span className="sr-only">Previous</span>
                                    </span>
                                </li>}

                                {pageUrl.next && <li className="page-item" title="sau" onClick={() => handlePageUrl(pageUrl.next)}>
                                    <span className="page-link no-loader" >
                                        <i className="fa fa-angle-right"></i>
                                        <span className="sr-only">Next</span>
                                    </span>
                                </li>}
                            </ul>
                        </nav>
                    </div>
                </div>
            </span>
        );
    }

    ReactDOM.createRoot(document.getElementById('documents')).render(<Documents/>);
</script>


@endsection
