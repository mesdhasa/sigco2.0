<?php
	$corps = '
	<style>
table {
  border-collapse: collapse;
  width: 900px;
}
td,
th {
  text-align: right;
  padding: .4em;
}
tr th:first-child,
tr td:first-child {
  text-align: left;
  width: 90%;
  /* Force description column to take more space */
}
tfoot tr td {
  font-weight: bold;
  border-top: 1px black solid;
  border-bottom: 1px black solid;
}
</style>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>JS Bin</title>
  <meta name=viewport content="width=device-width, initial-scale=1">

  </head>

<body>
  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Moon cakes</td>
        <td>5</td>
        <td>100</td>
        <td>500</td>
      </tr>
      <tr>
        <td>Super biscuits</td>
        <td>1</td>
        <td>500</td>
        <td>500</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">Total value</td>
        <td>1000</td>
      </tr>
    </tfoot>
  </table>
</body>

</html>';
 $content ="<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"5mm\" backright=\"5mm\" footer=\"page\"> 
	".$corps."
  </page>";
	$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15'); 
    $html2pdf->WriteHTML($content);
    $html2pdf->Output();
?>