@extends('layouts.app')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="container">
<h2>{{$albums->name}} [images({{$albums->images->count()}})]</h2>
  <!--Start add image-->
       <!-- Button trigger modal -->
       @if(Auth::check())
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Add Image
        </button>
       @endif
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form id="form" action="{{route('album.image')}}" method="POST" enctype="multipart/form-data">
              @csrf
                 
                <div class ="form-group">
                    <label>Adding Images in <strong>{{$albums->name}}</strong> album</label>
                    <input type="hidden" name="id" value="{{$albums->id}}"  class="form-control" >
                </div>

               <div class = "input-group control-group initial-add-more">
                 <input type ="file" name="image[]" class=" form-control" id="image"-->
                    <div class="input-group-btn">
                        <button class="btn btn-success btn-add-more" type= "button">+</button>
                </div>
            </div>
            <div class="copy" style="display:none;">
            <div class = "input-group control-group add-more" style="margin-top:12px;">
                 <input type ="file" name="image[]" class=" form-control" id="image">
                    <div class="input-group-btn">
                        <button class="btn btn-danger remove" type= "button">-</button>
                    </div>
            </div>
            </div>
              <br>
      

      </div>
      <div class="modal-footer">
                <div class="form-group">
                   <button class="btn btn-success" type = "submit">Submit</button>
               </div>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
       <!--End add image-->
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
       @foreach($albums->images as $album)
        <div class="col-sm-4">
            <div class="item">
                <img src="{{asset('storage/'.$album->name)}}" class="img-thumbnail">
            </div> 

                <!-- Button trigger modal -->
                @if(Auth::check()&&Auth::user()->user_type=='admin')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
                Delete
                </button>
                
                @elseif(Auth::check())
                <button type="button" disabled class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
                Delete
                </button>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete!
                    </div>
                        <div class="modal-footer">
                         <form action= "{{route('image.delete')}}" method="POST">@csrf 
                            <input type="hidden" name="id" value="{{$album->id}}">
                            <button class="btn btn-danger" type="submit">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         </form>
                    </div>
                    </div>
                </div>
                </div>
        </div>
     @endforeach  
      
    </div>
</div>

@endsection

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
            <script >
            $(document).ready(function(e){
                $(".btn-add-more").click(function(){
                    var html=$(".copy").html();
                    $(".initial-add-more").after(html);
                });
                $("body").on("click",".remove",function(){
                    $(this).parents(".control-group").remove();
                })
            });
            </script>

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
        
    }
    .item img:hover{
        -webkit-transform:scale(1.2);
        transform:scale(1.2);
      
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
