<h1 align="center">Data Peserta</h1>

<table border="1" class="table table-hover table-condensed table-bordered tabsen">
<tr>
	<td>ID</td>
	<td>Nama Lengkap</td>
	<td>Tempat, Tgl Lahir</td>
	<td>L/P</td>
	<td>Alamat</td>
	<td>No. HP</td>
	<td>Organisasi</td>
	<td>Notes</td>
	<td>Email</td>
	<td>Website</td>
</tr>

<?php 
include 'config.php';

// BEGIN -- Per Halaman --
require_once 'halaman.php';

$per_halaman = 5;
$halaman = new kelas_halaman($per_halaman);
// END -- Per Halaman --


$koneksi = mysql_connect($db_host, $db_user, $db_passwd);
if (!$koneksi) {
	die("Tidak dapat terhubung dengan basisdata :<br />" . mysql_error());
	# Tampilkan pesan error
} else {
	# Memilih basisdata
	$ambildbase = mysql_select_db($db_dbase);
	if (!$ambildbase) {
		# Tampilkan pesan Error
		die("Tidak dapat mengambil basisdata :<br />" . mysql_error());
	} else {
		$TheQuery = "SELECT * FROM $db_tabel";
		$hasil = mysql_query($TheQuery);
		if (!$hasil) {
			# Tampilkan pesan error (lagi)
			die("Tidak dapat melakukan query :<br />" . mysql_error());
		} else {
			// BEGIN -- Per Halaman --
			$jum_baris = mysql_num_rows($hasil);
			$halaman->tentukan_total_baris($jum_baris);
			$awal_record = $halaman->peroleh_awal_record();
			
			$newQuery = "SELECT * FROM $db_tabel " . "LIMIT $awal_record, $per_halaman";
			$hasil = mysql_query($newQuery);
			
			$nomor = $awal_record;
			
			// END -- Per Halaman --
			
			# Tampilkan data
			while ($PerBaris = mysql_fetch_row($hasil)) {
				# Tampilkan data per baris
				// echo "Nama Lengkap : " . $PerBaris[1] . "<br />";
				// echo "Nomor HP : " . $PerBaris[5] . "<br />";
				echo "<tr><td>". $PerBaris[0];
				// if ($panjang = mysql_num_rows($hasil)) {
				// # code...
				// 	for ($i=1 ; $i <= $panjang ; $i++ ) { 
				// 		# code...
				// 		echo($i);
				// 	}	
				// }
			echo "</td><td>". $PerBaris[1] ."</td><td>". $PerBaris[2] .", " . date('d-m-Y',  strtotime($PerBaris[3])) . "</td><td>". $PerBaris[12] ."</td><td>". $PerBaris[4] ."</td><td>". $PerBaris[5] ."</td><td>". $PerBaris[6] ."</td><td>". $PerBaris[7] ."</td><td>". $PerBaris[10] ."</td><td>". $PerBaris[11] ."</td></tr>";	
			}
			
		}
		
	}
}
echo "</table><br />";

// Tampilkan Link Halaman
$halaman->tampilkan_link_halaman();

if ($panjang = mysql_num_rows($hasil)) {
	# code...
	echo "Jumlah Total : " . $panjang . "<br />";
}

mysql_close($koneksi);

echo "Data diambil : ";
echo date('d M Y H:i:s') . " WIB";

 ?>
