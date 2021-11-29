/*Clean up database*/
UPDATE addresses
SET user_id = null;

UPDATE contacts
SET user_id = null;

UPDATE users
SET address_id = null
, contact_id = null;

DELETE FROM addresses;
DELETE FROM contacts;
DELETE FROM notification_details;
DELETE FROM notification_headers;
DELETE FROM applications;
DELETE FROM users;

ALTER TABLE addresses AUTO_INCREMENT = 1;
ALTER TABLE contacts AUTO_INCREMENT = 1;
ALTER TABLE notification_details AUTO_INCREMENT = 1;
ALTER TABLE notification_headers AUTO_INCREMENT = 1;
ALTER TABLE applications AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;

