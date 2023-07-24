<?php
class Note {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function create($title, $content, $userId) {
        $stmt = $this->conn->prepare("INSERT INTO notes (title, content, user_id) VALUES (:title, :content, :user_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->rowCount() > 0;
    }
    
    public function update($noteId, $title, $content, $userId) {
        $stmt = $this->conn->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $noteId);
        $stmt->bindParam(4, $userId);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }
    
    public function delete($noteId, $userId) {
        $stmt = $this->conn->prepare("DELETE FROM notes WHERE id = :note_id AND user_id = :user_id");
        $stmt->bindParam(":note_id", $noteId, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    // public function delete($noteId, $userId) {
    //     $sql = "DELETE FROM notes WHERE id = $noteId AND user_id = $userId";
		
	// 	if($this->conn->query($sql) == true) {
	// 		echo "Data Deleted Successfully";
	// 	}else{
	// 		echo "Error: ".$sql ."<br/>".$this->conn->error;
	// 	}
    // }


    public function getById($noteId) {
        $stmt = $this->conn->prepare("SELECT * FROM notes WHERE id = :note_id");
        $stmt->bindParam(":note_id", $noteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getNotesByUserId($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM notes WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
