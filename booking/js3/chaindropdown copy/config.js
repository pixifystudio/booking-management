$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
	// Kita sembunyikan dulu untuk loadingnya
	$("#loading").hide();


	
	$("#jenisfoto").change(function(){ // Ketika user mengganti atau memilih data kategori
		// $("#subkategori").hide(); // Sembunyikan dulu combobox subkategori nya
		// // $("#loading").show(); // Tampilkan loadingnya
		// $("#subkategoriform").show(); // munculkan box subkategori
		$('#paket').attr('disabled', false);
		
	
		$.ajax({
			type: "POST", // Method pengiriman data bisa dengan GET atau POST
			url: "get_pilihan.php", // Isi dengan url/path file php yang dituju
			data: {kategori : $("#jenisfoto").val()}, // data yang akan dikirim ke file yang dituju
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},
			success: function(response){ // Ketika proses pengiriman berhasil
				// $("#loading").hide(); // Sembunyikan loadingnya

				// set isi dari combobox subkategori
				// lalu munculkan kembali combobox subkategorinya
				$("#paket").html(response.data_subkategori).show();
			},
			error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
				alert(thrownError); // Munculkan alert error
			}
		});
	});
	
});





