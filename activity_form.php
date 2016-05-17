<?
include_once("config.php");

$action = "add";
$judul = "Penambahan Data";
$status = "Simpan";
$sql = "SELECT IFNULL(max(CAST(idactivity AS UNSIGNED)),0)+1  FROM activity";
$result = mysql_query($sql);
$data = mysql_fetch_array($result);
$idactivity = $data[0];
if (isset($_GET['action']) and $_GET['action'] == "update" and !empty($_GET['id'])) {
    $str = "select * from activity where idactivity = '$_GET[id]'";
    $res = mysql_query($str) or die("query gagal dijalankan");
    $data = mysql_fetch_assoc($res);
    $idactivity = $data['idactivity'];
    $activity = $data['activity'];
    $soptype_idsoptype = $data['soptype_idsoptype'];
    $unitact_idunitact = $data['unitact_idunitact'];
    $action = "update";
    $readonly = "readonly=readonly";
    $status = "Simpan";
    $judul = "Edit Data";
}
?>
<script type="text/javascript">

    $(function () {
        $("input#activity").focus();

        $("input").not($(":submit")).keypress(function (evt) {
            if (evt.keyCode == 13) {
                iname = $(this).val();
                if (iname !== 'Submit') {
                    var fields = $(this).parents('form:eq(0),body').find('button, input, textarea, select');
                    var index = fields.index(this);
                    if (index > -1 && (index + 1) < fields.length) {
                        fields.eq(index + 1).focus();
                    }
                    return false;
                }
            }
        });

        function loadData() {
            var dataString;
            var cari = $("input#fieldcari").val();
            var combo = $("select#pilihcari").val();

            if (combo == "idactivity") {
                dataString = 'idactivity=' + cari;
            }
            else if (combo == "activity") {
                dataString = 'activity=' + cari;
            }
            else if (combo == "soptype_idsoptype") {
                dataString = 'soptype_idsoptype=' + cari;
            }
            else if (combo == "unitact_idunitact") {
                dataString = 'unitact_idunitact=' + cari;
            }

            $.ajax({
                url: "activity_display.php",
                type: "GET",
                data: dataString,
                success: function (data) {
                    $('#divPageData').html(data);
                }
            });
        }

        $("form#activity_form").submit(function () {
            if (confirm("Apakah benar akan menyimpan data activity ini?")) {
                $.ajax({
                    url: "activity_process.php",
                    type: $(this).attr("method"), //metode yg digunakan sesuai pada form, dalam hal ini 'POST'
                    data: $(this).serialize(), //mengirim data secara serialize -- seluruh data input dikirim untuk diproses
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 2) // return nilai dari hasil proses
                        {
                            alert("Data berhasil diupdate!");
                            loadData(); //reload list data
                            $("#divPageEntry").load("activity_form.php");
                            $("#divPageEntry").hide();
                        }
                        else if (response.status == 1) {
                            alert("Data Baru berhasil disimpan!");
                            loadData(); //reload list data
                            //   window.location="activity_detail.php?id="+$("input#idslshdr").val();
                        }
                        else {
                            alert("Data gagal di simpan!");
                        }
                    }
                });
                //		return false;
            }
            //}
            return false;
        });
        $("#btnclose").click(function () {
            $("#divPageEntry").hide();
            $("#divLOV").hide();

            page3 = "activity_display.php";
            $("#divPageData").load(page3);
            $("#divPageData").show();
            return false;
        });
    });
</script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript">
    jQuery(function () {
        jQuery('input[name=rcv_date]').datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "1990:2025",
            dateFormat: "dd-mm-yy"
        });
    })
</script>
<form method="post" name="activity_form" action="" id="activity_form">
    <p class="judul">Form Memasukkan / Edit Data activity</p>
    <table>
        <tr>
            <th colspan="2"><b><?php echo $judul; ?></b></th>
        </tr>
        <?php if ($_GET['action'] == "update") { ?> <!-- //jika update maka textfield ID Pelanggan ditampilkan -->
            <tr>
                <td class="right">ID Aktifitas</td>
                <td><input type="text" id="idactivity" name="idactivity" size="10" <? echo $readonly; ?>
                           value="<? echo $idactivity; ?>"/></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td class="right">ID Aktifitas</td>
                <td><input type="text" id="idactivity" name="idactivity" size="10" value="<? echo $idactivity; ?>"/>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="right">Aktifitas</td>
            <td><input type="text" id="activity" name="activity" size="30" maxlength="45"
                       value="<? echo $activity; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Tipe SOP</td>
            <td><input type="text" id="soptype_idsoptype" name="soptype_idsoptype" size="30" maxlength="45"
                       value="<? echo $soptype_idsoptype; ?>"/></td>
        </tr>
        <tr>
            <td class="right">Aksi</td>
            <td><input type="text" id="unitact_idunitact" name="unitact_idunitact" size="30" maxlength="45"
                       value="<? echo $unitact_idunitact; ?>"/></td>
        </tr>
        <tr>
            <td><input class="button" type="submit" value="<? echo $status; ?>"></td>
            <td><input class="button" type="button" id="btnclose" value="Tutup Form"></td>
        </tr>
    </table>
    <input type="hidden" name="action" value="<? echo $action; ?>"/>
</form> 
