  <!-- header -->
  <nav id="sidebar" class="sidebar-wrapper printable">
      <div class="sidebar-content">
          <!-- sidebar-search  -->
          <div class="sidebar-menu">
              <ul>
                  @foreach($data["parties"]["party"] as $menu)
                  @if (str_contains($menu['type'], 'ancre'))
                  <li>
                      <a href="#{{$menu['content']['title']}}">
                          <span id="menu_title"> {!! __($menu["content"]["title"]) !!} </span>
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
              <button id="pdfExport" href="{{ URL::to('/report/pdf') }}" target="_blank"><i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></button>
          </li>
          <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                  <img class="bg-dark img-responsive mr-2" width="23" height="23" 
                    @if($data['general']['title_id'] == 1) src="{{ asset('/assets/img/avatar-man.png') }}"  
                    @else src="{{ asset('/assets/img/avatar-woman.png') }}"  
                    @endif alt="{{$data['general']['participant_name']}}">
                  <span class="user-name" style="color: #14191A;">{!!$data['general']['participant_name']!!}</span>
              </a>              
          </li>
      </ul>
  </header>
  <!-- /header -->

  <div class="top-header">
      <p>Карьер хөгжлийн төв - <strong>{!!$data['general']['participant_name']!!}</strong></p>
  </div>
