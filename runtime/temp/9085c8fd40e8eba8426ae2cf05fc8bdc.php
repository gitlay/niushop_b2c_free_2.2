<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:40:"template/adminblue\Order\printOrder.html";i:1524020942;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>订单打印</title>
	<link rel="shortcut  icon" type="image/x-icon" href="ADMIN_IMG/admin_icon.ico" media="screen"/>
	<style>
		*{
			padding: 0;
			margin: 0;
		}
		body{
			font:12px/1.5 "宋体", Arial, Helvetica, sans-serif;
			color:#404040;
			text-align:center
		}
		.print_area{
			width: auto;
   			margin: 20px;
   			height:1000px
		}
		.print_area table{
			border-top: 1px solid #aaa;
		    width: 100%;
		    text-align: left;
		}
		.print_area table tr th,.print_area table tr td{
			padding: 8px 10px;
   	 		padding-left: 16px;
		}	
		.print_area table tr td ul li{
			list-style: none;
			height: 25px;
			line-height: 25px;
		}	
		.handlerA {
			width:200px;
			height:25px;
			line-height:25px;
			overflow:hidden;
			color:#fff;
			background:#aaa;
			border:1px solid #aaa;
			text-align:center;
		}
		.handlerB {
			width:200px;
			margin:0 auto;
			height:120px;
			border:1px solid #ccc;
			background:#ccc;
		}
		.confirmPrintBtn {
			background:#0096ff;
			border:1px solid #0096ff;
			color:#fff;
			padding:6px 20px;
			font-weight:bold;
			font-size:14px;
			vertical-align:middle;
		}
		.cancelPrintBtn {
			background:#999;
			border:1px solid #999;
			color:white;
			padding:6px 20px;
			font-weight:bold;
			font-size:14px;
			vertical-align:middle;
		}
		.printSuccessBtn {
			background:#0096ff;
			border:1px solid #0096ff;
			color:#fff;
			padding:4px 15px;
			font-weight:bold;
			font-size:14px;
			vertical-align:middle;
		}
		.printFailBtn {
			background:#0096ff;
			border:1px solid #0096ff;
			color:#fff;
			padding:4px 18px;
			font-weight:bold;
			font-size:14px;
			vertical-align:middle;
		}
  
	</style>
