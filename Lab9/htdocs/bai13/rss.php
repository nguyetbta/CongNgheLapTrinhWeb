<?php
header("Content-type: text/xml");

$conn = mysqli_connect("localhost", "root", "", "rss")
or die("Khong the ket noi CSDL");

mysqli_set_charset($conn, "utf8");

$query = "SELECT * FROM news";
$result = mysqli_query($conn, $query);

$item = "";

while($row = mysqli_fetch_array($result)){
    $item .= '<item>';
    $item .= '<title>'.$row['title'].'</title>';
    $item .= '<link>'.$row['link'].'</link>';
    $item .= '<description>'.$row['description'].'</description>';
    $item .= '</item>';
}

echo('<?xml version="1.0" ?>');
echo('<rss version="2.0">');
echo("<channel>");

echo("<title>Học Web | Học làm web pro</title>");
echo("<link>http://hocweb.com.vn</link>");

echo("<description>Website hocweb.com.vn được hình thành từ ý tưởng giúp các em sinh viên có một nơi học tập thực tế.</description>");

echo $item;

echo("</channel>");
echo('</rss>');

mysqli_close($conn);
?>