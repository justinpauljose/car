#testing2

#testing
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--<meta http-equiv="refresh" content="1">-->
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/boot.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootMin.js"></script>
<link rel="stylesheet" href="css/flipclock.css">
<script src="js/flipclock.js"></script>	
<link rel="stylesheet" href="css/sweetalert2.min.css">
<script src="js/sweetalert2.min.js"></script> 

<script>
function alertFunc() {
  var img1 = document.getElementById('firstCard').value;
  //flipclock(3);
	$.ajax({	
		url : 'ajaxcall.php',
		type : 'POST',
		data : {'img1' : img1 },
		cache: false,
		success : function(data) {              
			var dataarray = data.split(',');
			if(dataarray[0]==''){
				dataarray[0] = 'background';	
			}
			document.getElementById('firstResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[0]+".png' width='45' height='60'>";
		}
	});  
}
function alertFunc2() {
  var img1 = document.getElementById('firstCard').value;
  var img2 = document.getElementById('secondCard').value;
 
  $.ajax({	
		url : 'ajaxcall.php',
		type : 'POST',
		data : {'img1' : img1, 'img2' : img2 },
		cache: false,
		success : function(data) {              
			//alert('Data: '+data);
			var dataarray = data.split(',');
			
			if(dataarray[0]==''){
				dataarray[0] = 'background';	
			}
			if(dataarray[1]==''){
				dataarray[1] = 'background';	
			}
			document.getElementById('firstResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[0]+".png' width='45' height='60'>";
			document.getElementById('secondResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[1]+".png' width='45' height='60'>";
		}
	});
	  
}
function redicetFunc(rid) {
  //alert(rid);
  var img1 = document.getElementById('firstCard').value;
  var img2 = document.getElementById('secondCard').value;
  var img3 = document.getElementById('thirdCard').value;
  
  //flipclock(3);
	$.ajax({	
		url : 'ajaxcall.php',
		type : 'POST',
		data : {'img1' : img1, 'img2' : img2, 'img3' : img3, 'roundId' : rid },
		cache: false,
		success : function(data) {              
			//alert('Data: '+data);
			var dataarray = data.split(',');
			
			if(dataarray[0]==''){
			dataarray[0] = 'background';	
			}
			if(dataarray[1]==''){
				dataarray[1] = 'background';	
			}
			if(dataarray[2]==''){
			dataarray[2] = 'background';	
			}
			
			document.getElementById('firstResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[0]+".png' width='45' height='60'>";
			document.getElementById('secondResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[1]+".png' width='45' height='60'>";
			document.getElementById('thirdResult').innerHTML = "<img src='http://172.104.53.29:8080/images1/"+dataarray[2]+".png' width='45' height='60'>";
		}
	}); 
		 
}
function placeBet(val){
	//alert(val);
	if(val=='line1'){
		$("#betnumber").html(val);	
		$('#odd').val('5');
	}else if(val=='line2'){
		$("#betnumber").html(val);
		$('#odd').val('5');
	}else if(val=='even'){
		$("#betnumber").html(val);
		$('#odd').val('5');		
	}else if(val=='odd'){
		$("#betnumber").html(val);
        $('#odd').val('5');		
	}else{
		$("#betnumber").html(val+' Single');
		$('#odd').val('9');
	}
	$('#game').val(val);
	//$('#placebetPanel').show();
}

function placeAmt(val){
	//alert(val);
	$('#stake').val(val);

}
function resetVal(){
	$('#stake').val('');
	$('#odd').val('');
}
function showResult(rid,res,variance){

	document.getElementById('roundId').innerHTML = "Round Id : "+rid;
	document.getElementById('resultDiv').innerHTML = "Result : "+res;
	document.getElementById('varianceDiv').innerHTML = "Variance : "+variance;
}

function flipclockone(t, type){	
    	var clock;
			$(document).ready(function() {
			clock = $('.clock').FlipClock(t, {
				clockFace: 'MinuteCounter',
				countdown: true,
				callbacks: {
					stop: function() {
						//$('.message').html('The clock has stopped!');
					}
				}
			});

		});
				
		if(type == 'twenty' && t <= 4){
			/* var ttimer = t*1000;
			setTimeout(function() {   //calls click event after a certain time */
				$(".pBetTd").removeAttr("data-target");
				$("#mydiv").addClass("disabledbutton");
				$('#myModal').modal('hide');
			/* }, ttimer); */
		}
	//}
}

function submitBet(){
	
	var game = document.getElementById('game').value;
	var odd = document.getElementById('odd').value;
	var dpid = document.getElementById('dp_id').value;
	var total = document.getElementById('stake').value;
	var round_id = document.getElementById('round_id').value;
	
	
	$.ajax({	
		url : 'Submitbet.php',
		type : 'POST',
		data : {'game' : game, 'dp_id' : dpid, 'odd' : odd, 'total' : total, 'round_id': round_id},
		cache: false,
		success : function(data) {              
			var resultData = data.split('|^|');             
			if(resultData[0]=='200'){
				Swal.fire("", resultData[1], "success"); 
				resetVal();
				$('#myModal').modal('toggle');
			}else{
				Swal.fire("Oops...", resultData[1], "error"); 
				$('#myModal').modal('toggle');
			}
			getMyBet();
		}
	}); 
}
</script>

<?php
error_reporting(0);
session_start(); 
?>
<script type="text/javascript">
setInterval(function(){ 
	$.ajax({	
			url : 'imageCall.php',
			type : 'POST',
			data : { },
			cache: false,
			success : function(data) {              
				//alert('Data: '+data);
				var dataarray = data.split(',');
				var img1 = document.getElementById('firstCard').value = dataarray[0];
  				var img2 = document.getElementById('secondCard').value = dataarray[1];
  				var img3 = document.getElementById('thirdCard').value =dataarray[2]; 
				/* document.getElementById('counterval').value = dataarray[3];
				document.getElementById('roundtimer').value = dataarray[4]; */
				if(dataarray[0]=='' && dataarray[1]=='' && dataarray[2]==''){
					getRoundID();
					getMyBet();
					$("#mydiv").removeClass("disabledbutton");
					flipclockone(dataarray[4], 'thirty');
				}else if(dataarray[0]!='' && dataarray[1]=='' && dataarray[2]==''){
					alertFunc();
					getMyBet();
					flipclockone(dataarray[3], 'three');
				}else if(dataarray[0]!='' && dataarray[1]!='' && dataarray[2]==''){
					alertFunc2();
					getMyBet();
					flipclockone(dataarray[3], 'twenty');
				}else if(dataarray[0]!='' && dataarray[1]!='' && dataarray[2]!=''){
					var roundId = document.getElementById('round_id').value;
					redicetFunc(roundId);						
					/* document.getElementById('counterval').value = '';
					document.getElementById('roundtimer').value = ''; */
					$(".pBetTd").removeAttr("data-target");
					$("#mydiv").addClass("disabledbutton");
					$('#myModal').modal('hide');
				}
			}
		}); 
}, 1000);

function getRoundID(){ 
	$.ajax({	
			url : 'roundNumber.php',
			type : 'POST',
			data : { },
			cache: false,
			success : function(data) {
				var dataarray = data.split('|^|');
				//alert(dataarray[1]);
				document.getElementById('roundNumber').innerHTML = dataarray[0];
				document.getElementById('allResult').innerHTML = dataarray[1];
			}
		}); 
}
function getMyBet(){ 
	var dpId = document.getElementById('dpId').value;
	var round_id = document.getElementById('round_id').value;
	$.ajax({	
			url : 'mybet.php',
			type : 'POST',
			data : { 'dp_id': dpId, 'round_id':round_id },
			cache: false,
			success : function(data) {
				var dataarray = data;
				document.getElementById('showMyBet').innerHTML = dataarray;
			}
		}); 
}
</script>
<?php
	$resultpage = "http://172.104.53.29:5000/api/v1/worlimtkResult";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $resultpage);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result_outpage = curl_exec($ch);
	$resultData = json_decode($result_outpage, true);
	curl_close ($ch);
	
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,"https://satta.us/index.php/api/wallet-balance");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, "dp_id=".$_GET['token']);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	$myBallance = curl_exec($ch1);
	$myBallance = json_decode($myBallance, true);
	curl_close ($ch1);
	//print_r($myBallance['data']);
?>
<script src="//demo.nanocosmos.de/nanoplayer/api/release/nanoplayer.4.min.js?20211122"></script>
<script>
var player;
var bintuStreamIds = [ 
   "7f6bb751-f304-4e74-99c8-b50494164f77" 
]; 
var config = {
    "source": {
        "defaults": {
            "service": "bintu"
        },
        "startIndex": 0,
        "entries": [
            {
                "index": 0,
                "bintu": {
                    "apiurl": "https://bintu.nanocosmos.de",
                    "streamid": bintuStreamIds[0]
                }
            }
        ]
    },
    "playback": {
        "autoplay": true,
        "automute": true,
        "muted": true
    },
    "style": {
        "displayMutedAutoplay": true,
        "width": "auto",
        "height": "auto"
    }
};
document.addEventListener('DOMContentLoaded', function () {
    player = new NanoPlayer("playerDiv");
    player.setup(config).then(function (config) {
        console.log("setup success");
        console.log("config: " + JSON.stringify(config, undefined, 4));
    }, function (error) {
        alert(error.message);
    });
});
</script>
</head>
<style>
body, html { overflow-x:hidden; }
</style>
<body>
<div class="container-fluid mainT" id="fillX">
<input type="hidden" value="<?=$imageone?>" id="firstCard" />
<input type="hidden" value="<?=$imagetwo?>" id="secondCard" />
<input type="hidden" value="<?=$imagethird?>" id="thirdCard" />
<input type="hidden" id="dpId" value="<?php echo $_GET['token']; ?>" />
<input type="hidden" id="round_id" value="<?=$resultData['roundList'][0]['roundId']?>" />
    <div class="col-md-12" style="padding-right:0px !important; padding-left:0px !important;">
        <div class="row"> 
            <div class="col-md-9 mDv vMainDv">
                <div class="cardsDV">
                    <span id="firstResult"></span><!--<img src="images/img/img3.png">-->
                    <span id="secondResult"></span>
                    <span id="thirdResult"></span>
                    <div class="clrBoth"></div>
                </div>
                <div class="topDV">
                    <p class="pL">INSTANT WORLI</p>
                    <p class="pR">RPUND ID | <span id="roundNumber"><?=$resultData['roundList'][0]['roundId']?></span> |Min 500</p>
                    <div class="clrBoth"></div>
                </div>
                <div class="imgDV">
                        <div class="mdv">
                          <!--<img src="images/img/2.jpg">-->
                          <div id="playerDiv"></div>
                        </div>
                    <div class="clrBoth"></div>
                    <div class="timerDV" style="width:140px !important;">
                    <div class="clock"></div>
                </div>
                </div>
                <div style="margin:5px 0 -10px 10px; color:#fff; font-size:14px;">Balance Rs<?=$myBallance['data']?></div>
                <div class="main" style="width:100%">

	<a href="#" class="pBet betSec" title="Place Bet" >Place Bet</a>
    <div class="" id="mydiv">
        <table class="table mtop" style="margin-top:15px;">
            <tr>
                <td class="nOTxt col5"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="1" onClick="placeBet(1)">1</a></td>
                <td class="nOTxt col2"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="2" onClick="placeBet(2)" >2</a></td>
                <td class="nOTxt col5"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="3" onClick="placeBet(3)">3</a></td>
                <td class="nOTxt col2"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="4" onClick="placeBet(4)">4</a></td>
                <td class="nOTxt col5"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="5" onClick="placeBet(5)">5</a></td>
                
            </tr>
            <tr>
                <td class="nOTxt col2"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="6" onClick="placeBet(6)">6</a></td>
                <td class="nOTxt col5"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="7" onClick="placeBet(7)">7</a></td>
                <td class="nOTxt col2"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="8" onClick="placeBet(8)">8</a></td>
                <td class="nOTxt col5"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="9" onClick="placeBet(9)">9</a></td>
                <td class="nOTxt col2"><a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="0" onClick="placeBet(0)">0</a></td>
                
            </tr>
        </table>
        <table class="table">
            <tr>
                <td class="nOTxt col4">
                <a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="Line 1" onClick="placeBet('line1')"><p>Line 1</p>
                <p style="font-size:16px;">1|2|3|4|5</p></a>
                </td>
                <td class="nOTxt col3">
                <a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="Line 2" onClick="placeBet('line2')" ><p>Line2</p>
                <p style="font-size:16px;">6|7|8|9|0</p></a>
                </td>
                <td class="nOTxt col4">
                <a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="Even" onClick="placeBet('even')"> <p>EVEN</p>
                <p style="font-size:16px;">2|4|6|8|0</p></a>
                </td>
                <td colspan="2" class="nOTxt col3">
                <a href="#" data-toggle="modal" data-target="#myModal" class="pBetTd" title="Odd" onClick="placeBet('odd')"><p>ODD</p>
                <p style="font-size:16px;">1|3|5|7|9</p></a>
                </td>
            </tr>
        </table>
    </div>

</div>
</div>
            <div class="col-md-3 text-center lDv">
                <a href="#" data-toggle="modal" data-target="#" class="pBet" title="My Bet" >My Bet</a>
                <div class="clrBoth"></div>
				<?php
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,"https://satta.us/index.php/api/my-warli-bets");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "dp_id=".$_REQUEST['token']);
					curl_setopt($ch, CURLOPT_POSTFIELDS, "round_id=".$resultData['roundList'][0]['roundId']);
                    // Receive server response ...
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $mybet = curl_exec($ch);
                    $myBet = json_decode($mybet, true);
                    curl_close ($ch);
					//print_r($myBet);						
                ?>
                <div id="showMyBet">
				<table class="table betTable">
					<tbody>
						<tr>
							<td class="nOTxt">Matched Bet</td>
							<td class="nOTxt">Odd</td>
							<td class="nOTxt">Stake</td>
						</tr>
						
                        <?php for($i=0; $i<count($myBet); $i++){ ?>
						<tr>
							<td class="nOTxt"><?php echo $myBet[$i]['game']; ?></td>
							<td class="nOTxt">9</td>
							<td class="nOTxt"><?php echo $myBet[$i]['money']; ?></td>
						</tr>
                        <?php } ?>
					</tbody>
				</table>
                </div>
                <div class="topDV btDV">
