<?php

namespace VacationPortal\Data\Model\Security;

use DateTime;
use VacationPortal\Data\Model\Basic\Address;
use VacationPortal\Data\Model\Basic\Contact;
use VacationPortal\Data\Model\Basic\Role;

class User {
    public int $id;
    public string $username;
    public string $password;
    public string $first_name;
    public string $last_name;
    public bool $enable;
    public int $role_id;
    public Role $role;
    public int $address_id;
    public Address $address;
    public int $contact_id;
    public Contact $contact;
    

    public function mapping(int $id
    , int $address_id
    , int $contact_id
    , int $role_id
    , string $username
    , string $password
    , string $first_name
    , string $last_name
    , bool $enable
    , string $description
    , bool $can_write
    , bool $can_read
    , bool $can_delete
    , bool $can_update
    , bool $is_manager
    , bool $is_admin
    , string $street
    , string $area
    , string $city
    , string $postal_code
    , string $state
    , string $country
    , string $phone_one
    , string $phone_two
    , string $phone_three
    , string $phone_four
    , string $mobile
    , string $email){
        $user = new User();

        $user->id = $id;
        $user->username = $username;
        $user->password = $password;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->enable = $enable;
        $user->address_id = $address_id;
        $user->contact_id = $contact_id;
        $user->role_id = $role_id;
        $user->role = new Role();
        $user->role->id = $role_id;
        $user->role->description = $description;
        $user->role->can_write = $can_write;
        $user->role->can_read = $can_read;
        $user->role->can_delete = $can_delete;
        $user->role->can_update = $can_update;
        $user->role->is_manager = $is_manager;
        $user->role->is_admin = $is_admin;
        $user->address = new Address();
        $user->address_id = $address_id;
        $user->address->street = $street;
        $user->address->area = $area;
        $user->address->city = $city;
        $user->address->postal_code = $postal_code;
        $user->address->state = $state;
        $user->address->country = $country;
        $user->contact = new Contact();
        $user->contact->id = $contact_id;
        $user->contact->phone_one = $phone_one;
        $user->contact->phone_two = $phone_two;
        $user->contact->phone_three = $phone_three;
        $user->contact->phone_four = $phone_four;
        $user->contact->mobile = $mobile;
        $user->contact->email = $email;

        return $user;
    }
}