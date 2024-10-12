<!-- resources/views/layouts/partials/admin-sidebar.blade.php -->
{{--<aside>--}}
{{--    <ul>--}}
{{--        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>--}}
{{--        <li><a href="{{ route('analytics', ['shortCode' => 'example']) }}">Analytics</a></li>--}}
{{--        <li>--}}

{{--            <form action="{{ route('logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit">Logout</button>--}}
{{--            </form>--}}

{{--        </li>--}}
{{--    </ul>--}}
{{--</aside>--}}

<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="assets/img/profile.jpeg">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    @if(Auth::check())
                                <span>
									{{ Auth::user()->name }}
									<span class="user-level">{{ Auth::user()->email }}</span>
									<span class="caret"></span>
								</span>
                     @endif
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                    <ul class="nav">
                        <li>
                            <a href="#settings">
                                <span class="link-collapse">
                                    <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; padding: 0;">Logout</button>
                                   </form>
                                </span>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
{{--        <ul class="nav">--}}
{{--            <li class="nav-item active">--}}
{{--                <a href="index.html">--}}
{{--                    <i class="la la-dashboard"></i>--}}
{{--                    <p> Dashboard </p>--}}
{{--                    <span class="badge badge-count">5</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
    </div>
</div>
