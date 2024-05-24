<?php
// Ensemble des fonctions qui permettent la suppression, l'ajout ou le tri des images.

// Classe ImageModel pour la gestion des images dans la base de données
class ImageModel {
    private $conn;

    // Constructeur de la classe, initialisant la connexion à la base de données
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fonction pour insérer une nouvelle image dans la base de données
    public function insertImage($filename, $date, $lieu, $user_id) {
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

        // Insérer le lien entre l'image et l'utilisateur dans la table t_image_avoir_user
        $stmt = $this->conn->prepare("INSERT INTO t_image_avoir_user (fk_imageUser, fk_userImage) VALUES (?, ?)");
        $stmt->bind_param("ii", $image_id, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    // Fonction pour supprimer une image de la base de données
    public function deleteImage($image_id) {
        $stmt = $this->conn->prepare("DELETE FROM t_image WHERE id_image = ?");
        $stmt->bind_param("i", $image_id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    // Fonction pour obtenir le nom de fichier d'une image par son ID
    public function getImageFilename($image_id) {
        $stmt = $this->conn->prepare("SELECT filename FROM t_image WHERE id_image = ?");
        $stmt->bind_param("i", $image_id);
        $stmt->execute();
        $stmt->bind_result($filename); // Assigne le résultat de la requête à $filename
        $stmt->fetch(); // Récupère le résultat
    
        $stmt->close();
    
        return $filename; // Retourne le nom de fichier récupéré
    }
    
    // Fonction pour obtenir les images par lieu
    public function getByLocation($lieu) {
        $images = array();
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu, t_utilisateur.user
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                INNER JOIN t_image_avoir_user ON t_image.id_image = t_image_avoir_user.fk_imageUser
                INNER JOIN t_utilisateur ON t_image_avoir_user.fk_userImage = t_utilisateur.id_utilisateur
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

    // Fonction pour obtenir les images par année
    public function getByYear($annee) {
        $images = array();
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu, t_utilisateur.user
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                INNER JOIN t_image_avoir_user ON t_image.id_image = t_image_avoir_user.fk_imageUser
                INNER JOIN t_utilisateur ON t_image_avoir_user.fk_userImage = t_utilisateur.id_utilisateur
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
    
    // Fonction pour obtenir toutes les images
    public function getAllImages() {
        $images = array();
    
        $sql = "SELECT t_image.id_image, t_image.filename, t_image.date, t_lieu.NomLieu, t_utilisateur.user
                FROM t_image 
                INNER JOIN t_image_avoir_lieu ON t_image.id_image = t_image_avoir_lieu.fk_image 
                INNER JOIN t_lieu ON t_image_avoir_lieu.fk_lieuimage = t_lieu.id_lieu
                INNER JOIN t_image_avoir_user ON t_image.id_image = t_image_avoir_user.fk_imageUser
                INNER JOIN t_utilisateur ON t_image_avoir_user.fk_userImage = t_utilisateur.id_utilisateur
                ORDER BY t_image.date";
    
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $images[] = $row;
            }
        }
    
        return $images;
    }
    
    // Fonction pour obtenir les lieux distincts
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

    // Fonction pour obtenir les années distinctes
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

    // Fonction pour obtenir toutes les images téléversées par un utilisateur
    public function getAllImagesByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT i.* FROM t_image i INNER JOIN t_image_avoir_user iu ON i.id_image = iu.fk_imageUser WHERE iu.fk_userImage = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $images = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $images;
    }
}

?>
