<? require_once('login.php');

$sektor = $_POST['sektor_idsektor'];
$duedate = $_POST['duedate'] ?: date('d-m-Y');
$paydate = $_POST['paydate'] ?: date('d-m-Y');
$dsp = $_POST['dsp'] ?: 5000;
$kav = $_POST['kavling'] ?: '%';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>technosoft Indonesia</title>
    <link rel="stylesheet" type="text/css" href="css/style-page.css"/>
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/unitar.js"></script>

    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css"/>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" language="javascript">
        jQuery(function () {
            jQuery('input[name=duedate]').datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1990:2025",
                dateFormat: "dd-mm-yy"
            });
            jQuery('input[name=paydate]').datepicker({
                changeYear: true,
                changeMonth: true,
                yearRange: "1990:2025",
                dateFormat: "dd-mm-yy"
            });
        })
    </script>


</head>
<body>
<? include_once "header.php"; ?>
<div id="divSearch">
    <form id="unitar" method="POST" action="" name="unitar">
        <table class="header">
            <tr>
                <td>
                    Sektor :
                    <select id="sektor_idsektor" name="sektor_idsektor" onchange="this.form.submit()">
                        echo "
                        <option value="%">Semua</option>
                        ";
                        <? createsektoroption($sektor); ?>
                    </select>

                    Kavling : <input type="text" size="15" name="kavling" id="kavling" value="<? echo $kav; ?>"/>
                    Show :<select id="dsp" name="dsp" onchange="this.form.submit()">
                        <? createdisplayoption($dsp); ?>
                    </select>

                    <input class="button" type="submit" value="Tampilkan"/>&nbsp;&nbsp;
                    <input class="button" type="button" id="btncetak" value="Cetak"/>


                </td>
            </tr>
        </table>
    </form>
</div>
<div id="column1-wrap" style="width:550px;">
    <div id="divPageEntry"></div>
    <div id="divPageData"></div>
</div>
<div id="divLOV" style="width:450px;"></div>
<div id="clear"></div>


</body>
</html> 