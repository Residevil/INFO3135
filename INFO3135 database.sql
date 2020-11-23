CREATE TABLE addresses (
    address_id INT(11) NOT NULL AUTO INCREMENT,
    street_number INT(11) NOT NULL,
    street_name VARCHAR(50) NOT NULL,
    unit_number INT(11) NOT NULL,
    city VARCHAR(20) NOT NULL,
    province VARCHAR(20) NOT NULL,
    postal_code VARCHAR(11) NOT NULL,
    PRIMARY KEY (address_id)
);

CREATE TABLE employee (
    employee_id INT(11) NOT NULL AUTO INCREMENT,
    name VARCHAR(50) NOT NULL,
    employee_type_id INT(11),
    address_id INT(11),
    PRIMARY KEY (employee_id),
    FOREIGN KEY (employee_type_id) REFERENCE employee type (employee_type_id),
    FOREIGN KEY (address_id) REFERENCE addresses(address_id)
);

CREATE TABLE employee type (
    employee_type_id INT(11) NOT NULL AUTO INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255), NOT NULL,
    PRIMARY KEY (employee_type_id)
);

CREATE TABLE violator (
    violator_id INT(11) NOT NULL AUTO INCREMENT,
    driver_license INT(20) NOT NULL,
    name VARCHAR(50) NOT NULL,
    address_id INT(11),
    PRIMARY KEY (violator_id),
    FOREIGN KEY (address_id) REFERENCE addresses(address_id)
);

CREATE TABLE violation (
    violation_id INT(11) NOT NULL AUTO INCREMENT,
    violation_number INT(50) NOT NULL,
    violation_date DATE(20) NOT NULL,
    fine_amount FLOAT(11) NOT NULL,
    fine_due_date DATE(20) NOT NULL,
    violator_id INT(11),
    violation_type_id INT(11),
    license_plate VARCHAR(11),
    PRIMARY KEY (violation_id),
    FOREIGN KEY (violator_id) REFERENCE violator type (violator_id),
    FOREIGN KEY (violation_type_id) REFERENCE violation type (violation_type_id),
    FOREIGN KEY (license_plate) REFERENCE vehicle(license_plate)
);

CREATE TABLE violation type (
    violation_type_id INT(11) NOT NULL AUTO INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255), NOT NULL,
    PRIMARY KEY (violation_type_id)
);

CREATE TABLE vehicle (
    license_plate INT(11) NOT NULL,
    name VARCHAR(20) NOT NULL,
    colour VARCHAR(20) NOT NULL,
    vehicle_type_id INT(11),
    PRIMARY KEY (license_plate),
    FOREIGN KEY (vehicle_type_id) REFERENCE vehicle type (vehicle_type_id)
);

CREATE TABLE vehicle type (
    vehicle_type_id INT(11) NOT NULL,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (vehicle_type_id)
);

CREATE TABLE vehicle manufacturers (
    manufacturer_code INT(50) NOT NULL,
    manufacturer_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (manufacturer_code)
);

CREATE TABLE payment methods (
    payment_method_code INT(11) NOT NULL,
    name VARCHAR(50), NOT NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (payment_method_code)
);
