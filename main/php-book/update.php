<?php
if(!isset($_POST['ISBN'])){
    alertMsg('HTTP method error');
    header("refresh:0;url='bookchange.htm'");
}else{
    $conn=require("../config.php");
    $bookName=$_POST["bookName"];
    $author=$_POST["author"];
    $ISBN=$_POST["ISBN"];
    $publisher=$_POST['publisher'];
    $publish_year=$_POST['publish_year'];
    $num=$_POST['num'];
    $describeBook=$_POST["describeBook"];
    $class=$_POST["class"];
    $img_url=null;
    $imageBlob=null;
    $filetype="";
    $imageBlob="";
    if(isset($_FILES['image']['name'])){
        $filename=$_FILES['image']['name'];
        $filetype=$_FILES['image']['type'];
        $filesize=$_FILES['image']['size']; 
        $tmpname=$_FILES['image']['tmp_name'];
    }
    
    $haveImage=true;
    if (isset($_POST["img_url"])){
        $img_url=$_POST["img_url"];
    }
    if(isset($_FILES["image"])&&$_FILES["image"]["error"] == 0  ){
        $imageBlob = mysqli_real_escape_string($conn,file_get_contents($tmpname)); //獲取圖片    

    }
    $oldnum=0;
    if($conn){
        $sql="select num from book where ISBN='$ISBN'";
        $result = mysqli_query($conn,$sql);
        $datas=array();
       //  echo "in";
        if ($result) {
            // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            if (mysqli_num_rows($result)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result)) {
                    // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                }
            }
            // 釋放資料庫查到的記憶體
            mysqli_free_result($result);
        }
        else {
            alertMsg("找不到書籍")  ;
        }
        $return_value="";
        // 處理完後印出資料
        if(!empty($result)){
            $oldnum=$datas[0]["num"];
        }  
        mysqli_query($conn,'SET NAMES uff8');
        echo "正確連接資料庫";
    }
    else {
        echo "不正確連接資料庫</br>" . mysqli_connect_error();
    }
    $stmt = $conn->prepare("update book set bookName='$bookName'
    , author='$author'
    , publisher='$publisher'
    , publish_year='$publish_year'
    ,num='$num'
    ,describeBook='$describeBook'
    ,class='$class'
    ,img_url='$img_url'
    , bookImage='$imageBlob' 
    ,imageType='$filetype' 
    where ISBN='$ISBN'");
    // $stmt->bind_param("s",$bookUniqueID);
    // $bookUniqueID=$ISBN.'_0';
    if($oldnum>$num)
    {
        alertMsg("")
    }else{

    }
    // $stmt->bind_param();
    $stmt->execute();
}
function alertMsg($msg){
    echo "<script>
    window.alert('$msg');
    </script>";
}
?>