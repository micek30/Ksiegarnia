<?php
class MySQL
{	private $CONNECTION;		// connection resource

	private $nav_pack;			// current pack No
	private $nav_pack_size;		// records per pack
	private $nav_pack_number;	// count of pack visible
	private $nav_pack_max;		// last pack no
	private $nav_pack_first;	// first pack no
	private $nav_pack_last;		// last visible pack
	private $nav_pack_prev;		// previous pack exist [TRUE|FALSE]
	private $nav_pack_next;		// next pack exist [TRUE|FALSE]
	private $nav_rec_first;		// first record no
	private $nav_rec_last;		// last record no
	private $nav_rec_number;	// count of recordc

	/**
	 * Class constructor
	 * @param string $server	- mysql server
	 * @param string $user		- database owner
	 * @param string $pass		- user password
	 * @param string $dbase		- database name
	 * @return bool	 connection success
	 */
	public function __construct($server="", $user="", $pass="", $dbase="")
	{	$conn = new mysqli($server, $user, $pass, $dbase);
	//{	$conn = mysqli_connect($server, $user, $pass, $dbase);
		if (mysqli_connect_errno())
		{	return FALSE;
		}
		$this->CONNECTION = $conn;
		$this->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
		return TRUE;
	}//end function

	/**
	 * Add record to table
	 * @param string	$sql	SQL instruction to insert record
	 * @return last inset id OR 0
	 */
	public function insert($sql)
	{	if (empty($sql)) return 0;
		if (empty($this->CONNECTION)) return 0;
		$conn = $this->CONNECTION;
		$results = $conn->query($sql);
		return $conn->insert_id;
	}//end function
   /* public function insert($sql)
    {	if (empty($sql)) return 0;
        if ($this->query($sql) == TRUE)
        {return 1;}
        else return 0;
    }*/

	/**
	 * Select records from database
	 * @param string	$sql	SQL instruction to execute
	 * @return array[][] with data from database OR FALSE
	 */
	public function select($sql)
	{	if (empty($sql)) return FALSE;
		if (empty($this->CONNECTION)) return FALSE;
		$conn = $this->CONNECTION;
		$results = $conn->query($sql);
		if (!$results or empty($results)) return FALSE;
		$data = array();
		while ($row = $results->fetch_assoc())	$data[] = $row;
		$results->close();
		return $data;
	}//end function

	/**
	 * Select part of records from database
	 * @param string	$sql			SQL instruction to execute
	 * @param int		$pack			current pack no
	 * @param int		$pack_size		count of records per pack
	 * @param int		$pack_number	count displayed pack
	 * @return array[][] with data from database OR FALSE
	 */
	public function select_part($sql, $pack=1, $pack_size=30, $pack_number=10)
	{	if (empty($this->CONNECTION)) return FALSE;
		$conn = $this->CONNECTION;
		if (empty($sql)) return FALSE;

		$sql_test = $sql;
		$results = $conn->query($sql_test);
		if (!$results or empty($results)) return FALSE;
		$row = $results->fetch_assoc();

		$this->nav_rec_number = $results->num_rows;
		$results->close();

		$this->nav_pack = $pack;
		$this->nav_pack_size = $pack_size;
		$this->nav_pack_number = $pack_number;

		$pack_number_left = floor($pack_number/2);
		$pack_number_right = $pack_number - $pack_number_left - 1;

		// compute last pack no
		$this->nav_pack_max = @ceil($this->nav_rec_number / $this->nav_pack_size);

		// if current pack < pack_count then get last pack
		if ($this->nav_pack * $this->nav_pack_size > $this->nav_rec_number) $this->nav_pack = $this->nav_pack_max;

		// if current pack < 1 then get first pack
		if ($this->nav_pack <= 0) $this->nav_pack = 1;

		// check previous and next visible pack
		$this->nav_pack_first = $this->nav_pack - $pack_number_left;
		$this->nav_pack_last = $this->nav_pack + $pack_number_right;
		if ($this->nav_pack_first <= 0) {
			$this->nav_pack_first = 1;
			$this->nav_pack_last = $this->nav_pack_number;
		}
		if ($this->nav_pack_last > $this->nav_pack_max) {
			$this->nav_pack_last = $this->nav_pack_max;
			if ($this->nav_pack_max > $this->nav_pack_number) $this->nav_pack_first = $this->nav_pack_max - $this->nav_pack_number + 1;
			else $this->nav_pack_first = 1;
		}

		// check previous and next pack
		if ($this->nav_pack > 1) $this->nav_pack_prev = TRUE;
		else $this->nav_pack_prev = FALSE;
		if ($this->nav_pack < $this->nav_pack_max) $this->nav_pack_next = TRUE;
		else $this->nav_pack_next = FALSE;

		// compute first and last record
		$this->nav_rec_first = (($this->nav_pack - 1) * $this->nav_pack_size) + 1;
		$this->nav_rec_last = $this->nav_pack * $this->nav_pack_size;
		if ($this->nav_rec_last > $this->nav_rec_number) $this->nav_rec_last = $this->nav_rec_number;

		// compute LIMIT directive
		$limit = ($this->nav_rec_first-1).", ".$this->nav_pack_size;
		$sql .= " LIMIT ".$limit;

		$results = $conn->query($sql);
		if (!$results or empty($results)) return FALSE;
		$data = array();
		while ($row = $results->fetch_assoc())	$data[] = $row;
		$results->close();
		return $data;
	}//end function

