
<?php
//选择店铺信息
$shopmag_select=mysql_query("select * from shop where shop_dm = '$shop_type_shop_dm_data'")or die("选择失败".mysql_error());
$shopmag_result=mysql_fetch_assoc($shopmag_select);

//选择连锁店信息
$shopchain_select=mysql_query("select * from chains where chains_dm = '$shop_type_shop_dm_data'")or die("选择失败".mysql_error());
$shopchain_result=mysql_fetch_assoc($shopchain_select);

//选择评论表信息
$comment_select=mysql_query("select * from comment where shop_id = '$shop_type_shop_dm_data' order by c_time desc")or die("选择失败".mysql_error());
$correcting_select=mysql_query("select * from comment where shop_id = '$shop_type_shop_dm_data' and (feedback=2 or feedback=3)  order by c_time desc")or die("选择失败".mysql_error());
$comment_num=mysql_num_rows($comment_select);
$correcting_num=mysql_num_rows($correcting_select);
?>
<div class="popup-title">店铺信息<span><a class="close">x</a></span></div>
<div class="shop-title">
    <ul>
        <li class="tit-teb click" _content="base-mag">基本信息</li>
        <li class="tit-teb" _content="comment">评论</li>
    <?php 
        if($shopmag_result['chains']!=0){
            echo "<li class='tit-teb total' _content='total-shop'>总店</li>";
        }
    ?>
        
        <li class="tit-teb" _content="error-correcting">纠错</li>
        <li class="tit-teb" _content="shopkeeper">我是店主</li>
    </ul>
</div>
<div class="base-mag J_click">
    <div class="shopimg-wrap">
    <?php 
        echo "<h2>";
        $shopmag_result_shop_mc=$shopmag_result['shop_mc'];
        echo "$shopmag_result_shop_mc";
        if($shopmag_result['chains']!=0){
            echo "<span><a class='totalshop'>总店</a></span>";
        }
        echo "</h2>";

        $shopmag_result_photos=$shopmag_result['photos'];//读取图片
        $photos_arr=split(',', $shopmag_result_photos);
        $photos_arr_num=count($photos_arr);
        for ($m=0; $m < $photos_arr_num; $m++) { 
            $photos_arr_src[$m]='shop_photos/'.$photos_arr[$m];
        }
        for ($h=0; $h < $photos_arr_num; $h++) { 
                $e=$h.'a';
                $bigimgid=$e."bigimg";
                echo "<div class='shopimg-biga $bigimgid' id=$bigimgid>
                        <img src='$photos_arr_src[$h]' class='bigimg' width='400px' height='280px' />
                    </div>";//店铺图片放大
            }

            echo "<div class='img-list'>";//店铺小图片轮播
            for ($d=0; $d < $photos_arr_num; $d++) { 
                $r=$d.'a';
                echo "<div class='img-littlea' _num='$r'><img src='$photos_arr_src[$d]' width='80px' height='60px;'></div>";
            }
            echo "</div>";

    ?>
    </div>

    <div class="shop-centent">
        <div class="shop-line">
            <div class="llabel">店名：</div>
            <div class="rlabel"><?php $shopmag_result_shop_mc= $shopmag_result['shop_mc'];echo "$shopmag_result_shop_mc"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">地址：</div>
            <div class="rlabel"><?php $shopmag_result_address=$shopmag_result['address'];echo "$address_province_data$address_city_data$address_county_data$street_mc_data$shopmag_result_address"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">联系方式：</div>
            <div class="rlabel"><?php $shopmag_result_telno=$shopmag_result['telno'];echo "$shopmag_result_telno"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">分类：</div>
            <div class="rlabel"><?php echo "$shop_type_mc_data"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">状态：</div>
            <div class="rlabel">
            <?php 
                $shopmag_shop_state=$shopmag_result['shop_state'];
                if($shopmag_shop_state=='0'){
                    echo "正常营业"; 
                }
            ?>
            </div>
        </div>
        <div class="server-support">
            <div class="server-label">环境支持：</div>
            <div class="server-img">
            <?php 
                $shopmag_enviro_support=$shopmag_result['enviro_support'];

                if(substr($shopmag_enviro_support, 0,1)==1){
                    echo "<img src='images/p.gif'/>";
                }
                if(substr($shopmag_enviro_support, 1,1)==1){
                    echo "<img src='images/wc.gif'/>";
                }
                if(substr($shopmag_enviro_support, 2,1)==1){
                    echo "<img src='images/wifi.gif'/>";
                }
            ?>
            </div>
            <div class="server-label">服务支持：</div>
            <div class="server-img">
            <?php 
                $shopmag_sever_support=$shopmag_result['sever_support'];
                if(substr($shopmag_sever_support, 4,1)==1){
                    echo "<img src='images/mt.gif'/>";
                }
                if(substr($shopmag_sever_support, 3,1)==1){
                    echo "<img src='images/bdwm.gif'/>";
                }
                if(substr($shopmag_sever_support, 2,1)==1){
                    echo "<img src='images/zfb.gif'/>";
                }
                if(substr($shopmag_sever_support, 1,1)==1){
                    echo "<img src='images/tb.gif'/>";
                }
                if(substr($shopmag_sever_support, 0,1)==1){
                    echo "<img src='images/tdd.gif'/>";
                }
            ?>
            </div>
        </div>
    </div>
