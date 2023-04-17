<?php



class Game {

	

	public $cell_col = 0;
	public $cell_row = 0;

	public function progress_bar() {



		$i = 0;
		$str = [];
		$percent = 0;
		$bar = "\e[33m | ";
		$stop = "\033[0m";
		system('clear');

		while($i <= 50) {

			echo "  LOADING" . " ( $percent% ) [";
			if ($i === 50) {
				echo ">]" . PHP_EOL . PHP_EOL;
				echo "[OK]" . " :) ";
				usleep(1000000);
			}	
			$res = $bar .= substr($bar, 0, 14);
			if (strlen($res) % 5 === 0) {
				echo $res;
				echo $stop;
			}
			echo strlen($res);
			usleep(100000);
			system('clear');
			$percent++;
			$percent++;
			$i++;
		}

		// $this->create_grid();
	}

	public function loading() {

		system('clear');

		$i = 0;
		// $str = [];
		$bar = "[ - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ]\r";
		$l = "|";

		echo "\033[0;33m[LOADING] :\033[0m" . PHP_EOL;
		echo "$bar\r";
		$res = str_split($bar);

		foreach($res as $r) {

			if($r === "[") {
				echo "[";
			} else 
			if ($r === " ") {

				echo " ";
			} else			
			if ($r === "-") {
				usleep(66666);
				// echo date(time());
				if ($i > 0 && $i < 20) {
					echo "\033[0;31m$l\033[0m";
				} else
				if ($i === 20) {
					echo "\033[0;36m$l\033[0m";
				} else
				if ($i > 20 && $i < 40) {
					echo "\033[0;33m$l\033[0m";
				} else
				if ($i === 40) {
					echo "\033[0;36m$l\033[0m";

				} else
				if ($i > 40 && $i < 61) {
					echo "\033[0;32m$l\033[0m";
				}
			}
			$i++;
		}

		echo PHP_EOL . "\033[0;32m[OK] :)\033[0m";
		usleep(1000000);
		echo PHP_EOL;
		system('clear');
	}
	public function create_grid($hihi) {

		echo PHP_EOL;
		if ($hihi === 0) {

			usleep(100000);
			echo "Welcome to \033[0;31mThe\033[0m \033[0;32mGame\033[0m \033[0;33mOf\033[0m \033[0;34mLife\033[0m \033[0;35m!\033[0m " . PHP_EOL;
			usleep(100000);
			echo "This a game about entropy and life itself !" . PHP_EOL;
			usleep(100000);
			echo "It is a zero player game wich means all you have to do" . PHP_EOL;
			usleep(100000);
			echo "is place down some blocks and see what happens !" . PHP_EOL . PHP_EOL;
			usleep(100000);
		}

		$str = [[]];
		$i = 0;
		$y = 0;
		if ($hihi !== 2) {
			while($i < 25) {
				while($y < 25) {

					$str[$i][$y] = 0;
					echo $str[$i][$y] . " ";
					$y++;
				}
				if ($hihi === 0) {

					usleep(100000);
				}
				echo PHP_EOL;
				$y = 0;
				$i++;
			}
		}

		if ($hihi === 1) {
			echo PHP_EOL;
			usleep(100000);
			echo "Controls:" . PHP_EOL . PHP_EOL;
			echo "(← ↑ → ↓) to move the cell ||" . " (ENTER) to start";
		}

		if ($hihi === 2) {

			while($i < 25) {
				while($y < 25) {
	
					$str[$i][$y] = 0;
					echo $str[$i][$y] . " ";
					$y++;
				}
				if ($hihi === 0) {
	
					usleep(100000);
				}
				echo PHP_EOL;
				$y = 0;
				$i++;
			}
		}
		return $str;
	}

	public function get_input() {

		$set = 0;
		// $this->loading();
		// $this->progress_bar();
		$this->create_grid(0);
		echo PHP_EOL;
		$input = readline("Press enter to start");
		if($set === 0) {
			if ($input === "") {

				$set = 1;
				$i = 0;

				while ($i < 16) {

					usleep(100000);
					echo PHP_EOL;
					$i++;
				}
				usleep(100000);
				system('clear');
				$this->gameloop();
			}
		}
	}

