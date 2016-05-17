<script type="text/javascript">
    function pagination(page) {
        var dataString;
        var cari = $("select#sektor_idsektor").val();


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random();
        ;

        $.ajax({
            url: "unit_materialbudget_unitdisplay.php",
            data: dataString,
            type: "GET",
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    // fungsi untuk me-load tampilan list data unit, data yang ditampilkan disesuaikan
    // juga dengan input data pada bagian search
    function loadData() {
        var dataString;
        var cari = $("select#sektor_idsektor").val();


        dataString = 'starting=' + page + '&sektor_idsektor=' + cari + '&random=' + Math.random();
        ;


        $.ajax({
            url: "unit_materialbudget_unitdisplay.php", //file tempat pemrosesan permintaan (request)
            type: "GET",
            data: dataString,
            success: function (data) {
                $('#divPageData').html(data);
            }
        });
    }

    $(function () {
        // membuat warna tampilan baris data pada tabel menjadi selang-seling
        $('#unit tr:even:not(#nav):not(#total)').addClass('even');
        $('#unit tr:odd:not(#nav):not(#total)').addClass('odd');

        $("a.detail").click(function () {
            window.location = 'unit_detail.php';
        });

        $("a.edit").click(function () {
            page = $(this).attr("href");
            $("#divPageData").load(page); // me-load formpelanggan untuk melakukan edit data
            $("#divPageData").show();
            $("#btnhide").show();
            return false;
        });

        $("a.delete").click(function () {
            el = $(this);
            if (confirm("Apakah benar akan menghapus data unit ini?")) {
                $.ajax({
                    url: $(this).attr("href"),
                    type: "GET",
                    dataType: 'json', //respon yang diminta dalam format JSON
                    success: function (response) {
                        if (response.status == 1) {
                            loadData();
                            $("#divFormContent").load("unit_form.php");
                            $("#divFormContent").hide();
                            $("#btnhide").hide();
                            alert("Data unit berhasil di hapus!");
                        }
                        else {
                            alert("data unit gagal di hapus!");
                        }
                    }
                });
            }
            return false;
        });
        $(".wmd-view-topscroll").scroll(function () {
            $(".wmd-view")
                .scrollLeft($(".wmd-view-topscroll").scrollLeft());
        });
        $(".wmd-view").scroll(function () {
            $(".wmd-view-topscroll")
                .scrollLeft($(".wmd-view").scrollLeft());
        });

    });

</script>

<?php
// memanfaatkan class pagination dari Reneesh T.K 
include_once('config.php');
include_once('pagination_class.php');

$sektor_idsektor = $_GET['sektor_idsektor'];


if ($sektor_idsektor == '%') {
    $sql = "select * from unit  order by  kavling";
} else {
    $sql = "select * from unit where sektor_idsektor = '$sektor_idsektor' order by  kavling";
}


if (isset($_GET['starting'])) { //starting page
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}

$recpage = 10;//jumlah data yang ditampilkan per page(halaman) 
$obj = new pagination_class($sql, $starting, $recpage);
$result = $obj->result;
?>
<html>
<body>
<p class="judul">Daftar RAB Material Unit </p>
<table id="unit" class="grid">
    <tr>
        <th>Aksi</th>
        <th colspan=2>Sektor</th>
        <th>Unit</th>
        <th>Kavling</th>
        <th>Tipe</th>
        <th>Luas Tanah</th>
        <th>RAB</th>
        <th>Progress</th>
        <th>(%)</th>
        <th>Pemilik</th>
    </tr>
    <?php
    //menampilkan data unit
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) {
            $sektor = sektorinfo($row['sektor_idsektor']);
            $sektorname = $sektor['sektorname'];
            $idunit = $row['idunit'];

            $sql1 = "SELECT sum(price*budget_qty) jrab FROM unit_materialbudget where unit_idunit ='$idunit'";
            $result1 = mysql_query($sql1);
            $data1 = mysql_fetch_array($result1);
            $jrab = $data1[0];

            $sqlp = "SELECT sum(sales_price*qty) jprogress FROM slsdtlunit a, slshdrunit b where a.slshdrunit_idslshdr =b.idslshdr and unit_idunit ='$idunit' ";
            $resultp = mysql_query($sqlp);
            $datap = mysql_fetch_array($resultp);
            $jprogress = $datap[0];


            if ($jrab == 0) {
                $pct = 0;
            } else {
                $pct = $jprogress / $jrab * 100;
            }


            $pct = number_format($pct, $decimals = 2);

            ?>
            <tr>
                <td width=75px>
                    <a href="unit_materialbudget_detail.php?action=update&idunit=<? echo $row['idunit']; ?>"
                       class="detail"> <input type="button" class="button" value="RAB Unit"></a>

                </td>


                <td><? echo $row['sektor_idsektor']; ?></td>
                <td><? echo $sektorname; ?></td>
                <td><? echo $row['idunit']; ?></td>
                <td><? echo $row['kavling']; ?></td>
                <td><? echo $row['tipe']; ?></td>
                <td><? echo $row['luastanah']; ?></td>
                <td class="right"><? echo nf($jrab); ?></td>
                <td class="right"><? echo nf($jprogress); ?></td>
                <td><? echo $pct; ?></td>
                <td><? echo $row['owner']; ?></td>

            </tr>
        <? } //end while
        ?>
        <tr id="nav">
            <td colspan="5"><?php echo $obj->anchors; ?></td>
        </tr>
        <tr id="total">
            <td colspan="5"><?php echo $obj->total; ?></td>
        </tr>
    <? } else {
        ?>
        <tr>
            <td align="center" colspan="5">Data tidak ditemukan!</td>
        </tr>
    <? } ?>
</table>
</body>
</html>
	