</div>

<div class="comment J_click" style="display:none;">
    <h3>消费评价<span class="my-comment">我要评论</span></h3>
    <div class="comment-list">
        <div class="com-cont">
            <form method="POST" id = <?php $formid="comment-form-cc".$l; echo "'$formid'"; ?>  enctype="multipart/form-data">
                <textarea class="cont-cc" <?php $bc="cont-cc".$l;  echo "id='$bc' name='$bc'"; ?> ></textarea>
                <!--<input type="file" class="file-img" <?php // $cc="file-img-cc".$l;  echo "id='$cc'"; ?>  value="选择上传图片" />-->
                <div class = "add-img" <?php $addl="add-img-cc".$l;  echo "id='$addl'"; ?> >
                    <input type="button" class="addpic-btn-cc" value="添加图片" />
                    <input type="text" style="display:none;" <?php $ln="cc-n".$l;  echo "id='$ln' name = '$ln'"; ?> > 
                </div>
                <a class="comment-commit" onclick=<?php $ss="'".$shop_type_shop_dm_data."'"; echo "SubmitReview('-cc',$ss,$l)"; ?>;> 提交评论</a>
                <input type = "submit" style = "display:none;" value = "提交"/>
            </form>
        </div>
        <?php
        for ($t=0; $t < $comment_num; $t++) {
            $comment_result=mysql_fetch_assoc($comment_select); 
            $comment_result_user_id=$comment_result['user_id'];
            //选择评论表评论人信息
            $user_select=mysql_query("select * from user where id = $comment_result_user_id")or die("选择失败".mysql_error());
            $user_result=mysql_fetch_assoc($user_select);
            $user_result_nicknames=$user_result['nicknames'];
            $user_result_avatar=$user_result['avatar'];
            $user_result_avatar_src='user_photo/'.$user_result_avatar;

            //选择评论表信息
            $comment_result_c_content=$comment_result['c_content'];
            $comment_result_reply=$comment_result['reply'];
            $comment_result_c_time=$comment_result['c_time'];
            $comment_result_c_type=$comment_result['c_type'];
            $comment_result_reply_time=$comment_result['reply_time'];
            $comment_result_feedback=$comment_result['feedback'];
            $comment_result_c_photo=$comment_result['c_photo'];
            $c_photo_arr=split(',', $comment_result_c_photo);
            $c_photo_arr_num=count($c_photo_arr);
            for ($m=0; $m < $c_photo_arr_num; $m++) { 
                $photos_arr_src[$m]='user_photo/'.$c_photo_arr[$m];
            }
            if($comment_result_feedback==0){
                echo "<div class='commenn-row'>";
                    echo "<div class='comment-person'>";
                        echo "<img src=$user_result_avatar_src width='60px' height='60px'/>";
                        echo "<span>$user_result_nicknames</span>";
                    echo "</div>";
                    echo "<div class='comment-content'>";
                        echo "<div class='comment-time'>$comment_result_c_time</div>";
                        echo "<p>$comment_result_c_content</p>";
                        echo "<div>";
                            for ($i=0; $i < $c_photo_arr_num; $i++) { 
                                $g=$i+1;
                                if($photos_arr_src[$i]!='user_photo/'){
                                    echo "<img src='$photos_arr_src[$i]' class='comment-img' width='50px;' height='50px;' _number='$g'/>";
                                }
                            }
                        echo "</div>";
                        for ($j=0; $j < $c_photo_arr_num; $j++) { 
                            $f=$j+1;
                            $d=$f."img";
                            if($photos_arr_src[$j]!='user_photo/.jpg'){
                                echo "<img src='$photos_arr_src[$j]' class='comment-img-big $d'/>";
                            }
                        }
                    echo "</div>";
                    if($comment_result_reply!=''){
                        echo "<div class='comment-reply'>";
                            echo "<h4>掌柜回复</h4><div class='comment-time'>$comment_result_reply_time</div>";
                            echo "<p>$comment_result_reply</p>";
                        echo "</div>";
                    }
                echo "</div>";
            }   
        }
        ?>
    </div>
