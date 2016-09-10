<html>
    <head>
        <script type="text/javascript" src="https//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="excel-builder/dist/excel-builder.dist.js"></script>
       
        <script type="text/javascript" src="app/js/functions.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.1/css/uikit.min.css"/>
        <link rel="stylesheet" href="app/css/style.css"/>
    </head>
    <body>
        <section>
        <div class="uk-text-center">
            <div class="uk-img-div uk-align-center">
                <img src="img/Facebook-create.png">
            </div>
            <div class="uk-vertical-align-middle">
           
                <?php 
                 require_once "app/functions/functions.php";
                 require_once "app/functions/pageGenerator.php";
                    if (empty($_POST)) {
                        $page=load_page('./views/form.php');
                        view_page($page);

                    }else{
                        $json=parseCSVFacebookByDays($_POST["csv"]);
                        $page=load_page('./views/form2.php');
                        $page=$page."<div class='uk-form-row'><a class='uk-width-1-1 uk-button uk-button-link uk-button-large' href='#' id='downloader' download=".$_POST['title'].".xlsx>Descarga</a></div></form>";
                        view_page($page);
                    }
                ?> 
            </div>
        </div>

        </section>
        <?php if (!empty($json)): ?>
        <script type="text/javascript">
            var structuredData = <?php print($json);?>;
            buildExcel(structuredData);
        </script>
        <?php endif; ?>
    </body>
</html>
