<?php
class ImageModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function insertImage($filename, $date, $lieu) {
        // Insérer les informations de l'image dans la table t_image
        $stmt = $this->conn->prepare("INSERT INTO t_image (filename, date) VALUES (?, ?)");
        $stmt->bind_param("ss", $filename, $date);
        $stmt->execute();
        $image_id = $stmt->insert_id; // Récupérer l'ID de l'image insérée
        $stmt->close();

        // Insérer le lien entre l'image et le lieu dans la table t_image_avoir_lieu
        $stmt = $this->conn->prepare("INSERT INTO t_image_avoir_lieu (fk_image, fk_lieuimage) VALUES (?, ?)");
        $stmt->bind_param("ii", $image_id, $lieu);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllImages() {
        $images = array();
    
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu 
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                ORDER BY Date";
    
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row;
            }
        }
    
        return $images;
    }
}
?>
