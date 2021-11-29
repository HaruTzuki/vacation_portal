<?php

namespace VacationPortal\Data\Repository;

use PDO;
use VacationPortal\Data\Model\Security\User;

class UserRepository implements IUserRepository{

    public function fetchAll() : array{
        global $conn;
        
        $stmt = $conn->prepare("SELECT u.id, u.address_id, u.contact_id, u.role_id, u.username
        , u.password, u.first_name, u.last_name, u.enable
        , r.description, r.can_write, r.can_read, r.can_delete, r.can_update, r.is_manager, r.is_admin
        , a.street, a.area, a.city, a.postal_code, a.state, a.country
        , c.phone_one, c.phone_two, c.phone_three, c.phone_four, c.mobile, c.email
        FROM users AS u
        INNER JOIN roles AS r ON r.id = u.role_id
        INNER JOIN addresses AS a ON a.id = u.address_id
        INNER JOIN contacts AS c ON c.id = u.contact_id");
        if(!$stmt->execute()){
            return array();
        }
        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Security\User", "mapping"));
    }

    public function fetch(int $id) : User{
        global $conn;
        
        $stmt = $conn->prepare("SELECT u.id, u.address_id, u.contact_id, u.role_id, u.username
        , u.password, u.first_name, u.last_name, u.enable
        , r.description, r.can_write, r.can_read, r.can_delete, r.can_update, r.is_manager, r.is_admin
        , a.street, a.area, a.city, a.postal_code, a.state, a.country
        , c.phone_one, c.phone_two, c.phone_three, c.phone_four, c.mobile, c.email
        FROM users AS u
        INNER JOIN roles AS r ON r.id = u.role_id
        INNER JOIN addresses AS a ON a.id = u.address_id
        INNER JOIN contacts AS c ON c.id = u.contact_id
        WHERE u.id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if(!$stmt->execute()){
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Security\User", "mapping"))[0];
    }

    public function fetchWithUsername(string $username): User
    {
        global $conn;
        
        $stmt = $conn->prepare("SELECT u.id, u.address_id, u.contact_id, u.role_id, u.username
        , u.password, u.first_name, u.last_name, u.enable
        , r.description, r.can_write, r.can_read, r.can_delete, r.can_update, r.is_manager, r.is_admin
        , a.street, a.area, a.city, a.postal_code, a.state, a.country
        , c.phone_one, c.phone_two, c.phone_three, c.phone_four, c.mobile, c.email
        FROM users AS u
        INNER JOIN roles AS r ON r.id = u.role_id
        INNER JOIN addresses AS a ON a.id = u.address_id
        INNER JOIN contacts AS c ON c.id = u.contact_id
        WHERE UPPER(u.username) = UPPER(:username)");

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        if(!$stmt->execute()){
            return NULL;
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Security\User", "mapping"))[0];
    }

    public function fetchWithEMail(string $email): User
    {
        global $conn;
        
        $stmt = $conn->prepare("SELECT u.id, u.address_id, u.contact_id, u.role_id, u.username
        , u.password, u.first_name, u.last_name, u.enable
        , r.description, r.can_write, r.can_read, r.can_delete, r.can_update, r.is_manager, r.is_admin
        , a.street, a.area, a.city, a.postal_code, a.state, a.country
        , c.phone_one, c.phone_two, c.phone_three, c.phone_four, c.mobile, c.email
        FROM users AS u
        INNER JOIN roles AS r ON r.id = u.role_id
        INNER JOIN addresses AS a ON a.id = u.address_id
        INNER JOIN contacts AS c ON c.id = u.contact_id
        WHERE UPPER(c.email) = UPPER(:email)");

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        if(!$stmt->execute()){
            return NULL;
        }

        return $stmt->fetchAll(PDO::FETCH_FUNC, array("VacationPortal\Data\Model\Security\User", "mapping"))[0];
    }

    public function add(User $user) : bool {
        global $conn;

        $conn->beginTransaction();
        $stmt_user =  $conn->prepare("INSERT INTO users(username, `password`, first_name, last_name, role_id) 
        VALUES(:username, :password, :first_name, :last_name, :role_id)");

        $stmt_user->bindParam(":username", $user->username, PDO::PARAM_STR);
        $stmt_user->bindParam(":password", $user->password, PDO::PARAM_STR);
        $stmt_user->bindParam(":first_name", $user->first_name, PDO::PARAM_STR);
        $stmt_user->bindParam(":last_name", $user->last_name, PDO::PARAM_STR);
        $stmt_user->bindParam(":role_id", $user->role_id, PDO::PARAM_INT);

        if(!$stmt_user->execute())
        {
            $conn->rollBack();
            return false;
        }

        $user_id = $conn->lastInsertId();

        $stmt_address = $conn->prepare("INSERT INTO addresses(street, area, city, postal_code, state, country, user_id)
        VALUES (:street, :area, :city, :postal_code, :state, :country, :user_id)");
        
        $stmt_address->bindParam(":street", $user->address->street, PDO::PARAM_STR);
        $stmt_address->bindParam(":area", $user->address->area, PDO::PARAM_STR);
        $stmt_address->bindParam(":city", $user->address->city, PDO::PARAM_STR);
        $stmt_address->bindParam(":postal_code", $user->address->postal_code, PDO::PARAM_STR);
        $stmt_address->bindParam(":state", $user->address->state, PDO::PARAM_STR);
        $stmt_address->bindParam(":country", $user->address->country, PDO::PARAM_STR);
        $stmt_address->bindParam(":user_id", $user_id, PDO::PARAM_STR);

        if(!$stmt_address->execute()){
            $conn->rollBack();
            return false;
        }

        $address_id = $conn->lastInsertId();
        
        $stmt_contact = $conn->prepare("INSERT INTO contacts(phone_one, phone_two, phone_three, phone_four, mobile, email, user_id)
        VALUES (:phone_one, :phone_two, :phone_three, :phone_four, :mobile, :email, :user_id)");

        $stmt_contact->bindParam(":phone_one", $user->contact->phone_one, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_two", $user->contact->phone_two, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_three", $user->contact->phone_three, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_four", $user->contact->phone_four, PDO::PARAM_STR);
        $stmt_contact->bindParam(":mobile", $user->contact->mobile, PDO::PARAM_STR);
        $stmt_contact->bindParam(":email", $user->contact->email, PDO::PARAM_STR);
        $stmt_contact->bindParam(":user_id", $user_id, PDO::PARAM_STR);

        if(!$stmt_contact->execute()){
            $conn->rollBack();
            return false;
        }

        $contact_id  = $conn->lastInsertId();


        $stmt_user = $conn->prepare("UPDATE users SET address_id = :address_id, contact_id = :contact_id WHERE id = :id");
        $stmt_user->bindParam(":address_id", $address_id, PDO::PARAM_INT);
        $stmt_user->bindParam(":contact_id", $contact_id, PDO::PARAM_INT);
        $stmt_user->bindParam(":id", $user_id, PDO::PARAM_INT);

        if(!$stmt_user->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }

    public function update(User $user) : bool{
        global $conn;

        $stmt_user = $conn->prepare("UPDATE users
        SET first_name = :first_name,
        last_name = :last_name,
        enable = :enable,
        role_id = :role_id
        WHERE id = :id");

        $stmt_user->bindParam(":first_name", $user->first_name, PDO::PARAM_STR);
        $stmt_user->bindParam(":last_name", $user->last_name, PDO::PARAM_STR);
        $stmt_user->bindParam(":enable", $user->enable, PDO::PARAM_INT);
        $stmt_user->bindParam(":role_id", $user->role_id, PDO::PARAM_INT);
        $stmt_user->bindParam(":id", $user->id, PDO::PARAM_INT);


        $conn->beginTransaction();

        if(!$stmt_user->execute()){
            $conn->rollBack();
            return false;
        }


        $stmt_address = $conn->prepare("UPDATE addresses
        SET street = :street,
        area = :area,
        city = :city,
        postal_code = :postal_code,
        state = :state,
        country = :country
        WHERE id = :id");

        $stmt_address->bindParam(":street", $user->address->street, PDO::PARAM_STR);
        $stmt_address->bindParam(":area", $user->address->area, PDO::PARAM_STR);
        $stmt_address->bindParam(":city", $user->address->city, PDO::PARAM_STR);
        $stmt_address->bindParam(":postal_code", $user->address->postal_code, PDO::PARAM_STR);
        $stmt_address->bindParam(":state", $user->address->state, PDO::PARAM_STR);
        $stmt_address->bindParam(":country", $user->address->country, PDO::PARAM_STR);
        $stmt_address->bindParam(":id", $user->address_id, PDO::PARAM_INT);

        if(!$stmt_address->execute()){
            $conn->rollBack();
            return false;
        }


        $stmt_contact = $conn->prepare("UPDATE contacts
        SET phone_one = :phone_one,
        phone_two = :phone_two,
        phone_three = :phone_three,
        phone_four = :phone_four,
        mobile = :mobile,
        email = :email
        WHERE id = :id");

        $stmt_contact->bindParam(":phone_one", $user->contact->phone_one, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_two", $user->contact->phone_two, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_three", $user->contact->phone_three, PDO::PARAM_STR);
        $stmt_contact->bindParam(":phone_four", $user->contact->phone_four, PDO::PARAM_STR);
        $stmt_contact->bindParam(":mobile", $user->contact->mobile, PDO::PARAM_STR);
        $stmt_contact->bindParam(":email", $user->contact->email, PDO::PARAM_STR);
        $stmt_contact->bindParam(":id", $user->contact_id, PDO::PARAM_INT);

        if(!$stmt_contact->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();

        return true;
    }

    public function delete(User $user) : bool {

        global $conn;

        $conn->beginTransaction();

        $stmt_address = $conn->prepare("UPDATE addresses SET user_id = NULL WHERE id = :id");
        $stmt_address->bindParam(":id", $user->address_id, PDO::PARAM_INT);

        if(!$stmt_address->execute()){
            $conn->rollBack();
            return false;
        }

        $stmt_contact = $conn->prepare("UPDATE contacts SET user_id = NULL WHERE id = :id");
        $stmt_contact->bindParam(":id", $user->contact_id, PDO::PARAM_INT);

        if(!$stmt_contact->execute()){
            $conn->rollBack();
            return false;
        }

        $stmt_user = $conn->prepare("UPDATE users SET contact_id = :contact_id, address_id = :address_id WHERE id = :id");
        $stmt_user->bindParam(":contact_id", $user->contact_id, PDO::PARAM_INT);
        $stmt_user->bindParam(":address_id", $user->address_id, PDO::PARAM_INT);
        $stmt_user->bindParam(":id", $user->id, PDO::PARAM_INT);

        if(!$stmt_user->execute()){
            $conn->rollBack();
            return false;
        }


        $stmt_address = $conn->prepare("DELETE FROM addresses WHERE id = :id");
        $stmt_address->bindParam(":id", $user->address_id, PDO::PARAM_INT);

        if(!$stmt_address->execute()){
            $conn->rollBack();
            return false;
        }

        $stmt_contact = $conn->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt_contact->bindParam(":id", $user->contact_id, PDO::PARAM_INT);

        if(!$stmt_contact->execute()){
            $conn->rollBack();
            return false;
        }

        $stmt_user = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt_user->bindParam(":id", $user->id, PDO::PARAM_INT);
        
        if(!$stmt_user->execute()){
            $conn->rollBack();
            return false;
        }

        $conn->commit();
        return true;
    }
    
}