@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h3>{{$typeStr}} Wallet</h3>

                @if($type == 2)
                    <span class="badge badge-secondary">Balance: ${{$balance + $total_group_sale}}</span>
                    <br><br>
                    <div class="container-card-deck container-decorate">
                        <b>Personal Deposit: </b>${{$balance}}
                        <br>
                        <b>Group Deposit: </b>${{$total_group_sale}}
                        <br><br>
                        @foreach($group_sale_list as $g)
                            <div>{{$g['user_id'].' '.$g['user_name'].' $'.$g['group_sale']}}</div>
                        @endforeach
                    </div>
                @else
                    <span class="badge badge-secondary">Balance: ${{$type == 1 ? $bonus->balance : $balance}}</span>
                @endif
                <br><br>

                @if($type == 2)
                    <form action="add-deposit" method="post">
                        {{csrf_field()}}
                        <input type="number" min="0" name="deposit" class="decorative-input">
                        <button class="primary-color-btn">Add Deposit</button>
                    </form>
                @endif

                <br>
                <div class="container-card-deck container-decorate">
                    <h3 class="primary-color-text text-center">Summaries</h3>
                    <br>
                    @foreach($summaries as $s)
                        <div class="container-card-deck-child">
                            {{$s->text}}
                            @if($s->status == "increment")
                                <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                            @else
                                <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                            @endif
                        </div>
                    @endforeach
                </div>
                <br><br>
                @if(Auth::user()->suspend_status == 'unsuspend' || ($type != 1 && Auth::user()->suspend_status != 'unsuspend'))
                <div class="container-card-deck container-decorate">
                    <h3 class="primary-color-text text-center">Withdraw</h3>
                    <form action="/wallet/withdraw/{{$type}}" method="post">
                        {{csrf_field()}}
                        <input type="number" min="2" id="wallet" name="wallet" max="{{$balance}}" value="0" class="decorative-input">
                        <br><br>
                        <b>20%</b> from your withdrawal will be <b>donated</b> to the community
                        <br><br>
                        What will you divide your withdrawal into?
                        <br><br>
                        <div id="max_get">Max: 0</div>
                        <table>
                            <tr>
                                <td>
                                    BCA
                                </td>
                                <td>
                                    <input type="number" name="bank" value="0" class="decorative-input margin-up-down-10">
                                </td>
                            </tr>
                            <tr>
                                <td>Registration Point</td>
                                <td><input type="number" name="registration" value="0" class="decorative-input margin-up-down-10"></td>
                            </tr>
                            <tr>
                                <td>Activation Point</td>
                                <td><input type="number" name="activation" value="0" class="decorative-input margin-up-down-10"></td>
                            </tr>
                            <tr>
                                <td>MCD Point</td>
                                <td><input type="number" name="mcd" value="0" class="decorative-input margin-up-down-10"></td>
                            </tr>
                        </table>
                        <input type="submit" value="Withdraw" class="primary-color-btn">
                    </form>
                </div>
                @foreach($errors->all() as $e)
                    <div>{{$e}}</div>
                @endforeach
                @endif
                <br><br>
                @if($type == 1)
                    @if(Auth::user()->name != 'admin' && Auth::user()->suspend_status == 'suspend')
                    <h3>Upgrade Package</h3>
                    <form action="/wallet/upgrade-package" method="post">
                        {{csrf_field()}}
                        <select name="upgrade_package" id="upgrade_package" class="select-design">
                            @foreach($packages as $p)
                                @if($p->id > $user_package)
                                    <option value="{{$p->id}}">
                                        {{'Get Max Withdraw $'.($p->max_withdraw*(double)$p->max_balance).' for $'.$p->package_cost}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <button class="primary-color-btn">Upgrade</button>
                    </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#wallet').change(function () {
                $.ajax({
                    url: "{{url('package')}}",
                    method: 'GET',
                    success: function (data) {
                        var max = 0
                        if ($('#wallet').val() != '') {
                            var max = Math.floor(parseFloat($('#wallet').val())*0.8);
                        } else {
                            $('#wallet').val(0)
                        }
                        $('#max_get').html('Max: ' + max)
                    }
                });
            });
        });
    </script>
@endsection
