<html>
    <head>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="../excel-builder/dist/excel-builder.dist.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
    </head>
    <body>
        <h3>DashboardBuilder</h3>
        <?php 
         require_once "functions/functions.php";
         require_once "functions/pageGenerator.php";
        ?>
        <div>#CONTENT#</div>
        <script type="text/javascript">
            var structuredData = <?php print(parseCSVFacebookByDays($_POST["csv"]));?>;
            console.log(structuredData);
            var workbook = buildDesiredExcelWorkbook(structuredData);
            ExcelBuilder.Builder.createFile(workbook).then(function (data) {
                if('download' in document.createElement('a')){
                    $("#downloader").attr({
                        href: "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,"+ data
                    });
                }
            });
        </script>
    </body>
</html>
