@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class=" justify-content-center">
            <div class="row">
                <div class="container-card-deck container-decorate col-10 offset-1 my-5 p-0">
                    <div class=""><h3>Pending Pin</h3></div>
                    <div class="">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Pin</th>
                                <th>Approved</th>
                                <th>Reject</th>
                            </tr>
                            @foreach($pin_pending as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->referral_id}}</td>
                                    <td>{{$p->code}}</td>
                                    <td>
                                        <form action="approved-pin/{{$p->id}}" method="post">
                                            {{csrf_field()}}
                                            <input type="submit" value="Approved">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="reject-pin/{{$p->id}}" method="post">
                                            {{csrf_field()}}
                                            <input type="submit" value="Reject">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="centering">
                        {{$pin_pending->links()}}
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="container-card-deck container-decorate col-10  offset-1 p-0">
                    <div class=""><h3>Pin</h3></div>
                    <div class="">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Pin</th>
                            </tr>
                            @foreach($pin as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->referral_id}}</td>
                                    <td>{{$p->code}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="centering">

                        {{$pin->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
