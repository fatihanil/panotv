<?php
include_once( "conf.php" );
include_once("inc/header-index.php");
$database = new mayeSQL();
$haftanin_gunleri = ["pazar", "pazartesi", "sali", "carsamba", "persembe", "cuma", "cumartesi"];
$aylar = ["01" => "ocak", "02" => "şubat", "03" => "mart", "04" => "nisan", "05" => "mayıs", "06" => "haziran", "07" => "temmuz", "08" => "ağustos", "09" => "eylül", "10" => "ekim", "11" => "kasım", "12" => "aralık"];
?>
<!--UYGULAMA YÖNETİM PANOSUNA ERİŞİM BUTONU-->
<a href="login.php"><i id="pencerenin-sag-alt-kosesine-disliyi-sabitle" class="fa fa-cog fa-spin fa-2x fa-fw"></i></a>
<!-- SAYFA BAŞLANGICI -->
<div class="container-fluid">
    <!--<hr>-->
    <section>
        <div class="row row-equal-height">
            <div class="col-md-2">
                <div class="thumbnail"> <!--id="kurum-logo"-->
                    <?php
                    $sql = "SELECT datavalue FROM " . APP_DATA_DB_TABLE . " WHERE dataname='logo';";
                    $logo = $database->sentQuery($sql);
                    if ($logo == null) {
                        ?><img src="img/logo-tvpano.png" class="img-fluid" alt="tvpano logosu">
                        <?php
                    } else {
                        foreach ($logo[0] as $deger) {
                            ?><img src='<?php echo FILE_UPLOAD_URL . $deger; ?>' class='img-responsive' alt="kurum logosu">
                            <?php
                        }
                        unset($logo);
                    }
                    ?>
                </div>
                <div id="sinava-ne-kadar-var-kutusu">
                    <h2 class="baslik-kutusu">SINAV TAKVİMİ</h2>
                    <?php
                    $sql = "SELECT sinavadi,sinavtarihi FROM " . ULUSALSINAVLAR_DB_TABLE . " ORDER BY sinavtarihi ASC;";
                    $sinavlar = $database->sentQuery($sql);
                    //$i=0;
                    //while(isset($sinavlar[$i])){
                    foreach ($sinavlar[0] as $alan => $deger) {
                        if ($alan == "sinavadi"): echo "<div class='panel panel-success text-center'>
							<div class='panel panel-heading '>" . $deger . "</div>";
                        endif;
                    }
                    if ($alan == "sinavtarihi") {
                        $o_sinav = new DateTime($deger);
                        $o_bugun = new DateTime();
                        $d_sinavtarihi = getdate(strtotime($deger));
                        $d_bugun = getdate();
                        
                        $kalan_ay = $o_sinav->diff($o_bugun)->m;
                        $sinava_ay = $kalan_ay . " AY";
                        $kalan_gun =$o_sinav->diff($o_bugun)->d;
                        $sinava_gun = $kalan_gun . " GÜN";
                        if ($kalan_ay >= 0 or $kalan_gun > 0) {
                            $altmesaj = "KALDI";
                            if ($kalan_ay == 0) {
                                $sinava_kalan = $sinava_gun;
                            } else {
                                $sinava_kalan = $sinava_ay . " " . $sinava_gun;
                            }                            
                        } else {
                            $altmesaj = "SINAV BİTTİ";
                            $sinava_kalan = "SINAV TAKVİMİNİ GÜNCELLEYİN";
                        }
                    }
                    echo "<div class='panel panel-body'><em class='sinava-kalan-sure'>$sinava_kalan</em></div>";
                    echo "<div class='panel panel-heading'>$altmesaj</div>
						</div>";

                    //	$i++;
                    //}
                    unset($sinavlar);
                    ?>

                </div>
                <div id="yemek-listesi">
                    <h2 class="baslik-kutusu">Okul Sınavları</h2>
                    <div class="tablo-sarmalayicisi">
                        <table class="table table-responsive table-striped">
                            <?php
                            /*
                              $sql="SELECT yemek1,yemek2,yemek3,yemek4 FROM ".OKUL_SINAVLARI_DB_TABLE." WHERE tarih='".date("Y-m-j")."';";
                              $yemekler=$database->sentQuery($sql);
                              $i=0;
                              while(isset($yemekler[$i])){
                              foreach($yemekler[$i] as $alan=>$deger){
                              if($alan=="yemek1"):echo "<tr><td>$deger</td></tr>";endif;
                              if($alan=="yemek2"):echo "<tr><td>$deger</td></tr>";endif;
                              if($alan=="yemek3"):echo "<tr><td>$deger</td></tr>";endif;
                              if($alan=="yemek4"):echo "<tr><td>$deger</td></tr>";endif;
                              }
                              $i++;
                              }
                              unset($yemekler);
                             */
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrap-slider">
                            <?php
//SLIDER İÇİN RESİMLER VE METİNLER ÇEKİLİYOR
                            $sql = "SELECT itempath,itemname,itemheader FROM " . SLIDER_DB_TABLE . ";";
                            $slides = $database->sentQuery($sql);
                            $i = 0;
                            while (isset($slides[$i])) {
                                foreach ($slides[$i] as $alan => $deger) {
                                    if ($alan == "itempath"): echo "<div class='slide slide$i' style='background-image:url($deger";
                                    endif;
                                    if ($alan == "itemname"): echo "/$deger);'><div class='slide-content'>";
                                    endif;
                                    if ($alan == "itemheader"): echo "<span><strong style='text-transform:capitalize;'>$deger</strong></span>
								</div>
							</div>";
                                    endif;
                                }
                                $i++;
                            }
                            unset($slides);
                            ?>
                        </div>
                    </div>
                </div>
                <?php