	/**
	 * Update records from database
	 * @param string	$sql	SQL instruction to execute
	 * @return bool success: TRUE or FALSE
	 */
	public function update($sql)
	{	if (empty($sql)) return FALSE;
		if (empty($this->CONNECTION)) return FALSE;
		$conn = $this->CONNECTION;
		$results = $conn->query($sql);
		if (!$results) return FALSE;
		return TRUE;
	}//end function

	/**
	 * Delete records from database
	 * @param string	$sql	SQL instruction to execute
	 * @return bool success: TRUE or FALSE
	 */
	public function delete($sql)
	{	if (empty($sql)) return FALSE;
		if (empty($this->CONNECTION)) return FALSE;
		$conn = $this->CONNECTION;
		$results = $conn->query($sql);
		if (!$results) return FALSE;
		return TRUE;
	}//end function

	/**
	 * Execute database query
	 * @param string	$sql	SQL instruction to execute
	 * @return bool success: TRUE or FALSE
	 */
	public function query($sql)
	{ 	if (empty($sql)) return FALSE;
		if (empty($this->CONNECTION)) return FALSE;
		$conn = $this->CONNECTION;
		$results = $conn->query($sql);
		if (!$results) return FALSE;
		return TRUE;
	}//end function

	/**
	 * Generate HTML navigator
	 * @param string	$param	parameters for links in navigator
	 * @return string: code with HTML navigator
	 */
	public function html_nawigator($param = "")
	{	if ($this->nav_rec_number <= $this->nav_pack_size)		return "";

		if ($this->nav_rec_number == 0)	$from_to = "&nbsp;";
		else							$from_to = "Pozycje " . $this->nav_rec_first . "-" . $this->nav_rec_last . " z " . $this->nav_rec_number;
		$nawigator = "<div style='text-align:center;margin:0px;padding:0px'>$from_to. Strona: ";

		// to previous pack
		if ($this->nav_pack_first > 1)
		{	$nawigator .= "<a href=\"".$_SERVER["PHP_SELF"]."?$param&pack=1\">&lt;&lt;</a>";
		}
		$nawigator .= "&nbsp;";
	
		// to pack N
		for ($i=$this->nav_pack_first; $i<=$this->nav_pack_last; $i++)
		{	if ($this->nav_pack != $i)
			{	$nawigator.= "&nbsp;<a href=\"".$_SERVER["PHP_SELF"]."?$param&pack=" . $i . "\">[$i]</a>&nbsp;";
			}
			else
			{	$nawigator.= "&nbsp;[$i]&nbsp;";
			}
		}
		$nawigator .= "&nbsp;";
	
		// to next pack
		if ($this->nav_pack_last < $this->nav_pack_max)
		{	$nawigator .= "<a href=\"".$_SERVER["PHP_SELF"]."?$param&pack=" . ($this->nav_pack_max) . "\">&gt;&gt;</a>";
		}
		$nawigator .= "</div>";

		return $nawigator;
	}//end function

	/**
	 * Escapes special characters in a string for use in an SQL statement, 
	 * taking into account the current charset of the connection
	 * @param  string	$par	string to be escaped
	 * @return string	escaped string
	 */
	public function real_escape($par)
	{	return mysqli_real_escape_string($this->CONNECTION, $par);
	}
}//end class
?>
