@extends('items.layout')

@section('content')
<div class="card mt-5">
    <div class="card-header">
        <div class="col-md-12">
            <h4 class="card-title"> Nithra School Step - News Feed
                <a class="btn btn-success ml-5" href="{{ route('items.create') }}" id="createNewItem"> Create New Post</a>
            </h4>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Files</th>
                <th>Posted On</th>
                <th width="20%">Action</th>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td><p style="line-height: 1.5em;height: 3em;overflow: hidden;">{{ $item->title }}<p></td>
                <td><p style="line-height: 1.5em;height: 3em;overflow: hidden;">{{ $item->description }}</p></td>
                <td>
                  @foreach (explode(',', $item->imageurl) as $key => $imageurlimg)
                  @if($key == '0')
                   <?php $os = array("jpeg", "jpg", "png", "webp");?>
@if (in_array(pathinfo($item->imageurl, PATHINFO_EXTENSION ), $os))
                <img src="{{ asset('public/images/' . $imageurlimg) }}" class="img-thumbnail" style="max-width:unset;height:60px;" width="75">
                       @endif  
                         @if(pathinfo($item->imageurl, PATHINFO_EXTENSION) == 'mp4')
                    <video width="75" height="50" controls="controls">
                        <source src="{{ asset('public/images/' . $imageurlimg) }}" type="video/mp4">
                    </video>
                    @endif
                 @endif
                 @endforeach
                 
                 @if($key > '0')
                  <span style="float:right;">+ {{$key}}</span>
                   @endif
                </td>
                 <td style="white-space: pre;">{{ date('d-M-Y', strtotime($item->created_at))}} <br> {{ date('h:i A', strtotime($item->created_at))}} </td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{ route('items.show',$item->id) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('items.edit',$item->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>
    <center style="margin:auto;">
    {!! $items->links() !!}
    </center>
    @endsection