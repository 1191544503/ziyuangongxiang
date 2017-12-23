<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/ziyuangongxiang/Public/CSS/ZY.css">
  <link rel="stylesheet" href="/ziyuangongxiang/Public/CSS/font-awesome.min.css">
  <script  src="/ziyuangongxiang/Public/JS/es5-shim.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es5-sham.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es6-promise.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es6-promise.auto.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/fetch-detector.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/fetch-ie8.js"></script>
  
  <title>文件&软件下载站(测试版)</title>
</head>
<body>
<script>
function isIE() { //ie?
 if (!!window.ActiveXObject || "ActiveXObject" in window)
  return true;
  else
  return false;
 }
function gohistory(){
	alert("您的浏览器版本过低，推荐使用chrome浏览");
	//history.go(-1);
}

isIE()? gohistory(): null;
console.warn("  任何疑问或建议或你有什么希望得到的资源都可发至邮箱 %c imax2017.yeah.net","color:red");

</script>
<header>
  <span><img src="/ziyuangongxiang/Public/image/1.png" width="100" alt="">资源下载站<span style="font-size:.6em;color:#999;" >（本站所有下载不走校园网）</span></span>
</header>
<article class="container">
  <div class=" left">
    <i class="fa fa-linode fa-2x"></i>文件列表
    <select class="" name="listone" id="Sel" onchange="Change()">
      <option value="none" disabled selected>---请选择---</option>
      <option value="teacher">教师文件</option>
      <option value="common"> 公共资源</option>
    </select>
    <label for="search">
      <i class="fa fl fa-superpowers fa-lg fa-border" onclick="Find()"></i>
    </label><input id="search" type="text" name="" value="" placeholder="搜 索">
    <section>
      <ul>
        <li><span><i class="fa fa-cube fa-lg"></i> Name</span><span><!--i class="fa fa-crop fa-lg"></i> UploadUser<--></span><span><i class="fa fa-calendar-minus-o fa-lg"></i> Last Update</span></li>
        <hr/>
      </ul>
      <ul id="Content">

      </ul>
    </section>
  </div>
  <nav class="right">
    <ul>
      <li><a href="http://210.30.1.126/index.php/Index">首页</a></li>
      <li><a href="http://210.30.1.126/index.php/Problems/all">练习</a></li>
      <li><a href="http://210.30.1.126/index.php/Competition">竞赛</a></li>
      <li><a href="http://210.30.1.126/index.php/Test">实验</a></li>
      <li><a href="http://210.30.1.126/index.php/Exam">考试</a></li>
      <li><a href="http://210.30.1.126/index.php/Bbs/invitation_list">讨论版</a></li>
      <li><a href="http://210.30.1.126/index.php/Home/help">帮助</a></li>
      <li><a href="http://10.203.87.54/资源" style="font-size:.8em">软件及PDF下载<sup style="color:red">Hot<sup></a></li>
      <li><a href="https://mirrors6.tuna.tsinghua.edu.cn/" style="font-size:.8em">清华大学IPv6开源软件镜像站</a></li>
      <li><a href="http://hdtv.neu6.edu.cn/" style="font-size:.8em">东北大学IPv6媒体直播测试站</a></li>
      <li><a href="https://ipv6.google.com" style="font-size:.8em">Google IPv6地址</a></li>
      <li><a href="http://10.203.87.54:8122" style="font-size:.8em">DVWA网站渗透实验站</a></li>
      <li>意见反馈<br/>imax2017@yeah.net</li>
    </ul>
  </nav>

</article>
<footer>
  <img src="/ziyuangongxiang/Public/image/name.png" width="500" alt="">
</footer>
</body>
<script type="text/javascript" >

/*    var FILE=[];//文件名
    const Url2="<?php echo U('File/showFileSearchByLabel');?>";*/
    /*  遍历渲染  ${text.fileusername}*/
