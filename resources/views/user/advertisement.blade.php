@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card my-5">
        <div class="card-header">
            <h2> This is your advertisement</h2>
        </div>
        <div class="card-body">
            @foreach($advertisements as $advertisement)
    
            <form action="/advertisement/update/{{$advertisement->id}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <img style="width: 10em; height: auto;"src="{{asset("storage/images/$advertisement->image_source")}}" alt="">
                update image <input type="file" name="image_source">
                <br>
                advertisement link <input type="text" name="link" value={{$advertisement->link}}>
                <br>
                advertisement description <input type="text" name="description" value={{$advertisement->description}}>
                <br>
                <input type="submit" value="Update"/>
            </form>
            <form action="/advertisement/delete/{{$advertisement->id}}" method="post">
                {{csrf_field()}}
                <input type="submit" value="Delete"/>
            </form>
            @endforeach
        </div>
    </div>
   
    
    
    
    <br>
    <div class="card my-5">
        <div class="card-header">
            <h3>Create your advertisement here</h3>
        </div>
        <div class="card-body">
            <form action="/advertisement/create" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="Link">link</label>
                    <input type="text" class="form-control" id="Link" name="link">
                </div>
                <div class="form-group">
                    <label for="Image">Image</label>
                    <input type="file" class="" id="Image" name="image_source">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">
                        Submit
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
    
    
</div>
    

@endsection
