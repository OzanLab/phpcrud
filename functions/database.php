<?php

/**
 * Used to running database query
 *
 * @param string mysql query
 *
 * return mixed
 */
function run_query(string $query) {
    $connection  = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) {
        throw new Exception("Database connection failed: " . mysqli_connect_error());
    }

    if(!$result = mysqli_query($connection, $query)) {
        throw new Exception(mysqli_error($connection));
    } else {
        return $result;
    }
}

/**
 * Used to create an INSERT query
 *
 * @param $table table name
 * @param $datas array the data to be inserted
 *
 * return bolean
 */
function insert(string $table, array $datas) {
    $dataColumn = null;
    $dataValues = null;
    foreach($datas as $column => $values) {
        $dataColumn .= $column . ",";
        $dataValues .= "'" . $values . "',";
    }

    $dataColumn = rtrim($dataColumn,',');
    $dataValues = rtrim($dataValues,',');

    $query = "INSERT INTO {$table} ({$dataColumn}) VALUES({$dataValues})";

    return run_query($query);
}

/**
 * @param string table name
 * @param string column
 * @param array conditions
 *
 * return array if has some data, false otherwise
 */
function select(string $table, string $column = null, $conditions = array()) {
    if(empty($column)) {
        $column = "*";
    }

    $query = "SELECT {$column} FROM {$table}";
    if(!empty($conditions)) {
        $query .= " WHERE {$conditions[0]} {$conditions[1]} '{$conditions[2]}'";
    }

    if (!$result = run_query($query)) {
        throw new Exception('Error when looking to the data');
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

/**
 *
 */
function find(string $table, array $conditions) {
    $result = select($table, null, $conditions);
    return $result[0];
}
