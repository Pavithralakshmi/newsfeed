@extends('items.layout') @section('content')
<div class="card mt-5">
    <div class="card-header">
        <div class="col-md-12">
            <h4 class="card-title">
                <strong>
                    Show Page</strong>
                Nithra School Steps - News Feed
                <a class="btn btn-success ml-5" href="{{ route('items.index') }}">Back</a>
            </h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong class="row">Title:</strong>
                    {{ $item->title }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group" style="white-space: break-spaces;text-align: justify;">
                    <strong class="row">Description:</strong>
                    {{ $item->description }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong class="row">File:</strong>
                     @foreach (explode(',', $item->imageurl) as $imageurlimg)
                    <?php $os = array("jpeg", "jpg", "png", "webp");?>
@if (in_array(pathinfo($item->imageurl, PATHINFO_EXTENSION ), $os))
                    <img src="{{ asset('public/images/' . $imageurlimg) }}" class="img-thumbnail">
@endif
                                        @if(pathinfo($item->imageurl, PATHINFO_EXTENSION) == 'mp4')
                    <video width="320" height="240" controls="controls">
                        <source src="{{ asset('public/images/' . $imageurlimg) }}" type="video/mp4">
                    </video>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection