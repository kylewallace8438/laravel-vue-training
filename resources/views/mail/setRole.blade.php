<h4>Your permissions have been updated</h4>
<h5>Your permissions : </h5>
@foreach ($roles as $role)
    @php
        $type =  explode('-', $role);
    @endphp
        <li>
            {{$type[0]}} with action : {{$type[1]}}
        </li>
@endforeach