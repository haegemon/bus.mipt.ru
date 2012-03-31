<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"><!--    -->
<title>
Добро пожаловать на сайт bus.mipt.ru
</title>
</head>
<frameset rows="100, *, 10">
<frame src="head.html" scrolling="no" noresize>
<center>
<?
	include "connect.php";
	$query="SELECT reis_name, reis_number, time(start_date), time(end_date), timediff(start_date, current_time) from main where timediff(start_date, current_time)>0 and hour(timediff(start_date, current_time))<1 order by timediff(start_date, current_time)";
	$result=mysql_query($query, $db);
?>
<h1>"Here will table!)"</h1>
<table border="2">
<tr>
	<td bgcolor="#E0E0E0"> <b>Название рейса</b></td>
	<td bgcolor="#E0E0E0"> <b>Номер рейса</b></td>
	<td bgcolor="#E0E0E0"> <b>Время отправления</b> </td>
	<td bgcolor="#E0E0E0"> <b>Время прибытия</b> </td>
	<td bgcolor="#FFFFFF"> <b><i>Оставшееся время</i></b> </td>
</tr>
<?	$i=2;  
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)):?>
		<? if($i%2==0):echo '<tr bgcolor="#FFFF14">'; else: echo '<tr bgcolor="#52FFA8">';?>
		<?endif?>
     			<?foreach ($line as $col_value):?>
            			<td>
                		<? echo $col_value;?>
            			</td>
        		<?endforeach?>
        	</tr>
	<?$i=$i+1;?>
    	<?endwhile?>
</table>

<?
    mysql_free_result($result);
    mysql_close($db);	
?>
</table>
</center>
<frame src="end.html" scrolling="no" noresize>
</html>
