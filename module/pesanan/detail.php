<?php

    $pesanan_id = $_GET["pesanan_id"];

    $query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif 
                                    FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

    $row=mysqli_fetch_assoc($query);

    $tanggal_pemesanan = $row['tanggal_pemesanan'];
    $nama_penerima = $row['nama_penerima'];
    $nomor_telepon = $row['nomor_telepon'];
    $alamat = $row['alamat'];
    $tarif = $row['tarif'];
    $nama = $row['nama'];
    $kota = $row['kota'];
    
?>

<div id="frame-faktur">

    <h3><center>Detail Pesanan</center></h3>

    <table>

        <tr>
            <td>Nomor Faktur</td>
            <td>:</td>
            <td><?php echo $pesanan_id; ?></td>
        </tr>
        <tr>
            <td>Nomor Pemesan</td>
            <td>:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Nomor Penerima</td>
            <td>:</td>
            <td><?php echo $nama_penerima; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $alamat; ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><?php echo $nomor_telepon; ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_pemesanan; ?></td>
        </tr>

    </table>

</div>

    <table class="table-list"> 
        <tr class="baris-title">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th class="kanan">Harga Satuan</th>
            <th class="kanan">Total</th>
        </tr>
    
        <?php

            $queryDetail = mysqli_query($koneksi, "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id
            WHERE pesanan_detail.pesanan_id='$pesanan_id'");

            $no = 1;
            $subtotal = 0;
            while($rowDetail=mysqli_fetch_assoc($queryDetail)){
                $total = $rowDetail["harga"] * $rowDetail["quantity"];
                $subtotal = $subtotal + $total;

                echo "<tr>
                        <td class='no'>$no</td>
                        <td class='kiri'>$rowDetail[nama_barang]</td>
                        <td class='tengah'>$rowDetail[quantity]</td>
                        <td class='kanan'>".rupiah($rowDetail["harga"])."</td>
                        <td class='kanan'>".rupiah($total)."</td>
                     </tr>";

                $no++;
            }

            $subtotal = $subtotal + $tarif;
        ?>

        <tr>
            <td class="kanan" colspan="4">Biaya Pengiriman</td>
            <td class="kanan"><?php echo rupiah($tarif); ?></td>
        </tr>

        <tr>
            <td class="kanan" colspan="4"><b>Sub Total</b></td>
            <td class="kanan"><?php echo rupiah($subtotal); ?></td>
        </tr>
    
    </table>

    <div id="frame-keterangan-pembayaran">
            <p>Silahkan lakukan pembayaran ke rekening BCA berikut ini:<br/>
                Nomor Account : 0000-222-333 (a/n Dwi Dhanis).<br/>
                Setelah melakukan pembayaran silahkan lakukan konfirmasi pembayaran
                <a href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini</a>
            </p>
    </div>