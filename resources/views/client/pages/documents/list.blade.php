@extends('client.master')

@section('head')

    <meta name="description" content="Nắm bắt xu hướng - phát triển đam mê, TVU Social Media Club">

    <meta property="og:type" content="article" />
    <meta property="og:image" content="/assets/img/file_explorer.jpg" />

    <meta property="og:title" content="Văn bản / Danh sách | TVU Social Media Club" />
    <meta property="og:description" content="Nắm bắt xu hướng - phát triển đam mê, TVU Social Media Club" />
    <meta property="og:url" content="https://tvusmc.com/van-ban" />

    <link rel="stylesheet" href="/assets/css/files.css">
    <link rel="stylesheet" href="/assets/css/loading.css">

    <style>
        .spinnerIconWrapper {
            position: absolute;
            height: calc(100% - 12px);
            min-height: calc(100% - 12px);
            top: 0;
            left: 0;
            right: 0;
            background-color: #0016346b;
            border-radius: .3rem;
            display: inline-block;
            margin: 0 0 20px 0;
        }

        .pagination {
            position: absolute;
            bottom: -24px;
            left: 15px;
            right: 15px;
        }
    </style>

@endsection

@section('header')
        <div class="container mt-3">
            @include('client.components.btn.previous')
        </div>
@endsection

@section('content')

    <div class="section py-3 section-typography">

        <div class="container">

            <div class="row">

                <div class="col-12 mt-4" style="position: relative;" >
                    <h2 class="h4 text-success font-weight-bold mb-4">
                        <span>Danh sách / Văn bản</span>
                    </h2>

                    <div style="position: relative; min-height: 100px" id="file-vanban">

                        <div class="col-12 text-center">
                            <small >
                                Chưa có danh sách/ văn bản
                            </small>
                        </div>

                    </div>
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
        const { useState, useMemo } = React;

        const FileItem = (props) => {

            const handleRedirectToDetail = () => {
                window.location.href = '/van-ban/' + props.slug;
            }

            return (
                <a className="col-12 file-item cursor-pointer" onClick={handleRedirectToDetail} title={props.title}>

                    <div className="file-item_content">

                        <div className="file-item_thumb">
                            <img src={props.thumb} alt={props.title} />
                        </div>

                        <div className="file-item_name px-2 col-12">
                            <span className="text-xs font-weight-bold text-clip">
                                { props.title }
                            </span>
                            <small>
                                { props.date }, có {props.fileCount} file đính kèm.
                            </small>
                        </div>

                    </div>

                </a>
            );
        }

        const FileList = (props) => {
            const [files, setFiles] = useState([]);
            const [loading, setLoading] = useState(true);
            const [pageUrl, setPageUrl] = useState({pre: '#', next: '#'});
            const [url, setUrl] = useState(props.url);

            useMemo(() => {
                axios({
                        method: 'get',
                        url: url,
                    })
                    .then(function (response) {
                        if (response.data.data.length > 0) {
                            setFiles(response.data.data);
                            // console.log(response.data);
                        }
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
                <React.Fragment>
                    {
                        files.map(file => (
                            <FileItem
                                key={file.id}
                                title={file.title}
                                date={file.post_at}
                                download={file.download}
                                thumb={file.thumb}
                                fileCount={file.files_count}
                                slug={file.slug}
                            />
                        ))
                    }
                    {
                        files.length == 0 && (
                            <div class="col-12 text-center">
                                <small >
                                    Chưa có văn bản / danh sách nào
                                </small>
                            </div>
                        )
                    }
                    {
                        loading && (<div className="spinnerIconWrapper ">
                                        <div className="spinnerIcon"></div>
                                    </div>)
                    }

                    <div className="col-12 pagination">
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


                </React.Fragment>
            );
        }

        ReactDOM.createRoot(document.getElementById('file-vanban')).render(<FileList url="/api/documents" />);
    </script>

@endsection
