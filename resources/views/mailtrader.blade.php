<table>
    <tr>
        <td>Hello {{$user}}</td>
    </tr>
    <tr>
        <td><a href="{{url('/verification/')}}/{{$random}}"> Click here</a> to verify your email id.</td>
    </tr>
    <tr>
        <td>Your apex login in Id is as following:</td>
    </tr>
    <tr>
        @php 
            $uname = strtolower(strtok($user," "));
        @endphp
        <td>Username: {{$uname}} <br> Password: {{$password}}</td>
    </tr>
</table>