<?php

$level = '';
$time = '';

if ($student['cert_level'] == 'DVM') {
    $level = "DIPLOMA";
    $time = "10.30 Pagi - 01.00 Tengah hari";
} else {
    $time = "08.00 Pagi - 10.30 Pagi";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT TAWARAN KOLEJ KEDIAMAN</title>
</head>
<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11pt;
    }
</style>

<body>

    <div class="container">
        <table>
            <tr>
                <td>
                    <img src="https://ekokedi.kvkualaselangor.com/images/kvksL.png" style="width:700px;" alt="">

                </td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    Ruj. Kami : KVKS.700-1/2/1(3)<br />
                    Tarikh :
                    <?= $newDateMalay ?>
                </td>
            </tr>
            <tr>
                <td>
                    NAMA PELAJAR : <b>
                        <?= $student['name'] ?>
                    </b><br />
                    NO. KAD PENGENALAN : <b>
                        <?= $student['nokp'] ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td><br />Tuan/Puan,</td>
            </tr>
            <tr>
                <td>
                    <b><br />TAWARAN KEMASUKAN KOLEJ KEDIAMAN KOLEJ VOKASIONAL KUALA SELANGOR</b>
                </td>
            </tr>
            <tr>
                <td>
                    Sukacita dimaklumkan bahawa anda telah ditawarkan penempatan di Kolej Kediaman :
                </td>
            </tr>
            <tr>
                <br />
                <table cellpadding="10" cellspacing="0">
                    <tr>
                        <td style="font-weight:bold;">NAMA INSTITUSI</td>
                        <td>:</td>
                        <td>Kolej Vokasional Kuala Selangor</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">ALAMAT</td>
                        <td>:</td>
                        <td>45600, Bestari Jaya, Selangor Darul Ehsan</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">PROGRAM</td>
                        <td>:</td>
                        <td>
                            <?= $level . ' ' . $student['programme_name'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">TARIKH LAPOR DIRI</td>
                        <td>:</td>
                        <td>1 Januari 2024</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">MASA</td>
                        <td>:</td>
                        <td>
                            <?= $time ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">BILIK</td>
                        <td>:</td>
                        <td>
                            <?= $student['room_name'] ?>
                        </td>
                    </tr>
                </table>
            </tr>
            <tr>
                <td style="text-align:justify;">
                    <br />
                    Sekiranya saudara/i didapati memberi maklumat salah/tidak benar/memanipulasi maklumat dan tidak
                    memenuhi syarat kemasukan, pihak kolej berhak menarik balik tawaran kemasukan saudara/i dengan serta
                    merta walaupun setelah ditawarkan tempat
                </td>
            </tr>
            <tr>
                <td style="text-align:justify;">
                    <br />
                    Tawaran ini adalah muktamad dan saudara/i tidak dibenarkan menukar atau menangguh kemasukan.
                    Menangguh kemasukan dianggap menolak tawaran
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    Sekian, Terima Kasih
                </td>
            </tr>
            <tr>
                <td>
                    <br/>
                    <b>"MALAYSIA MADANI"</b>
                    <br /><br/>
                    <b>"BERKHIDMAT UNTUK NEGARA"</b><br /><br />
                    Saya yang menjalankan amanah <br /><br />
                    <b>Pengarah</b> <br />
                    Kolej Vokasional Kuala Selangor<br />
                    45600 Bestari Jaya<br />
                    Selangor Darul Ehsan
                </td>
            </tr>
            <tr>
                <td style="text-align:center;">
                    <br />
                    <br />
                    <em style='color:red;'>* Surat ini adalah cetakan komputer, tiada tandatangan diperlukan</em>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>