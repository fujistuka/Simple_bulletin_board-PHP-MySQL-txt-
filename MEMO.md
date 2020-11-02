# fujitsuka
MySQL＆PHP　Simple bulletin board
I made a bulletin board linked with MySQL based on the txt read type bulletin board.
change point(txt => MySQL)
1,New post
　fopen(a),fwrite,fclose => prepare(INSERT INTO),bindParam,execute()
2,Edit execution
  fopen(w),fwrite,fclose =>update,query
3,Delete post
  fopen(w) =>delete,query
4,Edit show
  nochange
5,Roop
 foreach,explode =>query,foreach
6,Roading data
 file => new PDO,(prepare⇒bindValue⇒execute)or(select=>query)
7,create data
 "txt" =>new PDO,CREATE TABLE,query
8,if
　few change
9,Array
 foreach,explode,$[0],$[1] =>query,foreach,$[id],$[name]
10,Duplication prevention
　$=$[0] =>AUTO_INCREMENT 
