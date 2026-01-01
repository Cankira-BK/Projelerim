<aside id="right">

    <div id="content_ajax">

        <article class="page_article">
            <div class="panel-heading"><h2 class="head">404</h2></div>
            <div class="body">

                <style>
                    .main404 {
                        position: relative;
                        height: 500px;
                        margin: 10px;
                        font-weight: bold;
                        text-align: center;
                    }

                    .sub404{
                        position: absolute;
                        left: 50%;
                        top: 30%;
                        transform: translate(-50%, -30%);
                        color:#bfb3a9;

                    }
                </style>

                <div class="main404">
                    <div class="sub404">
                        <h1 style="font-size:52px;font-weight:bold">404</h1>
						<?=$lng[61]?>
                    </div>
                </div>
            </div>
        </article>

        <script type="text/javascript">
            if(typeof CustomJS !== 'undefined')
                CustomJS.initialize();

            if(typeof Shadowbox !== 'undefined')
                Shadowbox.setup();
        </script>
    </div>
</aside>