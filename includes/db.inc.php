<?php
/**
 * Database-related functions
 */

/**
 * Connect to the database.
 * 
 * Currently this function is intended for MySQL driver only. Will add support
 * for more drivers later.
 *
 * @param  array $config
 * @return mixed
 */
function connect($config) 
{
    $dsn = $config['driver'] 
         . ':host=' . $config['host'] 
         . ';dbname=' . $config['dbname'];

    try {
        $dbh = new PDO($dsn, $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec('SET NAMES "' . $config['charset'] . '"');
        return $dbh;
    } catch (PDOException $e) {
        return $e;
    }
}

/**
 * Make a SELECT query.
 *
 * @param  PDO    $dbh
 * @param  string $sql
 * @param  array  $bindings
 * @return mixed
 */
function query($dbh, $sql, $bindings = []) 
{
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute($bindings);
        return ($sth->rowCount() > 0) 
                ? $sth->fetchAll() 
                : [];
    } catch (PDOException $e) {
        return $e;
    }
}

/**
 * Execute INSERT, UPDATE, DELETE statements.
 *
 * @param  PDO    $dbh
 * @param  string $sql
 * @param  array  $bindings
 * @return mixed
 */
function execute($dbh, $sql, $bindings = []) 
{
    try {
        $sth = $dbh->prepare($sql);
        return $sth->execute($bindings);
    } catch (PDOException $e) {
        return $e;
    }
}

/**
 * Get rows from a specified table in descending order of ID. 
 *
 * @param  PDO    $dbh
 * @param  string $table_name
 * @param  int    $limit
 * @return mixed
 */
function get_table($dbh, $table_name, $limit = 10) 
{
    try {
        $sth = $dbh->query("SELECT * FROM $table_name 
                            ORDER BY id DESC 
                            LIMIT $limit");

        return ($sth->rowCount() > 0)
                ? $sth->fetchAll()
                : [];
    } catch (PDOException $e) {
        return $e;
    }
}