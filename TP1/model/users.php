<?php

class Users extends Database
{

    public $id;
    public $lastName;
    public $firstName;
    public $birthDate;
    public $address;
    public $postalCode;
    public $phoneNumber;
    public $id_service;

    public function addUsers()
    {
        $reqAddUsers = $this->db->prepare('INSERT INTO users (lastName, firstName, birthDate, address, postalCode, phoneNumber, id_service) VALUES (:lastName, :firstName, :birthDate, :address, :postalCode, :phoneNumber, :id_service)');
        $reqAddUsers->bindValue(':lastName', $this->lastName);
        $reqAddUsers->bindValue(':firstName', $this->firstName);
        $reqAddUsers->bindValue(':birthDate', $this->birthDate);
        $reqAddUsers->bindValue(':address', $this->address);
        $reqAddUsers->bindValue(':postalCode', $this->postalCode);
        $reqAddUsers->bindValue(':phoneNumber', $this->phoneNumber);
        $reqAddUsers->bindValue(':id_service', $this->id_service);
        if ($reqAddUsers->execute()) {
            return TRUE;
        }
    }

    public function selectUsers()
    {
        $reqSelectUsers = $this->db->query('SELECT users.id AS idUsers, users.lastName, users.firstName, users.birthDate, users.address, users.postalCode, users.phoneNumber, users.id_service, service.id, service.serviceName, service.serviceDescription from users INNER JOIN service ON service.id = users.id_service');
        if ($reqSelectUsers->execute()) {
            $fetchSelectUsers = $reqSelectUsers->fetchAll();
            return $fetchSelectUsers;
        }
    }

    public function deleteUsers()
    {
        $reqDeleteUsers = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $reqDeleteUsers->bindValue(':id', $this->id);
        if ($reqDeleteUsers->execute()) {
            return TRUE;
        }
    }

}
