@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-card-deck">
        <h3 class="primary-color-text">Create your advertisement here</h3>
        <form action="/advertisement/create" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="form-control" id="Description" name="description" ></textarea>
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
                <button type="submit" class="primary-color-btn">
                    Submit
                </button>
            </div>
        </form>
        @foreach($errors->all() as $e)
            <div>{{$e}}</div>
        @endforeach
    </div>

    <div class="container-card-deck">
        <h3 style="text-align:center;" class="primary-color-text">This is your advertisement</h3>
        <div class="row-centering">
            @foreach($advertisements as $advertisement)
                <div class="centering container-card-deck-child">
                        <form action="/advertisement/update/{{$advertisement->id}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <img style="width: 10em; height: auto;"src="{{asset("storage/images/$advertisement->image_source")}}" alt="">
                            <br>
                            <b>update image</b> <input type="file" name="image_source">
                            <br>
                            <b> link </b><input type="text" name="link" value={{$advertisement->link}}>
                            <br>
                            <b>description</b> <input type="text" name="description" value={{$advertisement->description}}>
                            <br>
                            <br>
                            <input type="submit" value="Update" class="primary-color-btn"/>
                        </form>
                        <br>
                        <form action="/advertisement/delete/{{$advertisement->id}}" method="post">
                            {{csrf_field()}}
                            <input type="submit" value="Delete" class="primary-color-btn"/>
                        </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
