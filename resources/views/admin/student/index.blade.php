<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/x-icon" href="{{ url("../images/PSU_logo.png") }}" />
  <title>Admin Student Dashboard</title>
</head>
<style>
td{
    border: none;
  }
</style>
@extends('components.atom.index')
@extends('components.molecule.sideBarNavigation')
@section('sideBarNavigation')
<section class="home-section" style="background-image: url('../images/PSU_background.jpg'); background-size: cover;">
  <div class="text">Admin Student List<i class='bx bxs-user-circle'></i></div>
    <div class="card-body-table">
        <table id="tblUsers" class="table table-hover table-responsive bg-white-100" style="font-size:12px; background-color: white;" cellspacing="0">
          {{-- <div align="center" style="margin-bottom: 20px;" >  
            </i><input type="text" name="search" id="search" class="form-control" placeholder="Search For Teacher Input Here ...." />  
          </div> --}}
            <thead style="background-color: rgb(0, 0, 178); text-transform: uppercase; color: white; font-size: 1.2em;">
                <tr>
                    <th>Profile Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th> 
                </tr>	
            </thead> 
            <tbody>
                @foreach($student as $student)
                <tr>
                    @if($student->profile_photo_path == null)
                    <td>No Profile Photo</td>
                    @else   
                    <td><img src="{{ URL::asset("storage/".$student->profile_photo_path) }}" alt="" style="width: 80px; height:80px; border-radius: 50%;"></td>
                    @endif
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <div class="deleteButton">
                            <form action='{{ url("teacher/page/$student->id") }}' method="post">
                            <input class="btn btn-danger" type="submit" value="Delete" />
                            @method('delete')
                            @csrf
                          </form>
                        </div>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <p id="result"></p>
         {{-- <div>
                    {{ $students->links() }}
           </div> --}}
</section>
@endsection
<body>
</html>
