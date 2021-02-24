<?php
session_start();
$lists_array = [];
$task_array = [];
if (isset($_SESSION['user_id'])) {
    if (!isset($pdo)) {
        $config = require_once './config.php';
        try {
            $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['dbname']), $config['user'], $config['pass']);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    //fill todo lists
    $sql = <<<'SQL'
        select * from todo_lists 
            where 
            user_id= :user_id
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['user_id' => $_SESSION['user_id']]);
    $lists_array = $sth->fetchAll();
    if ($sth->rowCount() != 0) {
        if (!isset($_SESSION['list_id'])) {
            $_SESSION['list_id'] = $lists_array[0]['id'];
        }
    }
} else {
    header('location: ./login.php');
    exit();
}


//add list
if (isset($_POST['add_list'])) {
    echo "asasa";
    $sql = <<<'SQL'
        insert into todo_lists 
            (user_id,list_name,created_at)
            values (:user_id,:list_name,:created_at)
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $param = ['user_id' => $_SESSION['user_id'], 'list_name' => $_POST['list_name'],
        'created_at' => date('y-m-d')];
    $sth->execute($param);
    header('location: ./index.php');
    exit();
}

//delete list
if (isset($_POST['delete_list'])) {
    $sql = <<<'SQL'
        delete from todo_lists 
             where id=:list_id
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $par = ['list_id' => $_POST['selectedlist']];
    $sth->execute($par);
    header('location: ./index.php');
    exit();
}

//fill tasks array
if (isset($_POST['selectedlist']) || isset($_SESSION['list_id'])) {
    $_SESSION['list_id'] = (isset($_POST['selectedlist']) ? $_POST['selectedlist'] : $_SESSION['list_id']);
    $sql = <<<'SQL'
        select id,created_at,is_done,title from todo_tasks 
            where 
            ( user_id=:user_id and list_id=:list_id)
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['user_id' => $_SESSION['user_id'],'list_id' => $_SESSION['list_id'] ]);
    $task_array = $sth->fetchAll();
}


//add task
if (isset($_POST['add'])) {
    $sql = <<<'SQL'
        insert into todo_tasks (user_id,list_id,created_at,is_done,title)
        values
        (:user_id,:list_id, :curent_date,:status,:task_title);
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $param = ['user_id' => $_SESSION['user_id'], 'list_id' => $_SESSION['list_id'],
     'curent_date' => date('y-m-d'), 'status' => (isset($_POST['isdone']) ? 1 : 0) ,
     'task_title' => $_POST['task_title']];
    $sth->execute($param);
    header('location: ./index.php');
    exit();
}

