<html>
    <head>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="../excel-builder/dist/excel-builder.dist.js"></script>
       
        <script type="text/javascript" src="js/functions.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.1/css/uikit.min.css"/>
    </head>
    <body>
        <h3 class="uk-h1 uk-text-center">DashboardBuilder</h3>
        
        <?php 
         require_once "functions/functions.php";
         require_once "functions/pageGenerator.php";
            if (empty($_POST)) {
                $page=load_page('./views/form.php');
                view_page($page);

            }else{
                $json=parseCSVFacebookByDays($_POST["csv"]);
                $page=load_page('./views/form2.php');
                $page=$page."<div class='uk-form-row'><a class='uk-width-1-1 uk-button uk-button-link uk-button-large' href='#' id='downloader' download=".$_POST['title'].".xlsx>Descarga</a></div></form></div></div>";
                view_page($page);
            }

        ?> 
        <?php if (!empty($json)): ?>
            <script type="text/javascript">

                    var structuredData = <?php print($json);?>;
                    buildExcel(structuredData);
            
            </script>
        <?php endif; ?>

    </body>
</html>