</head>
<body>
	<?php if(is_array($order_list) || $order_list instanceof \think\Collection || $order_list instanceof \think\Paginator): if( count($order_list)==0 ) : echo "" ;else: foreach($order_list as $key=>$vo): ?>
	<div class="print_area" style="page-break-after: always;">
		<table style="border-top: none;padding: 0;">
			<tr>
				<th><img src="<?php echo __IMG($web_info['logo']); ?>" alt=""></th>
				<th style="width:250px;" valign="bottom">下单用户：<?php echo $vo['user_name']; ?></th>
			</tr>
		</table>
		<table>
			<tr>
				<th>订单号：<?php echo $vo['order_no']; ?></th>
				<th style="width:250px;">下单日期：<?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></th>
			</tr>
		</table>
		<table>
			<colgroup>
				<col style="width: 6%;">
				<col style="width: 22%">
				<col style="width: 18%">
				<col style="width: 10%">
				<col style="width: 8%">
				<col style="width: 8%">
				<col style="width: 8%">
			</colgroup>
			<thead>
				<tr>
					<th>序号</th>
					<th>商品名称</th>
					<th>规格</th>
					<th>商品编号</th>
					<th>单价</th>
					<th>数量</th>
					<th>小计</th>
				</tr>
			</thead>
			<colgroup>
				<col style="width: 6%;">
				<col style="width: 22%">
				<col style="width: 18%">
				<col style="width: 10%">
				<col style="width: 8%">
				<col style="width: 8%">
				<col style="width: 8%">
			</colgroup>
			<tbody style="border-top: 1px solid #aaa" >
				<?php if(is_array($vo['order_item_list']) || $vo['order_item_list'] instanceof \think\Collection || $vo['order_item_list'] instanceof \think\Paginator): if( count($vo['order_item_list'])==0 ) : echo "" ;else: foreach($vo['order_item_list'] as $k=>$og): ?>
				<tr>
					<td><?php echo $k +1; ?></td>
					<td><?php echo $og['goods_name']; ?></td>
					<td><?php echo $og['sku_name']; ?></td>
					<td><?php echo $og['code']; ?></td>
					<td><?php echo $og['price']; ?></td>
					<td><?php echo $og['num']; ?></td>
					<td><?php echo $og['goods_money']; ?></td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<table>
			<tbody>
				<tr>
					<td style="width: 60px;">订单留言：</td>
					<td>
						<?php echo $vo['buyer_message']; ?>
					</td>
					<td style="width: 250px;text-align: right;">
						<ul>
							<li>总计：￥<?php echo $vo['goods_money']; ?> 元</li>
							<li>运费：<?php echo $vo['shipping_money']; ?> 元</li>
							<li>总优惠：<?php echo $vo['promotion_money']; ?> 元</li>
							<li>使用余额：<?php echo $vo['user_money']; ?> 元</li>
							<li>使用积分：<?php echo $vo['point']; ?> 个</li>
							<li>实际支付：￥<?php echo $vo['pay_money']; ?> 元</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<tr>
				<td>收货人：<?php echo $vo['receiver_name']; ?></td>
				<td style="text-align: right;">地址：<?php echo $vo['receiver_address']; ?></td>
			</tr>
			<tr>
				<td>收货人手机号：<?php echo $vo['receiver_mobile']; if(!(empty($vo['fixed_telephone']) || (($vo['fixed_telephone'] instanceof \think\Collection || $vo['fixed_telephone'] instanceof \think\Paginator ) && $vo['fixed_telephone']->isEmpty()))): ?>&nbsp;&nbsp;&nbsp;&nbsp;收货人固定电话：<?php echo $vo['fixed_telephone']; endif; ?>
				</td>
				<td style="text-align: right;">配送方式：
					<?php if(is_array($vo['goods_packet_list']) || $vo['goods_packet_list'] instanceof \think\Collection || $vo['goods_packet_list'] instanceof \think\Paginator): if( count($vo['goods_packet_list'])==0 ) : echo "" ;else: foreach($vo['goods_packet_list'] as $key=>$eo): ?>
						<?php echo $eo['packet_name']; ?> <?php echo $eo['express_name']; ?> <?php echo $eo['express_code']; ?>,
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td><img src="__UPLOAD__/<?php echo getBarcode($vo['order_no']); ?>" alt=""></td>
				<td></td>
			</tr>
		</table>
	</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="extraElement">
	    <div id="popA" style="width: 202px; opacity: 0.8; position: absolute; top: 262px; left: 850.5px; cursor: move;">
	        <!-- <div class="handlerA">
	        <span>操作</span></div> -->
	        <div class="handlerB">
	            <table>
	                <tbody>
	                    <tr style="height: 30px;line-height:30px;">
	                        <td colspan="4" style="text-align:center;background:#999;color:#fff;">操作</td></tr>
	                    <tr style="height: 40px;"></tr>
	                    <tr>
	                        <td style="width: 50px;"></td>
	                        <td>
	                            <input class="confirmPrintBtn" value="打印" onclick="javascript: printIt();" id="print" style="cursor: pointer;" type="button"></td>
	                        <td>
	                            <input class="cancelPrintBtn" onclick="javascript: printCancel();" value="取消" style="cursor: pointer;" type="button"></td>
	                        <td style="width: 50px;"></td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	    <div id="popB" style="width: 202px;opacity: 0.9;display: none;position: fixed;top: 200px;left: 42%;">
	        <div class="handlerA" style="width:202px;text-align:center;background: #999;height: 28px;line-height: 28px;">
	            <span style="color: red;font-size: 14px;">反馈您的打印结果【非常重要】</span></div>
	        <div class="handlerB">
	            <table>
	                <tbody>
	                    <tr style="height: 50px;">
	                        <td></td>
	                        <td></td>
	                        <td></td>
	                        <td></td>
	                    </tr>
	                    <tr>
	                        <!-- <td style="width: 60px;"></td> -->
	                        <td>
	                            <input class="printSuccessBtn" value="打印成功" onclick="javascript: printSuccess();" style="cursor: pointer;" type="button"></td>
	                        <td>
	                            <input class="printFailBtn" value="打印失败" onclick="javascript: printFail();" style="cursor: pointer;" type="button"></td>
	                        <!-- <td style="width: 60px;"></td> -->
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</body>
<script src="__STATIC__/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script>
$(function(){
	showDiv($("#popA"));
	$("#popA").easydrag();
	showDiv($("#popB"));
	$("#popB").easydrag();
	function showDiv(obj) {
		center(obj);
		$(window).scroll(function () {
			center(obj);
		});
		$(window).resize(function () {
			center(obj);
		});
	}
	
	function center(obj) {
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $(obj).height();
		var popupWidth = $(obj).width();
		$(obj).css({
			"position": "absolute",
			"top": (windowHeight - popupHeight) / 2 + $(document).scrollTop() - 150,
			"left": (windowWidth - popupWidth) / 2
		});
	}
})
// 打印失败
function printFail() {
	$("#popA").css("display", "block");
	$("#popB").css("display", "none");
};

// 打印
function printIt() {
	$("#popA").css("display", "none");
	window.print();
	setTimeout(function () {
		$("#popB").css("display", "block");
	}, 1000);
}

// 取消打印
function printCancel() {
	window.close();
}

// 打印成功后【当用户确定打印成功后才会修改订单的打印状态】
function printSuccess() {
	window.close();
}

</script>
</html>