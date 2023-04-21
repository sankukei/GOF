<?php

class Game
{

	public $cell_col = 0;
	public $cell_row = 0;
	public $gen = 0;

	public function progress_bar()
	{

		$i = 0;
		$percent = 0;
		$bar = "\e[33m | ";
		$stop = "\033[0m";

		system('clear');

		while ($i <= 50) {

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

	public function loading()
	{

		$i = 0;
		$l = "|";
		$bar = "[ - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ]\r";
		$res = str_split($bar);

		system('clear');
		echo PHP_EOL;
		echo "\033[0;33m[LOADING] :\033[0m" . PHP_EOL . PHP_EOL;
		echo "$bar\r";

		foreach ($res as $r) {

			if ($r === "[") {
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
		echo PHP_EOL . PHP_EOL . "\033[0;32m[OK] :)\033[0m";
		usleep(1000000);
		echo PHP_EOL;
		system('clear');
	}
	public function create_grid($hihi)
	{
		echo PHP_EOL;
		if ($hihi === 0) {

			usleep(100000);
			echo "\t\t\t\t\t\tWelcome to \033[0;31mThe\033[0m \033[0;32mGame\033[0m \033[0;33mOf\033[0m \033[0;34mLife\033[0m \033[0;35m!\033[0m " . PHP_EOL;
			usleep(100000);
			echo "\t\t\t\t\tThis a game about entropy and life itself !" . PHP_EOL;
			usleep(100000);
			echo "\t\t\t\t\tIt is a zero player game wich means all you have to do" . PHP_EOL;
			usleep(100000);
			echo "\t\t\t\t\tis place down some blocks and see what happens !" . PHP_EOL . PHP_EOL;
			usleep(100000);
		}

		$str = [[]];
		$i = 0;
		$y = 0;
		if ($hihi !== 2) {
			echo "\t\t\t\t\t";

			while ($i < 25) {
				while ($y < 25) {

					$str[$i][$y] = 0;
					echo $str[$i][$y] . " ";
					$y++;
				}
				if ($hihi === 0) {

					usleep(100000);
				}
				echo PHP_EOL;
				echo "\t\t\t\t\t";

				$y = 0;
				$i++;
			}
		}
		if ($hihi === 1) {
			echo PHP_EOL;
			usleep(100000);
			echo "\t\t\t\t\tControls:" . PHP_EOL . PHP_EOL;
			echo "\t\t\t\t\t(← ↑ → ↓) to move the cell ||" . " (TAB) to start";
		}

		if ($hihi === 2) {

			while ($i < 25) {
				while ($y < 25) {

					$str[$i][$y] = 0;
					echo $str[$i][$y] . " ";
					$y++;
				}
				echo PHP_EOL;
				$y = 0;
				$i++;
			}
		}

		if ($hihi === 3) {
			while ($i < 25) {
				while ($y < 25) {

					$str[$i][$y] = 0;
					$y++;
				}
				$y = 0;
				$i++;
			}
		}
		return $str;
	}

	public function get_input()
	{

		$set = 0;
		$this->loading();
		// $this->progress_bar();
		$this->create_grid(0);
		echo PHP_EOL;
		$input = readline("Press enter to start");
		if ($set === 0) {
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
	public function gameloop()
	{

		$grid = $this->create_grid(1);

		exec("stty -icanon min 0 time 0");
		while (true) {

			$input = fread(STDIN, 3);

			if ($input === "\033[A") 
				$this->place_cells($grid, 4);
			if ($input === "\033[B")
				$this->place_cells($grid, 3);
			if ($input === "\033[D")
				$this->place_cells($grid, 2);
			if ($input === "\033[C")
				$this->place_cells($grid, 1);
			if ($input === "\n")
				$grid = $this->place_cells($grid, 5);
			if ($input === "\t") {
				$this->simulation($grid);
				break;
			}
		}
	}
	public function place_cells($grid, $arrow)
	{

		$i = 0;
		$y = 0;

		system('clear');

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
		if ($this->cell_row < 0) {
			$this->cell_row = 0;
			echo "can't access grid ouf of bounds" . PHP_EOL;
		}
		if ($this->cell_col > 24) {
			$this->cell_col -= 1;
			echo "can't access grid out of bounds" . PHP_EOL;
		}
		if ($this->cell_row > 24) {
			$this->cell_row -= 1;
			echo "can't access grid out of bounds" . PHP_EOL;
		}

		echo PHP_EOL;
		echo "\t\t\t\t\t";

		while ($i < 25) {
			while ($y < 25) {

				$grid[$this->cell_row][$this->cell_col] = "\e[0;31;42m#\e[0m";
				echo $grid[$i][$y] . " ";
				$y++;
			}
			echo PHP_EOL;
			echo "\t\t\t\t\t";
			$y = 0;
			$i++;
		}
		echo $this->cell_row;
		echo $this->cell_col;
		// var_dump($grid);
		return $grid;
	}

	public function simulation($grid)
	{

		$i = 0;
		$y = 0;
		$new_grid = $this->create_grid(3);
		$count_r = count($grid);
		$count_c = count($grid[$i]);
		$neighbor = 0;
		$end = 0;

		echo PHP_EOL;

		while ($i < $count_r) {
			while ($y < $count_c) {

				$faith = 0;
				if (($i > 0 && $i < $count_r - 1) && ($y > 0 && $y < $count_c - 1)) {

					if ($grid[$i][$y] !== 0) {
						$end++;
					}

					if ($grid[$i - 1][$y - 1] !== 0)
						$neighbor++;
					if ($grid[$i - 1][$y] !== 0)
						$neighbor++;
					if ($grid[$i - 1][$y + 1] !== 0)
						$neighbor++;
					if ($grid[$i][$y - 1] !== 0) 
						$neighbor++;
					if ($grid[$i][$y + 1] !== 0) 
						$neighbor++;
					if ($grid[$i + 1][$y - 1] !== 0) 
						$neighbor++;
					if ($grid[$i + 	1][$y] !== 0) 
						$neighbor++;
					if ($grid[$i + 1][$y + 1] !== 0) 
						$neighbor++;

					if ($neighbor === 2 && $faith === 0) {
						if ($grid[$i][$y] !== 0) {
							$new_grid[$i][$y] = 1;
							$neighbor = 0;
							$faith++;
						} else {
							$new_grid[$i][$y] = 0;
							$neighbor = 0;
							$faith++;
						}
					}
					if ($neighbor === 3 && $faith === 0) {
	
						$new_grid[$i][$y] = 1;
						$neighbor = 0;
						$faith++;
					}
					if ($neighbor >= 4 && $faith === 0) {

						$new_grid[$i][$y] = 0;
						$neighbor = 0;
						$faith++;
					}
					if ($faith === 0) {

						$new_grid[$i][$y] = 0;
						$neighbor = 0;
					}
				}
				$y++;
			}
			$y = 0;
			$i++;
		}

		if ($end === 0) {

			system('clear');
			$this->restart();
			return "END";
		}

		// var_dump($grid);

		$this->render($new_grid);
	}
	// TODO implementer avec tab une seul ittération, sinon on peut launch normal et ça while(1)
	public function render($str)
	{

		$y = count($str);
		$i = 0;
		$y = 0;

		system('clear');
		echo PHP_EOL;
		echo "\t\t\t\t\t";

		while ($i < 25) {
			while ($y < 25) {
				if($str[$i][$y] === 0) {
					// echo $str[$i][$y] . " ";
					echo " " . " ";
				} else {
					echo "\e[0;32;42m0\e[0m" . "\e[0;32;42m0\e[0m";
				}
				// $str[$i][$y] = 0;
				// echo $str[$i][$y] . " ";
				$y++;
			}
			echo PHP_EOL;
			echo "\t\t\t\t\t";
			$y = 0;
			$i++;
		}
		echo "tick : " . $this->gen++;
		sleep(1);
		$this->simulation($str);
	}

	public function restart() {

		system('clear');
		echo "Restart or quit ? (R: restart Q: quit)";
		$input = fread(STDIN, 3);

		while (1) {

			if ($input === "\n") {
				$this->gameloop();
			}
			if ($input === "Q") {
				return;
			}
		}

	}
}
$xd = new Game();
$xd->get_input();

?>