	public function gameloop() {

		// echo PHP_EOL;
		$grid = $this->create_grid(2);
		exec("stty -icanon min 0 time 0");
		$t = 0;
		$i = 0;
		while (true) {

			$input = fread(STDIN, 3);
			if ($input === "\033[A") {
				echo "Up arrow key pressed" . PHP_EOL;
				if($i == 0) {
					$a = $this->place_cells($grid, 4);
					$i++;
				} else {
					$this->place_cells($a, 4);
				}
			}
			if ($input === "\033[B") {
				echo "Down arrow key pressed" . PHP_EOL;
				if($i == 0) {
					$a = $this->place_cells($grid, 3);
					$i++;
				} else {
					$this->place_cells($a, 3);
				}
			}
			if ($input === "\033[D") {
				echo "Left arrow key pressed" . PHP_EOL;
				if($i == 0) {
					$a = $this->place_cells($grid, 2);
					$i++;
				} else {
					$this->place_cells($a, 2);
				}
			}
			if ($input === "\033[C") {
				echo "Right arrow key pressed" . PHP_EOL;
				if($i == 0) {
					$a = $this->place_cells($grid, 1);
					$i++;
				} else {
					$this->place_cells($a, 1);
				}
			}
			if ($input === "\n") {
				echo "Enter key was pressed";
				if($t == 0) {
					$a = $this->place_cells($grid, 5);
					$t++;
				} else {
					$a = $this->place_cells($a, 5);
				}
			}
			if ($input === "\t") {

				echo "xd";
				$this->simulation($a);
				// echo "Enter key was pressed";
				// if($t == 0) {
				// 	$a = $this->place_cells($grid, 5);
				// 	$t++;
				// } else {
				// 	$a = $this->place_cells($a, 5);
				// }
			}
		}
	}
	public function place_cells($grid, $arrow) {
		// var_dump($grid);

		system('clear');

		$i = 0;
		$y = 0;

		if ($arrow === 1) {
			$this->cell_col += 1;
		} else if ($arrow === 2) {
			$this->cell_col -= 1;
		} else if ($arrow === 3) {
			$this->cell_row += 1;
		} else if ($arrow === 4) {
			$this->cell_row -= 1;
		}
		if ($this->cell_col < 0) {
			$this->cell_col = 0;
			echo "can't access grid out of bounds" . PHP_EOL;
		}
		if ($this->cell_row < 0 ) {
			$this->cell_row = 0;
			echo "can't access grid ouf of bounds". PHP_EOL;
		}
		if ($this->cell_col > 24) {
			$this->cell_col -= 1;
			echo "can't access grid out of bounds" . PHP_EOL;
		}
		if ($this->cell_row > 24) {
			$this->cell_row -= 1;
			echo "can't access grid out of bounds" . PHP_EOL;
		}

		while($i < 25) {
			while($y < 25) {

				$grid[$this->cell_row][$this->cell_col] = "\e[0;31;42m#\e[0m";
				echo $grid[$i][$y] . " ";
				$y++;
			}
			echo PHP_EOL;
			$y = 0;
			$i++;
		}
		echo $this->cell_row;
		echo $this->cell_col;
		// var_dump($grid);
		return $grid;
	}

	public function simulation($grid) {

		var_dump($grid);

		$i = 0;
		$y = -1;

		$az = count($grid[$i]);

		while($grid[$i]) {
			while ($y < $az) {

				
				echo "a ";
				// 1) Any live cell with two or three live neighbours survives.
				// 2) Any dead cell with three live neighbours becomes a live cell.
				// 3) All other live cells die in the next generation. Similarly, all other dead cells stay dead.
				$y++;
			}
			echo "b ";
			$y = 0;
			$i++;
		}
	}
}

$xd = new Game();
$xd->get_input();

?>