</div>

<div class="total-shop J_click" style="display:none;">
    <div class="shopimg-wrap">
        <h2><?php $shopchain_result_chains_mc=$shopchain_result['chains_mc'];echo "$shopchain_result_chains_mc"; ?>总店</a></span></h2>

        <?php 
            $shopchain_result_photos=$shopchain_result['photo'];//读取图片
            $photo_arr=split(',', $shopchain_result_photos);
            $photo_arr_num=count($photo_arr);
            for ($m=0; $m < $photo_arr_num; $m++) { 
                $photo_arr_src[$m]='shop_photos/'.$photo_arr[$m];
            }

            for ($h=0; $h < $photo_arr_num; $h++) { 
                $e=$h+1;
                $bigimgid=$e."bigimg";
                echo "<div class='shopimg-big $bigimgid' id=$bigimgid>
                        <img src='$photo_arr_src[$h]' class='bigimg' width='400px' height='280px' />
                    </div>";//店铺图片放大
            }

            echo "<div class='img-list'>";//店铺小图片轮播
            for ($d=0; $d < $photo_arr_num; $d++) { 
                $r=$d+1;
                echo "<div class='img-little' _num='$r'><img src='$photo_arr_src[$d]' width='80px' height='60px;'></div>";
            }
            echo "</div>";
        ?>
    </div>

    <div class="shop-centent">
        <div class="shop-line">
            <div class="llabel">店名：</div>
            <div class="rlabel"><?php $shopchain_result_chains_mc=$shopchain_result['chains_mc'];echo "$shopchain_result_chains_mc"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">地址：</div>
            <div class="rlabel"><?php $shopchain_result_address=$shopchain_result['address'];echo "$shopchain_result_address"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">联系方式：</div>
            <div class="rlabel"><?php $shopchain_result_tellphoto=$shopchain_result['tellphoto'];echo "$shopchain_result_tellphoto"; ?></div>
        </div>
        <div class="shop-line">
            <div class="llabel">分类：</div>
            <div class="rlabel"><?php echo "$shop_type_mc_data"; ?></div>
        </div>
        <div class="shop-introduction">
            <P><?php $shopchain_result_intro=$shopchain_result['intro'];echo "$shopchain_result_intro"; ?></P>
        </div>
    </div>
</div>

