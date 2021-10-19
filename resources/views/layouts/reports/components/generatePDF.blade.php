@extends('layouts.report')
<!-- logo -->
<div class="row">

    @php $item = "test"; @endphp
    @php $before_type = 'ancre' @endphp

    {{-- Indicator --}}
    <h2 class="card-title">lkjlkjl
    </h2>

    <div class="col-md-12" id=''>
        <div class="card">
            <div class="card-header .bg-secondary">
                {{ $item }}
            </div>
            <div class="card-body">
                <div class="col-xs-12 col-sm-3">
                    <h3 class="box-label">

                    </h3>
                    <div class="box-score" style="color:#000000; background-color: #1C3664">
                        <div class="header" style="color: #fff;">
                            {{ __('Quotient') }} <br>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="box-desc">
                    <div class="box-content ec-first-border-color" style="background-color: #EEEEEE">
                        dsfsdfdsfs

                    </div>
                </div>
                <br>
                <img src="./assets/img/emotion/us.clocheQE01.jpg" alt="" height="425" width="519" />
                {{-- {!!$item[3]['content']['introduction']!!} --}}
            </div>
        </div>
    </div>
</div>
