<html>
<head>
<title>minimal.php</title>
</head>
<body>
<?
	$db=mysql_connect("localhost", "root", "1379468250");
	mysql_select_db("bus_mipt", $db);
	$query="SELECT * from main";
	$result=mysql_query($query, $db);
?>
<h1>"Here will table!)"</h1>
<table>
<?  while ($line = mysql_fetch_array($result, MYSQL_ASSOC))?>
        <tr>
        <?foreach ($line as $col_value)?>
            <td>
                <? echo $col_value;?>
            </td>
        <?endforeach?>
        </tr>
    <?endwhile?>
</table>

<?    /* Освобождаем память от результата */
    mysql_free_result($result);

    /* Закрываем соединение */
    mysql_close($db);	
?>
</table>
</body>
</html>
