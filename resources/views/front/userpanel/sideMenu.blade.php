<div class="shadow_box d-none d-lg-block">
    <ul class="list-group list-group-flush">
        <li class="list-group-item {{ request()->routeIs('messages') ? 'active' : '' }}">
            <a href="{{route('messages')}}">
            {{__('Messages')}}
            </a>
        </li>
        <li class="list-group-item {{ request()->routeIs('showprofileform') ? 'active' : '' }}">
            <a href="{{route('showprofileform')}}">
                {{__('Profile info')}}
            </a>
        </li>
        <li class="list-group-item {{ request()->routeIs('showsavedads') ? 'active' : '' }}">
            <a href="{{route('showsavedads')}}">
                {{__('Saved ads')}}
            </a>
        </li>
        <li class="list-group-item {{ request()->routeIs('show_logindetails_form') ? 'active' : '' }}">
            <a href="{{route('show_logindetails_form')}}">
                {{__('Password settings')}}
            </a>
        </li>
        <li class="list-group-item {{ request()->routeIs('userpanel_contactus') ? 'active' : '' }}">
            <a href="{{route('userpanel_contactus')}}">
                {{__('Contact Us')}}
            </a>
        </li>
        <li class="list-group-item">
            {{-- <a data-bs-target="#subscriptionHistory" data-bs-toggle="modal" href="javascript:void(0);"> --}}
                <a href="{{route('show_subscription_history')}}">
                {{__('Subsctiption')}}
            </a>
        </li>
    </ul>
</div>


