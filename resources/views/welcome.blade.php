@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

<div class="container">
<h1>My Albums</h1>
@if(Auth::check())
<a href="{{route('album.store')}}"><button style="float:right;" class="btn btn-success">Create New Album</button></a><br>   
@endif
@if(session('success'))
                <div class="show"> 
                  <br>
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                </div>
            @endif  
    <div class="row">
       @foreach($albums as $album)
        <div class="col-sm-4">
           <a  href="albums/{{$album->id}}">
                <div class="item">
                   @if(empty($album->image))
                    <img src ="storage/uploads/iu0fpG8hLtQQ5nauT6HHQ9ldP1EqmeHBnwfAB2Gz.jpeg" class="img-thumbnail">
                   @else 
                   <img src="{{asset('storage/'.$album->image)}}" class="img-thumbnail">
                   @endif
                    <a href="albums/{{$album->id}}" class= "centered">{{$album->name}}</a> 
                </div>
            </a>

<!-- Button trigger modal -->
@if(Auth::check())
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
Change Album Image
</button>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('add.album.image')}}" method="post" enctype="multipart/form-data">@csrf
      <div class="modal-body">
      <input type="file" name="image" class="form-control">
      <input type="hidden" name="id"  value="{{$album->id}}" class="form-control">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
            
        </div>
     @endforeach  
      
    </div>
</div>

@endsection
<style>

    .item{
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
      
        
    }
    .item img{ 
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
        height: 200px;
        width:300px;
    }
    .item img:hover{
        -webkit-transform:scale(1.2);
        transform:scale(1.2);
        height: 200px;
        width:300px;
    }
    .centered{
        position:absolute;
        top:130;
        left:90;
        color: #fff;
        font-size: 24px;
    }
    .img-thumbnail{
        border: 0px;
        border-radius:0px;
    }
</style>