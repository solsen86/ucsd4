/* User Authentication Table(s):
   These tables will be used for user authentication and later
   controll access for Role Based Access Controls
*/

-- Users Table
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

/*
    Creation of Assets table and other secondary tables used to track
    inventory for the UCSD4 IT Department.
*/

-- MANUFACTURER
CREATE TABLE brands (
    brand_id INT NOT NULL AUTO_INCREMENT,
    brand_name VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (brand_id)
);

INSERT INTO brands (brand_name) VALUES
    ('Acer'),
    ('Apple'),
    ('AVer USA'),
    ('ByteSpeed'),
    ('Canon'),
    ('Dell'),
    ('Hitachi'),
    ('HP'),
    ('Lenovo');

-- MODEL
CREATE TABLE models (
    model_id INT NOT NULL AUTO_INCREMENT,
    brand_id INT NOT NULL,
    model_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (model_id),
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id)
);

INSERT INTO models (brand_id, model_name) VALUES
    ((SELECT brand_id FROM brands WHERE brand_name = 'Acer'), 'C910'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Macbook Pro A1278'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Macbook Pro 13.3" A1502'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'iMac 21.5" A1418'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'OptiPlex 7010'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'ByteSpeed'), 'H81M-C'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Latitude E6520'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Latitude E5590'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Macbook Air 13" A1466'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Lenovo'), 'Thinkpad E480'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Macbook Pro 13" A1708'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Latitude 7490'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Latitude 7400'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Mac Mini A1993'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Apple'), 'Macbook Air 13" A2179'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'HP'), 'LaserJet P4015X'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Latitude 5500'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'AVer USA'), 'AverVision F17-8M'),
    ((SELECT brand_id FROM brands WHERE brand_name = 'Dell'), 'Chromebook 3100');

-- BUILDING 
CREATE TABLE buildings (
    building_id INT NOT NULL AUTO_INCREMENT,
    building_code CHAR(2) NOT NULL,
    PRIMARY KEY (building_id)
);

INSERT INTO buildings (building_code) VALUES
    ('HS'),
    ('K8'),
    ('DO'),
    ('BB');

-- ROOM
CREATE TABLE rooms (
    room_id INT NOT NULL AUTO_INCREMENT,
    building_id INT NOT NULL,
    room_number VARCHAR(10) NOT NULL UNIQUE,
    room_name VARCHAR(50) NULL DEFAULT NULL,
    PRIMARY KEY (room_id),
    FOREIGN KEY (building_id) REFERENCES buildings(building_id)
);

