<?php

include_once("IMotion.php");
use IMotion;
class RoomScanner implements IMotion
{
    private $grid;
    private $motion;

    public function __construct()
    {
        $this->grid = array_fill(0, 33, array_fill(0, 33, 0));
        for ($i = 0; $i < 33; $i++) {
            $this->grid[$i][0] = $this->grid[$i][32] = -1; //les bords de la grid sont inaccessibles
            $this->grid[0][$i] = $this->grid[32][$i] = -1;
        }
        $this->grid[1][1] = 1;


        foreach($this->grid as $row) {
            foreach($row as $cell) {
                echo $cell . " ";
            }
            echo "<br>";
        }
    }

    public function scan() {
        $x = 1;
        $y = 1;
        $direction = "right";
        $orientation = "left";
        while (true) {
            if ($direction == "right") {
                //if($orientation == "right"){
                    $distance = $this->move(1);
                    if ($this->grid[$x][$y + 1] == 0) {
                        $this->grid[$x][++$y] = 1; //la case devient connue

                    } else {
                        $direction = "down";
                    }
                //}else{
                    //$this->rotate("right");
                //}

            } else if ($direction == "down") {
                $distance = $this->move(1);
                if ($this->grid[$x + 1][$y] == 0) {
                    $this->grid[++$x][$y] = 1;

                } else {
                    $direction = "left";
                }
            } else if ($direction == "left") {
                $distance = $this->move(1);
                if ($this->grid[$x][$y - 1] == 0) {
                    $this->grid[$x][--$y] = 1;

                } else {
                    $direction = "up";
                }
            } else if ($direction == "up") {
                $distance = $this->move(1);
                if ($this->grid[$x - 1][$y] == 0) {
                    $this->grid[--$x][$y] = 1;

                } else {
                    $direction = "right";
                }
            }
            if ($x == 1 && $y == 1) {
                break;
            }
        }

    }
    public function getGrid() {
        return $this->grid;
    }

    public function move($distance)
    {
        if($distance > 40) {
            return true;
        } else {
            return false;
        }
    }

    public function rotate($degree)
    {
        // TODO: Implement rotate() method.
    }
}

$robot = new RoomScanner();
$robot->scan();
$robot->getGrid();