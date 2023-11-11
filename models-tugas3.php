<?php
require_once('config/conn.php');
require_once('model/ModelAbstract.php');

class Students
{
    static function select()
    {
        global $conn;
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }


    static function insert($id, $name, $email, $role_fk)
    {
        global $conn;
        $sql = "INSERT INTO students(id, name, email, role_fk) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi', $id, $name, $email, $role_fk);
        $stmt->execute();
        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }


    static function delete()
    {
        global $conn;
        $sql = "DELETE FROM students;";
        $conn->query($sql);
        $result = $conn->affected_rows > 0 ? true : false;
        return $result;
    }

    static function joinRoles($clauseAddition = "")
    {
        global $conn;
        $sql = "SELECT s.id, s.name, s.email, r.role_name FROM students s, roles r WHERE s.role_fk = r.id " . $clauseAddition . ";";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }

    static function fresh()
    {
        Students::delete();
        global $conn;
        $data = [
            [212410103087, 'Rahadyan Rizqy A', 'mymail@rdnet.id', 'aktif', 1],
            [212410103073, 'Achmad Faris F', 'achmadfaris@faris.id', 'aktif', 1],
            [212410101005, 'Christianus Yoga W', 'christyoga@christ.net', 'aktif', 1],
            [212410101059, 'Isabel Aprilia A', 'isabelapril@isabel.net', 'aktif', 1],
            [222410102085, 'Rastian Restu F', 'rastianrestu@rast.net', 'cuti', 2],
            [222410102075, 'Khisan Afif Nur R', 'khisanafif@nurr.net', 'cuti', 2],
            [202410102032, 'Imroatul Fitriyah', 'imroatul@fitri.net', 'cuti', 2],
            [202410102041, 'Laida Lavenia H', 'laidalavenia@laida.net', 'cuti', 2],
            // Add more data as needed
        ];

        foreach ($data as $row) {
            $id = $row[0];
            $name = $row[1];
            $email = $row[2];
            $kondisi = $row[3];
            $role_fk = $row[4];

            $sql = "INSERT INTO students (id, name, email,kondisi, role_fk) VALUES (?, ?, ?,?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('issss', $id, $name, $email, $kondisi, $role_fk);

            $stmt->execute();
        }
        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function selectById($id)
    {
        global $conn;
        $sql = "SELECT * FROM students WHERE id = $id";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    } # sudah dikerjakan

    static function selectWhere($clause)
    {
        global $conn;

        // Gunakan tanda kutip untuk nilai string dalam klausa WHERE dan hindari SQL injection
        $sql = "SELECT * FROM students WHERE name = '$clause' OR email = '$clause' OR role_fk = '$clause'";
        $result = $conn->query($sql);
        $arr = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        } else {
            // Tangani kesalahan query
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        return $arr;
    } # sudah dikerjakan
    static function updateById($id, $name, $email, $role_fk)
    {
        global $conn;
        $query = "UPDATE students SET name = ?, email = ?, role_fk = ? WHERE id = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssii", $name, $email, $role_fk, $id);
        $success = $statement->execute();
        $statement->close();


        return $success;
    } # Sudah dikerjakan 

    static function updateWhere($kondisi, $role_fk)
    {
        global $conn;
        $query = "UPDATE `students` SET `kondisi` = ? WHERE `role_fk` = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("si", $kondisi, $role_fk);
        $success = $statement->execute();
        $statement->close();

        return $success;
    } # sudah dikerjakan

    static function deleteById($id)
    {
        global $conn;
        $sql = "DELETE FROM students WHERE id = $id";
        $conn->query($sql);
        $result = $conn->affected_rows > 0 ? true : false;
        return $result;
    } # Sudah dikerjakan

    static function deleteWhere($clause)
    {
        global $conn;
        $sql = "DELETE FROM students WHERE role_fk = $clause";
        $conn->query($sql);
        $result = $conn->affected_rows > 0 ? true : false;
        return $result;
    } # sudah dikerjakan!
}

###############################

class Roles
{
    static function select()
    {
        global $conn;
        $sql = "SELECT * FROM roles";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }

    
    static function selectById($id)
    {
        global $conn;
        $sql = "SELECT * FROM students WHERE role_fk = $id";
        $result = $conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                foreach ($row as $key => $value) {
                    $arr[$key][] = $value;
                }
            }
        }
        return $arr;
    }
}
