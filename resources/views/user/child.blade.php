@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container-card-deck">
            <h3 class="primary-color-text text-center">Hello, {{$user->name}}
                <span class="badge badge-secondary">here are your members</span>
            </h3>
            <div class="row-centering">
                @foreach($children as $c)
                    <div class="centering container-card-deck-child">
                        @if($c->profile_image != 'none')
                            <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                        @else
                            <img src="{{asset("storage/images/$c->profile_image")}}" class="rounded-circle"
                                 style="width:75px " alt="">
                        @endif
                        <br>
                        <b>Username:</b> {{$user->username}}
                        <br>
                        <b>Email: </b>{{$user->email}}
                        <br>
                        <b>Generated referral code: </b>{{$user->referral_code}}
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="container-card-deck">
            <h3 class="primary-color-text text-center">Unregistered users</h3>
                <div class="row-centering">
                    @foreach($unregisterUser as $c)
                        <div class="centering container-card-deck-child">
                            @if($c->profile_image != 'none')
                                <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                            @else
                                <img src="{{asset("storage/images/$c->profile_image")}}" class="rounded-circle"
                                     style="width:75px " alt="">
                            @endif
                            <br>
                            <b>Username:</b> {{$user->username}}
                            <br>
                            <b>Email: </b>{{$user->email}}
                            <br>
                            <b>Generated referral code: </b>{{$user->referral_code}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="container-card-deck">
            <h3 style="text-align:center;" class="primary-color-text">Register here!</h3>
            <div class="row-centering">
                <select name="member_id" id="member_id" class="select-design">
                    <option value="">Choose Member</option>
                    @foreach($unregisterUser as $u)
                        <option value="{{$u->id}}">{{$u->id.' '.$u->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @include('management');
        <div>
            @foreach($errors->all() as $e)
                <div>{{$e}}</div>
            @endforeach
        </div>
    </div>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
{{--    <script src="{{asset('js/d3.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            // var package = [];--}}
{{--            $.ajax({--}}
{{--                url: "{{url('child/1')}}",--}}
{{--                method: 'GET',--}}
{{--                success: function (data) {--}}
{{--                    // loopPackage();--}}
{{--                    var childList = {!! json_encode($childList) !!};--}}
{{--                    // console.log(package)--}}

{{--                    var svg = d3.select("body").append("svg").attr("width", 600)--}}
{{--                        .attr("height", 600).append("g")--}}
{{--                        .attr("transform", "translate(50,50)");--}}

{{--                    var dataStructure = d3.stratify()--}}
{{--                        .id(function (d) {return d.user_id;})--}}
{{--                        .parentId(function (d) {return d.parent_1;})--}}
{{--                        (childList);--}}

{{--                    var treeStructure = d3.tree().size([500, 300]);--}}
{{--                    var information = treeStructure(dataStructure);--}}

{{--                    console.log(information.descendants());--}}
{{--                    console.log(information.links());--}}

{{--                    var circles = svg.append("g").selectAll("circle")--}}
{{--                        .data(information.descendants());--}}
{{--                    circles.enter().append("circle")--}}
{{--                        .attr("cx", function(d){return d.x;})--}}
{{--                        .attr("cy", function(d){return d.y;})--}}
{{--                        .attr("r", 5)--}}

{{--                    var connections = svg.append("g").selectAll("path")--}}
{{--                        .data(information.links());--}}
{{--                    connections.enter().append("path")--}}
{{--                        .attr("d", function(d){return "M"+d.source.x+","+d.source.y+" C "+d.source.x + "," + (d.source.y + d.target.y)/2+" "+d.target.x+","+(d.source.y + d.target.y)/2 + " " + d.target.x + "," + d.target.y});--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
