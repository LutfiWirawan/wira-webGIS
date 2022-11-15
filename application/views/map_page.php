<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Script Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

		<!-- Script Legenda -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/leaflet.legend.css" />
    <script type="text/javascript" src="<?=base_url()?>assets/JavaScript/leaflet.legend.js"></script>

    <title>Wira WebGIS</title>

  </head>

  <body>

  	<!-- Image and text -->
		<nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="#">
		  	<div class="container">
		    <img src="<?=base_url()?>/assets/img/compass.svg" width="30" height="30" class="d-inline-block align-top" alt="">
		    Wira WebGIS
		    </div>
		  </a>
		</nav>

		<!-- Map View -->
		<div class="content">

			<div id="map" style="width: 100%; height: 600px;">
				<!-- /.content-wrapper -->
		  <footer class="main-footer">
		    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">ATR/BPN Kanwil Provinsi Jambi</a>.</strong>
		    All rights reserved.
		    <div class="float-right d-none d-sm-inline-block">
		      <b>Powered by</b> Leaflet.js
		    </div>
		  </footer>
			</div>


		</div>

		
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


		<!-- Script peta -->
		<script type="text/javascript">
						var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
							attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
								'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
								'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
							id: 'mapbox/streets-v11'
						});

						var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
							attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
								'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
								'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
							id: 'mapbox/satellite-v9'
						});


						var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
							attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
						});

						var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
							attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
								'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
								'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
							id: 'mapbox/dark-v10'
						});

				var map = L.map('map', {
				center: [-6.990087, 110.422303],
				zoom: 12,
				layers: [peta1]
				});

				var baseLayers = {
					'Streets': peta1,
					'Satellite': peta2,
					'OSM': peta3,
					'Dark': peta4
				};

				var overlays = {
					
				};

				var layerControl = L.control.layers(baseLayers).addTo(map);

				
				//Menampilkan GeoJSON
				<?php foreach ($peta as $key => $value) { ?>
						$.getJSON("<?=base_url('assets/geojson/'. $value -> geojson)?>", function(data) {
	        			geoLayer = L.geoJson(data, {
	            			style: function(feature) {
	            				return {
				            					fillOpacity: 0.5,
				                      weight: 1,
				                      opacity: 5,
				                      color: '#131413',  //Warna Hitam Untuk Batas
				                      fillColor:'<?= $value->warna?>', // Kode Warna dari Database
	            				};
	            			}
	            	}).addTo(map);
								
								geoLayer.eachLayer(function(layer){
									layer.bindPopup("Kecamatan: <?= $value->kecamatan?> <br>" +
												"Jumlah Penduduk: <?= $value->jumlah?> <br>" +
												"Kepadatan: <?= $value->kepadatan?> <br>" +
												"Sex ratio: <?= $value->ratio?> <br>" +
												"Luas Wilayah: <?= $value->luas?> <br>" +
												"<img src='<?= base_url('assets/img/'.$value->gambar)?>' width='200px'>"
												);
								});	            	

						});

				<?php } ?>

				//Marker Manual
				var icon_lokasi = L.icon({
              iconUrl: src="<?=base_url('assets/img/01marker.png')?>",
              iconSize: [30, 35]
          });

				L.marker([-6.990595, 110.422586], {icon:icon_lokasi}).addTo(map)
            .bindPopup('Simpang Lima')
            .openPopup();


        //Marker Database
        <?php foreach($marker as $key => $value) { ?>

        	var icon_marker = L.icon({
              iconUrl: src="<?=base_url('assets/img/' . $value->simbol)?>",
              iconSize: [30, 35]
          });

       		var lat = parseFloat('<?= $value->lat ?>');
       		var long = parseFloat('<?= $value->long ?>');


       		L.marker([lat, long], {icon:icon_marker}).addTo(map)
            .bindPopup("Nama: <?=$value->nama?> <br>" +
            						"Kategori: <?=$value->kategori?><br>" +
            						"Latitude: <?=$value->lat?> <br>" +
            						"Longitude: <?=$value->long?><br>" +
            						"<img src='<?= base_url('assets/img/'.$value->gambar)?>' width='200px'>"
            						)
            .openPopup();

        <?php } ?>

        //Legenda
        const legend = L.control.Legend({
            position: "bottomleft",
            collapsed: false,
            symbolWidth: 24,
            opacity: 1,
            column: 3,
            legends: [{
                label: "Gedung",
                type: "image",
                url: "<?= base_url('assets/img/gedung.png')?>",
            }, {
                label: "Tumbuhan",
                type: "image",
                url: "<?= base_url('assets/img/tumbuhan.png')?>",
            }, {
                label: "Museum",
                type: "image",
                url: "<?= base_url('assets/img/museum.png')?>",
            }, {
                label: "Wisata",
                type: "image",
                url: "<?= base_url('assets/img/wisata.png')?>"
            },{
                label: 'Kec Gunungpati',
                type: "rectangle",
                color: "#131413",
                fillColor: "#e4ed64",
                weight: 1,
            },{
                label: "Kec Mijen",
                type: "rectangle",
                margin: 100,
                color: "#131413",
                fillColor: "#88db65",
                weight: 1
            },{
                label: "Kec Tembalang",
                type: "rectangle",
                color: "#131413",
                fillColor: "#94a89a",
                weight: 1
            },{
                label: "Kec Banyumanik",
                type: "rectangle",
                color: "#131413",
                fillColor: "#edcb64",
                weight: 1
            },{
                label: "Kec Gajah Mungkur",
                type: "rectangle",
                color: "#131413",
                fillColor: "#ed9f64",
                weight: 1
            },{
                label: "Kec Semarang Selatan",
                type: "rectangle",
                color: "#131413",
                fillColor: "#ed6f64",
                weight: 1
            }]
        })
        .addTo(map);

      var legend2 = L.control({position: 'bottomright'});
      function style(feature) {
    	return {
      weight: 2,
      opacity: 1,
      color: 'white',
      dashArray: '3',
      fillOpacity: 0.7,
      fillColor: getColor(feature.properties.density)
		    };
		  }
     
      legend2.onAdd = function (map) {
      var div = L.DomUtil.create('div','info legend'),
      labels = ['"Peta ini bukan referensi resmi mengenai garis-garis batas bidang tanah','(tidak sesuai kadastral) administrasi nasional dan internasional"'];
      
      
      div.innerHTML = labels.join('<br>');
      return div;
		  };
		  legend2.addTo(map);

		</script>
		 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="https://in-ersia.com">Muhammad Lutfi Wirawan</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Powered by</b> Leaflet.js
    </div>
  </footer>
	
  </body>
  
</html>