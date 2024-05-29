<?php

class database {

    //Connection Info
    private $host ;
    private $user ;
    private $pw ;
    private $db ;

    //Core Varaibles
    private $con;
    private $query;
    private $output;

    //Debug
    public $debug = false;

    //Init connection
    function __construct($host,$user,$pw,$db) {
        $this->db = $db;
        $this->host = $host;
        $this->user = $user;
        $this->pw = $pw;
        try {
            //Set the $con param
            $this->con = new PDO('mysql:dbname='.$this->db.';host='.$this->host.';charset=utf8mb4', $this->user , $this->pw, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            //Check if debug is active
            if($this->debug)
                die($e->getMessage());
            else
                die("Database tidak ditemukan.");

        }
    }

    //Read Data from table
    public function read($table, $fields = '*', $where = null) {
        $this->query = 'SELECT '.$fields.' FROM '.$table;

        //Check if there is any conditions
        if (isset($where))
            $this->query .= ' WHERE '.$where;

        //Execute Query
        $this->run(true);
        return $this->output;
    }

    //Read Data from table
    public function connection($sql) {
        $this->output = $this->con->query($sql);
        return $this->output;
    }

    //Read Data from table
    public function lastId() {
        return $this->con->lastInsertId();
    }

    //Insert Data to table
    public function insert($table, $content) {
        $this->query = 'INSERT INTO '.$table.' (';

        //Count Array
        $count = count($content);
        $counter = 0;

        //Field Names Query Construct
        foreach ($content as $fName => $fValue) {
            $counter++;

            if ($count == 1) {
                $this->query .= $fName . ')'; //If array has only one member
            } elseif ($counter == $count ) {
                $this->query .= $fName . ')'; //If it's the last array member
            } else {
                $this->query .= $fName . ','; //If it's none of the above, it's a member and there is more arrays members
            }
        }

        $this->query.= ' VALUES (';

        //Field Values
        $counter = 0;

        foreach ($content as $fName => $fValue) {
            $counter++;

            if ($count == 1) {
                $this->query .= '"' . $this->escape($fValue) . '")'; //If array has only one member
            } elseif ($counter == $count ) {
                $this->query .= '"' . $this->escape($fValue) . '")'; //If it's the last array member
            } else {
                $this->query .= '"' . $this->escape($fValue) . '",'; //If it's none of the above, it's a member and there is more arrays members
            }
        }

        //Terminate Query
        $this->query.=';';

        //Execute Query
        $this->run(false);
        return $this->output;
    }

    //Update Data on Table
    public function update($table, $content, $where=null) {
        $this->query = "UPDATE ".$table." SET ";

        if ($where==null) {

            //If there is not a condition, it will update the whole table
            $count = count($content);
            $counter = 0;

            //Build Query
            foreach ($content as $fName => $fValue) {

                if ($counter == ($count-1)) {
                    $this->query.= $fName.'="'.$this->escape($fValue).'";';
                } else {
                    if ($counter == 0) {
                        $this->query .= $fName.'="'.$this->escape($fValue).'",';
                    } else {
                        $this->query .= $fName.'="'.$this->escape($fValue).'",';
                    }
                }
                $counter++;
            }

        } else {

            //If there is a update condition
            $count = count($content);
            $counter = 0;

            //Build Query
            foreach ($content as $fName => $fValue) {
                $counter++;
                if ($count == 1) {
                    $this->query.= $fName.'="'.$this->escape($fValue).'"';
                } elseif ($counter == $count) {
                    $this->query.= $fName.'="'.$this->escape($fValue).'"';
                } else {
                    $this->query.= $fName.'="'.$this->escape($fValue).'",';
                }
            }

            //Implement conditions to query
            if (isset($where))
                $this->query .= ' WHERE '.$where.';';
        }

        $this->run(false);
        return $this->output;

    }

    //Delete Data from table
    public function delete($table, $where=null) {

        //Check if is to delete all records
        if (isset($where))
            $this->query = 'DELETE FROM '.$table.' WHERE '.$where;
        else
            $this->query = 'DELETE FROM '.$table.';';

        $this->run(false);
        return $this->output;
    }

    //Run SQL
    public function sql($query, $output=false) {
        $this->query = $query;
        $this->run($output);
        return $this->output;
    }

    //Prepares the results into a stdClass inside of array
    private function manage_results($results) {
        $output = [];
        foreach ($results as $line) {
            $fields = new stdClass();
            foreach ($line as $line_param_name => $line_param_value) {
                $fields->$line_param_name = $line_param_value;
            }
            $output[] = $fields;
        }

        return $output;
    }

    //Runs the Querys - It can be used to run querys without output and querys that return data
    private function run($output = false) {
        if ($output) {
            //If query has to return values
            $run = $this->con->prepare($this->query);

            //Check if query runs successfully
            if ($run->execute()) {
                // $results = $run->fetchAll(PDO::FETCH_ASSOC);
                // $this->output = $this->manage_results($results);
                $results = $run;
                $this->output = $results;
            } else {
                $this->output = $run->errorInfo()[2];
            }

            //Check if Debug is active
            if($this->debug)
                $this->output = [$this->output, $this->query];

        } else {
            //If query does not return values
            $run = $this->con->prepare($this->query);

            //Check if query runs successfully
            if ($run->execute()) {
                $this->output = true;
            } else {
                $this->output = $run->errorInfo()[2];
            }

            //Check if Debug is active
            if($this->debug)
                $this->output = [$this->output, $this->query];
        }
    }

    //Escape Caracters Function - Prepares to be inserted
    private function escape($str) {
        // Escape the string
        $str = $this->con->quote($str);


        // If there are duplicated quotes, trim them away
        return ($str[0] === "'")
            ? substr($str, 1, -1)
            : $str;
    }


}

$db = new database($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASS'],$_ENV['DB_NAME']);
?>