<?
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display errors', 1);

$aLanguages=array("Slavic"=>array("Russian","Polish","Slovenian"),
    "Germanic"=>array("Swedish","Dutch","English"),
    "Romance"=>array("Italian","Spanish","Romanian")
);

foreach ($aLanguages as $sKey=>$aFamily){
    echo (
        "<h2>$sKey</h2>".
        "<ul>"
    );
    foreach ($aFamily as $sLanguage){
        echo ("<li>$sLanguage</li>");
    }
    echo ("</ul>");
}

?>



