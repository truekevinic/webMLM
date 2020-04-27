@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Package</p></div>
                    <table class="tablePackage" style="margin: 1.5em;"  >
{{--                        @foreach($packages as $p)--}}
{{--                            <tr>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->package_cost}}</li></td>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_balance}}</li></td>--}}
{{--                                <td class="profile-member-list"> <li style="list-style: none;">{{$p->max_withdraw}}</li></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                    </table>
                    <div>
                        <div>Add Package</div>
                        <table>
                            <tr>
                                <th class="profile-member-list"> <li style="list-style: none;">Package Cost</li></th>
                                <th class="profile-member-list"> <li style="list-style: none;">Max Balance</li></th>
                                <th class="profile-member-list"> <li style="list-style: none;">Max Withdraw</li></th>
                            </tr>
                            <tr>
                                <td><input type="number" name="addPackageCost" id="addPackageCost"></td>
                                <td><input type="number" name="addMaxBalance" id="addMaxBalance"></td>
                                <td><input type="number" name="addMaxWithdraw" id="addMaxWithdraw"></td>
                            </tr>
                        </table>
                        <div>
                            <button id="btnAdd">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
    $(document).ready(function () {
        // var package = [];
        var packageList = {!! json_encode($packages->toArray()) !!};
        // console.log(package)

        function loopPackage() {
            var packageDiv = "";

            packageDiv += '<tr>' +
                '<th class="profile-member-list"> <li style="list-style: none;">Package Cost</li></th>' +
                '<th class="profile-member-list"> <li style="list-style: none;">Max Balance</li></th>' +
                '<th class="profile-member-list"> <li style="list-style: none;">Max Withdraw</li></th>' +
            '</tr>'

            for (let i = 0; i < packageList.length ; i++) {
                packageDiv += '<tr>'+
                    '<td class="profile-member-list"> <li style="list-style: none;">'+packageList[i].package_cost+'</li></td>'+
                    '<td class="profile-member-list"> <li style="list-style: none;">'+packageList[i].max_balance+'</li></td>'+
                    '<td class="profile-member-list"> <li style="list-style: none;">'+packageList[i].max_withdraw+'</li></td>'+
                    '<td class="profile-member-list"> <li style="list-style: none;"><button onclick="" class="btnDelete" id="btnDeletePackage'+i+'">Remove</button></li></td>' +
                    '</tr>'
            }
            $('.tablePackage').html(packageDiv);
        }

        $.ajax({
            url: "{{url('package')}}",
            method: 'GET',
            success: function (data) {
                loopPackage();
            }
        });

        $('#btnAdd').click(function () {
            console.log("c")
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    packageList.push({
                        'package_cost': parseInt($('#addPackageCost').val()),
                        'max_balance': parseInt($('#addMaxBalance').val()),
                        'max_withdraw': parseInt($('#addMaxWithdraw').val())
                    });
                    console.log(packageList);
                    loopPackage()
                }
            });
        });

        $('.tablePackage').on('click', '.btnDelete', function (e) {
            $.ajax({
                url: "{{url('package')}}",
                method: 'GET',
                success: function (data) {
                    // console.log($(this).attr("id"))
                    console.log(e.target.id)
                    var idx = parseInt(e.target.id.split("btnDeletePackage")[1])
                    packageList.splice(idx,1);
                    loopPackage();
                }
            });
        });
    });
    </script>

@endsection