INSERT INTO rooms (building_id, room_number, room_name) VALUES
    (1, '22', 'Cafeteria'),
    (1, '23', 'Rec Lab'),
    (1, '103', 'Main Office'),
    (1, '111', 'Mailroom'),
    (1, '115', 'Athletics Office'),
    (1, '116', 'Student Information Office'),
    (1, '125', 'Computer & Technology Education'),
    (1, '126', 'Counseling'),
    (1, '127', 'SPED - Life Skills'),
    (1, '128', 'Math - Johnson'),
    (1, '129', 'Food & Consumer Science'),
    (1, '130', 'Business Lab'),
    (1, '130A', 'IT Server Room'),
    (1, '140', 'IT Office'),
    (1, '141', 'Guitar'),
    (1, '142', 'Band & Choir'),
    (1, '149', 'Library/Media Lab'),
    (1, '150', 'Writing Lab'),
    (1, '155', 'SPED - Resource Room'),
    (1, '156', 'Science Lab'),
    (1, '157', 'Physical Science'),
    (1, '158', 'English - Christopher'),
    (1, '159', 'English - Deckert'),
    (1, '160', 'English - Tinker'),
    (1, '161', 'Math - Petersen'),
    (1, '162', 'Social Studies'),
    (1, '163', 'Indistrial Arts'),
    (1, '166E', 'Vocational Agriculture'),
    (1, '167A', 'Custodian Closet'),
    (1, '175', 'SPED Conference Room'),
    (1, '179', 'Life Science'),
    (1, '180', 'Spanish'),
    (1, '189', 'Social Studies - Johnson'),
    (1, '189A', 'Maintenance Office'),
    (2, 'A-08', ''),
    (2, 'A-21', 'Wentz'),
    (2, 'A-22', ''),
    (2, 'B-02', ''),
    (2, 'B-03', ''),
    (2, 'B-07', ''),
    (2, 'B-12', ''),
    (2, 'B-16', ''),
    (2, 'C-01', ''),
    (2, 'C-04', ''),
    (2, 'C-14', ''),
    (2, 'C-15', ''),
    (2, 'D-01', ''),
    (2, 'D-02', ''),
    (2, 'D-03', ''),
    (2, 'D-04', ''),
    (2, 'D-05', ''),
    (2, 'D-06', ''),
    (2, 'D-07', ''),
    (2, 'D-10', ''),
    (2, 'D-11', ''),
    (2, 'D-12', ''),
    (2, 'D-13', ''),
    (2, 'D-14', ''),
    (2, 'E-02', ''),
    (2, 'E-03', ''),
    (2, 'E-04', ''),
    (2, 'E-05', ''),
    (2, 'E-06', ''),
    (2, 'E-08', ''),
    (2, 'E-09', ''),
    (2, 'E-10', ''),
    (2, 'E-11', ''),
    (2, 'E-12', ''),
    (2, 'E-13', ''),
    (2, 'E-14', ''),
    (2, 'F-02', ''),
    (2, 'F-03', ''),
    (2, 'F-04', ''),
    (2, 'F-05', ''),
    (2, 'F-06', ''),
    (2, 'F-07', ''),
    (2, 'F-10', ''),
    (2, 'F-11', ''),
    (2, 'F-12', ''),
    (2, 'F-13', ''),
    (2, 'F-14', ''),
    (2, 'F-23', ''),
    (2, 'F-24', ''),
    (2, 'G-02', ''),
    (2, 'G-03', ''),
    (2, 'G-04', ''),
    (2, 'G-05', ''),
    (2, 'G-06', ''),
    (2, 'G-07', ''),
    (2, 'G-10', ''),
    (2, 'G-11', ''),
    (2, 'G-12', ''),
    (2, 'G-13', ''),
    (2, 'G-23', ''),
    (2, 'G-25', ''),
    (2, 'G-26', ''),
    (2, 'LIB-WEST', '');

-- STATUS
CREATE TABLE dev_status (
    status_id INT NOT NULL AUTO_INCREMENT,
    status_name VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (status_id)
);

INSERT INTO dev_status (status_name) VALUES
    ('In Service'),
    ('Out of Service'),
    ('Recycle List');

-- Device Type
CREATE TABLE dev_types (
    dev_type_id INT NOT NULL AUTO_INCREMENT,
    dev_type VARCHAR(50) NOT NULL,
    PRIMARY KEY (dev_type_id)
);

INSERT INTO dev_types (dev_type) VALUES
    (UPPER('Desktop')),
    (UPPER('laptop')),
    (UPPER('server')),
    (UPPER('mobile device')),
    (UPPER('printer')),
    (UPPER('scanner')),
    (UPPER('doc cam')),
    (UPPER('projector')),
    (UPPER('interactive board')),
    (UPPER('router')),
    (UPPER('switch')),
    (UPPER('wireless ap')),
    (UPPER('nas')),
    (UPPER('device cart'));

-- SYSTEMS
CREATE TABLE systems (
    os_id INT NOT NULL AUTO_INCREMENT,
    os_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (os_id)
);

INSERT INTO systems (os_name) VALUES 
    (UPPER('Windows')),
    (UPPER('MacOS')),
    (UPPER('Linux')),
    (UPPER('ChromeOS')),
    (UPPER('iOS')),
    (UPPER('Android'));

