<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/ziyuangongxiang/Public/CSS/ZY.css">
  <link rel="stylesheet" href="/ziyuangongxiang/Public/CSS/font-awesome.min.css">
  <title>文件&软件下载站(测试版)</title>
  <script>
function isIE() { //ie?
 if (!!window.ActiveXObject || "ActiveXObject" in window)
  return true;
  else
  return false;
 }
function gohistory(){
        console.log("推荐使用chrome浏览器");
        //history.go(-1);
}

isIE()? gohistory(): null;

  </script>
  <script  src="/ziyuangongxiang/Public/JS/es5-shim.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es5-sham.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es6-promise.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/es6-promise.auto.min.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/fetch-detector.js"></script>
  <script  src="/ziyuangongxiang/Public/JS/fetch-ie8.js"></script>

  <style  type="text/css">
    section ul li span:nth-of-type(1){
      width: 200px;
    }
    section ul li span:nth-of-type(2){
      width: 100px;
      font-size: .8em;
      text-align: center;
    }
    section ul li span:nth-of-type(3){
      width: 150px;
      text-align: center;
    }
    section ul li span:nth-of-type(4){
      width: 200px;
      height: 100%;
      border-radius: inherit;
      color:inherit;
      border:inherit;
      background: inherit;
      text-align: center;
      letter-spacing: 1px;
    }
    section ul li span:nth-of-type(5){
      width: 65px;
      height: 100%;
      border-radius: 3px;
      color: #fff;
      border: 1px solid #fff;
      background: rgba(255, 0, 0, 0.5);
      text-align: center;
      letter-spacing: 1px;
    }
    .upl{
      display: inline-block;
      width: 200px;
      text-align: center;
      border-radius: 3px;
      border: 1px solid #f99;
      padding: .5em;
      margin-left: 3em;
    }
    ul li a{display:inline-block;}
    .upl a{
      color: rgba(217, 0, 65, 0.92);
    }
  </style>

</head>

<body>
<header>
  <span><img src="/ziyuangongxiang/Public/image/1.png" width="100" alt="">资源下载站</span>
  <div class="upl">
    <a href="<?php echo U('File/displayup');?>">上传文件</a>
  </div>
</header>
<article class="container">
  <div class=" left">
    <i class="fa fa-linode fa-2x"></i>我上传的文件列表

    <label for="search">
      <i class="fa fl fa-superpowers fa-lg fa-border" onclick="Find()"></i>
    </label><input id="search" type="text" name="" value="" placeholder="搜 索">

    <section>
      <ul>
        <li><span><i class="fa fa-cube fa-lg"></i> Name</span>
          <span><i class="fa fa-crop fa-lg"></i> 下载次数</span>
          <span><i class="fa fa-crop fa-lg"></i> Size</span>
          <span><i class="fa fa-calendar-minus-o fa-lg"></i> Last Update</span>
        </li>
      </ul>
      <hr/>
      <ul class="colorred" id="Content"></ul>
    </section>
  </div>
  <nav class="right">
    <ul>
      <li><a href="http://210.30.1.126/teacher.php/Index/index">教师首页</a></li>
      <li><a href="http://210.30.1.126/teacher.php/Exam/index">浏览考试与实验</a></li>
      <li><a href="http://210.30.1.126/teacher.php/Problems/index">浏览题目</a></li>
      <li><a href="http://210.30.1.126/teacher.php/SubmitStaus/showState">提交状态</a></li>
      <!--li><a href="http://210.30.1.126/index.php/Exam">考试</a></li-->
      <li><a href="http://210.30.1.126/teacher.php/Bbs/invitation_list">讨论版</a></li>
      <!--li><a href="http://210.30.1.126/index.php/Home/help">帮助</a></li-->
      <li>意见反馈<br/>imax2017@yeah.net</li>
    </ul>
  </nav>

</article>
<footer>
  <img src="/ziyuangongxiang/Public/image/name.png" width="500" alt="">
  <div id="time">

  </div>
</footer>
</body>
<script type="text/javascript">

 /*   var FILE=[];//文件名
    const Url1="<?php echo U('User/deleteFile');?>";
    const Url2="<?php echo U('File/UserinfoSearchByLabel');?>";
    /*  遍历渲染  */
/*    let xx=(text,i)=>{
        let str=`<li><span><i class="fa fa-trash-o fa-lg"></i><a title="${text.filename}" href="${text.downloadurl}">${text.filename}</a></span><span>${text.count}</span><span>xxx</span><span>${text.upfile_time}</span><span class="label">${text.filelabel}</span></li>`;
        document.getElementById('Content').innerHTML+=str;
    }

    let xd=(name,Url)=>{
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
            return response.text();
        }
    })
    .then(data=>{
            if(data=='1000')
        window.location.reload();
    else if(data=='1001')
            alert("删除失败");
        else
            alert("未知错误");
    })
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
       // console.log("请求成功，响应数据为:",text);
        for (let i in text) {
            xx(text[i],i);
        }
    })
    }

    /*  获取数据  */
