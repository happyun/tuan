<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title><?php echo L("success_html_title");?></title>
            <style type="text/css">
                *{margin:0px; padding:0px;}
                body{background-color:#EAEAEA;}
                .hd_error_html{
                    width:500px;margin:20px;
                    background-color:#F2F2F2;
                    height: auto;overflow:hidden; 
                    border-radius: 3px;box-shadow: 3px 3px 3px #aaa;
                }
                .hd_error_html h2{ height: 28px; color:#000;background-color:#FEC400;font-size:16px; font-weight: bold; text-indent: 10px; line-height: 1.8em;}
                .hd_error_html div{padding:10px; font-size:14px; font-weight: bold;color:#333;}
                .hd_error_html div a{color:royalblue;}
                .hd_error_html div p{ border-bottom: solid 1px #dcdcdc;padding-bottom: 10px; margin-bottom: 10px;}
                .hd_error_html div p a{color:#555; text-decoration: none;}
                .hd_error_html div p a:hover{color:#4985D7; text-decoration:underline;}
                .hd_error_html div span {color:#999; font-weight: normal;}
                .hd_error_html div span a{color:#999;}
                #time{color:#F57E1D;font-size:14px;padding:3px;}
            </style>
            <script type="text/javascript">
                window.setTimeout("<?php echo $url;?>",<?php echo $time;?>*1000);
            </script>
    </head>
    <body>
        <div class="hd_error_html">
            <h2><?php echo L("success_html_hd_error_html_h2");?></h2>
            <div>
                <p><?php echo $msg;?>&nbsp&nbsp&nbsp&nbsp</p>
                <span><span id="time"><?php echo $time;?></span><?php echo L("success_html_span1");?>
                    <a href="javascript:<?php echo $url;?>"><?php echo L("success_html_span2");?></a>
                    <?php echo L("success_html_span3");?><a href="http://localhost/SH_tuan"><?php echo L("success_html_span4");?></a></span>
            </div>
        </div>
        <script type="text/javascript">
            var time=document.getElementById("time").innerHTML;
            function revTime(){
                time--;
                if(time>0){
                    document.getElementById("time").innerHTML=time;
                }
            }
            setInterval("revTime()",1000);
        </script>
    </body>
</html>
