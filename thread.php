<?php
  dbconnect();
  if(!$_GET['tid']) {
    echo "<script>window.location='/';</script>";
    die();
  }
  $tid = $_GET['tid'];
  $res = dbquery("SELECT COUNT(*) FROM threads 
                  WHERE tid=:tid", 
                  array('tid'=>$tid));
  if($res->fetchColumn() == 0) {
    echo "<script>window.location='/';</script>";
    die();
  }
  $title = getTopicTitle($tid);
  breadcrumbs(getParent($tid), $tid);
  
  echo "<div id='thread'>
          <div id='titlebar'>
            <div id='title'>
              <a href='?page=thread&tid=$tid'><h1>$title</h1></a>
            </div>
            <div id='post-button'>
            <div class='buttons'>
              <a href='?page=discussion&tid=$tid'><button>Post Reply</button></a>
            </div>
            </div>
            
          </div>";
  if (allow('mod_approve')) {
    $res = dbquery("SELECT * FROM posts
                    WHERE tid=:tid
                    ORDER BY date;",
                    array('tid'=>$tid));
  } else {
    $res = dbquery("SELECT * FROM posts
                    WHERE tid=:tid AND approved=1
                    ORDER BY date;",
                    array('tid'=>$tid));
  }
  while($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $pid = $row['pid'];
    $title = $row['title'];
    $content = nl2br($row['content']);
    $uid = $row['uid'];
    $date = date("D, d M Y H:i", strtotime($row['date']));
    $user = getUsername($uid);
    echo "  
    <div class='post'>
      <div class='post-data'>
        <span>Username: <a href='?page=profile&uid=$uid'>$user</a></span>
        <p>Date: $date</p>
      </div>
      <div class='post-content'>
        <a name='p$pid' href='?page=thread&tid=$tid#p$pid'><h2>$title</h2></a>
        <span>$content</span>
      </div>
      
    </div>";
  }
  echo "</div>";
?>
