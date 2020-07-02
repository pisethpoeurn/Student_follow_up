@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 bg-white">
            <div class="container mt-3">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Follow Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Out Of Follow Up</a>
                    </li>
                </ul>
                <br>
                {{-- ///modal --}}
                      <a href="" data-toggle="modal" data-target="#myModal">Add students</a>
                      <!-- The Modal -->
                      <div class="modal" id="myModal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header text-center">
                              <h2 class="modal-title">Create New Student</h2>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{route("students.store")}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                      <label for="fname">firstName:</label>
                                      <input type="text" class="form-control" placeholder="FirstName" name="fname">
                                    </div>
                                    <div class="form-group">
                                      <label for="lname">lastName:</label>
                                      <input type="text" class="form-control" placeholder="LastName" name="lname">
                                    </div>
                                    <div class="form-group">
                                      <label for="class">class:</label>
                                      <select name="class" id="class" class="form-control">
                                        <option value="WEP2020-A">WEP2020-A</option>
                                        <option value="WEP2020-B">WEP2020-B</option>
                                        <option value="SNA2020">SNA2020</option>
                                        <option value="2021-A">2021-A</option>
                                        <option value="2021-B">2021-B</option>
                                        <option value="2021-C">2021-C</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="description">Description:</label>
                                      <textarea name="description" id=""  class="form-control" cols="10" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="picture">Picture:</label>
                                      <input type="file" class="form-control" placeholder="Picture" name="pic">
                                    </div>
                                    <div class="form-group">
                                      <label for="tutor">Tutor: </label>
                                      <select name="user_id" id="user_id" class="form-control">
                                          <option value="1">Admin</option>
                                          <option value="2">Normal</option>
                                      </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-danger btn-right" data-dismiss="modal">Close</button>
                                  </form>
                            </div>
                          </div>
                        </div>
                      </div>
                {{-- modalll --}}
              
                <!-- Tab panes -->
                <div class="tab-content">
                  <div id="home" class="container tab-pane active"><br>
                    <h1 class="text-center text-success text-bold">Follow Up list</h1>
                    <table class="table table-border ">
                        <thead class="text-center">
                            <tr>
                                <th>Picture</th>
                                <th>Full Name</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($students as $student)
                        @if ($student->activeFollowup==1)
                            <tr>
                            <td> <img src="/uploads/students/{{ $student->picture }}" width="90px;" height="90px;"></td>
                            <td>{{$student->firstName}} {{$student->lastName}}</td>
                            <td>{{$student->class}}</td>
                            <td>
                              <a href="{{route("students.show",$student->id)}}" class=" text-success">view</a>
                                {{-- ///modal --}}
                                  <!-- The Modal -->
                                  <a href="" data-toggle="modal" data-target="#Modal{{$student->id}}">Edit</a>
                                  @foreach ($students as $student)
                                  <div class="modal" id="Modal{{$student->id}}">
                                      <div class="modal-dialog">
                                      <div class="modal-content">
                                          <!-- Modal Header -->
                                          <div class="modal-header text-center">
                                          <h2 class="modal-title">Edit Student</h2>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
                                          <!-- Modal body -->
                                          <div class="modal-body">
                                              <form action="{{route("students.update",$student->id)}}" method="post" enctype="multipart/form-data" >
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="form-group">
                                                  <label for="fname">firstName:</label>
                                                  <input type="text" class="form-control" placeholder="FirstName" name="fname" value="{{$student->firstName}}">
                                                  </div>
                                                  <div class="form-group">
                                                  <label for="lname">lastName:</label>
                                                  <input type="text" class="form-control" placeholder="LastName" name="lname" value="{{$student->lastName}}">
                                                  </div>
                                                  <div class="form-group">
                                                  <label for="class">class:</label>
                                                  <select name="class" id="class">
                                                  <option value="WEP2020-A" @if($student->class==='WEP2020-A') selected='selected' @endif>WEP2020-A</option>
                                                  <option value="WEP2020-B" @if($student->class==='WEP2020-B') selected='selected' @endif>WEP2020-B</option>
                                                  <option value="SNA2020" @if($student->class==='SNA2020') selected='selected' @endif>SNA2020</option>
                                                  <option value="2021-A" @if($student->class==='2021-A') selected='selected' @endif>2021-A</option>
                                                  <option value="2021-B" @if($student->class==='2021-B') selected='selected' @endif>2021-B</option> 
                                                  <option value="2021-C" @if($student->class==='2021-C') selected='selected' @endif>2021-C</option>
                                                  </select>
                                                  </div>
                                                  <div class="form-group">
                                                  <label for="description">Description:</label>
                                                  <textarea name="description" id=""  class="form-control" cols="10" rows="5">{{$student->description}}</textarea>
                                                  </div>
                                                  <div class="form-group">
                                                  <label for="picture">Picture:</label>
                                                  <input type="file" class="form-control" placeholder="Picture" name="picture">
                                                  </div>
                                                  <div class="form-group">
                                                  <label for="tutor">Tutor: </label>
                                                  <select name="user_id" id="user_id" >
                                                      <option value="1" @if($student->user_id==='1') selected='selected' @endif>Admin</option>
                                                      <option value="2" @if($student->user_id==='2') selected='selected' @endif>Normal</option>
                                                  </select>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                                  <button type="button" class="btn btn-danger btn-right" data-dismiss="modal">Close</button>
                                              </form>
                                          </div>
                                      </div>
                                      </div>
                                  </div>
                                  {{-- modalll --}}
                                  @endforeach
                                  
                                </td>
                            </tr>  
                        @endif
                        @endforeach
                    </table>
                  </div>
                  <div id="menu1" class="container tab-pane fade"><br>
                    <h2 class="text-center text-success">Out of Follow Up List</h2>
                    <table class="table table-border">
                        <thead class="text-center">
                            <tr>
                                <th>Picture</th>
                                <th>Full Name</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($students as $student)
                        @if ($student->activeFollowup==0)
                            <tr>
                              <td> <img src="/uploads/students/{{ $student->picture }}" width="90px;" height="90px;"></td>
                                <td>{{$student->firstName}} {{$student->lastName}}</td>
                                <td>{{$student->class}}</td>
                                <td>
                                <a href="{{route('followup',$student->id)}}" class="material-icons text-danger">ToFollowUp</a>
                                </td>
                            </tr>
                        @endif        
                        @endforeach
                    </table>
                  </div>
                </div>
            </div>      
        </div>
    </div>
</div>
@endsection
