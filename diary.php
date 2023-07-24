<?php ini_set('display_errors', 0); ?>

<?php
session_start();
require_once 'config.php';
require_once 'User.php';
require_once 'Note.php';

// Check if the user is authenticated
$user = new User($conn);
if (!$user->isAuthenticated()) {
    // Redirect to login page if not authenticated
    header("Location: login.php");
    exit;
}

// Check if the note edit form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['note_id'])) {
        // Update note
        $noteId = $_POST['note_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        if($title != "" && $content != ""){
            $note = new Note($conn);
            $result = $note->update($noteId, $title, $content, $_SESSION['user_id']);
        }
        if ($result) {
            // Note updated successfully
            echo "<script>alert('Note updated successfully'); setTimeout(function() { window.location.href = 'diary.php'; }, 100);</script>";
            exit;
        } else {
            // Note update failed
            echo "";
        }
    } else if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['note_id'])) {
        $deleteNoteId = $_POST['note_id'];
    
        $note = new Note($conn);
        $deleteResult = $note->delete($deleteNoteId, $_SESSION['user_id']);
    
        if ($deleteResult) {
            // Note deleted successfully
            echo "<script>alert('Note deleted successfully'); setTimeout(function() { window.location.href = 'diary.php'; }, 100);</script>";
            exit;
        } else {
            // Note deletion failed
            echo "";
        }
    }  else {
        // Create new note
        $title = $_POST['title'];
        $content = $_POST['content'];

        if($title != "" && $content != ""){
            $note = new Note($conn);
             $result = $note->create($title, $content, $_SESSION['user_id']);
        }
        

        if ($result) {
        // Note created successfully
        echo "<script>alert('Note added successfully'); setTimeout(function() { window.location.href = 'diary.php'; }, 100);</script>";
        exit;
        } else {
            // Note creation failed
            echo "";
        }

        
    }    
}

//Check if the edit action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['note_id'])) {
    $editNoteId = $_GET['note_id'];

    $note = new Note($conn);
    $editNote = $note->getById($editNoteId);

    if ($editNote && $editNote['user_id'] == $_SESSION['user_id']) {
        $editNoteTitle = $editNote['title'];
        $editNoteContent = $editNote['content'];
    } else {
        // Invalid note or not authorized to edit
        header("Location: diary.php");
        exit;
    }
}

// Retrieve all notes for the logged-in user
$note = new Note($conn);
$notes = $note->getNotesByUserId($_SESSION['user_id'],  'ASC');

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Diary Page</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/styles-diary.css">
    <link rel="stylesheet" href="diwa/css/all.min.css">
    <link rel="stylesheet" href="diwa/css/fontawesome.min.css">
</head>
<body>
    <nav class="navbar navbar-diary">
        <div class="logo-container">
            <a href="diary.php">
                <img src="diwa/logos/4.png" alt="Diwa Logo">
             </a>
        </div>
        <p class="welcome">Ignite Your Diwa, <?php echo ucfirst($username) ; ?></p>
        <button onclick="location.href='logout.php'">
            LOGOUT
        </button>
    </nav>
    
    <div class="sidebar">
        <button class="createBtn" >CREATE ENTRY</button>
        <button class="viewBtn">VIEW ENTRIES</button>
    </div>
    <div class="createEntry">
        <form action="diary.php" method="POST">
            <?php if (!empty($editNoteId)) { ?>
                <input type="hidden" name="note_id" value="<?php echo $editNoteId; ?>">
            <?php } ?>
            <input type="text" name="title" placeholder="Title" value="<?php echo isset($editNoteTitle) ? $editNoteTitle : ''; ?>" class="inputTitle"required>
            <textarea name="content" placeholder="Tell us about your journey..." required><?php echo isset($editNoteContent) ? $editNoteContent : ''; ?></textarea>
            <?php if (!empty($editNoteId)) { ?>
            <input type="hidden" name="action" value="update">
            <button type="submit" class="updaterr">
                UPDATE
            </button>
            <button type="button" onclick="window.location.href='diary.php'" class="updaterr">
                CLEAR
            </button>
            <?php } else { ?>
                <input type="submit" value="+" class="createThis">
            <?php } ?>
        </form>
    </div>

    <div class="notes">
    <?php if (empty($notes)) { ?>
        <!-- Display the message when there are no notes -->
        <p>No entries yet, share your diwa now!</p>
    <?php } else { ?>
        <!-- Display the list of notes when there are notes -->
        <p class="diwa-title"> <?php echo ucfirst($username) ; ?>'s Diwa</p>
        <ul class="note-list">
        <?php for ($i = count($notes) - 1; $i >= 0; $i--) {$note = $notes[$i]; ?>
                <li>
                    <h3><?php echo strlen($note['title']) > 20 ? substr($note['title'], 0, 20) . "..." : $note['title']; ?></h3>
                    <p><?php echo strlen($note['content']) > 70 ? substr($note['content'], 0, 70) . "..." : $note['content']; ?></p>
                    <div class="button-container">
                        <a class="button" href="diary.php?action=edit&note_id=<?php echo $note['id']; ?>">
                            <button>
                                <i class="far fa-regular fa-eye"></i>
                            </button>
                        </a>
                        <form action="diary.php" method="POST" style="display: inline;">
                            <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" style="font-size: 15px"><i class="fa fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
<script src="scripts/diary.js"></script>
</body>
</html>