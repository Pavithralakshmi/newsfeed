@extends('items.layout')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        <div class="col-md-12">
            <h4 class="card-title"><strong> Edit Page</strong> Nithra School Steps - News Feed
                <a class="btn btn-success ml-5" href="{{ route('items.index') }}">Back</a>
            </h4>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('items.update',$item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="title" value="{{ $item->title }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $item->description }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Files:</strong>
                        <input type="file" name="image" />
                         @foreach (explode(',', $item->imageurl) as $imageurlimg)
                           <?php $os = array("jpeg", "jpg", "png", "webp");?>
@if (in_array(pathinfo($item->imageurl, PATHINFO_EXTENSION ), $os))
                        <img src="{{ asset('public/images/' . $imageurlimg) }}" class="img-thumbnail" width="100" />
                       @endif  
                         @if(pathinfo($item->imageurl, PATHINFO_EXTENSION) == 'mp4')
                    <video width="350" height="250" controls="controls">
                        <source src="{{ asset('public/images/' . $imageurlimg) }}" type="video/mp4">
                    </video>
                    @endif
                          @endforeach
                        <input type="hidden" name="hidden_image" value="{{ $item->imagurl }}" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    @endsection