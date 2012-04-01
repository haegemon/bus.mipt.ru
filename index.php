<html>
<head>
<meta name='Author' content='Kaledin Stas'>
<meta name='Reply-to' content='stanislavkaledin@rambler.ru'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>
Добро пожаловать на сайт bus.mipt.ru
</title>
</head>
<body>
<table rules='cols'  width=100% align='center' frame='void'>
<tr align='center'><center> <H1>Здесь будет шапка=)</h1></tr></center>
<br>
<hr>
<hr>
<tr>
<td align='left' valign='top' width=20%>
<H3> Рейсы:</h3>
<form action='index.php' method='get'>
<H2>Показать за:</h2>
<? 
$sTimeType = $_REQUEST['reis'];
$sTimeType = $sTimeType ? $sTimeType : 'unfull' ;
$iPathType = $_REQUEST['path'];
$iPathType = $iPathType ? $iPathType : 1;
?>
За час <input type='radio' name='reis' value='unfull' <?if($sTimeType=='unfull'){echo "checked";}?>>
Вообще все <input type='radio' name='reis' value='all' <?if($sTimeType=='all'){echo "checked";}?>><br>
Все оставшиеся за день <input type='radio' name='reis' value='full' <?if($sTimeType=='full'){echo "checked";}?>>
<button name='path' value='1'>Долгопрудная - Москва</button>
<button name='path' value='-1'>Москва - Долгопрудная</button>
</form>
<td align='center' width=85%>
<?
	include "connect.php";
    $query1 = "drop view if exists temp; create view temp(reis_name, reis_number, start_date, end_date, cur) as(SELECT reis_name, reis_number, time(start_date), time(end_date), timediff(start_date, current_time)from main where type_of_reis=".$iPathType.");";    
    echo ' к '.$query1.' 3 ';
	mysql_query($query1, $db);
	if($iPathType == 'unfull'){
		$query = "SELECT reis_name, reis_number, time(start_date), time(end_date), cur from temp where cur>0 and hour(cur)<1 order by cur;";
        } elseif($iPathType == 'full'){
            $query = "SELECT reis_name, reis_number, time(start_date), time(end_date), cur from temp where cur>0 order by cur;";
            } else {
                $query = "select reis_name, reis_number, time(start_date), time(end_date) from main where type_of_reis=".$iPathType.";";
            }
	$result=mysql_query($query, $db);
	
	
?>
<h1>"Here will table!)"</h1>
<table border="2">
<tr>
	<th bgcolor="#E0E0E0"> <b>Название рейса</b></th>
	<th bgcolor="#E0E0E0"> <b>Номер рейса</b></th>
	<th bgcolor="#E0E0E0"> <b>Время отправления</b> </th>
	<th bgcolor="#E0E0E0"> <b>Время прибытия</b> </th>
	<?if($_REQUEST['reis']!='all'):?><th bgcolor="#FFFFFF"> <b><i>Оставшееся время</i></b> </th><?endif?>
</tr>
<?	$i=2;  
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)):?>
		<? if ($i%2==0) {
            echo '<tr bgcolor="#FFFF14">';
        } else {
            echo '<tr bgcolor="#52FFA8">';
        }
        foreach ($line as $col_value):?>
            <td>
                <? echo $col_value;?>
            </td>
        <?endforeach?>
</tr>
        <?$i++;?>
    <?endwhile?>
</table>

<?
    mysql_free_result($result);
    mysql_close($db);	
?>
</td>
</tr>
</table>
<hr>
<center>
<small>
Каледин Стас	<form action='mailto:stanislavkaledin@rambler.ru' method='post'>
</small>
</center>
</body>
</html>



