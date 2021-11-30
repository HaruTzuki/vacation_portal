INSERT INTO users (id, username, password, first_name, last_name, enable, role_id)
VALUES (1, 'Manager1', '015bc1d636d841f080c051741d736c210617d36850cadff390b9e01e980488c3aaea00ff19fd89fb499b0ed1b88a990529b60ee3bb68515eb94c3f6e277d12c3', 'Manager', 'One', 1, 1),
(2, 'Manager2', '42e1b796500afd51b91cb78feefa62a0cea761432cbbc9888984144840706b900baa0531ca74cf54348f47765e89d0c44ffebda48b4dd7fa857a4b5f6aa2afdb', 'Manager', 'Two', 1, 1),
(3, 'Employee1', 'f9d9e2ffa0164dd773bf238e86ddc96e4b00af88cf8be272a7d95703e1efea31ed95ea05308d0fd6a241bb2e98316bed977b1d65134fa089fd9bd669e0690ec7', 'Employee', 'One', 1, 2),
(4, 'Employee2', '7e918bd82a6239394a4ffedf78a994b2809cbce3f0ec725c4c88727e850b9b9711eebacaea5d0ef9d044db7c227d9b3421e0331a25e8c600a650e24bbaeb32bd', 'Employee', 'Two', 1, 2),
(5, 'Employee3', '2136fd28a92d7d2bcb29e6dee270b6035a8879d943ea69de4b3c1cd93991dec4868fc60e2a6de5459574a4860878774bebd0047a60a929dc4d3bc5d1305f7d7f', 'Employee', 'Three', 1, 2);

INSERT INTO addresses (id, street, area, city, postal_code, state, country, user_id)
VALUES(1, '','','','','','',1),
(2, '','','','','','',2),
(3, '','','','','','',3),
(4, '','','','','','',4),
(5, '','','','','','',5);

INSERT INTO contacts(id, phone_one, phone_two, phone_three, phone_four, mobile, email, user_id)
VALUES (1, '', '','', '', '', 'manager_one@vacation-portal.com', 1),
(2, '', '','', '', '', 'manager_two@vacation-portal.com', 2),
(3, '', '','', '', '', 'employee_one@vacation-portal.com', 3),
(4, '', '','', '', '', 'employee_two@vacation-portal.com', 4),
(5, '', '','', '', '', 'employee_three@vacation-portal.com', 5);

UPDATE users
SET address_id = 1,
contact_id = 1
WHERE id = 1;

UPDATE users
SET address_id = 2,
contact_id = 2
WHERE id = 2;

UPDATE users
SET address_id = 3,
contact_id = 3
WHERE id = 3;

UPDATE users
SET address_id = 4,
contact_id = 4
WHERE id = 4;

UPDATE users
SET address_id = 5,
contact_id = 5
WHERE id = 5;