<div class="error-correcting J_click" style="display:none;">
    <h3>纠错<span class="my-comment">我要纠错</span></h3>
    <div class="comment-list">
        <div class="com-cont">
            <form method="post" id = <?php $formid="comment-form-ec".$l; echo "'$formid'"; ?>  enctype="multipart/form-data">
                <textarea class="cont-cc" <?php $bc="cont-ec".$l;  echo "id='$bc' name='$bc'"; ?> ></textarea>
                <div class = "add-img" <?php $addl="add-img-ec".$l;  echo "id='$addl'"; ?> >
                    <input type="button" class="addpic-btn-ec" value="添加图片" />
                    <input type="text" style="display:none;" <?php $ln="ec-n".$l;  echo "id='$ln' name = '$ln'"; ?> > 
                </div>
                <a class="comment-commit" onclick=<?php $ss="'".$shop_type_shop_dm_data."'"; echo  "SubmitReview('-ec',$ss,$l)"; ?>;> 提交</a>
            </form>
        </div>
        <?php
        for ($t=0; $t < $correcting_num; $t++) {
            $correcting_result=mysql_fetch_array($correcting_select); 
            $correcting_result_user_id=$correcting_result['user_id'];
            //选择纠错表评论人信息
            $user_select=mysql_query("select * from user where id = $correcting_result_user_id")or die("选择失败".mysql_error());
            $user_result=mysql_fetch_assoc($user_select);
            $user_result_nicknames=$user_result['nicknames'];
            $user_result_avatar=$user_result['avatar'];
            $user_result_avatar_src='user_photo/'.$user_result_avatar;

            //选择纠错表信息
            $correcting_result_c_content=$correcting_result['c_content'];
            $correcting_result_reply=$correcting_result['reply'];
            $correcting_result_c_time=$correcting_result['c_time'];
            $correcting_result_c_type=$correcting_result['c_type'];
            $correcting_result_reply_time=$correcting_result['reply_time'];
            $correcting_result_feedback=$correcting_result['feedback'];
            $correcting_result_c_photo=$correcting_result['c_photo'];
            $c_photo_arr=split(',', $correcting_result_c_photo);
            $c_photo_arr_num=count($c_photo_arr);
            for ($m=0; $m < $c_photo_arr_num; $m++) { 
                $photos_arr_src[$m]='user_photo/'.$c_photo_arr[$m];
            }
            if($correcting_result_feedback==2){
                echo "<div class='commenn-row'>";
                    echo "<div class='comment-person'>";
                        echo "<img src=$user_result_avatar_src width='60px' height='60px'/>";
                        echo "<span>$user_result_nicknames</span>";
                    echo "</div>";
                    echo "<div class='comment-content'>";
                        echo "<div class='comment-time'>$correcting_result_c_time <span class='error-states'>已解决</span></div>";
                        echo "<p>$correcting_result_c_content</p>";
                        echo "<div>";
                            for ($i=0; $i < $c_photo_arr_num; $i++) { 
                                $g=$i+1;
                                if($photos_arr_src[$i]!='user_photo/'){
                                    echo "<img src='$photos_arr_src[$i]' class='comment-img' width='50px;' height='50px;' _number='$g'/>";
                                }
                            }
                        echo "</div>";
                        for ($j=0; $j < $c_photo_arr_num; $j++) { 
                            $f=$j+1;
                            $d=$f."img";
                            if($photos_arr_src[$j]!='user_photo/'){
                                echo "<img src='$photos_arr_src[$j]' class='comment-img-big $d'/>";
                            }
                        }
                    echo "</div>";
                    if($correcting_result_reply!=''){
                        echo "<div class='comment-reply'>";
                            echo "<h4>回复</h4><div class='comment-time'>$correcting_result_reply_time</div>";
                            echo "<p>$correcting_result_reply</p>";
                        echo "</div>";
                    }
                echo "</div>";
            }  
            if($correcting_result_feedback==3){
                echo "<div class='commenn-row'>";
                    echo "<div class='comment-person'>";
                        echo "<img src=$user_result_avatar_src width='60px' height='60px'/>";
                        echo "<span>$user_result_nicknames</span>";
                    echo "</div>";
                    echo "<div class='comment-content'>";
                        echo "<div class='comment-time'>$correcting_result_c_time <span class='error-states'>待解决</span></div>";
                        echo "<p>$correcting_result_c_content</p>";
                        echo "<div>";
                            for ($i=0; $i < $c_photo_arr_num; $i++) { 
                                $g=$i+1;
                                if($photos_arr_src[$i]!='user_photo/'){
                                    echo "<img src='$photos_arr_src[$i]' class='comment-img' width='50px;' height='50px;' _number='$g'/>";
                                }
                            }
                        echo "</div>";
                        for ($j=0; $j < $c_photo_arr_num; $j++) { 
                            $f=$j+1;
                            $d=$f."img";
                            if($photos_arr_src[$j]!='user_photo/'){
                                echo "<img src='$photos_arr_src[$j]' class='comment-img-big $d'/>";
                            }
                        }
                    echo "</div>";
                    if($correcting_result_reply!=''){
                        echo "<div class='comment-reply'>";
                            echo "<h4>掌柜回复</h4><div class='comment-time'>$correcting_result_reply_time</div>";
                            echo "<p>$correcting_result_reply</p>";
                        echo "</div>";   
                    }
                echo "</div>";
            } 
        }
        ?>
    </div>
</div>

<div class="shopkeeper J_click" style="display:none;">
    <div class="shopkeeper-wrap">
        <form method="post" action="deal/claim-shop.php?shop_id=<?php echo "$shop_type_shop_dm_data"; ?>" enctype="multipart/form-data">
            <div class="shopkeeper-line">
                <div class="skleft">姓名：</div>
                <div class="skright"><input type="text" id="username" name="username" /></div>
            </div>
            <div class="shopkeeper-line">
                <div class="skleft">电话：</div>
                <div class="skright"><input type="text" id="tellphone" name="tellphone" /></div>
            </div>
            <div class="shopkeeper-line">
                <div class="skleft">身份证号：</div>
                <div class="skright"><input type="text" id="identity_card" name="identity_card" /></div>
            </div>
            <div class="shopkeeper-line">
                <div class="skleft">营业执照：</div>
                <div class="skright-file"><input type="file" id="business_license" name="business_license" /></div>
            </div>
            <div class="shopkeeper-line">
                <div class="skleft">组织结构代码证：</div>
                <div class="skright-file"><input type="file" id="Organization_Certificate" name="Organization_Certificate"/></div>
            </div>
            <input type="submit" class="submit" value="提交" name="t1"> 
        </form>      
    </div>
</div>



