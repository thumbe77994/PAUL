<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php require_once('Connections/easyshop.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_easyshop, $easyshop);
$query_ps = "SELECT * FROM s_product_ps ORDER BY s_product_ps ASC";
$ps = mysql_query($query_ps, $easyshop) or die(mysql_error());
$row_ps = mysql_fetch_assoc($ps);
$totalRows_ps = mysql_num_rows($ps);
?>

<?php require_once('Connections/easyshop.php'); ?>
<?php
$maxRows_rss = 10;
$pageNum_rss = 0;
if (isset($_GET['pageNum_rss'])) {
  $pageNum_rss = $_GET['pageNum_rss'];
}
$startRow_rss = $pageNum_rss * $maxRows_rss;

mysql_select_db($database_easyshop, $easyshop);
$query_rss = "SELECT * FROM s_product ORDER BY pro_id ";
$query_limit_rss = sprintf("%s LIMIT %d, %d", $query_rss, $startRow_rss, $maxRows_rss);
$rss = mysql_query($query_limit_rss, $easyshop) or die(mysql_error());
$row_rss = mysql_fetch_assoc($rss);

if (isset($_GET['totalRows_rss'])) {
  $totalRows_rss = $_GET['totalRows_rss'];
} else {
  $all_rss = mysql_query($query_rss);
  $totalRows_rss = mysql_num_rows($all_rss);
}
$totalPages_rss = ceil($totalRows_rss/$maxRows_rss)-1;

$maxRows_news = 10;
$pageNum_news = 0;
if (isset($_GET['pageNum_news'])) {
  $pageNum_news = $_GET['pageNum_news'];
}
$startRow_news = $pageNum_news * $maxRows_news;

mysql_select_db($database_easyshop, $easyshop);
$query_news = "SELECT * FROM news ORDER BY n_id DESC";
$query_limit_news = sprintf("%s LIMIT %d, %d", $query_news, $startRow_news, $maxRows_news);
$news = mysql_query($query_limit_news, $easyshop) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);

if (isset($_GET['totalRows_news'])) {
  $totalRows_news = $_GET['totalRows_news'];
} else {
  $all_news = mysql_query($query_news);
  $totalRows_news = mysql_num_rows($all_news);
}
$totalPages_news = ceil($totalRows_news/$maxRows_news)-1;

$maxRows_ppp = 5;
$pageNum_ppp = 0;
if (isset($_GET['pageNum_ppp'])) {
  $pageNum_ppp = $_GET['pageNum_ppp'];
}
$startRow_ppp = $pageNum_ppp * $maxRows_ppp;

$colname_ppp = "-1";
if (isset($_GET['id'])) {
  $colname_ppp = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_easyshop, $easyshop);
$query_ppp = sprintf("SELECT * FROM s_product WHERE s_ps = '%s' ORDER BY pro_id DESC", $colname_ppp);
$query_limit_ppp = sprintf("%s LIMIT %d, %d", $query_ppp, $startRow_ppp, $maxRows_ppp);
$ppp = mysql_query($query_limit_ppp, $easyshop) or die(mysql_error());
$row_ppp = mysql_fetch_assoc($ppp);

if (isset($_GET['totalRows_ppp'])) {
  $totalRows_ppp = $_GET['totalRows_ppp'];
} else {
  $all_ppp = mysql_query($query_ppp);
  $totalRows_ppp = mysql_num_rows($all_ppp);
}
$totalPages_ppp = ceil($totalRows_ppp/$maxRows_ppp)-1;

$queryString_ppp = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ppp") == false && 
        stristr($param, "totalRows_ppp") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ppp = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ppp = sprintf("&totalRows_ppp=%d%s", $totalRows_ppp, $queryString_ppp);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>幸福都市-旅遊好選擇APP</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport"   content="width=device-width, initial-scale=1" charset="utf-8">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/blue.css" rel="stylesheet" type="text/css" media="all" />
<!----font-Awesome----->
   	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
<!----font-Awesome----->
<!-- start plugins -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- Owl Carousel Assets -->
<link href="css/owl.carousel.css" rel="stylesheet">
<script src="js/owl.carousel.js"></script>
		<script>
			$(document).ready(function() {

				$("#owl-demo").owlCarousel({
					items : 4,
					lazyLoad : true,
					autoPlay : true,
					navigation : true,
					navigationText : ["", ""],
					rewindNav : false,
					scrollPerPage : false,
					pagination : false,
					paginationNumbers : false,
				});

			});
		</script>
		<!-- //Owl Carousel Assets -->
