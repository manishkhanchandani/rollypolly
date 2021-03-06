<?php require_once('../../Connections/connP2.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

require_once('config.php');

$rsSettings = mysql_query("select * from settings WHERE setting_id = 1");
$recSettings = mysql_fetch_array($rsSettings);

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = $recSettings['maxRecordPerPage'];
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_connP2, $connP2);
$query_rsView = "SELECT * FROM main_image";
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $connP2) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Front End</title>
</head>

<body>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<script type="text/javascript" src="js/jquery.maphilight.min.js"></script>
<script type="text/javascript">
    $(function () {
        //$('.mapHiLight').maphilight({ stroke: false, fillColor: '009DDF', fillOpacity: 1 });
        $('.map').maphilight();//,"alwaysOn":true
    });

var selwidth = 300;
var timeout;
$( document ).ready(function() {

        $( "#contentData" )
          .mouseenter(function() {
            //console.log('mouseenter div');
              clearTimeout(timeout);
          })
          .mouseleave(function() {
            //console.log('mouseleave div');
            timeout = setTimeout(function() {$( "#contentData" ).dialog( "close" )}, 4000);
          });
        
      $( "#contentData" ).dialog({
          autoOpen: false,
          position: { my: "left", at: "right", of: '#mainImage' },
          width: selwidth
      });
      /*$( "#position_1" ).mouseover(function() {
         clearTimeout(timeout);
         $('#contentbody').html('new text 1');
         $( "#contentData" ).dialog( "close" );
         $( "#contentData" ).dialog( "open" );
         timeout = setTimeout(function() {$( "#contentData" ).dialog( "close" )}, 4000);
      });*/
});
</script>

<style type="text/css">
.imglist {
  max-width: 100px;
}
.titleText {
  font-size:11px;
}
</style>
<style type="text/css">
body {
 font-family:Verdana;
 font-size: 11px; 
}
</style>

<h3>View Details</h3>
<?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
<p>No Record Found.</p>
<?php } // Show if recordset empty ?>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>

<?php do { ?>

<?php
if (!empty($row_rsView['resizeImg'])){
    $imageDir = IMAGEDIRNEW;
    $targetDir = IMAGEUPLOADDIRNEW;
} else {
    $imageDir = IMAGEDIR;
    $targetDir = IMAGEUPLOADDIR;
}
$imageSitePath = $targetDir.$row_rsView['fileName'];
$imageHttpPath = $imageDir.$row_rsView['fileName'];
$check = getimagesize($imageSitePath);


$rs = mysql_query("select * from image_details WHERE id = '".$row_rsView['id']."'");
$return = array();
if (mysql_num_rows($rs) > 0) {
    while ($rec = mysql_fetch_array($rs)) {
        $return[] = $rec;   
    }
}
?>
<p>
<img id="mainImage" src="<?php echo $imageDir.$row_rsView['fileName']; ?>" width="<?php echo $check[0]; ?>" height="<?php echo $check[1]; ?>" class="map" usemap="#Map_<?php echo $row_rsView['id']; ?>" />
<?php if (!empty($return)) { ?>
<map name="Map_<?php echo $row_rsView['id']; ?>">
    <?php foreach ($return as $k => $v) { 
    
$target_dir = SUBIMAGEDIR.$row_rsView['id'].'/';
$dataDetails = !empty($v['extraFields']) ? json_decode($v['extraFields'], 1): null;
//echo '<pre>';
//print_r($dataDetails);

//echo '</pre>';
    ?>
        <area shape="poly" coords="<?php echo $v['coordinates']; ?>" href="http://google.com" target="_blank" alt="Hat" id="position_<?php echo $row_rsView['id']; ?>_<?php echo $v['detail_id']; ?>"  data-maphilight='{"strokeColor":"0000ff","strokeWidth":2,"fillColor":"ff0000","fillOpacity":0.3}'>

<script>
   $(function() {
      $( "#position_<?php echo $row_rsView['id']; ?>_<?php echo $v['detail_id']; ?>" ).mouseover(function() {
         clearTimeout(timeout);
         $('#contentImage').attr('src', '');
         $('#contentbody').html('<?php echo $dataDetails['itemDescription']; ?>');
         $('#ui-id-1').html('<?php echo $dataDetails['modelNumber']; ?>');
         $('#contenturl').html('<a href="<?php echo $dataDetails['manufacturingDescription']; ?>" target="_blank" class="titleText"><?php echo $dataDetails['manufacturingDescription']; ?></a>');
         $('#contentImage').attr('src', '<?php echo $target_dir.$v['imageFile']; ?>');
         $( "#contentData" ).dialog( "close" );
         $( "#contentData" ).dialog( "open" );
         timeout = setTimeout(function() {$( "#contentData" ).dialog( "close" )}, 4000);
      });
   });
</script>
    <?php } ?>
</map>
<?php } ?>
</p>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
<p> Records <?php echo ($startRow_rsView + 1) ?> to <?php echo min($startRow_rsView + $maxRows_rsView, $totalRows_rsView) ?> of <?php echo $totalRows_rsView ?> &nbsp;
</p>
<table border="0">
    <tr>
        <td><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, 0, $queryString_rsView); ?>">First</a>
                <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_rsView > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, max(0, $pageNum_rsView - 1), $queryString_rsView); ?>">Previous</a>
                <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, min($totalPages_rsView, $pageNum_rsView + 1), $queryString_rsView); ?>">Next</a>
                <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_rsView < $totalPages_rsView) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_rsView=%d%s", $currentPage, $totalPages_rsView, $queryString_rsView); ?>">Last</a>
                <?php } // Show if not last page ?></td>
    </tr>
</table>
<?php } // Show if recordset not empty ?>
<div id="contentData" title="">
<table border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td valign="top"><img id="contentImage" src="" class="imglist" /></td>
    <td valign="top"><span id="contentbody"></span><br /><span id="contenturl"></span></td>
  </tr>
</table>
</div>

</body>
</html>
<?php
mysql_free_result($rsView);
?>