//delete task
if (isset($_POST['delete'])) {
    $sql = <<<'SQL'
        delete from todo_tasks 
            where id= :task_id
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $par = ['task_id' => $_POST['task_id']];
    $sth->execute(['task_id' => $_POST['task_id'] ]);
    header('location: ./index.php');
    exit();
}
//update task
if (isset($_POST['update'])) {
    $sql = <<<'SQL'
        update todo_tasks set is_done=:is_done,
                              created_at=:created_at,
                              title=:task_title
            where id= :task_id
     SQL;
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $param = ['is_done' => (isset($_POST['isdone']) ? 1 : 0), 'created_at' => $_POST['created_at'],
        'task_title' => $_POST['task_title'], 'task_id' => $_POST['task_id']];
    $sth->execute($param);
    header('location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Todo List Application</title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <script type="application/javascript">
        function change_task_visibility(trid) {
            var x = document.getElementById("current ".concat(trid));
            if (x.className  === "table-row") {
                x.className = "table-row-h";
            } else {
                x.className = "table-row";
            }
            var y = document.getElementById("new ".concat(trid));
            if (y.className === "table-row") {
                y.className = "table-row-h";
            } else {
                y.className = "table-row";
            }
            return false;
        }
        function change_list_visibility() {
            var x = document.getElementById("tasklist1");
            if (x.className  === "table-row") {
                x.className = "table-row-h";
            } else {
                x.className = "table-row";
            }
            var y = document.getElementById("tasklist2");
            if (y.className === "table-row") {
                y.className = "table-row-h";
            } else {
                y.className = "table-row";
            }
            return false;
        }
    </script>
</head>
<body>
    <div class="main-header">
        <h2>Welcome "<?= $_SESSION['user_name']?>" to your TODO LIST</h2>
    </div>
    <ul class="group-1">
        <li class="header3" >
            <h4 >Select a Todo List:</h4>
        </li>
        <li id="tasklist1" class="table-row">
            <div class="col-form">
                <form method="post" action="./index.php" >
                <div class="col-1"><select name="selectedlist" class="select" >
                    <?php foreach ($lists_array as $List) :?>
                        <option value="<?= $List['id']?>" <?=($List['id'] == $_SESSION['list_id']) ? "selected" : ""?>>
                            <?= $List['list_name']?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <div class="col-2"><input name="selected_list" type="submit" value="Show" class="btn"></div>
                <div class="col-3"><input name="delete_list" type="submit" value="Delete" class="btn"></div>
                </form>
            </div>
            <div  class="col-4">
                <button name="newlist" value="add" onclick="change_list_visibility()" class="btn"> Add List</button>
            </div>
        </li>
        <li id="tasklist2"  class="table-row-h">
            <div class="col-form">
                <form method="post" action="./index.php">
                    <div class="col-1"><input type="text" name="list_name" class="select"></div>
                    <div class="col-5"><input name="add_list" type="submit" value="save" class="btn"></div>
                </form>
            </div>
            <div class="col-4">
                <button name="cancel" value="cancel" onclick="change_list_visibility()" class="btn"> Cancel</button>
            </div>

        </li>
    </ul>

<table class="table">
    <thead>
    <tr  class="header">
        <th class="th" scope="col" colspan="3">Add New Tasks here</th>
    </tr>
    </thead>
    <tbody >
    <tr id="add new task" class="table-row">
        <form method="post" action="./index.php">
            <td><input type="checkbox" name="isdone"  > Done</td>
            <td><input type="text" name="task_title" class="select" ></td>
            <td colspan="2"><input name="add" type="submit" value="New Task" class="btn""></td>
        </form>

    </tr>
    </tbody>
</table>
  <table class="table">
      <thead class="th">
      <tr class="header">
          <th class="th-1" >status</th>
          <th>task</th>
          <th>created</th>
          <th class="th-2"  colspan="2">ACTIONS</th>
      </tr>
      </thead>
      <tbody >
      <?php foreach ($task_array as $List) :?>
        <tr id="current <?= $List['id'] ?>" CLASS="table-row">
            <form method="post" action="./index.php">
                <td class="td-1"><input type="checkbox"  <?= (($List['is_done'] == 1) ? "checked" : '' ) ?> ></td>
                <td class="td-2"><?= $List['title']?></td>
                <td class="td-3"><?= $List['created_at']?> <input type="hidden" name="task_id" value="<?= $List['id'] ?>"></td>
                <td class="td-4"><input name="delete" type="submit" value="Delete" class="btn"></td>
            </form>
            <td class="td-5">
                <button name="edite" value="Edite" onclick="change_task_visibility(<?= $List['id'] ?>)" class="btn">
                    Edite
                </button>
            </td>
        </tr>
              <tr id="new <?= $List['id'] ?>" CLASS="table-row-h">
                  <form method="post" action="./index.php">
                      <td class="td-1"><input type="checkbox" name="isdone" <?= (($List['is_done'] == 1) ? "checked" : '' ) ?> ></td>
                      <td class="td-2"><input type="text" name="task_title" value="<?= $List['title']?>"></td>
                      <td class="td-3"><input type="date" name="created_at" value="<?= $List['created_at']?>"></td>
                      <td class="td-4"><input type="hidden" name="task_id" value="<?= $List['id'] ?>">
                              <input name="update" type="submit" value="Save" class="btn">
                      </td>
                  </form>
                     <td class="td-5">
                         <button name="cancel" value="cancel" onclick="change_task_visibility(<?= $List['id'] ?>)"
                              class="btn"> Cancel</button>
                     </td>
              </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
    <ul class="group-1">
        <li  ">
           <div class="log-out">
               <form action="./action.php" method="post">
                   <button type="submit" name="logout" value="Log Out" class="btn-out">Log Out</button>
               </form></div>
        </li>
    </ul>

</body>
</html>