<!-- start circle -->
<script>
(function($){
	$.fn.percentPie = function(options){

		var settings = $.extend({
			width: 100,
			trackColor: "EEEEEE",
			barColor: "E2534B",
			barWeight: 30,
			startPercent: 0,
			endPercent: 1,
			fps: 60
		}, options);

		this.css({
			width: settings.width,
			height: settings.width
		});

		var	that = this,
			hoverPolice = false,
			canvasWidth = settings.width,
			canvasHeight = canvasWidth,
			id = $('canvas').length,
			canvasElement = $('<canvas id="'+ id +'" width="' + canvasWidth + '" height="' + canvasHeight + '"></canvas>'),
			canvas = canvasElement.get(0).getContext("2d"),
			centerX = canvasWidth/2,
			centerY = canvasHeight/2,
			radius = settings.width/2 - settings.barWeight/2;
			counterClockwise = false,
			fps = 1000 / settings.fps,
			update = .01;
			this.angle = settings.startPercent;

		this.drawArc = function(startAngle, percentFilled, color){
			var drawingArc = true;
			canvas.beginPath();
			canvas.arc(centerX, centerY, radius, (Math.PI/180)*(startAngle * 360 - 90), (Math.PI/180)*(percentFilled * 360 - 90), counterClockwise);
			canvas.strokeStyle = color;
			canvas.lineWidth = settings.barWeight;
			canvas.stroke();
			drawingArc = false;
		}

		this.fillChart = function(stop){
			var loop = setInterval(function(){
				hoverPolice = true;
				canvas.clearRect(0, 0, canvasWidth, canvasHeight);

				that.drawArc(0, 360, settings.trackColor);
				that.angle += update;
				that.drawArc(settings.startPercent, that.angle, settings.barColor);

				if(that.angle > stop){
					clearInterval(loop);
					hoverPolice = false;
				}
			}, fps);
		}

		this.mouseover(function(){
			if(hoverPolice == false){
				that.angle = settings.startPercent;
				that.fillChart(settings.endPercent);
			}
		});

		this.fillChart(settings.endPercent);
		this.append(canvasElement);
		return this;
	}
}(jQuery));

$(document).ready(function() {

	$('.google').percentPie({
		width: 100,
		trackColor: "E2534B",
		barColor: "76C7C0",
		barWeight: 20,
		endPercent: .9,
		fps: 60
	});
  
  $('.moz').percentPie({
		width: 100,
		trackColor: "E2534B",
		barColor: "76C7C0",
		barWeight: 20,
		endPercent: .75,
		fps: 60
	});
  
  $('.safari').percentPie({
		width: 100,
		trackColor: "E2534B",
		barColor: "#76C7C0",
		barWeight: 20,
		endPercent: .5,
		fps: 60
	});
    
});
</script>
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style2 {color: #999999}
-->
</style>
</head>
<body>
<div class="header_bg">
<div class="container">
	<div class="header">
		<div class="logo">
			<a href="index.html"><img src="images/logo.png" alt=""/></a>
		</div>
		<div class="h_menu">
		<a id="touch-menu" class="mobile-menu" href="#">功能選單 Menu</a>
		<nav>
		<ul class="menu list-unstyled">
			<li class="activate"><a href="index.php">回首頁</a></li>
			<li><a href="about.php">關於我們</a></li>
			<li><a href="news.php">最新消息</a></li>
			<li><a href="#">會員專區</a>
			<ul class="sub-menu list-unstyled">
				<li><a href="signup.php">註冊會員</a></li>
				<li><a href="login.php">登入會員</a></li>
			
				</li>
			</ul>
			</li>
			<li><a href="#">景點瀏覽</a>
			<ul class="sub-menu list-unstyled">
			
			<?php do { ?>
												  <li><a href="prod.php?id=<?php echo urlencode($row_ps['s_product_ps']); ?>"><?php echo $row_ps['s_product_ps']; ?></a></li>
												  <?php } while ($row_ps = mysql_fetch_assoc($ps)); ?>
	</li>
			</ul>
			</li>
		<li><a href="message.php">留言版</a></li>
		</ul>
		</nav>
		<script src="js/menu.js" type="text/javascript"></script>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>
<div class="main_bg"><!-- start main -->
<div class="container">
	<div class="main_grid1">
		<h3 class="style pull-left"><?php echo $_GET['id']; ?></h3>
		<ol class="breadcrumb pull-right">
		  <li><a href="index.php">回首頁</a></li>
		  <li class="active">景點地區</li>
		</ol>
		<div class="clearfix"></div>
	</div>
</div>
</div>
<div class="main_btm1"><!-- start main_btm -->
<div class="container">
	<div class="blog"><!-- start blog -->
			<div class="blog_main col-md-9">
			  <div class="blog_list">
					<div class="col-md-2 blog_date">
						<span class="date">
						<?php echo   date("M");?>					 
						 <p>
						<?php echo   date("d");?>
						 <p></p></span>
				 
					</div>
					 
						
						
						<?php do { ?>
						  <div class="col-md-10 blog_left">
						    <a href="maps.php?id=<?php   echo $row_ppp['s_addtype'];  ?>"><img src="system/store_photo/<?php echo $row_ppp['s_file']; ?>" alt="" border="0" class="img-responsive"/></a>
						    <h4><a href="#"><?php echo $row_ppp['s_product']; ?> </a></h4>
						   
						<p class="para"><?php echo $row_ppp['s_text']; ?></p>
						  <span class="style2">地址:<?php echo $row_ppp['s_addtype']; ?>					      </span>
						  <hr>
						    <div class="read_btn">
						      <a href="maps.php?id=<?php   echo $row_ppp['s_addtype'];  ?>"><button class="btn">查看地圖</button></a>	  
			<?php if($_SESSION['MM_Username']<>""){?>
			  <a href="my.php?id=<?php echo $_GET['id']?>&id2=<?php echo $row_ppp['pro_id']; ?>"><button class="btn">加到我的最愛</button></a>	
			  <?php }?>
			  								        
							  
						    </div>
				        </div>
						  <?php } while ($row_ppp = mysql_fetch_assoc($ppp)); ?>
                          <table border="0" width="50%" align="center">
                            <tr>
                              <td width="23%" align="center"><?php if ($pageNum_ppp > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_ppp=%d%s", $currentPage, 0, $queryString_ppp); ?>" class="style1">First</a>
                                    <?php } // Show if not first page ?>
                              </td>
                              <td width="31%" align="center"><?php if ($pageNum_ppp > 0) { // Show if not first page ?>
                                    <a href="<?php printf("%s?pageNum_ppp=%d%s", $currentPage, max(0, $pageNum_ppp - 1), $queryString_ppp); ?>" class="style1">Previous</a>
                                    <?php } // Show if not first page ?>
                              </td>
                              <td width="23%" align="center"><?php if ($pageNum_ppp < $totalPages_ppp) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_ppp=%d%s", $currentPage, min($totalPages_ppp, $pageNum_ppp + 1), $queryString_ppp); ?>" class="style1">Next</a>
                                    <?php } // Show if not last page ?>
                              </td>
                              <td width="23%" align="center"><?php if ($pageNum_ppp < $totalPages_ppp) { // Show if not last page ?>
                                    <a href="<?php printf("%s?pageNum_ppp=%d%s", $currentPage, $totalPages_ppp, $queryString_ppp); ?>" class="style1">Last</a>
                                    <?php } // Show if not last page ?>
                              </td>
                            </tr>
                          </table>
                          <!-- end blog -->
