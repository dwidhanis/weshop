<?php

    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
    $data_per_halaman = 5;
    $mulai_dari = ($pagination-1) * $data_per_halaman;

    if($level == "superadmin"){
        $queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC
        LIMIT $mulai_dari, $data_per_halaman");
    }else{
        $queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY
        pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman");
    }

    if(mysqli_num_rows($queryPesanan) == 0){
        echo "<h3>Sorry, kamu belum melakukan pesanan</h3>";
    }else{
        echo "<table class='table-list'>
                <tr class='baris-title'>
                    <td class='kiri'>Nomor Pesanan</td>
                    <td class='kiri'>Status</td>
                    <td class='kiri'>Nama</td>
                    <td class='kiri'>Action</td>
                </tr>";
        
        $no=1 + $mulai_dari;

        $adminButton = "";
        while($row=mysqli_fetch_assoc($queryPesanan)){
            if($level == "superadmin"){
                $adminButton = "<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]'>Update Status</a>";
            }

            $status = $row['status'];
            echo "<tr>
                    <td class='kiri'>$row[pesanan_id]</td>
                    <td class='kiri'>$arrayStatusPesanan[$status]</td>
                    <td class='kiri'>$row[nama]</td>
                    <td class='kiri'>
                        <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'>Detail Pesanan</a>
                        $adminButton
                    </td>
                 </tr>";
        }

            echo "</table>";

            $queryHitungPesanan = mysqli_query($koneksi, "SELECT * FROM pesanan");
            pagination($queryHitungPesanan, $data_per_halaman, $pagination, "index.php?page=my_profile&module=pesanan&action=list");
    
    }