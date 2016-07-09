<?php

require_once './connection.php';
require_once './functions.php';
protection();

//Deleta registros
function DeleteBD($table, $where = null) {
    $where = ($where) ? " WHERE {$where}" : null;

    $query = "DELETE FROM {$table}{$where}";
    return ExecuteBD($query);
}

//Altera registros
function UpdateBD($table, array $data, $where = null, $insertId = FALSE) {
    foreach ($data as $key => $value) {
        $fields[] = "{$key}= '{$value}'";
    }

    $fields = implode(',', $fields);

    $where = ($where) ? " WHERE {$where}" : null;
    $query = "UPDATE {$table} SET {$fields}{$where}";
    return ExecuteBD($query, $insertId);
}

//Ler registros
function SelectBD($table, $params = null, $fields = '*') {
    $params = $params ? " {$params}" : null;
    $query = "SELECT {$fields} FROM {$table}{$params}";

    $result = ExecuteBD($query);

    if (!mysqli_num_rows($result)) {
        return false;
    } else {
        while ($res = mysqli_fetch_assoc($result)) {
            $data[] = $res;
        }
        return ($data);
    }
}

//Executa querys 
function ExecuteBD($query, $insertId = false) {
    $link = ConnectBD();
    $result = @mysqli_query($link, $query) or die(mysqli_error($link));

    if ($insertId) {
        $result = mysqli_insert_id($link);
    }

    CloseBD($link);
    return $result;
}

//Grava registros
function InsertBD($table, array $data, $insertId = false) {
    $data = EscapeBD($data);
    $fields = implode(',', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $query = "INSERT INTO {$table}( {$fields} ) VALUES ({$values})";


    return ExecuteBD($query, $insertId);
}
