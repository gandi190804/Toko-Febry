<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="css/leaflet.css">
    <link rel="stylesheet" href="css/L.Control.Layers.Tree.css">
    <link rel="stylesheet" href="css/L.Control.Locate.min.css">
    <link rel="stylesheet" href="css/qgis2web.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/leaflet-search.css">
    <link rel="stylesheet" href="css/leaflet-control-geocoder.Geocoder.css">
    <style>
        .spaced b {
            margin-right: 5px;
            /* atau jumlah yang diinginkan */
        }

        #map,
        body,
        html {
            width: 100%;
            height: 100%;
        }

        @media (min-width: 577px) {
            .centered-div {
                margin-top: 2%;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 1595px;
                height: 685px;
                background-color: lightblue;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }

        @media (max-width: 576px) {
            .centered-div {
                margin-top: 7%;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 400px;
                height: 775px;
                background-color: lightblue;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
    <title>Lokasi</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body style="font-family: Poppins, sans-serif;">
    <nav class="navbar z-3 shadow-sm p-3 position-sticky top-0 start-0 end-0 gap-3 flex-nowrap rounded-bottom-4" style="background-color: #03C3EC;">
        <div class="w-100 d-block">
            <div class="row justify-content-between">
                <div class="col-auto d-flex align-items-center gap-3">
                    <button class="navbar-toggler py-1 px-2 btn-sm bg-secondary-subtle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="border: none; outline: none; box-shadow: none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <h1 class="m-0" style="font-weight: 600; font-size: 22px;">Lokasi</h1>
                </div>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="../image/logo.svg" alt="" style="width: 150px" />
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 gap-2">
                            <li class="nav-item bg-secondary-subtle rounded">
                                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../dashboard/">
                                    <i class="fa-solid fa-house"></i> Dasbor
                                </a>
                            </li>
                            <li class="nav-item dropdown bg-secondary-subtle rounded">
                                <a class="nav-link dropdown-toggle p-2 d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-book me-1"></i>
                                        <span>Pencatatan</span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu bg-secondary-subtle">
                                    <li><a class="dropdown-item" href="../pencatatan/pencatatan-masuk.php">Pemasukan</a></li>
                                    <li><a class="dropdown-item" href="../pencatatan/pencatatan-keluar.php">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li class="nav-item bg-secondary-subtle rounded">
                                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../menu/">
                                    <i class="fa-solid fa-burger"></i>Menu</a>
                            </li>
                            <li class="nav-item dropdown bg-secondary-subtle rounded">
                                <a class="nav-link dropdown-toggle p-2 d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid fa-clock-rotate-left" style="margin-right: 2px"></i>
                                        <span>Riwayat</span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu bg-secondary-subtle">
                                    <li><a class="dropdown-item" href="../pencatatan/riwayat/riwayat-masuk.php">Pemasukan</a></li>
                                    <li><a class="dropdown-item" href="../pencatatan/riwayat/riwayat-keluar.php">Pengeluaran</a></li>
                                </ul>
                            </li>
                            <li class="nav-item bg-secondary-subtle rounded">
                                <a class="nav-link p-2 d-flex align-items-center gap-3" href="#">
                                    <i class="fa-solid fa-location-dot me-1"></i> Lokasi</a>
                            </li>
                            <li class="nav-item bg-secondary-subtle rounded">
                                <a class="nav-link p-2 d-flex align-items-center gap-3" href="../user/pengaturan.php">
                                    <i class="fa-solid fa-gear me-1"></i> Pengaturan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </nav>


    <div class="centered-div">
        <div class="z-0" id="map">
            <script src="js/qgis2web_expressions.js"></script>
            <script src="js/leaflet.js"></script>
            <script src="js/L.Control.Layers.Tree.min.js"></script>
            <script src="js/L.Control.Locate.min.js"></script>
            <script src="js/leaflet.rotatedMarker.js"></script>
            <script src="js/leaflet.pattern.js"></script>
            <script src="js/leaflet-hash.js"></script>
            <script src="js/Autolinker.min.js"></script>
            <script src="js/rbush.min.js"></script>
            <script src="js/labelgun.min.js"></script>
            <script src="js/labels.js"></script>
            <script src="js/leaflet-control-geocoder.Geocoder.js"></script>
            <script src="js/leaflet-search.js"></script>
            <script src="data/ADMINISTRASIDESA_AR_25K_1.js"></script>
            <script src="data/Datadatadistributor_2.js"></script>
            <script>
                var highlightLayer;

                function highlightFeature(e) {
                    highlightLayer = e.target;

                    if (e.target.feature.geometry.type === 'LineString' || e.target.feature.geometry.type === 'MultiLineString') {
                        highlightLayer.setStyle({
                            color: '#ffff00',
                        });
                    } else {
                        highlightLayer.setStyle({
                            fillColor: '#ffff00',
                            fillOpacity: 1
                        });
                    }
                }
                var map = L.map('map', {
                    zoomControl: true,
                    maxZoom: 28,
                    minZoom: 1
                }).fitBounds([
                    [-6.665628837024768, 106.6729506656811],
                    [-6.534378834692488, 106.92676683276224]
                ]);
                var hash = new L.Hash(map);
                map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
                var autolinker = new Autolinker({
                    truncate: {
                        length: 30,
                        location: 'smart'
                    }
                });

                function removeEmptyRowsFromPopupContent(content, feature) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    var rows = tempDiv.querySelectorAll('tr');
                    for (var i = 0; i < rows.length; i++) {
                        var td = rows[i].querySelector('td.visible-with-data');
                        var key = td ? td.id : '';
                        if (td && td.classList.contains('visible-with-data') && feature.properties[key] == null) {
                            rows[i].parentNode.removeChild(rows[i]);
                        }
                    }
                    return tempDiv.innerHTML;
                }
                document.querySelector(".leaflet-popup-pane").addEventListener("load", function(event) {
                    var tagName = event.target.tagName,
                        popup = map._popup;
                    // Also check if flag is already set.
                    if (tagName === "IMG" && popup && !popup._updated) {
                        popup._updated = true; // Set flag to prevent looping.
                        popup.update();
                    }
                }, true);
                L.control.locate({
                    locateOptions: {
                        maxZoom: 19
                    }
                }).addTo(map);
                var bounds_group = new L.featureGroup([]);

                function setBounds() {}
                map.createPane('pane_OpenStreetMap_0');
                map.getPane('pane_OpenStreetMap_0').style.zIndex = 400;
                var layer_OpenStreetMap_0 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    pane: 'pane_OpenStreetMap_0',
                    opacity: 1.0,
                    attribution: '',
                    minZoom: 1,
                    maxZoom: 28,
                    minNativeZoom: 0,
                    maxNativeZoom: 19
                });
                layer_OpenStreetMap_0;
                map.addLayer(layer_OpenStreetMap_0);

                function pop_ADMINISTRASIDESA_AR_25K_1(feature, layer) {
                    layer.on({
                        mouseout: function(e) {
                            for (var i in e.target._eventParents) {
                                if (typeof e.target._eventParents[i].resetStyle === 'function') {
                                    e.target._eventParents[i].resetStyle(e.target);
                                }
                            }
                        },
                        mouseover: highlightFeature,
                    });
                    var popupContent = '<table>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDPPUM'] !== null ? autolinker.link(feature.properties['KDPPUM'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['NAMOBJ'] !== null ? autolinker.link(feature.properties['NAMOBJ'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['REMARK'] !== null ? autolinker.link(feature.properties['REMARK'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDPBPS'] !== null ? autolinker.link(feature.properties['KDPBPS'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['FCODE'] !== null ? autolinker.link(feature.properties['FCODE'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['LUASWH'] !== null ? autolinker.link(feature.properties['LUASWH'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['UUPP'] !== null ? autolinker.link(feature.properties['UUPP'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['SRS_ID'] !== null ? autolinker.link(feature.properties['SRS_ID'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['LCODE'] !== null ? autolinker.link(feature.properties['LCODE'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['METADATA'] !== null ? autolinker.link(feature.properties['METADATA'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDEBPS'] !== null ? autolinker.link(feature.properties['KDEBPS'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDEPUM'] !== null ? autolinker.link(feature.properties['KDEPUM'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDCBPS'] !== null ? autolinker.link(feature.properties['KDCBPS'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDCPUM'] !== null ? autolinker.link(feature.properties['KDCPUM'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDBBPS'] !== null ? autolinker.link(feature.properties['KDBBPS'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['KDBPUM'] !== null ? autolinker.link(feature.properties['KDBPUM'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WADMKD'] !== null ? autolinker.link(feature.properties['WADMKD'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WIADKD'] !== null ? autolinker.link(feature.properties['WIADKD'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WADMKC'] !== null ? autolinker.link(feature.properties['WADMKC'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WIADKC'] !== null ? autolinker.link(feature.properties['WIADKC'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WADMKK'] !== null ? autolinker.link(feature.properties['WADMKK'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WIADKK'] !== null ? autolinker.link(feature.properties['WIADKK'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WADMPR'] !== null ? autolinker.link(feature.properties['WADMPR'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['WIADPR'] !== null ? autolinker.link(feature.properties['WIADPR'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['TIPADM'] !== null ? autolinker.link(feature.properties['TIPADM'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['SHAPE_Leng'] !== null ? autolinker.link(feature.properties['SHAPE_Leng'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['SHAPE_Area'] !== null ? autolinker.link(feature.properties['SHAPE_Area'].toLocaleString()) : '') + '</td>\
                            </tr>\
                        </table>';
                    layer.bindPopup(popupContent, {
                        maxHeight: 400
                    });
                    var popup = layer.getPopup();
                    var content = popup.getContent();
                    var updatedContent = removeEmptyRowsFromPopupContent(content, feature);
                    popup.setContent(updatedContent);
                }

                function style_ADMINISTRASIDESA_AR_25K_1_0(feature) {

                }
                map.createPane('pane_ADMINISTRASIDESA_AR_25K_1');

                map.getPane('pane_ADMINISTRASIDESA_AR_25K_1').style['mix-blend-mode'] = 'normal';
                var layer_ADMINISTRASIDESA_AR_25K_1 = new L.geoJson(json_ADMINISTRASIDESA_AR_25K_1, {
                    attribution: '',
                    interactive: true,
                    dataVar: 'json_ADMINISTRASIDESA_AR_25K_1',
                    layerName: 'layer_ADMINISTRASIDESA_AR_25K_1',
                    pane: 'pane_ADMINISTRASIDESA_AR_25K_1',
                    onEachFeature: pop_ADMINISTRASIDESA_AR_25K_1,
                    style: style_ADMINISTRASIDESA_AR_25K_1_0,
                });



                function pop_Datadatadistributor_2(feature, layer) {
                    layer.on({
                        mouseout: function(e) {
                            for (var i in e.target._eventParents) {
                                if (typeof e.target._eventParents[i].resetStyle === 'function') {
                                    e.target._eventParents[i].resetStyle(e.target);
                                }
                            }
                        },
                        mouseover: highlightFeature,
                    });
                    var popupContent = '<table>\
                            <tr>\
                                <td colspan=2><h3>' + (feature.properties['Nama'] !== null ? autolinker.link(feature.properties['Nama'].toLocaleString()) : '') + '<h3></td>\
                            </tr>\
                            <tr>\
                                <th scope="row">Alamat</th>\
                                <td class="spaced"><b>:</b>' + (feature.properties['Alamat'] !== null ? autolinker.link(feature.properties['Alamat'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <th scope="row">Lattitude</th>\
                                <td class="spaced"><b>:</b>' + (feature.properties['Lattitude'] !== null ? autolinker.link(feature.properties['Lattitude'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <th scope="row">Longitude</th>\
                                <td class="spaced"><b>:</b>' + (feature.properties['Longitude'] !== null ? autolinker.link(feature.properties['Longitude'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <th scope="row">Jam Buka</th>\
                                <td class="spaced"><b>:</b>' + (feature.properties['Jam Buka'] !== null ? autolinker.link(feature.properties['Jam Buka'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <th scope="row">Keterangan</th>\
                                <td class="spaced"><b>:</b>' + (feature.properties['Keterangan'] !== null ? autolinker.link(feature.properties['Keterangan'].toLocaleString()) : '') + '</td>\
                            </tr>\
                            <tr>\
                                <td colspan="2">' + (feature.properties['Foto'] !== null ? '<img style="height: 200px; weight:300px" src="images/' + String(feature.properties['Foto']).replace(/[\\\/:]/g, '_').trim() + '">' : '') + '</td>\
                            </tr>\
                        </table>';
                    layer.bindPopup(popupContent, {
                        maxHeight: 400
                    });
                    var popup = layer.getPopup();
                    var content = popup.getContent();
                    var updatedContent = removeEmptyRowsFromPopupContent(content, feature);
                    popup.setContent(updatedContent);
                }

                function style_Datadatadistributor_2_0(feature) {
                    switch (String(feature.properties['Nama'])) {
                        case 'Pabrik Kerupuk Anugrah':
                            return {
                                pane: 'pane_Datadatadistributor_2',
                                    rotationAngle: -0.00872665,
                                    rotationOrigin: 'center center',
                                    icon: L.icon({
                                        iconUrl: 'markers/Datadatadistributor_2.svg',
                                        iconSize: [57.0, 57.0]
                                    }),
                                    interactive: true,
                            }
                            break;
                        case 'Toko Gloria':
                            return {
                                pane: 'pane_Datadatadistributor_2',
                                    rotationAngle: -0.00872665,
                                    rotationOrigin: 'center center',
                                    icon: L.icon({
                                        iconUrl: 'markers/Datadatadistributor_2.svg',
                                        iconSize: [57.0, 57.0]
                                    }),
                                    interactive: true,
                            }
                            break;
                        case 'Toko Kue Febri Lestari':
                            return {
                                pane: 'pane_Datadatadistributor_2',
                                    rotationAngle: -0.00872665,
                                    rotationOrigin: 'center center',
                                    icon: L.icon({
                                        iconUrl: 'markers/Datadatadistributor_2.svg',
                                        iconSize: [57.0, 57.0]
                                    }),
                                    interactive: true,
                            }
                            break;
                        case 'Toko Kue Glosir Hosana':
                            return {
                                pane: 'pane_Datadatadistributor_2',
                                    rotationAngle: -0.00872665,
                                    rotationOrigin: 'center center',
                                    icon: L.icon({
                                        iconUrl: 'markers/Datadatadistributor_2.svg',
                                        iconSize: [57.0, 57.0]
                                    }),
                                    interactive: true,
                            }
                            break;
                        default:
                            return {
                                pane: 'pane_Datadatadistributor_2',
                                    rotationAngle: -0.00872665,
                                    rotationOrigin: 'center center',
                                    icon: L.icon({
                                        iconUrl: 'markers/Datadatadistributor_2.svg',
                                        iconSize: [57.0, 57.0]
                                    }),
                                    interactive: true,
                            }
                            break;
                    }
                }
                map.createPane('pane_Datadatadistributor_2');
                map.getPane('pane_Datadatadistributor_2').style.zIndex = 402;
                map.getPane('pane_Datadatadistributor_2').style['mix-blend-mode'] = 'normal';
                var layer_Datadatadistributor_2 = new L.geoJson(json_Datadatadistributor_2, {
                    attribution: '',
                    interactive: true,
                    dataVar: 'json_Datadatadistributor_2',
                    layerName: 'layer_Datadatadistributor_2',
                    pane: 'pane_Datadatadistributor_2',
                    onEachFeature: pop_Datadatadistributor_2,
                    pointToLayer: function(feature, latlng) {
                        var context = {
                            feature: feature,
                            variables: {}
                        };
                        return L.marker(latlng, style_Datadatadistributor_2_0(feature));
                    },
                });
                bounds_group.addLayer(layer_Datadatadistributor_2);
                map.addLayer(layer_Datadatadistributor_2);
                var osmGeocoder = new L.Control.Geocoder({
                    collapsed: true,
                    position: 'topleft',
                    text: 'Search',
                    title: 'Testing'
                }).addTo(map);
                document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
                    .className += ' fa fa-search';
                document.getElementsByClassName('leaflet-control-geocoder-icon')[0]
                    .title += 'Search for a place';
                var baseMaps = {};
                var overlaysTree = [{
                        label: 'Data — datadistributor<br /><table><tr><td style="text-align: center;"><img src="legend/Datadatadistributor_2_PabrikKerupukAnugrah0.png" /></td><td>Pabrik Kerupuk Anugrah</td></tr><tr><td style="text-align: center;"><img src="legend/Datadatadistributor_2_TokoGloria1.png" /></td><td>Toko Gloria</td></tr><tr><td style="text-align: center;"><img src="legend/Datadatadistributor_2_TokoKueFebriLestari2.png" /></td><td>Toko Kue Febri Lestari</td></tr><tr><td style="text-align: center;"><img src="legend/Datadatadistributor_2_TokoKueGlosirHosana3.png" /></td><td>Toko Kue Glosir Hosana</td></tr><tr><td style="text-align: center;"><img src="legend/Datadatadistributor_2_4.png" /></td><td></td></tr></table>',
                        layer: layer_Datadatadistributor_2
                    },
                    {
                        label: 'ADMINISTRASIDESA_AR_25K<br /><table><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Watesjaya0.png" /></td><td>Watesjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Warungmenteng1.png" /></td><td>Warungmenteng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Waringinjaya2.png" /></td><td>Waringinjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tugujaya3.png" /></td><td>Tugujaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tonjong4.png" /></td><td>Tonjong</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tenjolaya5.png" /></td><td>Tenjolaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Telukpinang6.png" /></td><td>Telukpinang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tegalwaru7.png" /></td><td>Tegalwaru</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tegalgundil8.png" /></td><td>Tegalgundil</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tegalega9.png" /></td><td>Tegalega</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tanjungsari10.png" /></td><td>Tanjungsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tangkil11.png" /></td><td>Tangkil</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tanahsareal12.png" /></td><td>Tanahsareal</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_TanahBaru13.png" /></td><td>Tanah Baru</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tamansari14.png" /></td><td>Tamansari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tajurhalang15.png" /></td><td>Tajurhalang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Tajur16.png" /></td><td>Tajur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sumurbatu17.png" /></td><td>Sumurbatu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukawening18.png" /></td><td>Sukawening</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukatani19.png" /></td><td>Sukatani</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukasari20.png" /></td><td>Sukasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukaresmi21.png" /></td><td>Sukaresmi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukaraharja22.png" /></td><td>Sukaraharja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukamantri23.png" /></td><td>Sukamantri</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukamakmur24.png" /></td><td>Sukamakmur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukamaju25.png" /></td><td>Sukamaju</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukamahi26.png" /></td><td>Sukamahi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukaluyu27.png" /></td><td>Sukaluyu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukajaya28.png" /></td><td>Sukajaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukahati29.png" /></td><td>Sukahati</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukaharja30.png" /></td><td>Sukaharja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sukadamai31.png" /></td><td>Sukadamai</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Srogol32.png" /></td><td>Srogol</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Situgede33.png" /></td><td>Situgede</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Situdaun34.png" /></td><td>Situdaun</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_SituUdik35.png" /></td><td>Situ Udik</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_SituIlir36.png" /></td><td>Situ Ilir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sirnagalih37.png" /></td><td>Sirnagalih</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sindangsari38.png" /></td><td>Sindangsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sindangrasa39.png" /></td><td>Sindangrasa</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sindangbarang40.png" /></td><td>Sindangbarang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sinarsari41.png" /></td><td>Sinarsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sentul42.png" /></td><td>Sentul</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sempur43.png" /></td><td>Sempur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_SemplakBarat44.png" /></td><td>Semplak Barat</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Semplak45.png" /></td><td>Semplak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Sanja46.png" /></td><td>Sanja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ranggamekar47.png" /></td><td>Ranggamekar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Rancamaya48.png" /></td><td>Rancamaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Rancabungur49.png" /></td><td>Rancabungur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Rabak50.png" /></td><td>Rabak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Purwasari51.png" /></td><td>Purwasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Petir52.png" /></td><td>Petir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirmuncang53.png" /></td><td>Pasirmuncang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirmulya54.png" /></td><td>Pasirmulya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirlaja55.png" /></td><td>Pasirlaja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirkuda56.png" /></td><td>Pasirkuda</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirjaya57.png" /></td><td>Pasirjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirjambu58.png" /></td><td>Pasirjambu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirgaok59.png" /></td><td>Pasirgaok</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasireurih60.png" /></td><td>Pasireurih</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirbuncir61.png" /></td><td>Pasirbuncir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasirangin62.png" /></td><td>Pasirangin</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasiraja63.png" /></td><td>Pasiraja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pasawahan64.png" /></td><td>Pasawahan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Parakanjaya65.png" /></td><td>Parakanjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Parakan66.png" /></td><td>Parakan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pandansari67.png" /></td><td>Pandansari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pancawati68.png" /></td><td>Pancawati</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Panaragan69.png" /></td><td>Panaragan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pamoyanan70.png" /></td><td>Pamoyanan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Paledang71.png" /></td><td>Paledang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Palasari72.png" /></td><td>Palasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pakuan73.png" /></td><td>Pakuan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pagelaran74.png" /></td><td>Pagelaran</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Padasuka75.png" /></td><td>Padasuka</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pabuaran76.png" /></td><td>Pabuaran</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Pabaton77.png" /></td><td>Pabaton</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Neglasari78.png" /></td><td>Neglasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Nanggewermekar79.png" /></td><td>Nanggewermekar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Nanggewer80.png" /></td><td>Nanggewer</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Nagrak81.png" /></td><td>Nagrak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Mulyaharja82.png" /></td><td>Mulyaharja</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Muarasari83.png" /></td><td>Muarasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Muarajaya84.png" /></td><td>Muarajaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Menteng85.png" /></td><td>Menteng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Mekarwangi86.png" /></td><td>Mekarwangi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Mekarsari87.png" /></td><td>Mekarsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Mekarjaya88.png" /></td><td>Mekarjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Margajaya89.png" /></td><td>Margajaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Loji90.png" /></td><td>Loji</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Leuwinutug91.png" /></td><td>Leuwinutug</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Leuwimekar92.png" /></td><td>Leuwimekar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Leuwiliang93.png" /></td><td>Leuwiliang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Leuwibatu94.png" /></td><td>Leuwibatu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Leuwengkolot95.png" /></td><td>Leuwengkolot</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Lemahduhur96.png" /></td><td>Lemahduhur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Lawanggintung97.png" /></td><td>Lawanggintung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Laladon98.png" /></td><td>Laladon</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kotabatu99.png" /></td><td>Kotabatu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kertamaya100.png" /></td><td>Kertamaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Keradenan101.png" /></td><td>Keradenan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kencana102.png" /></td><td>Kencana</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kemang103.png" /></td><td>Kemang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kedungwaringin104.png" /></td><td>Kedungwaringin</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kedungjaya105.png" /></td><td>Kedungjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kedunghalang106.png" /></td><td>Kedunghalang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kedungbadak107.png" /></td><td>Kedungbadak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kebonpedes108.png" /></td><td>Kebonpedes</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kebonkalapa109.png" /></td><td>Kebonkalapa</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kayumanis110.png" /></td><td>Kayumanis</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Katulampa111.png" /></td><td>Katulampa</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Karihkil112.png" /></td><td>Karihkil</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Karehkel113.png" /></td><td>Karehkel</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_KarangasemTimur114.png" /></td><td>Karangasem Timur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Karacak115.png" /></td><td>Karacak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Kadumanggu116.png" /></td><td>Kadumanggu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Jambuliwuk117.png" /></td><td>Jambuliwuk</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Harjasari118.png" /></td><td>Harjasari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Hambalang119.png" /></td><td>Hambalang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gunungmenyan120.png" /></td><td>Gunungmenyan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gununggeulis121.png" /></td><td>Gununggeulis</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gunungbatu122.png" /></td><td>Gunungbatu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gudang123.png" /></td><td>Gudang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gobang124.png" /></td><td>Gobang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Girimulya125.png" /></td><td>Girimulya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gimulang126.png" /></td><td>Gimulang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Genteng127.png" /></td><td>Genteng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Galunga128.png" /></td><td>Galunga</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Gadog129.png" /></td><td>Gadog</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Empang130.png" /></td><td>Empang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Dukuh131.png" /></td><td>Dukuh</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Dramaga132.png" /></td><td>Dramaga</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Curugmekar133.png" /></td><td>Curugmekar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Curug134.png" /></td><td>Curug</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cujujung135.png" /></td><td>Cujujung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciwaringin136.png" /></td><td>Ciwaringin</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciupas137.png" /></td><td>Ciupas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Citaringgul138.png" /></td><td>Citaringgul</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Citapen139.png" /></td><td>Citapen</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cisalada140.png" /></td><td>Cisalada</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cipicung141.png" /></td><td>Cipicung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cipelang142.png" /></td><td>Cipelang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cipayung143.png" /></td><td>Cipayung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciparigi144.png" /></td><td>Ciparigi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cipambuan145.png" /></td><td>Cipambuan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cipaku146.png" /></td><td>Cipaku</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciomasrahayu147.png" /></td><td>Ciomasrahayu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciomas148.png" /></td><td>Ciomas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cinangneng149.png" /></td><td>Cinangneng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cinangka150.png" /></td><td>Cinangka</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cinagara151.png" /></td><td>Cinagara</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimayang152.png" /></td><td>Cimayang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimangis153.png" /></td><td>Cimangis</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CimanggungSatu154.png" /></td><td>Cimanggung Satu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CimanggungDua155.png" /></td><td>Cimanggung Dua</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimandehilir156.png" /></td><td>Cimandehilir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimande157.png" /></td><td>Cimande</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimandala158.png" /></td><td>Cimandala</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cimahpar159.png" /></td><td>Cimahpar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciluar160.png" /></td><td>Ciluar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cileungsi161.png" /></td><td>Cileungsi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CilendekTimur162.png" /></td><td>Cilendek Timur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CilendekBarat163.png" /></td><td>Cilendek Barat</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CilebutTimur164.png" /></td><td>Cilebut Timur</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CilebutBarat165.png" /></td><td>Cilebut Barat</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cikodom166.png" /></td><td>Cikodom</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cikeas167.png" /></td><td>Cikeas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cikaret168.png" /></td><td>Cikaret</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cikarawang169.png" /></td><td>Cikarawang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cijujung170.png" /></td><td>Cijujung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cijeruk171.png" /></td><td>Cijeruk</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cijayanti172.png" /></td><td>Cijayanti</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CihideungUdik173.png" /></td><td>Cihideung Udik</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CihideungIlir174.png" /></td><td>Cihideung Ilir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciherangpondok175.png" /></td><td>Ciherangpondok</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciherang176.png" /></td><td>Ciherang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cigombong177.png" /></td><td>Cigombong</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciderum178.png" /></td><td>Ciderum</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cicadas179.png" /></td><td>Cicadas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciburuy180.png" /></td><td>Ciburuy</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciburayut181.png" /></td><td>Ciburayut</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CibuntuTengah182.png" /></td><td>Cibuntu Tengah</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibuntu183.png" /></td><td>Cibuntu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibuluh184.png" /></td><td>Cibuluh</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibogor185.png" /></td><td>Cibogor</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibodas186.png" /></td><td>Cibodas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibeuteungudik187.png" /></td><td>Cibeuteungudik</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibening188.png" /></td><td>Cibening</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibedug189.png" /></td><td>Cibedug</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CibeberSatu190.png" /></td><td>Cibeber Satu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CibeberDua191.png" /></td><td>Cibeber Dua</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CibatokDua192.png" /></td><td>Cibatok Dua</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibanteng193.png" /></td><td>Cibanteng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibanon194.png" /></td><td>Cibanon</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibalung195.png" /></td><td>Cibalung</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cibadak196.png" /></td><td>Cibadak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciawi197.png" /></td><td>Ciawi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CiaruteunUdik198.png" /></td><td>Ciaruteun Udik</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CiaruteunIlir199.png" /></td><td>Ciaruteun Ilir</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CiampeaUdik200.png" /></td><td>Ciampea Udik</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciampea201.png" /></td><td>Ciampea</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Ciadeg202.png" /></td><td>Ciadeg</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_CemplangSatu203.png" /></td><td>Cemplang Satu</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cemplang204.png" /></td><td>Cemplang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Caringin205.png" /></td><td>Caringin</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Candali206.png" /></td><td>Candali</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Cadasngampar207.png" /></td><td>Cadasngampar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bubulak208.png" /></td><td>Bubulak</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bondongan209.png" /></td><td>Bondongan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bojongrangkas210.png" /></td><td>Bojongrangkas</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bojongkerta211.png" /></td><td>Bojongkerta</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bojongjengkol212.png" /></td><td>Bojongjengkol</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bojong213.png" /></td><td>Bojong</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bitungsari214.png" /></td><td>Bitungsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Benteng215.png" /></td><td>Benteng</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bendungan216.png" /></td><td>Bendungan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Batutulis217.png" /></td><td>Batutulis</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Barengkok218.png" /></td><td>Barengkok</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Baranagsiang219.png" /></td><td>Baranagsiang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bantarsari220.png" /></td><td>Bantarsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bantarjaya221.png" /></td><td>Bantarjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Bantarjati222.png" /></td><td>Bantarjati</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Banjarwaru223.png" /></td><td>Banjarwaru</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Banjarwangi224.png" /></td><td>Banjarwangi</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Banjarsari225.png" /></td><td>Banjarsari</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Balumbangjaya226.png" /></td><td>Balumbangjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Babakanpasar227.png" /></td><td>Babakanpasar</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Babakanmadang228.png" /></td><td>Babakanmadang</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Babakan229.png" /></td><td>Babakan</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_Atangsenjaya230.png" /></td><td>Atangsenjaya</td></tr><tr><td style="text-align: center;"><img src="legend/ADMINISTRASIDESA_AR_25K_1_231.png" /></td><td></td></tr></table>',
                        layer: layer_ADMINISTRASIDESA_AR_25K_1
                    },
                    {
                        label: "OpenStreetMap",
                        layer: layer_OpenStreetMap_0
                    },
                ]
                var lay = L.control.layers.tree(null, overlaysTree, {
                    //namedToggle: true,
                    //selectorBack: false,
                    //closedSymbol: '&#8862; &#x1f5c0;',
                    //openedSymbol: '&#8863; &#x1f5c1;',
                    //collapseAll: 'Collapse all',
                    //expandAll: 'Expand all',
                    collapsed: true,
                });
                lay.addTo(map);
                setBounds();
                map.addControl(new L.Control.Search({
                    layer: layer_Datadatadistributor_2,
                    initial: false,
                    hideMarkerOnCollapse: true,
                    propertyName: 'Nama'
                }));
                document.getElementsByClassName('search-button')[0].className +=
                    ' fa fa-binoculars';
            </script>
        </div>
    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>