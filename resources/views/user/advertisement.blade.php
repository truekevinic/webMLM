@extends('layouts.app')

@section('content')
    <br><br><br>
<div class="container">

    <div class="container-card-deck container-decorate">
        <h3 class="primary-color-text text-center">Create your advertisement here</h3>
        <form action="/advertisement/create" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="Description"><b> Description</b></label>
                <textarea class="form-control" id="Description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="Link"><b>link</b></label>
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
    <br><br>

        <h3 class="primary-color-text text-center">This is your advertisement</h3>

            @foreach($advertisements as $advertisement)
            <div class="centering container-decorate px-3">
                <form action="/advertisement/update/{{$advertisement->id}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <table class="mx-auto">
                        <tr>
                            <td class="px-4 py-4">
                                <img style="width: 10em; height: auto;"
                                    src="{{asset("storage/images/$advertisement->image_source")}}" alt="">
                            </td>
                            <td class="px-4">
                                <b>update image</b> <br><input type="file" name="image_source">
                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <label for="Description"><b> Description</b></label>
                        <textarea class="form-control" id="Description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Link"><b>link</b></label>
                        <input type="text" class="form-control" id="Link" name="link">
                    </div>
                    <input type="submit" value="Update" class="primary-color-btn mx-5" />


                    <form action="/advertisement/delete/{{$advertisement->id}}" method="post">
                        {{csrf_field()}}
                        <input type="submit" value="Delete" class="primary-color-btn mx-5" />
                    </form>
                    <br><br>
                </form>


            </div>
            <br><br>
            @endforeach



</div>
@endsection
