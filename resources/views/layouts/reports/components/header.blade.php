  <!-- header -->
  <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        @foreach($data["parties"]["party"] as $menu)
                        @if (str_contains($menu['type'], 'ancre'))
                        <li>
                            <a href="#{{$menu['content']['title']}}">
                                <span id="menu_title"> {{$menu["content"]["title"]}} </span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>

  <header>
      <span class="navbar-brand ">
          <img src="../../assets/brand/umc_logo.png">
      </span>
      <button id="menu-toggle" class="toggle-nav pull-left" aria-label="Open side menu">
          <div>
              <span></span>
              <span></span>
              <span></span>
          </div>
      </button>

      <ul class="nav" style="display: flex;margin: 0 0 0 auto;align-items: center">
          <li class="pdf-icon">
              <i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"><a id="pdfExport" href="" target=""></a></i>
          </li>
          <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                  <img class=" img-responsive" width="23" height="23" src="/images/assessment/avatar-woman.png"
                      alt="{{$data['general']['participant_name']}}">
                  <span class="user-name" style="color: #14191A;">{{$data['general']['participant_name']}}</span>
              </a>
              <ul class="dropdown-menu">
              </ul>
          </li>
      </ul>
  </header>
  <!-- /header -->
