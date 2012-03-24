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
	print("Here will table!)");
	print("<table>\n");
        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    	    print("\t<tr>\n");
    	    foreach ($line as $col_value) {
    	        print("\t\t<td>$col_value</td>\n");
    	    }
    	    print("\t</tr>\n");
    	}
    	print("</table>\n");

    /* Освобождаем память от результата */
    mysql_free_result($result);

    /* Закрываем соединение */
    mysql_close($db);	
?>
</body>
</html>
