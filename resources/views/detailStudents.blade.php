@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-white">
            <div class="container mt-3">
                <h2 class="text-center">View Detial Students</h2>
                @csrf
                <div class="card">
                    <div class="card-header text-center">
                        <img src="/uploads/students/{{ $students->picture }}" width="100px;" height="100px;">
                    </div>
                    <div class="card-body">
                        <div class="col-3">{{$students->firstName}} {{$students->lastName}}</div>
                        <div class="col-3"> <p>{{$students->class}}</p></div>
                        <div class="col-3"> <p>{{$students->description}}</p></div>
                    </div>
                </div><br>
                <form action="{{route('addComment',$students->id)}}" method="POST">
                    @csrf
                    <textarea class="form-control" name="comment" id="comment" cols="150" rows="3" placeholder="Write comment..."></textarea>
                    <br>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
                <br>
                    @foreach ($students->comments as $item)
                        <strong>{{$students->user->firstName}}</strong>
                        <textarea class="form-control" name="comment" id="comment" cols="150" rows="3" disabled selected >{{$item->comment}}</textarea>
                        @if (Auth::user() && (Auth::user()->id == $item->user_id)) 
                                {{-- ///modal --}}
                                  <!-- The Modal -->
                                  <a href="" data-toggle="modal" data-target="#Modal{{$item->id}}">Edit</a>
                                  <div class="modal" id="Modal{{$item->id}}">
                                      <div class="modal-dialog">
                                      <div class="modal-content">
                                          <!-- Modal Header -->
                                          <div class="modal-header text-center">
                                          <h2 class="modal-title">Edit Commentd</h2>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <!-- Modal body -->
                                          <div class="modal-body">
                                              <form action="{{route("editComments",$item->id)}}" method="post" id="{{'comment'.$item->id}}">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="_method" value="PUT">
                                                  <div class="form-group">
                                                  <label for="comment">Comments:</label>
                                                  <textarea name="comment" id=""  class="form-control" cols="10" rows="5">{{$item->comment}}</textarea>
                                                  </div>
                                                  <button type="submit" class="btn btn-success btn-right">submit</button>
                                                  <button type="button" class="btn btn-danger btn-right" data-dismiss="modal">Close</button>
                                              </form>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                {{-- modalll --}}
                        <a href="{{route('deleteComments',$item->id)}}">Delete</a><hr>
                        @endif
                    @endforeach
            </div>      
        </div>
    </div>
</div>
@endsection
