<div class="footer">
    <div class="footer_con">
     <div id="74gm"> 
	 <a href="http://www.13yyw.com"> 要上页游网络出品</a>
	 <div></div>

</div>

<script type="text/javascript">

    $(function () {

        $(".nav ul li[class!='orange']").each(function () {

            if (window.location.href.toLowerCase().indexOf($(this).children("a").attr("href").toLowerCase()) > 0 ||

            window.location.href.toLowerCase() == $(this).children("a").attr("href").toLowerCase()) {

                $("div.nav ul li").removeClass("select");

                $(this).addClass("select");

            }

        })

    })

</script>