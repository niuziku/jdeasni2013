
    <div class="container row-fluid">
    
    	<div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">定制</p></li>
               <li>&gt;</li>
               <li><p class="text">洗水牛仔裤</p></li>
               <li>&gt;</li>
               <li><p class="text">定制详情</p></li>
            </ul>
        </div>
        
    	<div class="custom-block">
        
			<div class="item-header">
                <img class="big-photo" />
                
                <div class="item-info">
                    <p class="item-name"></p>
                    <p class="price-large"><span>RMB</span></p>
                    <input type="hidden" id="price" value="0"/>
                    <p>预计制作时间:7~14天&nbsp;&nbsp;</p>
                    <span class="label">更多定制细节在下面</span>
                    <hr/>
                    <p class="item-intro">
                    </p>
                </div><!-- div item info -->
                
                <div class="small-photo-group">
                	<ul class="inline">
                    </ul>
                </div>
            </div><!-- div item header -->
            
            <div class="item-select">
            	<h3>请选择定制细节</h3>
                
 				<div class="row-fluid" id="thickness-select">
                	<div class="select-header">
                		<legend>①&nbsp;选择厚度</legend>
                    </div>
                    <div class="select-block">
                    <ul class="inline option-list">    	
                    	  
                    </ul>
                    </div><!-- select block -->
                </div><!-- select thickness -->
                
                <div class="row-fluid" id="color-select">
                	<div class="select-header">
                        <legend>②&nbsp;选择颜色<span>除了商品展示的颜色外,你还能选择定制其他颜色</span></legend>
                    </div>
                    <div class="select-block">
                    <ul class="inline option-list">    	
                    	
                    </ul>
                    </div><!-- select block -->
                </div><!-- select color -->
                
            	<div class="row-fluid" id="banxing-select">
                	<div class="select-header">
                        <legend style="margin-top:10px;">③&nbsp;选择板型<span>除了商品展示的板型外,你还能选择定制其他板型</span></legend>
                    </div>
                    <div class="select-block">
                    <ul class="inline option-list">    	
                    	
                    </ul>
                    </div>
                </div><!-- div banxing select -->
                
     
                
                <button type="button" class="btn btn-block btn-info" id="more-select-button">更多细节选择  <span class="caret"></span></button>
                
                <div id="more-select">
                    
                   	<div class="row-fluid" id="fly-select">
                        <div class="select-header">
                            <legend>④&nbsp;选择门襟</legend>
                        </div>
                        <div class="select-block">
                            <ul class="inline option-list">    	
                                
                            </ul>
                        </div><!-- select block -->
                	</div><!-- select fly -->
                    
                    
                	<div class="row-fluid" id="metal-select">
                        <div class="select-header">
                            <legend>⑤&nbsp;选择钮扣</legend>
                        </div>
                        <div class="select-block">
                            <ul class="inline option-list">    	
                                
                            </ul>
                        </div><!-- select block -->
                    </div><!-- metal select -->
                    
                    <div class="row-fluid" id="metal2-select">
                        <div class="select-header">
                            <legend>⑥&nbsp;选择撞钉</legend>
                        </div>
                        <div class="select-block">
                            <ul class="inline option-list">    	
                                
                            </ul>
                        </div><!-- select block -->
                    </div><!-- metal select -->
                    
                    <div class="row-fluid" id="linecolor-select">
                    <div class="select-header">
                		<legend>⑦&nbsp;选择线色</legend>
                    </div>	
                    	<div class="select-block">
                            <ul class="inline option-list">    	
                    	
	                   		</ul>
	                    </div><!-- select block -->
                    </div><!--linecolor select -->
                </div><!-- more select -->
                <!-- 
                <div class="select-intro">
                	<div class="metal-intro span4">
                    	介绍五金
                    </div>
                    
                    <div class="leather-intro span4">
                    	介绍皮牌
                    </div>
                    
                    <div class="detail-intro span4">
                    	其他细节介绍
                    </div>
                </div>
             -->
            </div><!-- div item select -->
            
        </div><!-- left part -->
      
       <div id="sidebar">
       		
	       <div class="add-cart">
	       		<div class="add-cart-header">
	               <!-- <p class="price-small"><span>RMB</span>350</p>-->
	            </div>
	            
	            <div id="size-block">
	            <div class="btn-group" id="size-select">
	                <button class="btn active btn-primary" id="standard-size-button">标准尺码</button>
	                <button class="btn" id="custom-fit-button">合身定制</button>
	                <button class="btn" id="sample-fit-button">来样定制</button>
	            </div>
	            
	            <div id="standard-size">
	            	<p class="description">选择标准的尺码用于定制牛仔裤</p>
	                <form class="form-horizontal">
	                    <div class="control-group">
	                        <label class="control-label">腰围</label>
	                        <div class="controls">
	                            <select name="yaowei" onclick="getSize()">
	                            	<option value="W26">W26</option>
	                            	<option value="W27">W27</option>
	                                <option value="W28">W28</option>
	                                <option value="W29">W29</option>
	                                <option value="W30" selected>W30</option>
	                                <option value="W31">W31</option>
	                                <option value="W32">W32</option>
	                                <option value="W33">W33</option>
	                                <option value="W34">W34</option>
	                                <option value="W35">W35</option>
	                                <option value="W36">W36</option>
	                                <option value="W37">W37</option>
	                                <option value="W38">W38</option>
	                                <option value="W39">W39</option>
	                                <option value="W40">W40</option>
	                                <option value="W41">W41</option>
	                                <option value="W42">W42</option>
	                                <option value="W43">W43</option>
	                                <option value="W44">W44</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="control-group">
	                        <label class="control-label">裤长</label>
	                        <div class="controls">
	                            <select name="kuchang" onclick="getSize()">
	                                <option value="L26">L26</option>
	                            	<option value="L27">L27</option>
	                                <option value="L28">L28</option>
	                                <option value="L29">L29</option>
	                                <option value="L30" selected>L30</option>
	                                <option value="L31">L31</option>
	                                <option value="L32">L32</option>
	                                <option value="L33">L33</option>
	                                <option value="L34">L34</option>
	                                <option value="L35">L35</option>
	                                <option value="L36">L36</option>
	                            </select>
	                        </div>
	                    </div>
	                </form>
	            </div><!-- standard size-->
	            
	            <div id="custom-fit">
	            	<p class="description">提供你的个人量身数据,合身定制可为你制作独一无二的合身牛仔裤</p>
	                
	                <!-- modal view -->
	                <!-- Button to trigger modal -->
	                <a href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-left:10px; width:174px;">填写量身数据</a>
	                 
	               
	                
	            </div>
	            
	            <div id="sample-fit">
	            	<p class="description">你可以选择把你的裤子寄给我们,我们将根据这条裤子的尺寸制作</p>
					<address class="description">
	                    <strong>ID jeans, Inc.</strong><br>
	                    广州市海珠区<br>
	                    土华华骏西街四巷十号二楼<br>
	                    收件人：梁先生<br>
	                    电话：<strong>020-34081069</strong>
	                </address>
	            </div>
	            </div><!-- size block -->
	            
	        	<button class="btn btn-large btn-success" type="button" id="buy-button" data-content="你还没选尺码哦~">立即购买</button>
	        </div><!-- right float block for select size and add to cart -->
	        
	        <div id="list">
        	<h5>小计</h5>
        	<p><span class="currency">RMB</span><span class="price-label">234</span></p>
        	<div>
        		<input type="hidden" class="item-id"/>
        	</div>
            <div id="size-list">
                <h5>尺寸清单</h5>
                <p id="shengao"></p>
                <p id="tizhong"></p>
                <p id="yaowei"></p>
                <p id="kuchang"></p>
                
                <p id="datui"></p>
                <p id="jiaowei"></p>
                <p id="qiandang"></p>
                <p id="tunwei"></p>
                <p id="xigai"></p>
                <p id="houdang"></p>
                
                <p id="sample">根据样板</p>
            </div>
            <div id="select-list">
                <h5>定制选项清单</h5>
                <p id="thickness"></p>
                <p id="color"></p>
                <p id="plate"></p>
                <p id="placket"></p>
                <p id="embroidery" style="width:100px; float:left;"></p>
                <p id="metal" style="width:100px; float:left;"></p>
                <p id="linecolor"></p>
            </div>
        </div>
        </div>  
    </div><!-- div container -->
    
    
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">填写量身数据</h3>
                    </div>
                    <div class="modal-body">
                        <div class="custom-fit-input row-fluid">
                        	<div class="pic">
                        		<img src="<?php echo base_url("images/others/measure/shengao.png");?>"/>
                            </div>
                            <div class="input">
                            	<form class="form-horizontal">
                                	<div class="control-group">
                                    	<label class="control-label" for="input-shengao">身高</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="重要!" id="input-shengao");"  onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/shengao.png");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                           <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-tizhong">体重</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="重要!" id="input-tizhong"  onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/tizhong.png");?>');"/>
                                                <span class="add-on">kg</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                    
                                	<div class="control-group">
                                    	<label class="control-label" for="input-kuchang">裤长</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="重要!" id="input-kuchang"  onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/kuchang.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                                
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-yaowei">腰围</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="重要!" id="input-yaowei" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/yaowei.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                </form>
                                
                                
                                <form class="form-horizontal right-input">    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-datui">大腿</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-datui" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/datui.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                           <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-jiaowei">脚围</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-jiaowei" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/jiaowei.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-qiandang">前档</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-qiandang" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/qiandang.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-tunwei">臀围</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-tunwei" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/tunwei.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-xigai">膝盖</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-xigai" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/xigai.jpg");?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="control-group">
                                    	<label class="control-label" for="input-houdang">后档</label>
                                        <div class="controls">
                                        	<div class="input-append">
                                                <input type="text" placeholder="" id="input-houdang" onFocus="$('.pic img').attr('src','<?php echo base_url("images/others/measure/houdang.jpg")?>');"/>
                                                <span class="add-on">cm</span>
                                            </div>
                                            <span class=""></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- input div -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">不保存返回</button>
                        <button class="btn btn-primary" onClick="submitCustomFit()">保存</button>
                    </div>
                </div>
