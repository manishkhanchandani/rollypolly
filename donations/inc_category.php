<?php require_once('../Connections/connWork.php'); ?>
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

mysql_select_db($database_connWork, $connWork);
$query_rsCategoryLink = "SELECT * FROM donations_category ORDER BY category ASC";
$rsCategoryLink = mysql_query($query_rsCategoryLink, $connWork) or die(mysql_error());
$row_rsCategoryLink = mysql_fetch_assoc($rsCategoryLink);
$totalRows_rsCategoryLink = mysql_num_rows($rsCategoryLink);

if ($totalRows_rsCategoryLink > 0) { // Show if recordset not empty ?>
  <ul id="cat-navi" class="nav nav-list">
    <li><a href="view.php" class="list-group-item active"> Categories</a></li>
    <?php do { ?>
      <li><a href="view.php?cid=<?php echo $row_rsCategoryLink['category_id']; ?>&cat=<?php echo urlencode($row_rsCategoryLink['category']); ?>" class="list-group-item"> <?php echo $row_rsCategoryLink['category']; ?></a></li>
      <?php } while ($row_rsCategoryLink = mysql_fetch_assoc($rsCategoryLink)); ?>
  </ul>
<?php } // Show if recordset not empty ?>
<?php
mysql_free_result($rsCategoryLink);
?>