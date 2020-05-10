@extends('layouts.app')

@section('content')

    This is your advertisement
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
    <br>
    Create your advertisement here
    <form action="/advertisement/create" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        description
        <input type="text" name="description">
        <br>
        link
        <input type="text" name="link">
        <br>
        image
        <input type="file" name="image_source">

        <input type="submit" value="Submit">
    </form>

@endsection
