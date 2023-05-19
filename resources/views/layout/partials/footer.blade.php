<footer class="page-footer">
    <div class="font-13">{{ date('Y') }} © <b></b> - All right reserved.</div>
    <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
</footer>
<script>

    $( document ).ready(function() {
    // Handler for .ready() called.
        if (localStorage.getItem("active_li") == null) {
            localStorage.setItem('active_li', 0);
        }
        $('.side-menu.metismenu li').on('click', function(){
            localStorage.setItem('active_li', $(this).index());
        });
        $(function() {
            $($('.side-menu.metismenu li')).removeClass('active');
            $($('.side-menu.metismenu li')[localStorage.getItem('active_li')]).addClass('active');
        });

        $("#hamburger-sidebar-toggler").on('click', function(){
            if( $("nav#sidebar").css('left') == "0px" ){
                $(".page-brand").hide();
                $("nav#sidebar").css('left', '-240px');
                $(".content-wrapper").css("margin-left", "0px");
            } else if( $("nav#sidebar").css('left') == "-240px" ){
                $("nav#sidebar").css('left', '0px');
                $(".page-brand").show();
                $(".content-wrapper").css("margin-left", "24px");
            }
        });
    });
</script>
