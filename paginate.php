<?php
require_once('includes/functions.php');

function pagination($query, $per_page = '', $page = 1, $url = '?')
{
	$mysqli = connectdb();
	$query = "SELECT COUNT(*) as `num` FROM products";
	$result = $mysqli->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$total = $row['num'];
	$adjacents = "2";

	$page = ($page == 0 ? 1 : $page);
	$start = ($page - 1) * $per_page;

	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total / $per_page);
	$lpm1 = $lastpage - 1;

	$pagination = "";

	if ($lastpage > 1) {
		$pagination .= "<div style='text-align:center; margin-top:1rem;'> Page $page of $lastpage <br>";
		if ($lastpage < 7 + ($adjacents * 2)) {
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$pagination .= "<a class='current w3-button w3-black'>$counter</a>";
				else
					$pagination .= "<a href='{$url}page=$counter' class='w3-button w3-black'>$counter</a>";
			}
		} elseif ($lastpage > 5 + ($adjacents * 2)) {
			if ($page < 1 + ($adjacents * 2)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page)
						$pagination .= "<a class='current w3-button'>$counter</a>";
					else
						$pagination .= "<a href='{$url}page=$counter'>$counter</a>";
				}
				$pagination .= "<li class='dot'>..</li>";
				$pagination .= "<a href='{$url}page=$lpm1'>$lpm1</a>";
				$pagination .= "<a href='{$url}page=$lastpage'>$lastpage</a>";
			} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
				$pagination .= "<a href='{$url}page=1'>1</a>";
				$pagination .= "<a href='{$url}page=2'>2</a>";
				$pagination .= "<li class='dot'>..</li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination .= "<li><a class='current'>$counter</a>";
					else
						$pagination .= "<li><a href='{$url}page=$counter'>$counter</a>";
				}
				$pagination .= "<li class='dot'>..</li>";
				$pagination .= "<a href='{$url}page=$lpm1'>$lpm1</a>";
				$pagination .= "<a href='{$url}page=$lastpage'>$lastpage</a>";
			} else {
				$pagination .= "<a href='{$url}page=1'>1</a>";
				$pagination .= "<li><a href='{$url}page=2'>2</a>";
				$pagination .= "<li class='dot'>..</li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<a class='current w3-button'>$counter</a>";
					else
						$pagination .= "<a href='{$url}page=$counter'>$counter</a>";
				}
			}
		}

		if ($page < $counter - 1) {
			$pagination .= "<br><a href='{$url}page=$next' class='w3-button'>Next&nbsp&nbsp</a>";
			$pagination .= "<a href='{$url}page=$lastpage' class=w3-button>Last</a>";
		} else {
			$pagination .= "<br><a class='current w3-button'>Next</a>";
			$pagination .= "<a class='current w3-button'>Last</a>";
		}
		$pagination .= "\n";
	} ?> </div>
	<?php return $pagination;
} ?>