<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
<body>


<?php
  $filename = "Mission3-5.txt";

   


               //新規投稿機能  
if (!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['passcode'])) {
 $password=$_POST['passcode'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $date = date("Y/m/d H:i:s");


     //編集対象番号が入力されているなら
     //最終番号＝＝投稿番号にする
    if (empty($_POST['edit-number'])) {
       //ファイルの存在がある場合は投稿番号+1、なかったら1を指定する
  if(isset($_POST['name'])&&($_POST['comment'])&&!($_POST['edit'])){
    $lines=file($filename);
    foreach($lines as $line){
        $data=explode("<>",$line);
        $num=0;
        if($num<$data[0]){
           $num=$data[0];
           }
           }
           $num++;
           $fp=fopen($filename,'a');
           fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."<>".$password."\n");
           fclose($fp);
}


/*
    if (file_exists($filename)) {
    $number = count(file($filename)) + 1;
      } else {
      $number = 1;
      }
*/

 



         //編集実行機能  つまり新規投稿と編集で分岐する
  }else{

    $edit_number = $_POST['edit-number']; //読み込んだファイルの中身を配列に格納する
    $ret_array = file($filename);
    $fp = fopen($filename,"w");     //ファイルを開き、中身を空に 

    foreach ($ret_array as $line) {   //配列の数だけループ
    $edit_data= explode("<>",trim($line));

        //新稿番号と編集番号が一致・不一致で分ける
      if ($edit_data[0] == $edit_number && $password==$edit_data[4]){

       //編集のフォームで送信された値で上書きする（$edit_numberが$numberと変わっている）
      fwrite($fp, $edit_number. "<>" . $name . "<>" . $comment . "<>" . $date . "<>" .$password. "\n");


      } else {
        fwrite($fp,$line);  //不一致なら書き込む
     }
     }
        fclose($fp);

      }
  }  



                    //削除機能
if(!empty($_POST['deleteNo']) && !empty($_POST['Delpasscode'])){  //DelpasswordがPOSTされていないなら、機能しない


    $Delpassword=$_POST['Delpasscode'] ;
    $delete=$_POST['deleteNo']; //$deleteの定義づけ
    $delcon=file("Mission3-5.txt"); //file関数で開くテキストファイルの指定
    $fp=fopen("Mission3-5.txt","w");//ファイル読み込み、中身を空にする


    for($j=0; $j<count($delcon); $j++){ //ループ処理を行う
    $deldata=explode("<>",trim($delcon[$j])); //カッコで抽出


     //行内容をファイルに書き込む

   
    if($deldata[0] == $delete && $deldata[4]==$Delpassword){ //削除番号と行番号が一致・不一致
   //行内容をファイルに書き込む
     fwrite($fp, "");
    }else{
     //書き込まない（つまり削除）、行を詰める
      fwrite($fp,$delcon[$j]);
    }
    }

    fclose($fp); //ファイルを閉じる
}




        //編集選択機能
if (!empty($_POST['edit']) &&!empty($_POST['Editpasscode'])) {

   //入力データの受け取りを変数に代入
        $Editpassword= $_POST['Editpasscode'];
        $edit = $_POST['edit'];

   //読み込んだファイルの中身を配列に格納する
        $editCon = file($filename);

      foreach ($editCon as $line) {  
      $editdata = explode("<>",trim($line));

       //投稿番号と編集対象番号が一致したらその投稿の「名前」と「コメント」を取得
        if ($edit == $editdata[0] &&$editdata[4]==$Editpassword) {

       //投稿のそれぞれの値を取得し変数に代入
        $editnumber = $editdata[0];
        $editname = $editdata[1];
        $editcomment = $editdata[2];

    //既存の投稿フォームに、上記で取得した「名前」と「コメント」の内容が既に入っている状態で表示させる
    //formのvalue属性で対応
      }
        }
}
?>




<form action="" method="post">
<input type="text" name="name" placeholder="名前" value="<?php if(isset($editname)) {echo $editname;} ?>"><br>
<input type="text" name="comment" placeholder="コメント" value="<?php if(isset($editcomment)) {echo $editcomment;} ?>">
<input type="hidden" name="edit-number" value="<?php if(isset($editnumber)) {echo $editnumber;} ?>">
<input id="password" type="password" name="passcode" value="<?php if(isset($editpassword)) {echo $editpassword;} ?>" placeholder="パスワードを入力してください">
<input type="submit" name="submit" value="送信" >
</form>


<form action="" method="post">
<input type="text" name="deleteNo" placeholder="削除対象番号">
<input id="password" type="password" name="Delpasscode"  value="" placeholder="パスワードを入力してください">
<input type="submit" name="delete" value="削除">
</form>

<form action="" method="post">
<input type="text" name="edit" placeholder="編集対象番号">
<input id="password" type="password" name="Editpasscode"  value="" placeholder="パスワードを入力してください">
<input type="submit" value="編集" name="edit2">
</form>



<?php      


                    //表示機能
                      $filename = "Mission3-5.txt";
      if (file_exists($filename)) { 
           $data = file($filename); //読み込んだファイルの中身を配列に格納する


        if(isset($_POST['submit']) || isset($_POST['delete']) ||isset($_POST['edit2']))
      { 
           


         foreach ($data as $line) { 
         $showdata = explode("<>",$line);  
         echo $showdata[0] . "<>" . $showdata[1] . "<>" . $showdata[2] . "<>" . $showdata[3]  ."<br>"; 
         }
      }
      }
   
   

        
      
      


?>

  </body>
</html>