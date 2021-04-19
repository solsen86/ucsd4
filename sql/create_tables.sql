/* User Authentication Table(s):
   These tables will be used for user authentication and later
   controll access for Role Based Access Controls
*/

-- Users Table
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR(25) NOT NULL,
    username VARCHAR(25) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_full_name (first_name, last_name)
);

/*
    Creation of Assets table and other secondary tables used to track
    inventory for the UCSD4 IT Department.
*/

-- Assets table // Parent table
CREATE TABLE assets (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    asset_name VARCHAR(15) NULL DEFAULT NULL,
    asset_description TINYTEXT NULL DEFAULT NULL,
    asset_serial VARCHAR(50) NOT NULL,
    asset_sped_tag ENUM('Yes', 'No') NOT NULL DEFAULT 'No',
    asset_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    asset_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE INDEX uq_asset_tag (asset_tag ASC),
    UNIQUE INDEX uq_asset_name (asset_name ASC)
);

-- CPU BRANDS
CREATE TABLE cpu_brands (
    id INT NOT NULL AUTO_INCREMENT,
    cpu_brand VARCHAR(25) NOT NULL,
    PRIMARY KEY (id)
);

-- CPU MODELS
CREATE TABLE cpu_models (
    id INT NOT NULL AUTO_INCREMENT,
    cpu_brand_id INT NOT NULL,
    cpu_model_name VARCHAR(25) NOT NULL,
    cpu_model_num VARCHAR(25) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (cpu_brand_id) REFERENCES cpu_brands(id)
);

-- CPU TABLE: FOREIGN KEY ( asset_tag ) REFERENCES assets(id)
CREATE TABLE processors (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    cpu_brand VARCHAR(25) NOT NULL,
    cpu_model VARCHAR(25) NOT NULL,
    cpu_number VARCHAR(10) NOT NULL,
    cpu_low FLOAT(3, 2) NULL DEFAULT NULL, 
    cpu_high FLOAT(3, 2) NULL DEFAULT NULL,
    cpu_model_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(tag),
    FOREIGN KEY (cpu_model_id) REFERENCES cpu_models(id)
);

-- STORAGE TABLE: FOREIGN KEY ( asset_tag ) REFERENCES assets(id)
CREATE TABLE storage (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    storage_type ENUM('SSD', 'SSHD', 'HHD', 'eMMC') NOT NULL,
    storage_form ENUM('M.2 SATA', '2.5\" SATA', '3.5\" SATA', 'Embedded') NOT NULL,
    storage_size SMALLINT(4) NOT NULL,
    storage_unit ENUM('GB', 'TB'),
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag)
);

-- MEMORY TABLE: FOREIGN KEY ( asset_tag ) REFERENCES assets(id)
CREATE TABLE memory (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    memory_type ENUM('DESKTOP', 'LAPTOP', 'SERVER', 'OPTANE') NOT NULL,
    memory_size SMALLINT(4) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag)
);

-- IP Addresses TABLE: FOREIGN KEY ( asset_tag ) REFERENCES assets(id)
CREATE TABLE network_addresses (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL UNIQUE,,
    network_address INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag)
);

-- MAC Addresses TABLE: FOREIGN KEY ( asset_tag ) REFERENCES assets(id)
CREATE TABLE physical_addresses (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL,
    physical_address CHAR(12) NOT NULL UNIQUE,
    physical_type ENUM('WLAN', 'LAN') NULL DEFAULT NULL,
    physical_label VARCHAR(25) NULL DEFAULT NULL,
    physical_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    physical_modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag)        
);      

-- Table for Buildings
CREATE TABLE buildings (
    id INT NOT NULL AUTO_INCREMENT,
    building_name VARCHAR(25),
    PRIMARY KEY (id)
);

-- Table for Rooms
CREATE TABLE rooms (
    id INT NOT NULL AUTO_INCREMENT,
    building_id INT NOT NULL,
    room_name VARCHAR(25) NOT NULL,
    room_number VARCHAR(10) NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (building_id) REFERENCES buildings(id)
);

-- Table for logistical information containing building, room and user assignment
CREATE TABLE logistics (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL UNIQUE,,
    room_id INT NOT NULL,
    staff_member VARCHAR(50) NULL DEFAULT NULL,
    device_status ENUM('ACTIVE','RETIRED', 'NEEDS REPAIRED', 'PARTS ONLY', 'PENDING') NOT NULL DEFAULT 'ACTIVE',
    purchase_date DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- Table for device type
CREATE TABLE device_categories (
    id INT NOT NULL AUTO_INCREMENT,
    device_category VARCHAR(25),
    PRIMARY KEY (id)
);

-- Table for device category
CREATE TABLE device_types (
    id INT NOT NULL AUTO_INCREMENT,
    device_category_id INT NOT NULL,
    device_type VARCHAR(25),
    PRIMARY KEY (id),
    FOREIGN KEY (device_category_id) REFERENCES device_categories(id)
);

-- Table Table for device categories and sub categories
CREATE TABLE classifications (
    id INT NOT NULL AUTO_INCREMENT,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL UNIQUE,,
    device_type_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag),
    FOREIGN KEY (device_type_id) REFERENCES device_types(id)
);

-- Table for brand names
CREATE TABLE brands (
    id INT NOT NULL AUTO_INCREMENT,
    brand_name VARCHAR(25) NOT NULL,
    PRIMARY KEY (id)
);

-- Table table for models
CREATE TABLE  models (
    id INT NOT NULL AUTO_INCREMENT,
    model_name VARCHAR(25) NOT NULL,
    brand_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
);

-- Manufacture info
CREATE TABLE mfr_info (
    id INT NOT NULL AUTO_INCREMENT,
    model_id INT NOT NULL,
    asset_tag SMALLINT(6) ZEROFILL NOT NULL UNIQUE,,
    mfr_date DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (model_id) REFERENCES models(id),
    FOREIGN KEY (asset_tag) REFERENCES assets(asset_tag)
);