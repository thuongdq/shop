<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
        <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
           title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase
            Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV
<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">
                <span>Purchase Metronic</span>
                <i class="icon-basket"></i>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">
                <span>Customer Reviews</span>
                <i class="icon-users"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/showcast/" target="_blank">
                <span>Showcase</span>
                <i class="icon-user"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">
                <span>Changelog</span>
                <i class="icon-graph"></i>
            </a>
        </li>
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>
END QUICK NAV -->

<!--[if lt IE 9]>
<script src="{{ asset('backend/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('backend/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('backend/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('backend/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('backend/global/plugins/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('backend/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@yield('js-plugins')
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('backend/global/scripts/app.min.js') }}" type="text/javascript"></script>
{{--<script type="text/javascript">--}}
    {{--var window.csrf_token = $('meta[name="csrf-token"]').attr('content');--}}
{{--</script>--}}
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('js-scripts')
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('backend/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<!-- BEGIN BOTTOM SCRIPTS -->
@yield('js-bottom')
<script type="text/javascript">
    axios.defaults.headers.comment = {
        'X-Requested-With' : 'XMLHttpRequest'
    };
</script>
<!-- END BOTTOM SCRIPTS -->
{{--<script src="{{ asset('js/vue.js') }}" type="text/javascript"></script>--}}
</body>

</html>
