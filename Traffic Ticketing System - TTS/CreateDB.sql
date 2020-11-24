CREATE TABLE Addresses (
    AddressID INT(11) NOT NULL AUTO_INCREMENT,
    StreetNumber INT(11),
    StreetName VARCHAR(50) NOT NULL,
    UnitNumber INT(11),
    City VARCHAR(20) NOT NULL,
    Province VARCHAR(20) NOT NULL,
    PostalCode VARCHAR(11) NOT NULL,
    PRIMARY KEY(AddressID)
);

CREATE TABLE EmployeeType (
    EmployeeTypeID INT(11) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Description VARCHAR(255) NOT NULL,
    PRIMARY KEY(EmployeeTypeID)
);

CREATE TABLE Employee (
    EmployeeID INT(11) NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Email VARCHAR(255),
    Password VARCHAR(255),
    EmployeeTypeID INT(11),
    AddressID INT(11),	
    PRIMARY KEY(EmployeeID),
    FOREIGN KEY(EmployeeTypeID) REFERENCES EmployeeType(EmployeeTypeID),
    FOREIGN KEY(AddressID) REFERENCES Addresses(AddressID)
);

CREATE TABLE Violators (
    ViolatorID INT(11) NOT NULL AUTO_INCREMENT,
    DriversLicenseNumber VARCHAR(50) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    AddressID INT(11),
    PRIMARY KEY(ViolatorID),
    FOREIGN KEY(AddressID) REFERENCES Addresses(AddressID)
);

CREATE TABLE VehicleType (
    VehicleTypeID INT(11) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Description VARCHAR(255) NOT NULL,
    PRIMARY KEY(VehicleTypeID)
);

CREATE TABLE Manufacturers (
    ManufacturerCode INT(50) NOT NULL,
    ManufacturerName VARCHAR(50) NOT NULL,
    PRIMARY KEY(ManufacturerCode)
);

CREATE TABLE Vehicles (
    LicensePlateNumber VARCHAR(11) NOT NULL,
    Name VARCHAR(20) NOT NULL,
    Colour VARCHAR(20) NOT NULL,
    VehicleTypeID INT(11),
    ManufacturerCode INT(50),
    PRIMARY KEY(LicensePlateNumber),
    FOREIGN KEY(VehicleTypeID) REFERENCES VehicleType(VehicleTypeID),
    FOREIGN KEY(ManufacturerCode) REFERENCES Manufacturers(ManufacturerCode)
);

CREATE TABLE ViolationType (
    ViolationTypeID INT(11) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Description VARCHAR(255)NOT NULL,
    PRIMARY KEY(ViolationTypeID)
);

CREATE TABLE Violations (
    ViolationID INT(11) NOT NULL AUTO_INCREMENT,
    ViolationNumber INT(50) NOT NULL,
    ViolationDate DATE NOT NULL,
    FineAmount FLOAT(11) NOT NULL,
    FineDueDate DATE NOT NULL,
    ViolatorID INT(11),
    ViolationTypeID INT(11),
    LicensePlateNumber VARCHAR(11),
    PRIMARY KEY(ViolationID),
    FOREIGN KEY(ViolationTypeID) REFERENCES ViolationType(ViolationTypeID),
    FOREIGN KEY(ViolatorID) REFERENCES Violators(ViolatorID),
    FOREIGN KEY(LicensePlateNumber) REFERENCES Vehicles(LicensePlateNumber)
);

CREATE TABLE PaymentMethod (
    PaymentMethodCode INT(11) NOT NULL,
    Name VARCHAR(50) NOT NULL,
    Description VARCHAR(255) NOT NULL,
    PRIMARY KEY(PaymentMethodCode)
);
