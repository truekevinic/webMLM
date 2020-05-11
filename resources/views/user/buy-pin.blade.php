@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My point</div>
                    <div class="card-body">
                        <div>Registration Point: {{$reg}}</div>
                        <div>Activation Point: {{$ac}}</div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Buy Pin</div>
                    <div class="card-body">
                        <form action="/buy-pin-post" method="post">
                            {{csrf_field()}}
                            How many pin you want to buy? (1 pin is worth ${{$pinPrice}})
                            <div>
                                <input type="number" min="1" name="pin-total" value="1">
                            </div>
                            <div>

                            </div>
                            <div>
                                How much registration point and activation point you want to use?
                                <div>
                                    Registration <input type="number" name="registration" id="registration" min="1" value="1">
                                </div>
                                <div>
                                    Activation <input type="number" name="activation" id="activation" min="0" value="0">
                                </div>
                            </div>
                            <input type="submit" value="Buy">
                        </form>
                    </div>
                    @foreach($errors->all() as $e)
                        <div>{{$e}}</div>
                    @endforeach
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Pin List</div>
                    <div class="card-body">
                        <table border="1">
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Pin</th>
                                <th>Status</th>
                            </tr>
                            @foreach($pin as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->referral_id}}</td>
                                    <td>{{$p->code}}</td>
                                    <td>{{$p->status}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
