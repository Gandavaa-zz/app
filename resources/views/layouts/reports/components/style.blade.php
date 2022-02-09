<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

    @keyframes swing {
        0% {
            transform: rotate(0deg);
        }

        10% {
            transform: rotate(10deg);
        }

        30% {
            transform: rotate(0deg);
        }

        40% {
            transform: rotate(-10deg);
        }

        50% {
            transform: rotate(0deg);
        }

        60% {
            transform: rotate(5deg);
        }

        70% {
            transform: rotate(0deg);
        }

        80% {
            transform: rotate(-5deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    @keyframes sonar {
        0% {
            transform: scale(0.9);
            opacity: 1;
        }

        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    @media print {
        * {
            font-family: DejaVu Sans;
            font-size: 12px;
        }


    }

    body {
        font-family: "Open Sans", "Arial", sans-serif;
        font-size: 14px;
        line-height: 20px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-wrapper .sidebar-wrapper,
    .sidebar-wrapper .sidebar-brand>a,
    .sidebar-wrapper .sidebar-dropdown>a:after,
    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before,
    .sidebar-wrapper ul li a i,
    .page-wrapper .page-content,
    .sidebar-wrapper .sidebar-search input.search-menu,
    .sidebar-wrapper .sidebar-search .input-group-text,
    .sidebar-wrapper .sidebar-menu ul li a,
    #show-sidebar,
    #close-sidebar {
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    /*----------------page-wrapper----------------*/

    .page-wrapper {
        height: 100vh;
    }

    .page-wrapper .theme {
        width: 40px;
        height: 40px;
        display: inline-block;
        border-radius: 4px;
        margin: 2px;
    }

    .page-wrapper .theme.chiller-theme {
        background: #1e2229;
    }

    /*----------------toggeled sidebar----------------*/

    .page-wrapper.toggled .sidebar-wrapper {
        left: 0px;
        margin-top: 70px;
    }

    @media screen and (min-width: 768px) {
        .page-wrapper.toggled .page-content {
            padding-left: 280px;
        }
    }

    /*----------------show sidebar button----------------*/

    #show-sidebar {
        position: fixed;
        left: 0;
        top: 10px;
        border-radius: 0 4px 4px 0px;
        width: 35px;
        transition-delay: 0.3s;
    }

    .page-wrapper.toggled #show-sidebar {
        left: -40px;
    }

    /*----------------sidebar-wrapper----------------*/

    .sidebar-wrapper {
        width: 260px;
        height: 100%;
        max-height: 100%;
        position: fixed;
        top: 0;
        left: -300px;
        z-index: 999;
    }

    #menu_title {
        position: relative;
        left: -17px;
    }

    .sidebar-wrapper ul {
        padding-left: 30px;
        list-style-type: decimal;
        margin: 0;
        text-transform: uppercase;
        font-size: 1.1em;
        /* color: white; */
        line-height: 2;
    }

    .sidebar-wrapper ul li a:hover {
        margin-left: 7px;
        transition: transform 0.1 ease;
        color: black;
    }

    .sidebar-wrapper a {
        text-decoration: none;
    }

    /*----------------sidebar-content----------------*/

    .sidebar-content {
        max-height: calc(100% - 30px);
        height: calc(100% - 30px);
        overflow-y: auto;
        box-shadow: 0 4px 10px rgb(0 0 0 / 15%);
        position: relative;
    }

    .sidebar-content.desktop {
        overflow-y: hidden;
    }

    /*--------------------sidebar-brand----------------------*/

    .sidebar-wrapper .sidebar-brand {
        padding: 10px 20px;
        display: flex;
        align-items: center;
    }

    .sidebar-wrapper .sidebar-brand>a {
        text-transform: uppercase;
        font-weight: bold;
        flex-grow: 1;
    }

    .sidebar-wrapper .sidebar-brand #close-sidebar {
        cursor: pointer;
        font-size: 20px;
    }

    /*--------------------sidebar-header----------------------*/

    .sidebar-wrapper .sidebar-header {
        padding: 20px;
        overflow: hidden;
    }

    .sidebar-wrapper .sidebar-header .user-pic {
        float: left;
        width: 60px;
        padding: 2px;
        border-radius: 12px;
        margin-right: 15px;
        overflow: hidden;
    }

    .sidebar-wrapper .sidebar-header .user-pic img {
        object-fit: cover;
        /* height: 100%; */
        width: 100%;
    }

    .sidebar-wrapper .sidebar-header .user-info {
        float: left;
    }

    .sidebar-wrapper .sidebar-header .user-info>span {
        display: block;
        padding-top: 20px;
    }

    .sidebar-wrapper .sidebar-header .user-info .user-role {
        font-size: 12px;
    }

    .sidebar-wrapper .sidebar-header .user-info .user-status {
        font-size: 11px;
        margin-top: 4px;
    }

    .sidebar-wrapper .sidebar-header .user-info .user-status i {
        font-size: 8px;
        margin-right: 4px;
        color: #5cb85c;
    }

    /*-----------------------sidebar-search------------------------*/

    .sidebar-wrapper .sidebar-search>div {
        padding: 10px 20px;
    }

    /*----------------------sidebar-menu-------------------------*/

    .sidebar-wrapper .sidebar-menu {
        padding-bottom: 10px;
    }

    .sidebar-wrapper .sidebar-menu .header-menu span {
        font-weight: bold;
        font-size: 14px;
        padding: 15px 20px 5px 20px;
        display: inline-block;
    }

    .sidebar-wrapper .sidebar-menu ul li a {
        display: block;
        width: 100%;
        text-decoration: none;
        position: relative;
        padding: 8px 30px 8px 20px;
    }

    .sidebar-wrapper .sidebar-menu ul li a i {
        margin-right: 10px;
        font-size: 12px;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 4px;
    }

    .sidebar-wrapper .sidebar-menu ul li a:hover>i::before {
        display: inline-block;
        animation: swing ease-in-out 0.5s 1 alternate;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown>a:after {
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        content: "\f105";
        font-style: normal;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        background: 0 0;
        position: absolute;
        right: 15px;
        top: 14px;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu ul {
        padding: 5px 0;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li {
        padding-left: 25px;
        font-size: 13px;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a:before {
        content: "\f111";
        font-family: "Font Awesome 5 Free";
        font-weight: 400;
        font-style: normal;
        display: inline-block;
        text-align: center;
        text-decoration: none;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        margin-right: 10px;
        font-size: 8px;
    }

    .sidebar-wrapper .sidebar-menu ul li a span.label,
    .sidebar-wrapper .sidebar-menu ul li a span.badge {
        float: right;
        margin-top: 8px;
        margin-left: 5px;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .badge,
    .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li a .label {
        float: right;
        margin-top: 0px;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-submenu {
        display: none;
    }

    .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active>a:after {
        transform: rotate(90deg);
        right: 17px;
    }

    .badge-sonar {
        display: inline-block;
        background: #980303;
        border-radius: 50%;
        height: 8px;
        width: 8px;
        position: absolute;
        top: 0;
    }

    .badge-sonar:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        border: 2px solid #980303;
        opacity: 0;
        border-radius: 50%;
        width: 100%;
        height: 100%;
        animation: sonar 1.5s infinite;
    }

    /*--------------------------page-content-----------------------------*/

    .page-wrapper .page-content {
        display: inline-block;
        width: 100%;
        padding-left: 0px;
        padding-top: 20px;
    }

    .page-wrapper .page-content>div {
        padding: 10px;
        margin-top: 70px;
    }

    .page-wrapper .page-content {
        overflow-x: hidden;
    }

    /*------scroll bar---------------------*/

    ::-webkit-scrollbar {
        width: 5px;
        height: 7px;
    }

    ::-webkit-scrollbar-button {
        width: 0px;
        height: 0px;
    }

    ::-webkit-scrollbar-thumb {
        background: #525965;
        border: 0px none #ffffff;
        border-radius: 0px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #525965;
    }

    ::-webkit-scrollbar-thumb:active {
        background: #525965;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
        border: 0px none #ffffff;
        border-radius: 50px;
    }

    ::-webkit-scrollbar-track:hover {
        background: transparent;
    }

    ::-webkit-scrollbar-track:active {
        background: transparent;
    }

    ::-webkit-scrollbar-corner {
        background: transparent;
    }

    /*-----------------------------chiller-theme-------------------------------------------------*/

    .sidebar-header {
        border-top: 1px solid #3a3f48;
    }

    .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
    .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
        border-color: transparent;
        box-shadow: none;
    }

    .chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-role,
    .chiller-theme .sidebar-wrapper .sidebar-header .user-info .user-status,
    .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
    .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text,
    .chiller-theme .sidebar-wrapper .sidebar-brand>a,
    .chiller-theme .sidebar-wrapper .sidebar-menu ul li a,
    .chiller-theme .sidebar-footer>a {
        color: #373737;
    }

    .page-wrapper.chiller-theme.toggled #close-sidebar {
        color: #bdbdbd;
    }

    .page-wrapper.chiller-theme.toggled #close-sidebar:hover {
        color: #ffffff;
    }

    .chiller-theme .sidebar-wrapper ul li:hover a i,
    .chiller-theme .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
    .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu:focus+span,
    .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown.active a i {
        color: #16c7ff;
        text-shadow: 0px 0px 10px rgba(22, 199, 255, 0.5);
    }

    .chiller-theme .sidebar-wrapper .sidebar-menu ul li a i,
    .chiller-theme .sidebar-wrapper .sidebar-menu .sidebar-dropdown div,
    .chiller-theme .sidebar-wrapper .sidebar-search input.search-menu,
    .chiller-theme .sidebar-wrapper .sidebar-search .input-group-text {
        background: #3a3f48;
    }

    .chiller-theme .sidebar-wrapper .sidebar-menu .header-menu span {
        color: #6c7b88;
        margin-left: -40px;
        font-size: 1em;
    }

    .chiller-theme .sidebar-footer>a:first-child {
        border-left: none;
    }

    .chiller-theme .sidebar-footer>a:last-child {
        border-right: none;
    }

    .footer {
        right: 0;
        bottom: 0;
        left: 0;
        margin-top: auto;
        right: 0;
        padding: 1rem;
        /* position: fixed; */
        color: white;
        background-color: #14191A;
    }

    h1,
    h2,
    h3,
    h4 {
        font-family: "Poppins", "Arial", sans-serif;
    }

    h3 {
        font-size: 19px;
    }

    .card-title {
        color: #1C3664;
        padding-left: 20px;
        font-size: 28px;
    }

    .lightgrey {
        background-color: lightgrey;
    }

    .card {
        box-shadow: rgba(4, 9, 20, 0.03) 0px 0.46875rem 2.1875rem, rgba(4, 9, 20, 0.03) 0px 0.9375rem 1.40625rem, rgba(4, 9, 20, 0.05) 0px 0.25rem 0.53125rem, rgba(4, 9, 20, 0.03) 0px 0.125rem 0.1875rem;
        border-width: 0px;
        border-radius: 0.25rem !important;
        border: none;
        margin-top: 15px;
        margin-bottom: 30px;
    }

    .card-body {
        padding-left: 30px;
    }

    .card-header {
        border: none;
        background-color: lightgrey;
        font-size: 21px;
        font-weight: 200;
        line-height: 30px;
    }

    .box {
        min-width: 100%;
        border-width: 0;
        border-radius: .25rem !important;
        margin-top: 15px;
        box-shadow: 0 0.46875rem 2.1875rem rgb(4 9 20 / 3%), 0 0.9375rem 1.40625rem rgb(4 9 20 / 3%), 0 0.25rem 0.53125rem rgb(4 9 20 / 5%), 0 0.125rem 0.1875rem rgb(4 9 20 / 3%);
    }

    .box-content {
        padding: 10px;
        background-color: #fff;
    }

    .ec-title {
        margin-top: 10px;
        padding: 5px;
        font-size: 22px;
        word-wrap: break-word;
        color: #1C3664;
    }

    .group-list {
        margin-top: 13px;
    }

    .factor>h3 {
        font-size: 19px;
        color: #222222;
    }

    .factor span {
        font-size: 13.7px;
        color: #222222;
    }

    .f-title {
        font-size: 19px;
        /* background-color: #C9E6AE; */
        font-weight: bold;
    }

    .title {
        text-align: center;
    }

    .score-bar-wrapper {
        display: flex;
        align-items: center;
    }

    .score-bar {
        width: 100% !important;
        height: 30px;
        padding: 5px;
        margin-top: 10px;
        border: 1px solid #ccc;
    }

    .progress {
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        background-image: none;
        background-color: #cccccc;
        filter: none;
    }

    .box-score {
        margin-bottom: 10px;
        text-align: center;
    }

    .box-score .header {
        padding: 10px;
        font-weight: bold;
    }

    .box-label {
        margin-top: 10px;
        padding: 5px;
        font-size: 22px;
        word-wrap: break-word;
        margin-left: -12;
        color: #1C3664;
    }

    .box .box-header.box-header-small {
        font-size: 14px;
        font-weight: 200;
        line-height: 19px;
        padding: 10px 10px;
    }

    .box .box-content,
    .box-content,
    .box-tool,
    .box-tool-bottom {
        border-width: 0;
        border-radius: .25rem !important;
        box-shadow: 0 0.46875rem 2.1875rem rgb(4 9 20 / 3%), 0 0.9375rem 1.40625rem rgb(4 9 20 / 3%), 0 0.25rem 0.53125rem rgb(4 9 20 / 5%), 0 0.125rem 0.1875rem rgb(4 9 20 / 3%);
    }

    .box-desc {
        padding: 10px;
        margin-top: -10px;
    }

    .b-table td {
        padding: 0.1rem !important;
        vertical-align: top !important;
        border: none !important;
    }

    .b-table {
        margin-top: 25px;
    }

    .left-p {
        position: relative;
        left: 30;
        width: 8%;
    }

    #table_header {
        padding: 20px;
    }

    #table_header>h3 {
        color: #1C3664;
        font-size: 24.5px;
        font-weight: 400;
        margin-bottom: -20px;
    }

    .b-table td:hover {
        cursor: pointer !important;
    }

    .hiddenRow {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-right: 20px;
        margin-left: 20px;
    }

    .t-right {
        position: absolute;
        right: 35;
    }

    .progress-bar {
        width: 1.5%;
        max-width: 94% !important;
        color: #000000;
        background-color: #1C3664;
        /* height: 20px!important; */
    }

    .legend-match {
        border: 1px solid;
        margin-bottom: 10px;
        width: 90%;
        margin-left: 5%;
    }

    .legend-match .color {
        width: 30px;
        height: 20px;
        border: 1px solid black;
        display: inline-block;
        vertical-align: middle;
    }

    .legends {
        margin-top: 20px;
        margin-left: 270px;
    }

    .bordered {
        margin-top: 20px;
        border: 1px solid black;
        background-color: lightgray;
    }

    .column {
        border-right: 1px solid black;
        /* border-left: 1px solid black; */
        border-top: 1px solid black;
    }

    .columns {
        background-color: white;
    }

    .p-title {
        border-bottom: 1px solid lightgrey;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .progress {
        width: 80%;
        float: left;
    }

    .percentage {
        float: right;
        text-align: center;
        margin-top: -4px;
    }

    .factor-score {
        background-color: #EEEEEE;
        vertical-align: middle;
        width: 3%
    }

    .factor-score-grey {
        background-color: #D3D3D3;
        vertical-align: middle;
        width: 3%
    }

    .img-calibration .gausse {
        margin: 0 auto;
        background: url(/assets/img/bg-gausse-web.png) no-repeat;
        background-size: 100%;
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-position: 0 0;
        width: 500px;
        height: 169px;
        direction: initial !important;
    }

    .img-calibration .pointer-gausse {
        position: relative;
        background: url(/assets/img/pointer-gausse-web.png) no-repeat;
        background-size: 100%;
        background-position: 0 bottom;
        background-repeat: no-repeat;
        width: 15px;
        height: 169px;
        top: 0;
    }

    .score-bar {
        position: relative;
    }

    #percent_end {
        content: 100;
        position: absolute;
        right: 10;
        color: #343a40;
        font-weight: bold;
    }

    #percent_start {
        left: 0;
        width: 14px;
        font-weight: bold;
        color: #343a40;
    }

    #pdf_export {
        position: absolute;
        right: 10px;
        top: 20;
    }

    .bg-grey {
        background-color: #ececec;
    }

    header {
        position: fixed;
        width: 100.5%;
        height: 70px;
        padding: 0;
        display: flex;
        float: right;
        background-color: white;
        z-index: 1;
        border-bottom: 1px solid #eee;
        box-shadow: 2px 0px 4px rgb(51 51 51);
    }

    header #menu-toggle {
        width: 80px;
        /* height: 69px; */
        background: white;
        border: none;
        outline: none;
        cursor: pointer;
        box-shadow: none;
    }

    header #menu-toggle div span {
        width: 22px;
        height: 4px;
        border-radius: 10px;
        background-color: #6134C4;
        margin-top: 3px;
    }

    #menu-toggle {
        -webkit-transition: all 0.15s ease-in-out;
        transition: all 0.15s ease-in-out;
    }

    header #menu-toggle div span:nth-child(2) {
        -webkit-transform: translateX(-5px);
        transform: translateX(-5px);
    }

    header #menu-toggle div:hover span {
        width: 27px;
        -webkit-transform: translateX(0);
        transform: translateX(0);
        transition: all 0.15s ease-in-out;
    }

    header #menu-toggle div:hover span {
        width: 27px;
        /* -webkit-transform: translateX(0); */
        /* transform: translateX(0); */
    }

    header #menu-toggle div {
        height: 100%;
        padding: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        /* -webkit-box-align: center; */
        -ms-flex-align: center;
        align-items: center;
        /* -webkit-box-pack: center; */
        -ms-flex-pack: center;
        justify-content: center;
    }

    .fa-file-pdf-o:before {
        content: "\f1c1";
        color: #6134C4;
        font-size: 36px;
    }

    .pdf-icon {
        left: -30px;
        position: relative;
    }

    a:hover {
        text-decoration: none;
    }

    header .dropdown-toggle {
        padding: 0 15px;
    }

    .user-name {
        font-weight: bold;
    }

    .group-header {
        margin-top: 10px;
        padding: 5px;
        font-size: 22px;
        color: #1C3664;
        word-wrap: break-word;
    }

    .factor-header {
        text-align: center;
    }

    .remove-md-print p:hover {
        cursor: pointer;
    }

    .synthetic-card-combination-box {
        text-transform: uppercase;
        width: 60px;
        height: 60px;
        font-size: 60px;
        padding-top: 20px;
        font-weight: bold;
        display: inline-block;
        text-align: center;
    }

    .synthetic-card-targets-list {
        line-height: 2em;
        margin-top: 20px;
        padding-left: 0px;
        padding-right: 0px;
        margin-bottom: 20px;
    }

    .synthetic-card-part {
        margin-top: 15px;
    }

    .align-left {
        text-align: left;
    }

    .align-center {
        text-align: center;
    }

    .synthetic-card .target-score {
        display: inline-block;
        width: 90px;
    }

    .synthetic-card-target {
        margin-bottom: 5px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .font-large {
        font-size: large;
    }

    .desc {
        margin-top: 50px;
    }

    .star-rating {
        padding-right: 20px;
    }

    .col-1,
    .col-2,
    .col-3,
    .col-4,
    .col-5,
    .col-6,
    .col-7,
    .col-8,
    .col-9,
    .col-10,
    .col-11,
    .col-12,
    .col,
    .col-auto,
    .col-sm-1,
    .col-sm-2,
    .col-sm-3,
    .col-sm-4,
    .col-sm-5,
    .col-sm-6,
    .col-sm-7,
    .col-sm-8,
    .col-sm-9,
    .col-sm-10,
    .col-sm-11,
    .col-sm-12,
    .col-sm,
    .col-sm-auto,
    .col-md-1,
    .col-md-2,
    .col-md-3,
    .col-md-4,
    .col-md-5,
    .col-md-6,
    .col-md-7,
    .col-md-8,
    .col-md-9,
    .col-md-10,
    .col-md-11,
    .col-md-12,
    .col-md,
    .col-md-auto,
    .col-lg-1,
    .col-lg-2,
    .col-lg-3,
    .col-lg-4,
    .col-lg-5,
    .col-lg-6,
    .col-lg-7,
    .col-lg-8,
    .col-lg-9,
    .col-lg-10,
    .col-lg-11,
    .col-lg-12,
    .col-lg,
    .col-lg-auto,
    .col-xl-1,
    .col-xl-2,
    .col-xl-3,
    .col-xl-4,
    .col-xl-5,
    .col-xl-6,
    .col-xl-7,
    .col-xl-8,
    .col-xl-9,
    .col-xl-10,
    .col-xl-11,
    .col-xl-12,
    .col-xl,
    .col-xl-auto {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }

    .col-auto {
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        width: auto;
        max-width: none;
    }

    .col-1 {
        -ms-flex: 0 0 8.333333%;
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }

    .col-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }

    .col-3 {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .col-5 {
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }

    .col-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-7 {
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
    }

    .col-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }

    .col-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
    }

    .col-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }

    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 576px) {
        .container {
            max-width: 540px;
        }
    }

    @media (min-width: 768px) {
        .container {
            max-width: 720px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 960px;
        }
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1140px;
        }
    }

    .container-fluid {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    .progress {
        display: -ms-flexbox;
        display: flex;
        height: 1rem;
        overflow: hidden;
        font-size: 0.75rem;
        background-color: #e9ecef;
        border-radius: 0.25rem;
    }

    .progress-bar {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        background-color: #007bff;
        transition: width 0.6s ease;
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .progress-bar {
            transition: none;
        }
    }

    .progress-bar-striped {
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-size: 1rem 1rem;
    }

    .progress-bar-animated {
        -webkit-animation: progress-bar-stripes 1s linear infinite;
        animation: progress-bar-stripes 1s linear infinite;
    }

    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    article,
    aside,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    main,
    nav,
    section {
        display: block;
    }

    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    .card>hr {
        margin-right: 0;
        margin-left: 0;
    }

    .card>.list-group:first-child .list-group-item:first-child {
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .card>.list-group:last-child .list-group-item:last-child {
        border-bottom-right-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .card-title {
        margin-bottom: 0.75rem;
    }

    .card-subtitle {
        margin-top: -0.375rem;
        margin-bottom: 0;
    }

    .card-text:last-child {
        margin-bottom: 0;
    }

    .card-link:hover {
        text-decoration: none;
    }

    .card-link+.card-link {
        margin-left: 1.25rem;
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, 0.03);
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-header:first-child {
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
    }

    .card-header+.list-group .list-group-item:first-child {
        border-top: 0;
    }

    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: rgba(0, 0, 0, 0.03);
        border-top: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card-footer:last-child {
        border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
    }

    .card-header-tabs {
        margin-right: -0.625rem;
        margin-bottom: -0.75rem;
        margin-left: -0.625rem;
        border-bottom: 0;
    }

    .card-header-pills {
        margin-right: -0.625rem;
        margin-left: -0.625rem;
    }

    .card-img-overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1.25rem;
    }

    .card-img {
        width: 100%;
        border-radius: calc(0.25rem - 1px);
    }

    .card-img-top {
        width: 100%;
        border-top-left-radius: calc(0.25rem - 1px);
        border-top-right-radius: calc(0.25rem - 1px);
    }

    .card-img-bottom {
        width: 100%;
        border-bottom-right-radius: calc(0.25rem - 1px);
        border-bottom-left-radius: calc(0.25rem - 1px);
    }

    .card-deck {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .card-deck .card {
        margin-bottom: 15px;
    }

    @media (min-width: 576px) {
        .card-deck {
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .card-deck .card {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            -ms-flex-direction: column;
            flex-direction: column;
            margin-right: 15px;
            margin-bottom: 0;
            margin-left: 15px;
        }
    }

    .card-group {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .card-group>.card {
        margin-bottom: 15px;
    }

    @media (min-width: 576px) {
        .card-group {
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
        }

        .card-group>.card {
            -ms-flex: 1 0 0%;
            flex: 1 0 0%;
            margin-bottom: 0;
        }

        .card-group>.card+.card {
            margin-left: 0;
            border-left: 0;
        }

        .card-group>.card:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .card-group>.card:first-child .card-img-top,
        .card-group>.card:first-child .card-header {
            border-top-right-radius: 0;
        }

        .card-group>.card:first-child .card-img-bottom,
        .card-group>.card:first-child .card-footer {
            border-bottom-right-radius: 0;
        }

        .card-group>.card:last-child {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .card-group>.card:last-child .card-img-top,
        .card-group>.card:last-child .card-header {
            border-top-left-radius: 0;
        }

        .card-group>.card:last-child .card-img-bottom,
        .card-group>.card:last-child .card-footer {
            border-bottom-left-radius: 0;
        }

        .card-group>.card:only-child {
            border-radius: 0.25rem;
        }

        .card-group>.card:only-child .card-img-top,
        .card-group>.card:only-child .card-header {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .card-group>.card:only-child .card-img-bottom,
        .card-group>.card:only-child .card-footer {
            border-bottom-right-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .card-group>.card:not(:first-child):not(:last-child):not(:only-child) {
            border-radius: 0;
        }

        .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top,
        .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,
        .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,
        .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer {
            border-radius: 0;
        }
    }

    .card-columns .card {
        margin-bottom: 0.75rem;
    }

    @media (min-width: 576px) {
        .card-columns {
            -webkit-column-count: 3;
            -moz-column-count: 3;
            column-count: 3;
            -webkit-column-gap: 1.25rem;
            -moz-column-gap: 1.25rem;
            column-gap: 1.25rem;
            orphans: 1;
            widows: 1;
        }

        .card-columns .card {
            display: inline-block;
            width: 100%;
        }
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6;
    }

    .table .table {
        background-color: #fff;
    }

    .table-sm th,
    .table-sm td {
        padding: 0.3rem;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead td {
        border-bottom-width: 2px;
    }

    .table-borderless th,
    .table-borderless td,
    .table-borderless thead th,
    .table-borderless tbody+tbody {
        border: 0;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .table-primary,
    .table-primary>th,
    .table-primary>td {
        background-color: #b8daff;
    }

    .table-hover .table-primary:hover {
        background-color: #9fcdff;
    }

    .table-hover .table-primary:hover>td,
    .table-hover .table-primary:hover>th {
        background-color: #9fcdff;
    }

    .table-secondary,
    .table-secondary>th,
    .table-secondary>td {
        background-color: #d6d8db;
    }

    .table-hover .table-secondary:hover {
        background-color: #c8cbcf;
    }

    .table-hover .table-secondary:hover>td,
    .table-hover .table-secondary:hover>th {
        background-color: #c8cbcf;
    }

    .table-success,
    .table-success>th,
    .table-success>td {
        background-color: #c3e6cb;
    }

    .table-hover .table-success:hover {
        background-color: #b1dfbb;
    }

    .table-hover .table-success:hover>td,
    .table-hover .table-success:hover>th {
        background-color: #b1dfbb;
    }

    .table-info,
    .table-info>th,
    .table-info>td {
        background-color: #bee5eb;
    }

    .table-hover .table-info:hover {
        background-color: #abdde5;
    }

    .table-hover .table-info:hover>td,
    .table-hover .table-info:hover>th {
        background-color: #abdde5;
    }

    .table-warning,
    .table-warning>th,
    .table-warning>td {
        background-color: #ffeeba;
    }

    .table-hover .table-warning:hover {
        background-color: #ffe8a1;
    }

    .table-hover .table-warning:hover>td,
    .table-hover .table-warning:hover>th {
        background-color: #ffe8a1;
    }

    .table-danger,
    .table-danger>th,
    .table-danger>td {
        background-color: #f5c6cb;
    }

    .table-hover .table-danger:hover {
        background-color: #f1b0b7;
    }

    .table-hover .table-danger:hover>td,
    .table-hover .table-danger:hover>th {
        background-color: #f1b0b7;
    }

    .table-light,
    .table-light>th,
    .table-light>td {
        background-color: #fdfdfe;
    }

    .table-hover .table-light:hover {
        background-color: #ececf6;
    }

    .table-hover .table-light:hover>td,
    .table-hover .table-light:hover>th {
        background-color: #ececf6;
    }

    .table-dark,
    .table-dark>th,
    .table-dark>td {
        background-color: #c6c8ca;
    }

    .table-hover .table-dark:hover {
        background-color: #b9bbbe;
    }

    .table-hover .table-dark:hover>td,
    .table-hover .table-dark:hover>th {
        background-color: #b9bbbe;
    }

    .table-active,
    .table-active>th,
    .table-active>td {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover>td,
    .table-hover .table-active:hover>th {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #212529;
        border-color: #32383e;
    }

    .table .thead-light th {
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .table-dark {
        color: #fff;
        background-color: #212529;
    }

    .table-dark th,
    .table-dark td,
    .table-dark thead th {
        border-color: #32383e;
    }

    .table-dark.table-bordered {
        border: 0;
    }

    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, 0.05);
    }

    .table-dark.table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.075);
    }

    @media (max-width: 575.98px) {
        .table-responsive-sm {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive-sm>.table-bordered {
            border: 0;
        }
    }

    @media (max-width: 767.98px) {
        .table-responsive-md {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive-md>.table-bordered {
            border: 0;
        }
    }

    @media (max-width: 991.98px) {
        .table-responsive-lg {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive-lg>.table-bordered {
            border: 0;
        }
    }

    @media (max-width: 1199.98px) {
        .table-responsive-xl {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive-xl>.table-bordered {
            border: 0;
        }
    }

    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }

    .table-responsive>.table-bordered {
        border: 0;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    @media screen and (prefers-reduced-motion: reduce) {
        .form-control {
            transition: none;
        }
    }

    .form-control::-ms-expand {
        background-color: transparent;
        border: 0;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-control::-webkit-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::-moz-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control:-ms-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::-ms-input-placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
    }

    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 2px);
    }

    select.form-control:focus::-ms-value {
        color: #495057;
        background-color: #fff;
    }

    .form-control-file,
    .form-control-range {
        display: block;
        width: 100%;
    }

    .col-form-label {
        padding-top: calc(0.375rem + 1px);
        padding-bottom: calc(0.375rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1.5;
    }

    .col-form-label-lg {
        padding-top: calc(0.5rem + 1px);
        padding-bottom: calc(0.5rem + 1px);
        font-size: 1.25rem;
        line-height: 1.5;
    }

    .col-form-label-sm {
        padding-top: calc(0.25rem + 1px);
        padding-bottom: calc(0.25rem + 1px);
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .form-control-plaintext {
        display: block;
        width: 100%;
        padding-top: 0.375rem;
        padding-bottom: 0.375rem;
        margin-bottom: 0;
        line-height: 1.5;
        color: #212529;
        background-color: transparent;
        border: solid transparent;
        border-width: 1px 0;
    }

    .form-control-plaintext.form-control-sm,
    .input-group-sm>.form-control-plaintext.form-control,
    .input-group-sm>.input-group-prepend>.form-control-plaintext.input-group-text,
    .input-group-sm>.input-group-append>.form-control-plaintext.input-group-text,
    .input-group-sm>.input-group-prepend>.form-control-plaintext.btn,
    .input-group-sm>.input-group-append>.form-control-plaintext.btn,
    .form-control-plaintext.form-control-lg,
    .input-group-lg>.form-control-plaintext.form-control,
    .input-group-lg>.input-group-prepend>.form-control-plaintext.input-group-text,
    .input-group-lg>.input-group-append>.form-control-plaintext.input-group-text,
    .input-group-lg>.input-group-prepend>.form-control-plaintext.btn,
    .input-group-lg>.input-group-append>.form-control-plaintext.btn {
        padding-right: 0;
        padding-left: 0;
    }

    .form-control-sm,
    .input-group-sm>.form-control,
    .input-group-sm>.input-group-prepend>.input-group-text,
    .input-group-sm>.input-group-append>.input-group-text,
    .input-group-sm>.input-group-prepend>.btn,
    .input-group-sm>.input-group-append>.btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    select.form-control-sm:not([size]):not([multiple]),
    .input-group-sm>select.form-control:not([size]):not([multiple]),
    .input-group-sm>.input-group-prepend>select.input-group-text:not([size]):not([multiple]),
    .input-group-sm>.input-group-append>select.input-group-text:not([size]):not([multiple]),
    .input-group-sm>.input-group-prepend>select.btn:not([size]):not([multiple]),
    .input-group-sm>.input-group-append>select.btn:not([size]):not([multiple]) {
        height: calc(1.8125rem + 2px);
    }

    .form-control-lg,
    .input-group-lg>.form-control,
    .input-group-lg>.input-group-prepend>.input-group-text,
    .input-group-lg>.input-group-append>.input-group-text,
    .input-group-lg>.input-group-prepend>.btn,
    .input-group-lg>.input-group-append>.btn {
        padding: 0.5rem 1rem;
        font-size: 1.25rem;
        line-height: 1.5;
        border-radius: 0.3rem;
    }

    select.form-control-lg:not([size]):not([multiple]),
    .input-group-lg>select.form-control:not([size]):not([multiple]),
    .input-group-lg>.input-group-prepend>select.input-group-text:not([size]):not([multiple]),
    .input-group-lg>.input-group-append>select.input-group-text:not([size]):not([multiple]),
    .input-group-lg>.input-group-prepend>select.btn:not([size]):not([multiple]),
    .input-group-lg>.input-group-append>select.btn:not([size]):not([multiple]) {
        height: calc(2.875rem + 2px);
    }

    .form-group {
        margin-bottom: 1rem;
    }

    hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 0.5rem;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    ol ol,
    ul ul,
    ol ul,
    ul ol {
        margin-bottom: 0;
    }

    * {
        page-break-inside: always;
    }

    .form-text {
        display: block;
        margin-top: 0.25rem;
    }

    .mb-2,
    .my-2 {
        margin-bottom: 0.5rem !important;
    }
</style>