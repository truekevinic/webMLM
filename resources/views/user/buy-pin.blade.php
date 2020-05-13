@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container-card-deck container-decorate">
                    <h3 class="primary-color-text text-center">My Point</h3>
                <b>Registration Point:
                    </b> {{$reg}}
                <br>
                <b>Activation Point: </b>{{$ac}} 
                <br><br>
                </div>
                <br><br>
                <div class="container-card-deck container-decorate">
                    <h3 class="primary-color-text text-center">Buy Pin</h3>
                    <form action="/buy-pin-post" method="post">
                        {{csrf_field()}}

                        <br><br>
                        <table>
                        <tr>
                            <td>

                                How many pin you want to buy? 
                                <br>(1 pin is worth ${{$pinPrice}})
                            </td>
                            <td>

                            
                                <input type="number" min="1" name="pin-total" value="1" class="decorative-input margin-up-down-10">
                            </td>
                                
                            
                            
                        </tr>

                            <tr>
                                <td>
                                    Registration
                                </td>
                                <td>
                                    <input type="number" name="registration" id="registration" min="1" value="1" class="decorative-input margin-up-down-10">
                                </td>
                            </tr>
                            <tr>
                                <td>Activation</td>
                                <td><input type="number" name="activation" id="activation" min="0" value="0" class="decorative-input margin-up-down-10"></td>
                            </tr>
                        </table>
                        <input type="submit" value="Buy" class="primary-color-btn">
                    </form>
                </div>
                <br>
                
                <br>
                <div class="container-card-deck container-decorate   p-4">
                    <br><br>
                    <h3 class="primary-color-text text-center">Pin List</h3>
                    <br>
                    <div class="">
                        <table  class="table">
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
