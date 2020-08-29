    <div class="c-subheader px-3">
      <ol class="breadcrumb border-0 m-0">
          <li class="breadcrumb-item"><a href="/">Нүүр</a></li>
          <?php $segments = ''; ?>
        
          @for($i = 1; $i <= count(Request::segments()); $i++) <?php $segments .= '/'. getBreadcrumb(Request::segment($i)); ?>
              @if($i < count(Request::segments())) <li class="breadcrumb-item">{{ getBreadcrumb(Request::segment($i)) }}</li>
              @else
              <li class="breadcrumb-item active">{{ getBreadcrumb(Request::segment($i)) }}</li>
              @endif
              @endfor            
      </ol>
  </div>