</div>
</div>
<div class="footer_bg"><!-- start footer -->
<div class="container">
	<div class="footer">
		<div class="col-md-4 footer1_of_3">
			<div class="f_logo">
				<a href="index.html"><img src="images/logo.png" alt=""/></a>
			</div>		
			<p class="f_para">適時的安排旅遊，能夠讓大腦暫時休息，得到舒緩的效果，外出旅遊可以讓自己的大腦暫時休息，放下那些惱人的事物，讓大腦歸零，恢復最好的狀態，進而活化，促進新的技能學習，也能夠提升記憶力。旅遊能夠將低21%生病的機率，且能增加心臟功能，沒旅遊的人發生心臟病的機率增加30%，工時過長的人發生冠狀動脈心臟病的機率增加40%。
</p>
			<p>Phone:&nbsp;<span>09XX-XXX0XXX</span></p>
			<span class="">Email:&nbsp;<a href="mailto:info@mycompany.com">APP@APP.com</a></span>
		</div>
		<div class="col-md-2 footer1_of_3">
			<h4>旅遊6大優點</h4>
			<ul class="list-unstyled f_list">
				<li><a href="#">1. 讓大腦歸零活化。</a></li>
				<li><a href="#">2. 提升解決問題能力。</a></li>
				<li><a href="#">3. 更長壽。</a></li>
				<li><a href="#">4. 增加工作效率。</a></li>
				<li><a href="#">5. 降低罹患憂鬱症機率。</a></li>
				<li><a href="#">6. 有助於睡眠。</a></li>
				 
			</ul>
		</div>
		<div class="col-md-2 footer1_of_3">
			<h4>最新景點</h4>
			<ul class="list-unstyled f_list">
		 
			  <?php do { ?>
		      <li><a href="prod2.php?id=<?php echo $row_rss['pro_id']; ?>"><?php echo $row_rss['s_product']; ?></a></li>
			    <?php } while ($row_rss = mysql_fetch_assoc($rss)); ?></ul>
		</div>
		
		
		<div class="clearfix"></div>
	</div>
</div>
</div>
<div class="footer1_bg"><!-- start footer1 -->
<div class="container">
	<div class="footer1">
		<div class="copy pull-left">
			<p class="link"><span>&#169; All rights reserved | Template by&nbsp;<a href="http://w3layouts.com/"> W3Layouts</a></span></p>
		</div>
		<div class="soc_icons pull-right">
			<ul class="list-unstyled text-center">
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="#"><i class="fa fa-rss"></i></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</div>
</body>
</html>
<?php
mysql_free_result($rss);

mysql_free_result($news);

mysql_free_result($ppp);
?>