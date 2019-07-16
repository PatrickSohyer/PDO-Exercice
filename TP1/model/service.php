<?php

class Service extends Database
{

    public $id;
    public $serviceName;
    public $serviceDescription;

    public function selectService()
    {
        $reqSelectService = $this->db->query('SELECT * FROM service');
        if ($reqSelectService->execute()) {
            $fetchSelectService = $reqSelectService->fetchAll();
            return $fetchSelectService;
        }
    }

    public function selectServiceList()
    {
        $reqSelectServiceList = $this->db->prepare('SELECT users.id AS usersID, users.lastName AS usersLN, users.firstName AS usersFN, users.birthDate AS usersBD, users.address AS usersAD, users.postalCode AS usersPC, users.phoneNumber AS usersPN, users.id_service AS usersIDS, service.id AS serviceID, service.serviceName AS serviceN, service.serviceDescription AS serviceD FROM users INNER JOIN service ON service.id = users.id_service WHERE service.serviceName = :serviceName');
        $reqSelectServiceList->bindValue(':serviceName', $this->serviceName);
        $reqSelectServiceList->execute();
        $fetchSelectServiceList = $reqSelectServiceList->fetchAll();
        return $fetchSelectServiceList;
    }
}
