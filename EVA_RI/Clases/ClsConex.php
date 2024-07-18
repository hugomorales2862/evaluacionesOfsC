<?php
session_start();
class ClsConex
{
    var $conn;
    function getConexion()
    {
        $user = $_SESSION['auth_user'];
        $pass = $_SESSION['pass'];
        try {
            //$ifxConnect = new PDO("informix:host=srvlnx; service=1526; database=mdn; server=srvlnx_tcp; protocol=onsoctcp;", $user, $pass);
            // $ifxConnect = new PDO("informix:host=srvlnx; service=1526; database=mdn; server=srvlnx_tcp; protocol=onsoctcp; CLIENT_LOCALE=en_US.utf8", $user, $pass);
            // $ifxConnect = new PDO("informix:host=zeusnet; service=1526; database=mdn; server=hercules; protocol=onsoctcp; EnableScrollableCursors=1;", $user, $pass);
            $ifxConnect = new PDO("informix:host=192.168.73.30; service=1526; database=mdn; server=atila_tcp; protocol=onsoctcp; EnableScrollableCursors=1;", $user, $pass);
        } catch (PDOException $e) {
            $e->getMessage();
        }
        if ($ifxConnect) {
            $this->conn = $ifxConnect;
        } else {
            return false;
        }
    }

    function exec_query($sql)
    {
        $this->getConexion();
        $conn = $this->conn;

        if ($conn) {
            $result = $conn->query($sql);

            if ($result) {
                $x = 0;
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $result_array[$x] = $row;
                    $x++;
                }
                if ($x > 0) {
                    return $result_array;
                }
            } else {
                return false;
            }
        } else {
            return "!E";
        }
    }


    function exec_sql($sql)
    {
        $this->getConexion();
        $conn = $this->conn;

        if ($conn) {
            $conn->beginTransaction();
            $result = $conn->exec($sql);
            if ($result === 1) {
                $conn->commit();
                return 1;
            } else {
                $conn->rollBack();
                return 0;
            }
        } else {
            return 0;
        }
    }
}
