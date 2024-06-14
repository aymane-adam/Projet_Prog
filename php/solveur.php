<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/level.css">
    <title>Level Page</title>
</head>
<body>
<?php
session_start();
class Solver {
    private $matrix;
    private $rows;
    private $cols;
    private $initialDirection;
    private $directions;
    private $directionCounts;

    public function __construct($matrix, $initialDirection) {
        $this->matrix = $matrix;
        $this->rows = count($matrix);
        $this->cols = count($matrix[0]);
        $this->initialDirection = $initialDirection;

        $this->directions = [
            'nord' => [-1, 0],
            'sud' => [1, 0],
            'est' => [0, 1],
            'ouest' => [0, -1]
        ];

        $this->directionCounts = [
            'nord' => 0,
            'sud' => 0,
            'est' => 0,
            'ouest' => 0
        ];
    }

    private function isValid($x, $y) {
        return $x >= 0 && $x < $this->rows && $y >= 0 && $y < $this->cols && ($this->matrix[$x][$y] == 0 || $this->matrix[$x][$y] == 12);
    }

    private function changeDirection($currentDirection, $newX, $newY, $x, $y) {
        foreach ($this->directions as $direction => $coords) {
            if ($newX == $x + $coords[0] && $newY == $y + $coords[1]) {
                if ($direction !== $currentDirection) {
                    $this->directionCounts[$direction]++;
                }
                return $direction;
            }
        }
        return $currentDirection;
    }

    public function findPath() {
        $start = null;
        $end = null;

        // Find the positions of 1 and 12 in the matrix
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                if ($this->matrix[$i][$j] == 1) {
                    $start = [$i, $j];
                }
                if ($this->matrix[$i][$j] == 12) {
                    $end = [$i, $j];
                }
            }
        }

        if ($start === null || $end === null) {
            return "Start or End not found in the matrix.";
        }

        $queue = [];
        array_push($queue, [$start, [], $this->initialDirection]);
        $visited = array_fill(0, $this->rows, array_fill(0, $this->cols, false));
        $visited[$start[0]][$start[1]] = true;

        while (!empty($queue)) {
            list($current, $path, $currentDirection) = array_shift($queue);
            $x = $current[0];
            $y = $current[1];
            $path[] = [$current, $currentDirection];

            if ($this->matrix[$x][$y] == 12) {
                return $path;
            }

            foreach ($this->directions as $direction => $coords) {
                $newX = $x + $coords[0];
                $newY = $y + $coords[1];

                if ($this->isValid($newX, $newY) && !$visited[$newX][$newY]) {
                    $newDirection = $this->changeDirection($currentDirection, $newX, $newY, $x, $y);
                    array_push($queue, [[$newX, $newY], $path, $newDirection]);
                    $visited[$newX][$newY] = true;
                }
            }
        }
        echo '<script>alert("Niveau impossible");</script>';
        header("Location: editeur_niveau_aleatoire.php");
        return "No path found.";
    }

    public function getDirectionCounts() {
        return $this->directionCounts;
    }
}

// Example usage:
$matrix = $_SESSION['matrix'];

$solver = new Solver($matrix, 'est');
$path = $solver->findPath();

if (is_array($path)) {
    echo "Path found:\n";
    foreach ($path as $step) {
        echo "(" . $step[0][0] . ", " . $step[0][1] . ") - Direction: " . $step[1] . "\n";
    }
    require("bdd.php");
    $nom_niveau = isset($_SESSION['nom_niv_alea']) ? $_SESSION['nom_niv_alea'] : null;

    if ($nom_niveau != null) {
        // Proceed with database insertion
        $contenu = [
            "fleche_n" => $step[0][1],
            "fleche_s" => $step[0][1],
            "fleche_o" => $step[0][1],
            "fleche_e" => $step[0][1],
            "matrix" => json_encode(isset($_SESSION["matrix"]) ? $_SESSION["matrix"] : null),
        ];

        // Assuming $conn is your PDO connection object
        $createur = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'inconnu';
        $type_niveau = 3;
        
        $sql1 = $conn->prepare("INSERT INTO niveaux (nom_niveau, contenu, createur, type_niveau) VALUES (:nom_niveau, :contenu, :createur, :type_niveau)");
        $sql1->execute(array(
            ':nom_niveau' => $nom_niveau,
            ':contenu' => json_encode($contenu),
            ':createur' => $createur,
            ':type_niveau' => $type_niveau,
        ));
    
    } 


    $directionCounts = $solver->getDirectionCounts();
    echo "Direction changes:\n";
    foreach ($directionCounts as $direction => $count) {
        echo "$direction: $count times\n";
    }
} else {
    echo $path;
}

?>


</body>
</html>