/*    (function Getdata(){
        const url=`<?php echo U('User/userinfo');?>`;
        fetch(url,{
            method:"post",
            headers:{
                "Content-type":"application/x-www-form-urlencoded"
            },
            credentials: "same-origin"
        })
            .then(response=>{
            if (response.status == 200){return response;}})
    .then(data=>{return data.json();})
    .then(text=>{
            document.getElementById('Content').innerHTML='';
      //  console.log("请求成功，响应数据为:",text);
        FILE=[];
        for (let i in text) {
            xx(text[i],i);
            FILE[i]=text[i];
        }
        var delet = document.getElementsByClassName('fa-trash-o');
        var label = document.getElementsByClassName('label');
        for (let x=0; x<delet.length;x++) {
            //var r=confirm("Press a button")
            delet[x].onclick = function(){
                let r=confirm("确认要删除"+FILE[x].filename+"吗？");
                let filename=FILE[x].filesavename;
                if(r==true)
                    xd("filesavename="+filename,Url1);
            }
        }
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
        //    console.log("Fetch错误:"+err);
    })
    })();
    var Find=()=>{
        let myselect=document.getElementById("search").value;
        document.getElementById('Content').innerHTML='';
        //   console.log( myselect);
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
    }*/


"use strict";

var FILE = []; //文件名
var Url1 = "<?php echo U('User/deleteFile');?>";
var Url2 = "<?php echo U('File/UserinfoSearchByLabel');?>";
/*  遍历渲染  */
var xx = function xx(text, i) {
    var str = "<li><span><i class=\"fa fa-trash-o fa-lg\"></i><a title=\"" + text.filename + "\" href=\"" + text.downloadurl + "\">" + text.filename + "</a></span><span>" + text.count + "</span><span>xxx</span><span>" + text.upfile_time + "</span><span class=\"label\">" + text.filelabel + "</span></li>";
    document.getElementById('Content').innerHTML += str;
};

var xd = function xd(name, Url) {
    fetch(Url, {
        method: "post",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        credentials: "same-origin",
        body: name
    }).then(function (response) {
        if (response.status == 200) {
            return response.text();
        }
    }).then(function (data) {
        if (data == '1000') window.location.reload();else if (data == '1001') alert("删除失败");else alert("未知错误");
    });
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
        // console.log("请求成功，响应数据为:",text);
        for (var i in text) {
            xx(text[i], i);
        }
    });
};

/*  获取数据  */
(function Getdata() {
    var url = "<?php echo U('User/userinfo');?>";
    fetch(url, {
        method: "post",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        credentials: "same-origin"
    }).then(function (response) {
        if (response.status == 200) {
            return response;
        }
    }).then(function (data) {
        return data.json();
    }).then(function (text) {
        document.getElementById('Content').innerHTML = '';
        //  console.log("请求成功，响应数据为:",text);
        FILE = [];
        for (var i in text) {
            xx(text[i], i);
            FILE[i] = text[i];
        }
        var delet = document.getElementsByClassName('fa-trash-o');
        var label = document.getElementsByClassName('label');

        var _loop = function _loop(x) {
            //var r=confirm("Press a button")
            delet[x].onclick = function () {
                var r = confirm("确认要删除" + FILE[x].filename + "吗？");
                var filename = FILE[x].filesavename;
                if (r == true) xd("filesavename=" + filename, Url1);
            };
        };

        for (var x = 0; x < delet.length; x++) {
            _loop(x);
        }

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
    });
    /* .catch(err=>{
         //    console.log("Fetch错误:"+err);
     })*/
})();
var Find = function Find() {
    var myselect = document.getElementById("search").value;
    document.getElementById('Content').innerHTML = '';
    //   console.log( myselect);
    for (var str in FILE) {
        if (FILE[str].filename.includes(myselect)) {
            //        console.log(FILE[str]);
            xx(FILE[str], str);
        }
    }
    document.getElementById("search").value = '';
    var label = document.getElementsByClassName('label');

    var _loop3 = function _loop3(x) {
        label[x].onclick = function () {
            var tfilelabel = FILE[x].filelabel;
            tfilelabel = tfilelabel.replace(/\+/g, "%2B");
            tfilelabel = tfilelabel.replace(/\&/g, "%26");
            xl("filelabel=" + tfilelabel, Url2);
        };
    };

    for (var x = 0; x < label.length; x++) {
        _loop3(x);
    }
};
</script>
</html>