/*    let xx=(text,i)=>{
        let str=`<li><span><a title="${text.filename}" href="${text.downloadurl}">${text.filename}</a></span><span></span><span>${text.upfile_time}</span><span class="label">${text.filelabel}</span></li>`
        document.getElementById('Content').innerHTML+=str;
    }
    let xl=(name,Url)=>{
        fetch(Url,{
            method:"post",
            headers:{
                "Content-type":"application/x-www-form-urlencoded"
            },
            credentials: "same-origin",
            body:name
        })
            .then(response=>{
            if (response.status == 200){
            return response.json();
        }
    })
    .then(text=>{
            document.getElementById('Content').innerHTML='';
      //  console.log("请求成功，响应数据为:",text);
        for (let i in text) {
            xx(text[i],i);
        }
    })
    }*/
    /*  选择  */
 /*   var Change=()=>{
        const url=`<?php echo U('File/showfile');?>`;
        let myselect=document.getElementById("Sel");
        let index=myselect.selectedIndex ; // selectedIndex代表的是你所选中项的index
        let val=myselect.options[index].value

        fetch(url,{
            method:"post",
            headers:{
                "Content-type":"application/x-www-form-urlencoded"
            },
            credentials: "same-origin",
            body:`select=${val}`
        })
            .then(response=>{
            if (response.status == 200){
            return response;
        }
    })
    .then(data=>{
            return data.json();
    })
    .then(text=>{
            document.getElementById('Content').innerHTML='';
       // console.log("请求成功，响应数据为:",text);
        FILE=[];
        for (let i in text) {
            xx(text[i],i);
            FILE[i]=text[i];
        }
        var label = document.getElementsByClassName('label');
        for (let x=0; x<label.length;x++) {
            label[x].onclick = function(){
                let tfilelabel=FILE[x].filelabel;
                tfilelabel = tfilelabel.replace(/\+/g, "%2B");
                tfilelabel = tfilelabel.replace(/\&/g, "%26");
                xl(`filelabel=${tfilelabel}`,Url2);
            }
        }
    })
    .catch(err=>{
       //     console.log("Fetch错误:"+err);
    })
    }*/
    /*  搜索  */
 /*   var Find=()=>{
        let myselect=document.getElementById("search").value;
        document.getElementById('Content').innerHTML='';
     //   console.log( myselect);
        // if(!myselect)
        for (let str in FILE) {
            if(FILE[str].filename.includes(myselect))
            {
        //        console.log(FILE[str]);
                xx(FILE[str],str);
            }
        }
        document.getElementById("search").value='';
        var label = document.getElementsByClassName('label');
        for (let x=0; x<label.length;x++) {
            label[x].onclick = function(){
                let tfilelabel=FILE[x].filelabel;
                tfilelabel = tfilelabel.replace(/\+/g, "%2B");
                tfilelabel = tfilelabel.replace(/\&/g, "%26");
                xl(`filelabel=${tfilelabel}`,Url2);
            }
        }
    }
*/"use strict";

var FILE = []; //文件名
var Url2 = "<?php echo U('File/showFileSearchByLabel');?>";
/*  遍历渲染  ${text.fileusername}*/
var xx = function xx(text, i) {
    var str = "<li><span><a title=\"" + text.filename + "\" href=\"" + text.downloadurl + "\">" + text.filename + "</a></span><span></span><span>" + text.upfile_time + "</span><span class=\"label\">" + text.filelabel + "</span></li>";
    document.getElementById('Content').innerHTML += str;
};
var xl = function xl(name, Url) {
    fetch(Url, {
        method: "post",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        credentials: "same-origin",
        body: name
    }).then(function (response) {
        if (response.status == 200) {
            return response.json();
        }
    }).then(function (text) {
        document.getElementById('Content').innerHTML = '';
        //  console.log("请求成功，响应数据为:",text);
        for (var i in text) {
            xx(text[i], i);
        }
    });
};
/*  选择  */
var Change = function Change() {
    var url = "<?php echo U('File/showfile');?>";
    var myselect = document.getElementById("Sel");
    var index = myselect.selectedIndex; // selectedIndex代表的是你所选中项的index
    var val = myselect.options[index].value;

    fetch(url, {
        method: "post",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        credentials: "same-origin",
        body: "select=" + val
    }).then(function (response) {
        if (response.status == 200) {
            return response;
        }
    }).then(function (data) {
        return data.json();
    }).then(function (text) {
        document.getElementById('Content').innerHTML = '';
        // console.log("请求成功，响应数据为:",text);
        FILE = [];
        for (var i in text) {
            xx(text[i], i);
            FILE[i] = text[i];
        }
        var label = document.getElementsByClassName('label');

        var _loop = function _loop(x) {
            label[x].onclick = function () {
                var tfilelabel = FILE[x].filelabel;
                tfilelabel = tfilelabel.replace(/\+/g, "%2B");
                tfilelabel = tfilelabel.replace(/\&/g, "%26");
                xl("filelabel=" + tfilelabel, Url2);
            };
        };

        for (var x = 0; x < label.length; x++) {
            _loop(x);
        }
    });
/*.catch(function (err) {
        //     console.log("Fetch错误:"+err);
    });*/
};
/*  搜索  */
var Find = function Find() {
    var myselect = document.getElementById("search").value;
    document.getElementById('Content').innerHTML = '';
    //   console.log( myselect);
    // if(!myselect)
    for (var str in FILE) {
        if (FILE[str].filename.includes(myselect)) {
            //        console.log(FILE[str]);
            xx(FILE[str], str);
        }
    }
    document.getElementById("search").value = '';
    var label = document.getElementsByClassName('label');

    var _loop2 = function _loop2(x) {
        label[x].onclick = function () {
            var tfilelabel = FILE[x].filelabel;
            tfilelabel = tfilelabel.replace(/\+/g, "%2B");
            tfilelabel = tfilelabel.replace(/\&/g, "%26");
            xl("filelabel=" + tfilelabel, Url2);
        };
    };

    for (var x = 0; x < label.length; x++) {
        _loop2(x);
    }
};
</script>
</html>