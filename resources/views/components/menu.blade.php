<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #131432">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link" style="background: #131432">
        <img src="{{ URL::asset('dist/img/ceit.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CEIT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    Meng Moua
                </a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2 d-flex flex-column justify-content-between" style="height:94%">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('home') }}"
                        class="nav-link {{ request()->routeIs('home') ? 'bg-secondary' : '' }}">
                        <i class="nav-icon bi bi-house"></i>
                        <p>ໜ້າທໍາອິດ</p>
                    </a>
                </li>
                @if (auth()->check())
                    @if (auth()->user()->user_type === 'teacher')
                        <li class="nav-item ">
                            <a href="{{ route('show-thesis') }}"
                                class="nav-link {{ request()->routeIs('show-thesis') ? 'bg-secondary' : '' }}">
                                <i class="bi bi-journal-check"></i>
                                <p>
                                    ອະນຸຍາດການສົ່ງປື້ມ
                                </p>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                    <a href="{{ route('comment', auth()->user()->id) }}"
                        class="nav-link {{ request()->routeIs('comment') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-chat-square-text"></i>
                        <p>ຄໍາເຫັນກຸ່ມປ້ອງກັນບົດ</p>
                    </a>
                </li>
                @if (auth()->check())
                    @if (auth()->user()->position === 'ຫົວໜ້າພາກວິຊາ')
                        <li class="nav-item">
                            <a href="{{ route('request') }}" class="nav-link {{ request()->routeIs('#') ? 'bg-secondary' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ຄໍາຂໍອາຈານທີ່ປຶກສາ</p>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item ">
                    <a href="{{ route('plan') }}"
                        class="nav-link {{ request()->routeIs('plan') ? 'bg-secondary' : '' }}">
                        <i class="bi bi-bookmark-check"></i>
                        <p>
                            ແຜນການຕ່າງໆ
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('defense') }}"
                        class="nav-link {{ request()->routeIs('defense') ? 'bg-secondary' : '' }}">
                        <i class="nav-icon bi bi-book"></i>
                        <p>
                            ຜົນການສອບບົດຈົບຊັ້ນ
                        </p>
                    </a>
                </li>
                {{-- @if (auth()->check())
                    @if (auth()->user()->user_type === 'teacher')
                        <li class="nav-item">
                            <a href="{{ route('scores') }}"
                                class="nav-link {{ request()->routeIs('scores') ? 'bg-secondary' : '' }}">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    ຄະແນນສອບບົດຈົບຊັ້ນ
                                </p>
                            </a>
                        </li>
                    @endif
                @endif --}}

                @if (auth()->check())
                    @if (auth()->user()->user_type === 'teacher')
                        <li class="nav-item ">
                            <a href="{{ route('thesis') }}"
                                class="nav-link {{ request()->routeIs('thesis') ? 'bg-secondary' : '' }}">
                                <i class="bi bi-journal-check"></i>
                                <p>
                                    ປື້ມບົດຈົບຊັ້ນ
                                </p>
                            </a>
                        </li>
                    @endif
                @endif
                @if (auth()->check())
                    @if (auth()->user()->user_type === 'teacher')
                        <li class="nav-item">
                            <a href="/accept" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    ຍອມຮັບການແກ້ໄຂ້
                                </p>
                            </a>
                        </li>
                    @endif
                @endif


                <li class="nav-item">
                    <a href="{{ route('advisor') }}"
                        class="nav-link {{ request()->routeIs('advisor') ? 'bg-secondary' : '' }}">
                        <i class="nav-icon bi bi-person"></i>
                        <p>
                            ອາຈານທີ່ປຶກສາ
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('group') }}"
                        class="nav-link {{ request()->routeIs('group') ? 'bg-secondary' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            ກຸ່ມທັງໝົດ
                        </p>
                    </a>
                </li>
            </ul>

            @auth
                <button type="button" class="btn btn-block btn-flat text-light d-flex justify-content-center">
                    {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                    </a> --}}
                    <div class="d-flex align-items-center">
                        <i class="bi bi-box-arrow-left"></i>
                        <a class="nav-link" href="{{ route('login') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </button>
            @endauth
        </nav>

        <!-- /.sidebar -->
</aside>

@section('page-script')
    <script>
        // $(document).ready(function() {
        //     $('.nav-item').on('click', function() {
        //         // Remove 'menu-open' class from all nav items
        //         $('.nav-item').removeClass('menu-open');

        //         // Add 'menu-open' class to the clicked nav item
        //         $(this).addClass('menu-open');
        //     });
        // });
    </script>
@endsection
