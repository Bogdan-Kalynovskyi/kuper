<?php
if (!defined('IN_BMC')) {
    die('Access Denied!');
}


class bDb {

    var $link; // this object the MysqL connection handle
    var $result = null;
    var $output = null;

    //var debug

    // The constructor. Get the mysql info vars and connect to the server
    function bDb () {
        global $my_host, $my_user, $my_pass, $my_db, $my_prefix, $my_charset;

        $this->link = @mysql_connect($my_host, $my_user, $my_pass, TRUE); // Connect to the MySQL server

        if (!$this->link) {
            trigger_error(mysql_error());
        }
        if (!@mysql_select_db($my_db, $this->link) || !@mysql_query("SET NAMES $my_charset", $this->link)) {
            trigger_error(mysql_error());
        }
    }


//***************************************************************************
    function evaluate ($query_str) {

        $this->result = @mysql_query($query_str, $this->link);
        if ($this->result === false) {
            trigger_error(mysql_error() . ' ==>> ' . htmlentities($query_str));
        }

        return @mysql_result($this->result, 0, 0); // or trigger_error(var_dump...);
    }


//***************************************************************************
    // Perform the MySQL queries
    function query ($query_str, $multi = true, $smart = false) {

        $this->result = @mysql_query($query_str, $this->link); // Do the quer
        if ($this->result === false) {
            trigger_error(mysql_error() . ' ==>> ' . htmlentities($query_str));
            return null;
        }

        if (strtolower(substr(ltrim($query_str), 0, 6)) != 'select') { //SET //and others

            // Return the number of rows affected by this operation
            return mysql_affected_rows();

        }


        // Return multiple rows stored in a multi dimensional array
        if ($multi) {

            // If the query was to get data, i.e, select, then return the data as arrays
            $this->output = array();
            $num = -1;

            while ($row = mysql_fetch_array($this->result, MYSQL_ASSOC)) {
                if ($smart) {
                    $num = array_shift($row);
                }
                else {
                    $num++;
                }

                $this->output[$num] = $row;
            }

            return $this->output; // Return the multi demensional array


        }

        // Return the result in a one dimensional array
        return mysql_fetch_array($this->result, MYSQL_ASSOC);


    }

//***********************************************************************************


    // Get the number of rows for a particular query
    function total_count () {
        return mysql_result(mysql_query("SELECT FOUND_ROWS()", $this->link), 0);
    }

    function row_count ($query_str) {
        $this->result = @mysql_query($query_str, $this->link);
        if ($this->result === false) {
            trigger_error(mysql_error() . ' ==>> ' . htmlentities($query_str));
            return null;
        }

        return @mysql_num_rows($this->result);
    }


    function sql_from_array ($query, $assoc_ary, $glue = 'AND ') {
        if (!is_array($assoc_ary)) {
            return false;
        }

        $fields = $values = array();

        if ($query == 'INSERT' || $query == 'REPLACE') //critical
        {
            foreach ($assoc_ary as $key => $var) {
                $fields[] = '' . mysql_real_escape_string($key) . '';
                $values[] = a($var);
            }
            return ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ') ';
        }

        if ($query == 'MULTI_INSERT' || $query == 'MULTI_REPLACE') //todo bodya view all history na predmet mysq_re_es_s
        {
            foreach ($glue as $key) {
                $fields[] = '' . mysql_real_escape_string($key) . '';
            }

            foreach ($assoc_ary as $arr) {
                foreach ($arr as &$var) {
                    $var = a($var);
                }
                $values[] = '(' . implode(', ', $arr) . ')';
            }

            return ' (' . implode(', ', $fields) . ') VALUES ' . implode(', ', $values);
        }

        elseif ($query == 'UPDATE' || $query == 'SELECT' || $query == 'WHERE') {
            foreach ($assoc_ary as $key => $var) {
                $values[] = '' . mysql_real_escape_string($key) . ' = ' . a($var); //critical update for luizyogos
            }
            return implode(($query == 'UPDATE') ? ', ' : " $glue ", $values); /*WHERE*/
        }

        else //$KEY==$QUERY
        {
            foreach ($assoc_ary as $key => $var) {
                $fields[] = '' . $key . '';
                if ($key == $query) /* exception*/ /* or last element in array*/ {
                    $values[] = $var;
                }
                else {
                    $values[] = a($var);
                }
            }
            return ' (' . implode(', ', $fields) . ') (SELECT ' . implode(', ', $values) . ')';
        }

    }


} // End class

?>