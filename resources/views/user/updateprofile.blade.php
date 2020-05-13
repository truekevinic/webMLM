@extends('layouts.app')

@section('content')

<div class="container">
    <br><br><br>
    <div class=" container-card-deck container-decorate centering text-center">
        <h3 style="text-align:center;" class="primary-color-text">Update Profile</h3>
        <form action="/update" method="post" enctype="multipart/form-data" class="centering">
            {{csrf_field()}}
            <table>
                <tr>
                    <td>
                        <b>Name </b>
                       
                    </td>
                    <td>
                        :<input type="text" class="decorative-input margin-up-down-10" name="name" value={{$user->name}}>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Username</b> 
                    </td>
                    <td>
                        :<input type="text" class="decorative-input margin-up-down-10" name="username" value={{$user->username}}>
                        
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <b>Email</b> 
                    </td>
                    <td>
                        :<input type="text" class="decorative-input margin-up-down-10" name="email" value={{$user->email}}>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> Profile image</b> <br>
                        @if($user->profile_image != 'none')
                        <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                        @else
                        <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle" style="width:75px " alt="">
                        @endif
                    </td>
                    <td>

                        <input type="file" class="decorative-input margin-up-down-10" name="profile_image">    
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4> Change Password</h4>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <b>Old password</b>
                    </td>
                    <td>
                        :<input type="password" class="decorative-input margin-up-down-10" name="old_password" >
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Password</b>
                    </td>
                    <td>
                        :<input type="password" class="decorative-input margin-up-down-10" name="password">
                    </td>
                    
                </tr>
    
                
            </table>
            <input type="submit" class="primary-color-btn">
        </form>
    </div>
    <br><br><br>
</div>
@endsection