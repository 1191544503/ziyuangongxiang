<?php
namespace Home\Controller;
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class FileController extends BaseController{
    public function displayup(){
        $username =$_SESSION['username'];
        $fileModel=D('file');
        $result=$fileModel->searchLabelByUsername($username);
        $this->assign(label,$result);
     //   print_r($result);
        $this->display('upfile');
    }
    /**
     * 展示文件
     * 根据分页每页15个文件
     */
    public function showfile(){
        $fileModel = D('file');
        $filefolder=I('post.select');
        if($filefolder=="teacher") {//判断展示哪类文件
            $fileusername = $_SESSION['teacherid'];////////////////////////////////////////////////////////////////////

            //查询数据数量 将数量传给page产生分页 然后将分页传给MODEL查询数据
          //  $count = $fileModel->queryFileCountByUsername($fileusername);//查询信息数量

            $result = $fileModel->queryDataByUsername($fileusername);//，查询信息数据
            $label=$fileModel->searchLabelByUsername($fileusername);//查询标签数据
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
        //    $_SESSION['search_flag']=1;//该session用于搜索，需要改善
            $this->assign(label,$label);

        }
        else if($filefolder=="common"){
      //      $count = $fileModel->queryFileCountByFolder($filefolder);//查询信息数量
            $result=$fileModel->queryFileByFolder('testdata');//查询文件夹内文件根据page分页
            for($i=0;$i<count($result);$i++){
                $result[$i]['downloadurl'] = U('File/downloadFile')."&folders={$result[$i]['filesavefolder']}&file={$result[$i]['filesavename']}&reallyfile={$result[$i]['filename']}&fileusername={$result[$i]['username']}";
            }
  //          $_SESSION['search_flag']=0;
        }
        echo json_encode($result);

}

    /**
     * 处理文件信息
     */

    public function up(){
        $file= $_FILES['upfile'];
        $username = session('username');
        $uptype=I('post.filetype');
        if($uptype=="teacherfile"){//上传正常教师文件
            $filename=$file['name'];
            $data['filelabel']=I('post.label1');//获取标签
            if($data['filelabel']==""){
                $data['filelabel']=I('post.label');
            }
            $data['filesavefolder'] = "ziyuan";
        }
        elseif($uptype=="testdata"){//上传公共文件
            $filename=$file['name'];
            $data['filesavefolder'] = "testdata";
            $data['filelabel']="公共文件";
          //  $filename = $this->subFilename($file['name'],$filename);//将后输入的文件名拼接后缀
        }
        $filenamemd5=$this->md5FileName($filename,date(Y-m-d));
        $filesavename = $this->subFilename($filename,$filenamemd5);
        $data['fileusername'] = $username;
        $data['filename'] = $filename;
        $data['filetype'] = $file['type'];
        $data['filesavename'] = $filesavename;
        $data['isdelete'] = 0;
        $data['count'] = 0;
        $data['upfile_time'] = date("Y-m-d");
        $fileModel = D('file');

        if($this->upFile($file,$filenamemd5,$data['filesavefolder'])){
            if($fileModel->insertData($data)) {
                $this->success("上传成功",U('file/displayup'));
            }else{
                $this->error("上传失败",U('file/displayup'));
            }
        }else{
            $this->error("上传失败",U('file/displayup'));
        }
    }



    /**
     * 文件上传函数
     * 参数 文件信息 保存的件名 保存的文件夹
     */
    public function upFile($file,$filename,$folders){
        $folders = iconv("utf-8","GBK",$folders);
        $path='./Public/'.$folders.'/';
        if(!file_exists($path)){
            mkdir($path);
        }

        $upload = new \Think\Upload();
        $upload->maxSize=3145728000;
        $upload->autoSub=false;
        $upload->rootPath=$path;
        $upload->saveName = $filename;
        $upload->exts = array('pptx','pdf','exe','jpg','jpeg','zip','doc','txt','docx','png','ppt','gif','bmp','mp4','avi','xml','rar','7z');
        $upload->uploadReplace = false;

        $info = $upload->uploadOne($file);

        if($info){
            return true;
        }else{
            $this->error=$upload->getError();
            echo $this->error;
            return false;
        }
}
     /**
      * 文件下载函数
      *
      */
 public function downloadFile(){
        $folders=I('get.folders');
        $file = I('get.file');
        $reallyfile=I('get.reallyfile');

        echo $file;
        $reallyfile=urlencode($reallyfile);
        $file = iconv("utf-8","GBK",$file);
        $url ='/usr/local/nginx/html/parabola923/ziyuangongxiang/Public/'.$folders.'/'.$file;
        echo  $url;
        import('Org.Net.Http');
        $fileModel=D('file');
        $fileModel->addCount($file);

        $http=new \Org\Net\Http;
        $http->download($url,$reallyfile);
 }
    /**
     *
     */
    public function onlineShow()
    {
        $folders = I('get.folders');
        $file = I('get.file');
        $reallyfile = I('get.reallyfile');
        $len=strlen($reallyfile);
        if($reallyfile[$len-3]=='t'&&$reallyfile[$len-2]=='x'&&$reallyfile[$len-1]=='t'||1) {

            $reallyfile = urlencode($reallyfile);
        //    $folders = iconv("utf-8", "GBK", $folders);
            $file = iconv("utf-8", "GBK", $file);
            $url = '/usr/local/nginx/html/parabola923/ziyuangongxiang/Public/'.$folders.'/'.$file;

            if (file_exists($url)) {
                $str = file_get_contents($url);//将整个文件内容读入到一个字符串中
                $str = str_replace("\r\n", "<br />", $str);
                $str = iconv("gb2312", "utf-8//IGNORE", $str);
                echo $str;

            }
        }else{
            echo "该文件类型暂不支持在线浏览";
        }
    }

    /**
     * 在showfile中检索数据
     */
    public function showFileSearchByLabel(){
        $label=I('post.filelabel');
        $fileModel = D('file');
	if($label=="公共文件"){
            $result = $fileModel->searchFileBygonggong();
        }else {
        $fileusername = $_SESSION['teacherid'];//获取该页面文件是谁的
      //  $count=$fileModel->searchFileCountByfilename($fileusername,$label);
        $result=$fileModel->searchFileBylabel($fileusername,$label);
       }
	 echo json_encode($result);
    }
    public function UserinfoSearchByLabel(){
        $label=I('post.filelabel');
        $fileModel = D('file');
        $fileusername = $_SESSION['username'];
        //  $count=$fileModel->searchFileCountByfilename($fileusername,$label);
        $result=$fileModel->searchFileBylabel($fileusername,$label);
        echo json_encode($result);
    }
    /**
     *文件命名MD5加密
     * 通过将文件名尾部添加随机数，并进行15次md5加密
     */
 public function md5FileName($filename ,$date){
        $random=rand(1001,9999999);
        $filename.=$date;
        $filename.=$random;

        for($i=0;$i<15;$i++) {
            $filename = md5($filename);
        }

        return $filename;
 }
    /**
     * 文件名后缀拼接
     */
 public function subFilename($filename,$filesavename){

     $filesavename.=strchr($filename,".");
     return $filesavename;
 }

}
?>
