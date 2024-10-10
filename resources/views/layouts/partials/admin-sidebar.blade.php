<!-- resources/views/layouts/partials/admin-sidebar.blade.php -->
<aside>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
{{--        <li><a href="{{ route('analytics', ['shortCode' => 'example']) }}">Analytics</a></li>--}}
        <li>
{{--            <a href="{{ route('logout') }}">Logout</a>--}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>

        </li>
    </ul>
</aside>
