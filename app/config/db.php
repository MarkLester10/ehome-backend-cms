<?php

session_start();
require 'connection.php';

//PURPOSE: FOR DEBUGGING ;
function dump($value) // to be deleted soon

{
  echo "<pre>", print_r($value, true), "</pre>";
  die();
}


function execQuery($sql, $data)
{
  global $conn;
  $stmt = $conn->prepare($sql);
  $values = array_values($data);
  $types = str_repeat('s', count($values));
  $stmt->bind_param($types, ...$values);
  $stmt->execute();
  return $stmt;
}

// SELECT FUNCTIONS
function selectAll($table, $conditions = [])
{
  global $conn;
  $sql = "SELECT * FROM $table";
  if (empty($conditions)) {
    $sql = "{$sql} ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
  } else {
    //this will return records that match the passed conditions
    $i = 0;
    foreach ($conditions as $key => $value) {
      if ($i === 0) {
        $sql = $sql . " WHERE $key=?";
      } else {
        $sql = $sql . " AND $key=?";
      }
      $i++;
    }
    $sql =  "{$sql} ORDER BY id DESC";
    $stmt = execQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
    return $records;
  }
}

//Select One AND-WHERE
function selectOne($table, $conditions)
{
  $sql = "SELECT * FROM $table";
  //$sql ="SELECT * FROM users WHERE id=0 AND username=Mark Lester AND ADMIN=1 AND"
  $i = 0;
  foreach ($conditions as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key=?";
    } else {
      $sql = $sql . " AND $key=?";
    }
    $i++;
  }
  return commit($sql, $conditions);
}


//Select One OR-WHERE
function selectOneOr($table, $conditions)
{
  $sql = "SELECT * FROM $table";
  //$sql ="SELECT * FROM users WHERE id=0 AND username=Mark Lester AND ADMIN=1 AND"
  $i = 0;
  foreach ($conditions as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " WHERE $key=?";
    } else {
      $sql = $sql . " OR $key=?";
    }
    $i++;
  }
  return commit($sql, $conditions);
}

function commit($sql, $conditions)
{
  $sql = $sql . " LIMIT 1"; // this helps when you have a thousands or millions of records
  $stmt = execQuery($sql, $conditions);
  $records = $stmt->get_result()->fetch_assoc(); //associative array that return each value
  return $records;
}


//CREATE FUNCTION
function create($table, $data) //insert
{
  // $sql = "INSERT INTO users SET name=?, size=?, email=?, password=?";
  $sql = "INSERT INTO $table SET ";
  $i = 0;
  foreach ($data as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " $key=?";
    } else {
      $sql = $sql . ", $key=?";
    }
    $i++;
  }
  $stmt = execQuery($sql, $data);
  $id = $stmt->insert_id;
  return $id;
}

//UPDATE FUNCTION
function update($table, $column = '', $columnData, $data)
{
  //$sql ="UPDATE users SET username=?, admin=?, email=?, password=? WHERE type=?"
  $sql = "UPDATE $table SET";

  $i = 0;
  foreach ($data as $key => $value) {
    if ($i === 0) {
      $sql = $sql . " $key=?";
    } else {
      $sql = $sql . ", $key=?";
    }
    $i++;
  }
  $sql = "{$sql} WHERE {$column}=?";
  $data[$column] = $columnData;
  $stmt = execQuery($sql, $data);
  return $stmt->affected_rows;
}




//DELETE FUNCTION
function delete($table, $data)
{
  $column = key($data);
  $value = current($data);
  $sql = "DELETE FROM $table WHERE $column = ?";
  $stmt = execQuery($sql, [$column => $value]);
  return $stmt->affected_rows;
}


// Search
function searchPost($keyword)
{
  $searchMatch = '%' . $keyword . '%';

  $sql = "SELECT
  p.*,
  sc.name AS subcategory,
  sc.slug AS subcategory_slug,
  c.name AS category, 
  c.slug AS catSlug,
  u.profile_image,
  u.username,
  COUNT(posts_likes.id) AS likes
  FROM posts AS p

  LEFt JOIN categories AS c
  ON p.category_id = c.id

  LEFt JOIN subcategories AS sc
  ON p.subcategory_id = sc.id

  LEFT JOIN users as u
  ON p.user_id = u.id

  LEFT JOIN posts_likes
  ON p.id = posts_likes.post_id
  WHERE p.title LIKE ? AND p.is_published='1' OR p.body LIKE ?
  GROUP BY p.id ORDER BY p.id DESC";

  $stmt = execQuery($sql, ['p.title' => $searchMatch, 'p.body' => $searchMatch]);
  $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); //return all values
  return $records;
}


function selectCount($table, $column)
{
  global $conn;
  $columnName = key($column);
  $columnValue = current($column);
  $sql = "SELECT
  COUNT(*) AS count
  FROM $table
  WHERE $columnName  = ?";
  $stmt = execQuery($sql, [$columnName => $columnValue]);
  $records = $stmt->get_result()->fetch_assoc();
  return $records;
}

function resetAll($table)
{
  global $conn;
  $sql = "TRUNCATE $table";
  $stmt = $conn->prepare($sql);
  $res = $stmt->execute();

  if ($res) {
    $status = 1;
  } else {
    $status = 0;
  }

  return $status;
}