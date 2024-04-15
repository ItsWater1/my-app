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

    // Supprimer une image
    public function deleteImage($image_id) {
        $stmt = $this->conn->prepare("DELETE FROM t_image WHERE id_image = ?");
        $stmt->bind_param("i", $image_id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // Obtenir le nom du fichier
    public function getImageFilename($image_id) {
        $stmt = $this->conn->prepare("SELECT filename FROM t_image WHERE id_image = ?");
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $stmt->bind_result($filename);
        $stmt->fetch();
        $stmt->close(); 
    }
    
    public function getByLocation($lieu) {
        $images = array();
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu 
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                WHERE t_lieu.id_lieu = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $lieu);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }

        return $images;
    }

    public function getByYear($annee) {
        $images = array();
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu, t_lieu.id_lieu 
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                WHERE YEAR(t_image.date) = ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $annee);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }
    
        return $images;
    }
    
    
    
    public function getAllImages() {
        $images = array();

        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu 
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                ORDER BY t_image.date";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row;
            }
        }

        return $images;
    }

    public function getDistinctLieux() {
        $lieux = array();

        $sql = "SELECT DISTINCT NomLieu, id_lieu FROM t_lieu ORDER BY Nomlieu";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lieux[] = $row;
            }
        }

        return $lieux;
    }

    public function getDistinctYears() {
        $years = array();

        $sql = "SELECT DISTINCT YEAR(date) as year FROM t_image";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $years[] = $row['year'];
            }
        }

        return $years;
    }
}

?>