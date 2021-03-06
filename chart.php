<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Demo page</title>	
		<link type="text/css" rel="stylesheet" href="css/visualize.jQuery.css"/>
		<link type="text/css" rel="stylesheet" href="css/demopage.css"/>
		<script type="text/javascript" src="js/visualize.jquery.min.js"></script>
		<!--[if IE]><script type="text/javascript" src="excanvas.compiled.js"></script><![endif]-->
		<script type="text/javascript" src="js/visualize.jQuery.js"></script>
		<script type="text/javascript">
			$(function(){
				//make some charts
				$('table').visualize({type: 'pie', pieMargin: 10, title: '2009 Total Sales by Individual'});	
				$('table').visualize({type: 'line'});
				$('table').visualize({type: 'area'});
				$('table').visualize();
			});
		</script>
	</head>
	<body>	

<table >
	<caption>2009 Employee Sales by Department</caption>
	<thead>
		<tr>
			<td></td>
			<th>food</th>
			<th>auto</th>
			<th>household</th>
			<th>furniture</th>
			<th>kitchen</th>
			<th>bath</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Mary</th>
			<td>190</td>
			<td>0</td>
			<td>40</td>
			<td>120</td>
			<td>30</td>
			<td>-70</td>
		</tr>
		<tr>
			<th>Tom</th>
			<td>300</td>
			<td>400</td>
			<td>30</td>
			<td>45</td>
			<td>350</td>
			<td>49</td>
		</tr>
		<tr>
			<th>Brad</th>
			<td>10</td>
			<td>180</td>
			<td>10</td>
			<td>85</td>
			<td>25</td>
			<td>79</td>
		</tr>
		<tr>
			<th>Kate</th>
			<td>40</td>
			<td>80</td>
			<td>90</td>
			<td>25</td>
			<td>15</td>
			<td>119</td>
		</tr>		
	</tbody>
</table>
	</body>
</html>