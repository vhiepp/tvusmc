@extends('client.master')


@section('header')

    @include('client.layouts.header')

@endsection

@section('content')

    <div class="section section-typography">

        <div class="container">
            
            <div class="row">

                <div class="col-md-7">
                    {!! view('client.components.events.list', [
                        'header' => 'Sự kiện',
                        'events' => $events,
                    ]) !!}
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