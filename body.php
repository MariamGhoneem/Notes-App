<?php
session_start();
if (isset($_SESSION['user'])){
    $userId = $_SESSION['user'];
    require_once("queries.php");
    $noteRes = getData("note","*","userid=$userId");
}
else {
    header("location:login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Notes</title>
  <link rel="stylesheet" href="style.css">
  </link>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"
    ></script>
</head>

<body>
  <div id="app">
    <div class="toolbar">
      <button onclick="addNote()" class="toolbar-button" id="new">New</button>
      <button onclick="deleteNote()" class="toolbar-button" id="delete">Delete</button>
      <input class="toolbar-search" type="text" placeholder="Search...">
    </div>
    <div class="note-container">
      <div class="note-selectors" >
        <?php
          while ($notesData=mysqli_fetch_assoc($noteRes)){
            $content = $notesData['content'];
            $noteId = $notesData['id'];
            $noteTitle = $notesData['noteTitle'];
        ?>
        <div onclick="updateScreen(this)" class="note-selector" 
          data-id="<?= $noteId ?>"
          data-title="<?= $noteTitle ?>"
          data-content="<?= $content ?>"
         >
          <p class="note-selector-title"><?= $noteTitle; ?></p>
        </div>
        <?php
          }
        ?>
      </div>
      <div class="note-editor">
        <p class="note-editor-info">Timestamp here...</p>
        <textarea class="note-editor-smlinput" id="title" >
            loading
        </textarea> <br/>
        <textarea class="note-editor-input" id="content">
            I'm loading this note
        </textarea>
        <button onclick="saveNote()" id="save" style="height: 30px; color: #000;">Save</button>

        <script>
          //loading first post
          const notes = Array.from(document.getElementsByClassName("note-selector")) // Converting HTMLCollection to array.

          const noteTitleElement = document.getElementById("title")
          const noteContentElement = document.getElementById("content")

          noteTitleElement.value = notes[0].dataset.title
          noteContentElement.value = notes[0].dataset.content
          var idd = notes[0].dataset.id
          
          const updateScreen = element => {
            noteTitleElement.value = element.dataset.title
            noteContentElement.value = element.dataset.content
            idd = element.dataset.id; 
          }
          const deleteNote = ()=>{
            $.ajax({
                url:"deletenote.php",
                method:"Post", 
                data: {noteId:idd,delete:1},
                success: ()=>{
                    window.location.reload(true);
              }
            });
          }
          const addNote =()=>{
            $.ajax({
                url:"addnote.php",
                method:"Post",
                success: ()=>{
                    window.location.reload(true);
              }
            });
          }
          const saveNote =()=>{
            $.ajax({
                url: "editnote.php",
                method: "Post",
                data: {title:noteTitleElement.value,content:noteContentElement.value,id:idd,save:1},
                success: ()=>{
                    window.location.reload(true);
              }
            });
          }
        </script>
      </div>
    </div>

    <form class="toolbar" action="logout.php">
      <input type="submit" value="Log Out" name="logout" class="toolbar-button" style="float: right;">
      <a href="editdata.php" class="toolbar-button">Edit personal data</a>
    </form>

  </div>
</body>
</html>