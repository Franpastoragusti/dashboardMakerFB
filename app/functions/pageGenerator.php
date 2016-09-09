<?php
function replace_content($in='/\#CONTENT\#/ms', $out,$pagina){
    return preg_replace($in, $out, $pagina);        
}

function load_template(){
    $pagina = load_page('views/page.php');
    return $pagina;
}


function load_page($page){
        return file_get_contents($page);
}
    
function view_page($html){
    echo $html;
}
?>