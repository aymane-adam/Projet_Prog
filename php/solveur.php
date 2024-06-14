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

        return "No path found.";
    }

    public function getDirectionCounts() {
        return $this->directionCounts;
    }
}

// Example usage:
$matrix = [
    [0, 0, 0, 0, 0],
    [0, 1, 0, 2, 0],
    [0, 2, 0, 2, 0],
    [0, 0, 0, 2, 0],
    [0, 2, 0, 0, 12]
];

$solver = new Solver($matrix, 'est');
$path = $solver->findPath();

if (is_array($path)) {
    echo "Path found:\n";
    foreach ($path as $step) {
        echo "(" . $step[0][0] . ", " . $step[0][1] . ") - Direction: " . $step[1] . "\n";
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