//$sql="SELECT dataname,datavalue FROM ".APP_DATA_DB_TABLE." WHERE dataname='slidertime';";
//$slider_time=$database->sentQuery($sql);
//json_encode($slider_time[0]);
                ?>
                <script>
                    var sliderImages = document.querySelectorAll(".slide"),
                            arrowLeft = document.querySelector("#arrow-left"),
                            arrowRight = document.querySelector("#arrow-right"),
                            current = 0,
                            time = 5000;


                    // Clear all images
                    function reset() {
                        for (let i = 0; i < sliderImages.length; i++) {
                            sliderImages[ i ].style.display = "none";
                        }
                    }

                    // Init slider
                    function startSlide() {
                        reset();
                        sliderImages[ 0 ].style.display = "block";
                    }

                    function autoChangeSlide() {
                        reset();
                        sliderImages[ current ].style.display = "block";
                        //alert(current+"/"+sliderImages.length) ;     
                        if (current === sliderImages.length - 1) {
                            current = 0;
                        } else {
                            current++;
                        }
                        setTimeout('autoChangeSlide()', time);
                    }
                    //startSlide();
                    autoChangeSlide();
                </script>
                <?php
                $sql = "SELECT datavalue FROM " . APP_DATA_DB_TABLE . " WHERE dataname='video';";
                $video_id = $database->sentQuery($sql);
//echo $video_id[0]["datavalue"];
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-frame" id="ytplayer">

                        </div>
                    </div>
                </div>
                <!-- YOUTUBE VİDEO KONTROLÜ İÇİN JS API SCRİPT-->
                <script>
                    // 2. This code loads the IFrame Player API code asynchronously.
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                    // 3. This function creates an <iframe> (and YouTube player)
                    //    after the API code downloads.
                    var player;
                    function onYouTubeIframeAPIReady() {
                        player = new YT.Player('ytplayer', {
                            height: '330',
                            width: '100%',
                            videoId: '<?php echo $video_id[0]["datavalue"]; /*
                  foreach($video[0] as $alan=>$deger){
                  echo $deger;
                  }
                  unset($video); */ ?>',
                            events: {
                                'onReady': onPlayerReady,
                                'onStateChange': onPlayerStateChange
                            }
                        });
                    }

                    // 4. The API will call this function when the video player is ready.
                    function onPlayerReady(event) {
                        event.target.playVideo();
                    }

                    // 5. The API calls this function when the player's state changes.
                    //    The function indicates that when playing a video (state=1),
                    //    the player should play for six seconds and then stop.
                    var done = false;
                    function onPlayerStateChange(event) {
                        if (event.data == YT.PlayerState.ENDED) {
                            event.target.playVideo();
                            //done = true;
                        }
                    }
                    function stopVideo() {
                        player.stopVideo();
                    }
                </script>
            </div>
            <div class="col-md-3">
                <div id="nobet-listesi" class="table-responsive">
                    <h2 class="baslik-kutusu"><?php $gunun_tarihi = date('d ') . $aylar[date('m')] . date(' Y - ') . $haftanin_gunleri[date('w')];
                echo $gunun_tarihi;
                ?></h2>
                    <div class="bosluk"></div>
                    <h2 class="baslik-kutusu">nöbetçiler</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-dark">

                            <?php
                            $bugun = getdate();
                            $sql = "SELECT nobetyeri,nobetci FROM " . NOBETLER_DB_TABLE . " WHERE nobetgunu='" . $haftanin_gunleri[$bugun['wday']] . "';";
                            $nobetciler = $database->sentQuery($sql);
                            $i = 0;
                            while (isset($nobetciler[$i])) {
                                foreach ($nobetciler[$i] as $alan => $deger) {
                                    if ($alan == "nobetyeri"): echo "<tr><td class='col-md-4'><b>$deger</b></td>";
                                    endif;
                                    if ($alan == "nobetci"): echo "<td class='col-md-8' >$deger</td></tr>";
                                    endif;
                                }
                                $i++;
                            }
                            unset($nobetciler);
                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div id="duyuru-bandi" class="col-md-12 center-block">
                <div class="marquee">
                    <div class="marquee__track">
                    
                    <?php
                    $sql = "SELECT duyurumetni FROM " . DUYURULAR_DB_TABLE . ";";
                    $duyurular = $database->sentQuery($sql);
                    $i = 0;
                    while (isset($duyurular[$i])) {
                        foreach ($duyurular[$i] as $alan => $deger) {
                            if ($alan == "duyurumetni"): echo "<span>$deger &nbsp; &raquo; &raquo; &raquo; &nbsp; </span>";
                            endif;
                        }
                        $i++;
                    }
                    unset($duyurular);
                    ?>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--<hr>-->

    <!-- ANA İÇERİK BİTİŞİ-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <?php
    include_once( 'inc/footer.php' );
    ?>