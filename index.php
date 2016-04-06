<?php 
$num_rec_per_page=50;
mysql_connect('localhost','root','');
mysql_select_db('php_pagination');

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM student LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysql_query ($sql); //run the query
?> 
<table style="width:50%;border:1px solid;margin: auto;" border="1">
<tr><td>Name</td><td>Phone</td></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Phone']; ?></td>            
            </tr>
<?php 
}; 
?> 
</table>
<?php 
$sql = "SELECT * FROM student"; 
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 

echo "<div style='width:50%;margin:auto; padding-top: 15px;'><a href='index.php?page=1'>".'|<'."</a> "; // Goto 1st page 
$p=1;
$current_page=1;
$num_of_link_inpagination = 5;
$num_of_link_inpagination=$num_of_link_inpagination-1;
if(isset($_GET['page'])){
    $current_page = $_GET['page'];
    $p= $_GET['page'] - 1;
}

 $temp_current = $total_pages - $num_of_link_inpagination;
if($current_page > $temp_current){ $current_page = $temp_current; }
if($p >=1){
echo "<a href='index.php?page=$p' style='padding:2px;border:1px solid;'>".'Prev'."</a> ";
}
if($current_page >= $temp_current){
echo '....';
}
for ($i=$current_page,$j=0; $i<=$total_pages; $i++,$j++){
        if($num_of_link_inpagination >= $j){
            echo "<a href='index.php?page=".$i."' style='padding:2px;border:1px solid;'>".$i."</a> "; 
        }
}
if($temp_current > $current_page){
echo '....';
}

$n=2;
if(isset($_GET['page'])){
    $n= $_GET['page'] + 1;
}
if($n <= $total_pages){
echo "<a href='index.php?page=$n' style='padding:2px;border:1px solid;'>".'Next'."</a>";
}
echo "<a href='index.php?page=$total_pages'>".'>|'."</a> </div>"; // Goto last page
?>