<?php



function parseCSVFacebookByDays($strCsv){
    $contador28 = 0;
    $result = array();
    if (($handle = fopen($strCsv, "r")) !== FALSE) {
        $column_headers = fgetcsv($handle);
        foreach($column_headers as $header) {
                $result[$header] = array();
        }
        while (($data = fgetcsv($handle)) !== FALSE) {
            $i = 0;
            foreach($result as &$column) {

                    $column[] = $data[$i++];
            }
        }
        fclose($handle);
    }
    $daysArray = [];

    for ($i=0; $i < sizeof($result["Date"]); $i++) { 

        foreach ($result as $key => $value) {         
            if ($value[$i] != "") {
               
                if (strpos("$key", "28 Days") !== FALSE){
                    $daysArray = buildArray($daysArray, $key, $value, $i, "28Days");


                }elseif (strpos("$key", "Lifetime") !== FALSE) {
                    $daysArray = buildArray($daysArray, $key, $value, $i, "lifetime");


                }elseif (strpos("$key", "Daily") !== FALSE) {
                    $daysArray = buildArray($daysArray, $key, $value, $i, "daily");

                }elseif (strpos("$key", "Weekly") !== FALSE) {
                    $daysArray = buildArray($daysArray, $key, $value, $i, "weekly");


                }else{
                    $daysArray[$i][$key] = $value[$i] ;
                }
            }

        }

    }
    $json = json_encode($daysArray);

    return $json;

}



function parseCSV($strCsv){
    $contador28 = 0;
    $result = array();
    if (($handle = fopen($strCsv, "r")) !== FALSE) {
        $column_headers = fgetcsv($handle);
        foreach($column_headers as $header) {
                $result[$header] = array();
        }
        while (($data = fgetcsv($handle)) !== FALSE) {
            $i = 0;
            foreach($result as &$column) {

                    $column[] = $data[$i++];
            }
        }
        fclose($handle);
    }
       $json = json_encode($result);

    return $json;

}


function buildArray($daysArray, $key, $value, $i, $group){

     if(strpos("$key", " - ") !== FALSE){
        $element = explode(" - ", strtolower($key));


     }else{
        $element = explode(" ", strtolower($key));
     }

    if (strpos("$key", "Country") !== FALSE){
        $daysArray[$i]["$group"]["country"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "Demographics") !== FALSE){
        $daysArray[$i]["$group"]["demographics"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "story type") !== FALSE){
        $resultado = str_replace(' ', '-', $element[sizeof($element)-1]);
        $daysArray[$i]["$group"]["storyType"][$resultado]= $value[$i];

    }elseif (strpos("$key", "Page") !== FALSE){
        
        if(strpos("$key", " - ") !== FALSE){

            if(strpos("$key", "Like Sources - On Your Page") !== FALSE){
                $daysArray[$i]["$group"]["likes"]["sources"]["yourPage"]= $value[$i];

            }elseif(strpos("$key", "Sources - Page Suggestions") !== FALSE){
                $daysArray[$i]["$group"]["likes"]["sources"]["suggestions"]= $value[$i];

            }elseif(strpos("$key", "content type") !== FALSE){
                $daysArray[$i]["$group"]["page"]["interactions"][$element[sizeof($element)-1]]= $value[$i];

            }elseif(strpos("$key", "posts frequency") !== FALSE){
                $daysArray[$i]["$group"]["page"]["post-frequency"][$element[sizeof($element)-1]]= $value[$i];


            }elseif(strpos("$key", "consumptions by type") !== FALSE){

                $resultado = str_replace(' ', '-', $element[sizeof($element)-1]);

                $daysArray[$i]["$group"]["page"]["consumptions"][$resultado]= $value[$i];


            }else{

                $daysArray[$i]["$group"]["page"][$element[sizeof($element)-1]]= $value[$i];
            }

        }else{

            if(strpos("$key", "Reach of Page posts") !== FALSE){

                if (strpos("$key", "Paid") !== FALSE) {
                    $daysArray[$i]["$group"]["paid"]["postViews"]= $value[$i];
                }
                if (strpos("$key", "Organic") !== FALSE) {
                    $daysArray[$i]["$group"]["organic"]["postViews"]= $value[$i];
                }
                

            }elseif(strpos("$key", "Logged-in") !== FALSE){
                $daysArray[$i]["$group"]["logged"]= $value[$i];

            }elseif(strpos("$key", "Page consumptions") !== FALSE){
               $daysArray[$i]["$group"]["page"]["consumptions"]['total']= $value[$i];



            }else{
               $daysArray[$i]["$group"]["page"][$element[sizeof($element)-1]]= $value[$i];
            }


        }


    }elseif (strpos("$key", "Total") !== FALSE){

        if(strpos("$key", "-") !== FALSE){
            $daysArray[$i]["$group"]["total"]["frequency"][$element[sizeof($element)-1]]= $value[$i];
        }else{
            if(strpos("$key", "Impressions of your posts") !== FALSE){
                $daysArray[$i]["$group"]["total"]["impressionsOfPosts"]= $value[$i];
            }else{
                $daysArray[$i]["$group"]["total"][$element[sizeof($element)-1]]= $value[$i];
            }
            
        }

    }elseif (strpos("$key", "Organic") !== FALSE){
        $daysArray[$i]["$group"]["organic"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "Reach of page posts")!== FALSE){
            $daysArray[$i]["$group"]["postViews"]= $value[$i];

    }elseif (strpos("$key", "Paid") !== FALSE){
        if(strpos("$key", "impressions of your posts") !== FALSE){
            $daysArray[$i]["$group"]["paid"]["impressionsOfPosts"]= $value[$i];
        }else{
            $daysArray[$i]["$group"]["paid"][$element[sizeof($element)-1]]= $value[$i];
        }

    }elseif (strpos("$key", "Gender and Age") !== FALSE){
        $daysArray[$i]["$group"]["genderAndAge"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "Language") !== FALSE){
        $daysArray[$i]["$group"]["language"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "City") !== FALSE){
        $daysArray[$i]["$group"]["city"][$element[sizeof($element)-1]]= $value[$i];

    }elseif (strpos("$key", "Like") !== FALSE || strpos("$key", "Unlike") !== FALSE){
        if (strpos("$key", "Sources") !== FALSE) {
            $daysArray[$i]["$group"]["likes"]["sources"][$element[sizeof($element)-1]]= $value[$i];
        }elseif (strpos("$key", "Unlikes") !== FALSE) {
            $daysArray[$i]["$group"]["likes"]["unlikes"]= $value[$i];
        }else{
            $daysArray[$i]["$group"]["likes"]["newLikes"]= $value[$i];
        }

    }else{

            $daysArray[$i][$key]= $value[$i] ;

    }
    return $daysArray;
}


?>