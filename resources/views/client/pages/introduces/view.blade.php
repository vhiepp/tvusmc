@extends('client.master')

@section('head')

    <meta name="description" content="Với slogan: “Nắm bắt xu hướng – Phát triển đam mê”, Câu lạc bộ TVU Social Media được thành lập dựa trên sự phát triển của truyền thông mạng xã hội. Đây là Câu lạc bộ thứ 18 trực thuộc Hội Sinh viên Trường Đại học Trà Vinh dành cho các bạn sinh viên, học sinh nhà trường.">

    <meta property="og:type" content="article"/>
    <meta property="og:image" content="/assets/img/bg.jpg"/>
    <meta property="og:title" content="{{$title}}"/>
    <meta property="og:description" content="Với slogan: “Nắm bắt xu hướng – Phát triển đam mê”, Câu lạc bộ TVU Social Media được thành lập dựa trên sự phát triển của truyền thông mạng xã hội. Đây là Câu lạc bộ thứ 18 trực thuộc Hội Sinh viên Trường Đại học Trà Vinh dành cho các bạn sinh viên, học sinh nhà trường."/>
    <meta property="og:url" content="{{ route('client.introduces') }}"/>

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
                Giới thiệu về TVU Social Media Club
            </h1>

            <div class="text-dark mb-3 d-flex justify-content-between">
                <div></div>
                <div
                    class="fb-share-button"
                    data-href="{{route('client.introduces')}}"
                    data-layout="button_count"
                    data-size="small">
                        <a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore">Chia sẻ</a>
                </div>
            </div>

            <hr class="mt-2">
            <div class="ck-content">
                @include('introduce')
            </div>

            <hr class="mt-2">
            <h2 class="h5 text-success font-weight-bold mb-4">
                <span>Bình luận</span>
            </h2>
            <div class="fb-comments"
                data-href="{{route('client.introduces')}}"
                data-width="100%" data-numposts="3">
            </div>
            <hr class="mt-2">
            <div class="row">

                <div class="col-md-6" style="position: relative; min-height: 543px" id="blogs">

                    <h2 class="h4 text-success font-weight-bold mb-4">
                        <span>Bài viết</span>
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
</style>

<script type="text/babel">

    const { useState, useMemo} = React;

    const Blog = (props) => {
        return (
            <a className="col-md-12 mb-2 list-item" href={props.url}>
                <div className="thumb">
                    <img src={ props.thumb } alt="Raised image" className="rounded shadow-lg" />
                </div>
                <div className="content">
                    <div className="col-12 title" title={ props.title }>
                        <span className="text-dark">
                            { props.shortTitle }
                        </span>
                    </div>
                    <div className="col-12">
                        <span className="text-muted">
                            <small>
                                { props.date }
                            </small>
                        </span>
                    </div>
                </div>
            </a>
        );
    }

    const Blogs = (props) => {
        const [blogs, setBlogs] = useState([]);
        const [loading, setLoading] = useState(true);
        const [pageUrl, setPageUrl] = useState({pre: '#', next: '#'});
        const [url, setUrl] = useState('/api/blogs/gets');

        useMemo(() => {
            axios({
                    method: 'post',
                    url: url,
                })
                .then(function (response) {
                    setBlogs(response.data.data);
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
                    <span>Bài viết</span>
                </h2>
                <div className="row blogs-list">
                    {
                        blogs.map(blog => (
                            <Blog
                                url={blog.url}
                                thumb={blog.thumb}
                                title={blog.title}
                                shortTitle={blog.short_title}
                                date={blog.post_at}
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

    ReactDOM.createRoot(document.getElementById('blogs')).render(<Blogs/>);
</script>


@endsection