-- ASSETS
CREATE TABLE assets (
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    asset_location VARCHAR(5) NULL DEFAULT NULL,
    asset_name VARCHAR(15) NULL DEFAULT NULL,
    asset_serial VARCHAR(50) NOT NULL,
    model_id INT NULL DEFAULT NULL,
    room_id INT NULL DEFAULT NULL,
    status_id INT NULL DEFAULT NULL,
    dev_type_id INT NULL DEFAULT NULL,
    os_id INT NULL DEFAULT NULL,
    asset_cpu VARCHAR(50) NULL DEFAULT NULL,
    asset_hdd_type ENUM('SSD', 'SSHD', 'HDD', 'eMMC') NULL DEFAULT NULL,
    asset_hdd_size INT NULL DEFAULT NULL,
    asset_mem INT NULL DEFAULT NULL,
    asset_static_ip VARCHAR(15) NULL DEFAULT NULL,
    asset_wlan_mac VARCHAR(12) NULL DEFAULT NULL,
    asset_lan_mac VARCHAR(12) NULL DEFAULT NULL,
    asset_sped_tag ENUM('Yes', 'No') NOT NULL DEFAULT 'No',
    asset_bios_password VARCHAR(50) NULL DEFAULT NULL,
    asset_date DATETIME NULL DEFAULT NULL,
    asset_age INT NULL DEFAULT NULL,
    asset_price DECIMAL(15,2) NULL DEFAULT NULL,
    PRIMARY KEY (asset_tag),
    FOREIGN KEY (model_id) REFERENCES models(model_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id),
    FOREIGN KEY (status_id) REFERENCES dev_status(status_id),
    FOREIGN KEY (dev_type_id) REFERENCES dev_types(dev_type_id),
    FOREIGN KEY (os_id) REFERENCES systems(os_id)
);

INSERT INTO assets (asset_tag, asset_name, asset_serial, model_id, room_id, 
                    status_id, dev_type_id, os_id, asset_cpu, asset_hdd_size, 
                    asset_mem, asset_wlan_mac,
                    asset_sped_tag, asset_date, asset_age) VALUES 
    (8538, UPPER('tech-olsens-853'), UPPER('c02t66b0fvh4'), (SELECT model_id FROM models WHERE model_name = 'Macbook Pro 13" A1502'),
        (SELECT room_id FROM rooms WHERE room_number = '140'), (SELECT status_id FROM dev_status WHERE status_name = 'In Service'), (SELECT dev_type_id from dev_types WHERE dev_type = 'Laptop'),
        (SELECT os_id FROM systems WHERE os_name = 'Windows'), 'i7-8650U', 512, 16, UPPER('186590cdb871'), 'NO', (STR_TO_DATE('03/13/2017','%m/%d/%Y')),
        (TIMESTAMPDIFF(YEAR,(STR_TO_DATE('03/13/2017','%m/%d/%Y')),CURDATE())));

-- assignments
CREATE TABLE assignments (
    assignment_id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    assignment_status ENUM('CHECKED IN', 'CHECKED OUT') NOT NULL DEFAULT 'CHECKED IN',
    PRIMARY KEY (assignment_id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag) ON DELETE CASCADE
);

INSERT INTO assignments (asset_tag, assignment_status) VALUES
    (8538, 'CHECKED OUT');

-- CREATE TABLE CHECKOUTS
CREATE TABLE checkouts (
    checkout_id INT NOT NULL AUTO_INCREMENT,
    assignment_id INT NOT NULL,
    checkout_user VARCHAR(50) NOT NULL,
    checkout_date_out TIMESTAMP NOT NULL DEFAULT CURDATE(),
    checkout_date_in TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (checkout_id),
    FOREIGN KEY (assignment_id) REFERENCES assignments(assignment_id) ON DELETE CASCADE
);

INSERT INTO checkouts (assignment_id, checkout_user) VALUES
    (1, 'Seth Olsen');

-- Notes
CREATE TABLE notes (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    note_date TIMESTAMP NOT NULL DEFAULT CURDATE(),
    note_author VARCHAR(50) NULL DEFAULT NULL,
    note_subject VARCHAR(50) NOT NULL,
    note_text TEXT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag) ON DELETE CASCADE
);  