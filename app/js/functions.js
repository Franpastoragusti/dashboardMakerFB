
function buildDesiredData (stadistics){
    var originalData = [['FECHA', 'Lifetime Total Likes', 'Daily New Likes','Daily Unlikes', 'Likes Netos','Daily Engage', 'Alcance diario Orgánico','Alcance diario Pagado','Alcance Total', 'Impresiones diarias Orgánico','Impresiones diarias Pagado', 'Impresiones Daily']];

    stadistics.forEach( function(day, index) {
        if (day.Date){
            originalData.push([
                day.Date, 
                parseInt(day.lifetime.total.likes), 
                parseInt(day.daily.likes.newLikes), 
                parseInt(day.daily.likes.unlikes), 
                parseInt(day.daily.likes.newLikes-day.daily.likes.unlikes), 
                parseInt(day.daily.page.users), 
                parseInt(day.daily.organic.reach), 
                parseInt(day.daily.paid.reach), 
                (parseInt(day.daily.organic.reach)+parseInt(day.daily.paid.reach)),
                parseInt(day.daily.organic.impressions),
                parseInt(day.daily.paid.impressions),
                (parseInt(day.daily.organic.impressions)+parseInt(day.daily.paid.impressions))
            ]);
        }
    });

    return originalData;
}

function buildDesiredWorkbook (stadistics) {
	
                var originalData = buildDesiredData(stadistics);
                var workbook = ExcelBuilder.Builder.createWorkbook();
                var worksheet = workbook.createWorksheet({ name: 'TestSheet' });
                var stylesheet = workbook.getStyleSheet();

                var albumTable = new ExcelBuilder.Table();
                albumTable.styleInfo.themeStyle = "TableStyleDark2";
                albumTable.setReferenceRange([1, 1], [3, originalData.length]);

                worksheet.sheetView.showGridLines = false;
                worksheet.setData(originalData);
                worksheet.setColumns([
			        {width: 30},
			        {width: 20},
			        {width: 15},
			        {width: 15},
			        {width: 15},
			        {width: 15},
			        {width: 15},
			        {width: 15},
			        {width: 15},
			        {width: 15}
			    ]);
                workbook.addWorksheet(worksheet);

                worksheet.addTable(albumTable);
                workbook.addTable(albumTable);
            return workbook
}

function buildExcel (nData) {
    console.log(nData);
    var workbook = buildDesiredWorkbook(nData);
    ExcelBuilder.Builder.createFile(workbook).then(function (data) {
        if('download' in document.createElement('a')){
            $("#downloader").attr({
                href: "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,"+ data
            });
        }
    }); 
}