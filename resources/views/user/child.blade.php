@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User</div>
                    <a class="card-body" href="/child/{{$user->id}}">
                        {{$user->name}}
                    </a>
                </div>
                <br>
                <div class="card">
                    <div class="card-header"><p>Your Members</p></div>
                    <div class="card-body">
                        @foreach($children as $c)
                            <div class="child-member">
                                <a class="card-body" href="/child/{{$c->id}}">
                                    {{$c->name}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header"><p>Unregistered Member</p></div>
                    <div class="card-body">
                        @foreach($unregisterUser as $c)
                            <div class="child-member">
                                <a class="card-body" href="/child/{{$c->id}}">
                                    {{$c->name}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header"><p>Hierarchy</p></div>
                    <div class="card-body">
                        @foreach($childList as $c)
                            <div class="child-member">
                                <a class="card-body" href="/child/{{$c['user_id']}}">
                                    {{'Parent '.$c['parent_1'].' Child '.$c['user_id'].' '.$c['user_name']}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
{{--                {{dd($childList)}}--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header"><p>Member not Registered in jackpot</p></div>--}}
{{--                    <div class="card-body">--}}
{{--                        @foreach($unregistJackpotUser as $u)--}}
{{--                            <div class="child-member">--}}
{{--                                <a class="card-body" href="/child/{{$u->id}}">--}}
{{--                                    {{$u->id.' '.$u->name}}--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header"><p>My Jackpot Child</p></div>--}}
{{--                    <div class="card-body">--}}
{{--                        @foreach($childListY as $childListX)--}}
{{--                            {{$key = array_search($childListX, $childListY)}}--}}
{{--                            <div>--}}
{{--                                @foreach($childListX as $c)--}}
{{--                                    <div>ember-id--}}
{{--                                        {{'ID '.$c->user_id.' Name '.$c->name.' Child Count '.$c->count}}--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
                <form action='add-member' method="post">
                    {{csrf_field()}}
                    MemberID
                    <select name="member_id" id="member-id">
                        @foreach($unregisterUser as $u)
                            <option value="{{$u->id}}">{{$u->id.' '.$u->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    ParentID
                    <select name="parent_1" id="parent_1">
                        @foreach($childList as $c)
                            <option value="{{$c['user_id']}}">{{$c['user_id'].' '.$c['user_name']}}</option>
                        @endforeach
                    </select>
                    <button>Submit</button>
                </form>
                <div>
                    @foreach($errors->all() as $e)
                        <div>{{$e}}</div>
                    @endforeach
                </div>
            </div>
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
