<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{ asset('assets/brand/logo.png') }}" height="auto"
        alt="CoreUI Logo">
    <img class="c-sidebar-brand-minimized" src="assets/brand/coreui-signet-white.svg" width="118" height="46"
        alt="CoreUI Logo">
</div>

<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="/">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-speedometer') }}"></use>
            </svg> Хянах самбар
        </a>
    </li>
    <li class="c-sidebar-nav-title">Үндсэн</li>

    @role('super-admin|admin')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-settings') }}"></use>
            </svg> Тохиргоо</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('users.index') }} ">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-user') }}"></use>
                </svg> Систем хэрэглэгчид</a>
            </li>

            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('role.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-people') }}"></use>
                </svg> Роль </a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('permission.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-lock-unlocked') }}"></use>
                </svg> Зөвшөөрөл</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('group.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-people') }}"></use>
                </svg> Бүлэг</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-bell') }}"></use>
                </svg> Сонордуулга</a>
            </li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('icons/sprites/free.svg#cil-applications') }}"></use>
                </svg> Бусад</a>
            </li>


        </ul>
    </li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" >
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-user') }}"></use>
            </svg>Оролцогчид</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('candidate.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Жагсаалт
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('candidate.group') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Групп
                </a>
            </li>

        </ul>
    </li>


    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{ asset('icons/sprites/free.svg#cil-description') }}"></use>
        </svg> Тест</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('testapi.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Жагсаалт
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('assessment.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Үнэлгээ
                </a>
            </li>
        </ul>
    </li>

    @endrole

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link" href="{{ route('translations.index') }}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{ asset('icons/sprites/free.svg#cil-description') }}"></use>
        </svg> Орчуулга</a>
    </li>

    @hasanyrole('writer|admin')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{ asset('icons/sprites/free.svg#cil-description') }}"></use>
        </svg> Тест</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('test.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Жагсаалт
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('test.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-spreadsheet') }}"></use>
                    </svg> Үр дүн
                </a>
            </li>
        </ul>
    </li>

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-people') }}"></use>
            </svg> Харилцагчид</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('candidate.index') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-list') }}"></use>
                    </svg> Жагсаалт
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('candidate.group') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-spreadsheet') }}"></use>
                    </svg> Группd
                </a>
            </li>
        </ul>
    </li>

    <!-- <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-grain"></use>
            </svg> Үр дүн нийцүүлэх</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('participants') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-list"></use>
                    </svg> Үр дүн менежмент
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('test') }} ">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-archive"></use>
                    </svg> Архив
                </a>
            </li>
        </ul>
    </li> -->
    @endhasanyrole
    <li class="c-sidebar-nav-title">Нэмэлт</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle"
            href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('icons/sprites/free.svg#cil-star') }}"></use>
            </svg> Тусламж</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="login.html" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('icons/sprites/free.svg#cil-account-logout') }}"></use>
                    </svg> Мэдээлэл</a></li>
        </ul>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized"></button>

</div>