<p class="pL">Last Result</p>
<p class="pR"><a href="#" data-toggle="modal" data-target="#myViewModal" style="color:#fff; text-decoration:none">View All</a></p>
<div class="clrBoth"></div>
</div>
<p class="cirm" id="allResult">
<?php for($i=1; $i<count($resultData['roundList']); $i++){ ?>
<span class="cir" data-toggle="modal" data-target="#resModal" style="cursor:pointer;" onClick="showResult('<?php echo $resultData['roundList'][$i]['roundId']; ?>','<?php echo $resultData['roundList'][$i]['result']; ?>','<?php echo $resultData['roundList'][$i]['variance']; ?>')" >R</span>
<?php } ?>
</p>
            </div>
        </div>
	</div>    

  <!-- The Modal -->  
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Place Bet</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form enctype="multipart/form-data" action="" method="post"> <!--https://satta.us/index.php/api/warli-instant-->
        <div class="modal-body">
          <div class="">
        <div class="tableMain">
        <div class="row">
        	<div class="col-md-3 col-6">
            <div class="form-group">
              <label for="usr"><i class="fa fa-remove rem"></i> Bet for</label>
              <p class="Llabel" id="betnumber"> 4 Single</p>
            </div>
            </div>
            <div class="col-md-3 col-6">
            <div class="form-group">
              <label for="usr">Odd:</label>
              <input type="text" class="form-control" name="odd" id="odd" />
            </div>
            </div>
            <div class="col-md-3 col-6">
            <div class="form-group">
              <label for="usr">Stake:</label>
              <input type="text" class="form-control" id="stake" name="total" readonly />
            </div>
            </div>
            <div class="col-md-3 col-6">
            <div class="form-group">
              <label for="usr">Profit:</label>
              <p class="Llabel"> 0</p>
            </div>
            </div>
            </div>
            <table class="table table-striped">
            <tbody>
                <tr>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('500');">500</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('1000');">1000</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('2000');">2000</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('5000');">5000</a></span></td>
                </tr>
                <tr>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('10000');">10000</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('15000');">15000</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('25000');">25000</a></span></td>
                    <td class="tfild"><span ><a href="#" onClick="placeAmt('50000');">50000</a></span></td>
                </tr>
            </tbody>
            </table>
            <input type="hidden" name="round_id" id="round_id" value="<?=$resultData['roundList'][0]['roundId'];?>" />
            <input type="hidden" name="game" id="game" value="" />
 		    <input type="hidden" name="dp_id" id="dp_id" value="<?php echo $_GET['token']; ?>" />
          <a href="#" class="reset" data-dismiss="modal" onClick="resetVal()"> Reset</a>
          <!--<a href="#"><input type="submit" name="submit" value="Submit" class="Submit" /></a>-->
          <a href="#" class="Submit" onClick="submitBet()"> Submit</a>
  
  	
  <div class="clrBoth"></div>
        </div>
    	
    </div>
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- The Model End -->  
  <!-- The Modal -->
  <div class="modal fade" id="resModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Result</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="">
                <div class="cardsDVmodel" id="roundId">
                    <div class="clrBoth"></div>
                </div>
                <div class="cardsDVmodel" id="resultDiv">
                    <div class="clrBoth"></div>
                </div>
                <div class="cardsDVmodel" id="varianceDiv">
                    <div class="clrBoth"></div>
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- The Model End -->  
  <!-- The View all Modal Start -->  
  <div class="modal fade" id="myViewModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View All</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form enctype="multipart/form-data" action="" method="post"> <!--https://satta.us/index.php/api/warli-instant-->
        <div class="modal-body">
          <div class="">
        <div class="tableMain">
        <table class="table table-striped">
            <tbody>
            <tr>
                <td class="tfild"><span >Round ID</span></td>
                <td class="tfild"><span >Winner</span></td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- The View all Modal End --> 
</div>

</body>
</html>
