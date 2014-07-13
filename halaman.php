<?php
/*
 * halaman.php
 * 
 * Copyright 2014 Samsul Ma'arif <samsul@samsul.web.id>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<?php
class kelas_halaman
{
	// property
	var $halaman_sekarang;
	var $jumlah_data;
	var $jumlah_halaman;
	var $baris_per_halaman;
	var $jum_baris_per_hal;
	
	// konstruktor
	function kelas_halaman($jum_baris_per_hal)
	{
		$this->baris_per_halaman = $jum_baris_per_hal;
		
		$this->halaman_sekarang = $_GET['page'];
		if (empty($this->halaman_sekarang))
			$this->halaman_sekarang = 1;
	}
	
	function tentukan_total_baris($jumlah)
	{
		$this->jumlah_data = $jumlah;
		$this->jumlah_halaman = ceil($jumlah / $this->baris_per_halaman);
		
	}
	
	function peroleh_awal_record()
	{
		$awal_record = ($this->halaman_sekarang - 1) * $this->baris_per_halaman;
		return $awal_record;
	}
	
	function tampilkan_link_halaman()
	{
		if ($this->jumlah_halaman > 1)
		{
			print("Halaman: ");
			for ($hal = 1; $hal <= $this->jumlah_halaman; $hal++)
			{
				if ($hal == $this->halaman_sekarang)
					echo "$hal |";
				else
				{
					$nama_skrip = $_SERVER['PHP_SELF'];
					
					echo "<a href=\"$nama_skrip?page=$hal\"" . ">$hal</a> | \n";
				}
			}
		}
	}
}

?>
