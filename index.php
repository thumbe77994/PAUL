<?php require_once('Connections/easyshop.php'); ?>
<?php
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

mysql_select_db($database_easyshop, $easyshop);
$query_nn = "SELECT * FROM news ORDER BY n_id DESC";
$nn = mysql_query($query_nn, $easyshop) or die(mysql_error());
$row_nn = mysql_fetch_assoc($nn);
$totalRows_nn = mysql_num_rows($nn);
?><!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
<!--start slider -->
    <link rel="stylesheet" href="css/fwslider.css" media="all">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <script src="js/fwslider.js"></script>
<!--end slider -->
<!-- must have -->
<link href="css/allinone_carousel.css" rel="stylesheet" type="text/css">
<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
<script src="js/allinone_carousel.js" type="text/javascript"></script>
<!--[if IE]><script src="js/excanvas.compiled.js" type="text/javascript"></script><![endif]-->
<!-- must have -->
	<script>
		jQuery(function() {

			jQuery('#allinone_carousel_charming').allinone_carousel({
				skin: 'charming',
				width: 990,
				height: 454,
				responsive:true,
				autoPlay: 3,
				resizeImages:true,
				autoHideBottomNav:false,
				showElementTitle:false,
				verticalAdjustment:50,
				showPreviewThumbs:false,
				//easing:'easeOutBounce',
				numberOfVisibleItems:5,
				nextPrevMarginTop:23,
				playMovieMarginTop:0,
				bottomNavMarginBottom:-10
			});		
		});
	</script>
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
    <div id="fwslider"><!-- start slider -->
        <div class="slider_container">
            <div class="slide"> 
                <!-- Slide image -->
                    <img src="image/111.jpg">
                <!-- /Slide image -->
                <!-- Texts container -->
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <!-- Text title -->
                        <h4 class="title">春、夏、秋、冬哪一個季節都很適合出外旅行</h4>
                        <!-- /Text title -->
                        <!-- Text description -->
                        <p class="description">國內的旅遊風氣逐漸形成。旅遊不再只是早出晚歸、走馬看花的行程。它可以計畫很多元、很豐富的行程，讓人留下難忘的回憶。</p>
                        <!-- /Text description -->
                    </div>
                </div>
                 <!-- /Texts container -->
            </div>
            <!-- /Duplicate to create more slides -->
            <div class="slide">
                <img src="image/222.jpg">
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <h4 class="title">春、夏、秋、冬哪一個季節都很適合出外旅行</h4>
                    <p class="description">國內的旅遊風氣逐漸形成。旅遊不再只是早出晚歸、走馬看花的行程。它可以計畫很多元、很豐富的行程，讓人留下難忘的回憶。</p>
                    </div>
                </div>
            </div>
            <!--/slide -->
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div><!--/slider -->
<div class="main_bg"><!-- start main -->
<div class="container">
	<div class="main_grid">
		<div class="top_grid"><!-- start top_grid -->
				<div class="col-md-10 span1_of_1">
						<h3>最新消息</h3>
						<p><?php echo $row_nn['n_text']; ?></p>
				</div>
				<div class="col-md-2 span1_of_2">
					<a class="btn" href="news.php">view more</a>				</div>
				<div class="clearfix"></div>
		</div>
		<div class="span_of_4"><!-- start span_of_4 -->
			<div class="col-md-3 span1_of_4">
				<div class="span4_of_list">
					<span class="active"><i class="fa fa-thumbs-o-up"></i></span>
					<h3>註冊會員</h3>
					<p>加入會員才能留言哦</p>
					<div class="read_more">
						<a class="btn btn-2 active" href="signup.php">LINK</a>
					</div>
				</div>
			</div>
			<div class="col-md-3 span1_of_4">
				<div class="span4_of_list">
					<span><i class="fa fa-lock"></i></span>
					<h3>留言版</h3>
					<p>有任何問題歡迎留言</p>
					<div class="read_more">
						<a class="btn  btn-2b" href="message.php">LINK</a>
					</div>	
				</div>	
			</div>
			<div class="col-md-3 span1_of_4">
				<div class="span4_of_list">
					<span><i class="fa fa-flag"></i></span>
					<h3>關於我們</h3>
					<p>關於幸福都市-旅遊好選擇...</p>
					<div class="read_more">
						<a class="btn btn-2b" href="about.php">LINK</a>
					</div>		
				</div>
			</div>
			<div class="col-md-3 span1_of_4">
				<div class="span4_of_list">
					<span><i class="fa fa-flask"></i></span>
					<h3>最新公告</h3>
					<p>最新消息都會PORT在上面哦</p>
					<div class="read_more">
						<a class="btn btn-2b" href="news.php">LINK</a>
					</div>						
				</div>
			</div>
			<div class="clearfix"></div>
		</div><!-- end span_of_4 -->
	</div>
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
			<p>Phone:&nbsp;<span>0912-902676</span></p>
			<span class="">Email:&nbsp;<a href="mailto:info@mycompany.com">11013137147@gm.kuas.edu.tw</a></span>
		</div>
		<div class="col-md-2 footer1_of_3">
			<h4>旅遊5大優點</h4>
			<ul class="list-unstyled f_list">
				<li><a href="https://www.nownews.com/news/20160625/2146775" target="_blank">1. 讓大腦歸零活化。</a></li>
				<li><a href="https://www.ettoday.net/news/20160625/721241.htm?feature=descendantsofthesun&tab_id=466" target="_blank">2. 提升解決問題能力。</a></li>
				<li><a href="https://travel.ulifestyle.com.hk/DetailNews.php?id=ADgRYREvA3UMLQ&p=1" target="_blank">3. 更長壽。</a></li>
				<li><a href="http://lifestyle.fanpiece.com/ECjobsonline/%E6%97%85%E8%A1%8C%E6%9C%89%E5%8A%A9%E6%8F%90%E5%8D%87%E5%B7%A5%E4%BD%9C%E6%95%88%E7%8E%87-c1265454.html" target="_blank">4. 增加工作效率。</a></li>
				<li><a href="https://travel.ettoday.net/article/636496.htm?t=%E5%8E%9F%E4%BE%86%E6%97%85%E8%A1%8C%E9%80%99%E9%BA%BC%E6%A3%92%EF%BC%81%E7%BE%8E%E7%A0%94%E7%A9%B6%EF%BC%9A%E6%97%85%E9%81%8A%E6%9C%89%E5%8A%A9%E9%99%8D%E4%BD%8E%E5%A4%9A%E7%A8%AE%E7%96%BE%E7%97%85%E9%A2%A8%E9%9A%AA" target="_blank">5. 降低罹患憂鬱症機率。</a></li>
				
				 
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

</body>
</html>
<?php
mysql_free_result($rss);

mysql_free_result($nn);
?>