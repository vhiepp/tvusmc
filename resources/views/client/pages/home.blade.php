@extends('client.master')


@section('header')

    @include('client.layouts.header')

@endsection

@section('content')

    <div class="section section-typography">

        <div class="container">
            
            <div class="row">

                <div class="col-md-7">
                    @include('client.components.events.list')
                </div>
                <div class="col-md-5">
                    {!! view('client.components.blogs.list', [
                        'header' => 'Bài viết',
                        'blogs' => $blogs,
                    ]) !!}
                </div>

            </div>

        </div>

    </div>

@endsection