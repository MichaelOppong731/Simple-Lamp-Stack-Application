-- Create the database
CREATE DATABASE IF NOT EXISTS lampstack;
USE lampstack;

-- Create the hospital table FIRST
CREATE TABLE IF NOT EXISTS hospital (
    hoscode VARCHAR(45) PRIMARY KEY,
    hosname VARCHAR(45) NOT NULL,
    city VARCHAR(45) NOT NULL,
    prov VARCHAR(45) NOT NULL,
    numofbed INT NOT NULL,
    headdoc VARCHAR(45)
);

-- Create the doctor table (Now referencing hospital)
CREATE TABLE IF NOT EXISTS doctor (
    licensenum VARCHAR(45) PRIMARY KEY,
    firstname VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL,
    licensedate DATE NOT NULL,
    birthdate DATE NOT NULL,
    hosworksat VARCHAR(45),
    speciality VARCHAR(45),
    FOREIGN KEY (hosworksat) REFERENCES hospital(hoscode)
);

-- Create the patient table
CREATE TABLE IF NOT EXISTS patient (
    ohipnum VARCHAR(45) PRIMARY KEY,
    firstname VARCHAR(45) NOT NULL,
    lastname VARCHAR(45) NOT NULL
);

-- Create the looksafter table (After all required tables exist)
CREATE TABLE IF NOT EXISTS looksafter (
    licensenum VARCHAR(45),
    ohipnum VARCHAR(45),
    PRIMARY KEY (licensenum, ohipnum),
    FOREIGN KEY (licensenum) REFERENCES doctor(licensenum),
    FOREIGN KEY (ohipnum) REFERENCES patient(ohipnum)
);

-- Populate the hospital table FIRST
INSERT INTO hospital (hoscode, hosname, city, prov, numofbed, headdoc) VALUES
('HOS001', 'General Hospital', 'Toronto', 'ON', 500, 'DOC001'),
('HOS002', 'City Hospital', 'Vancouver', 'BC', 300, 'DOC002');

-- Populate the doctor table
INSERT INTO doctor (licensenum, firstname, lastname, licensedate, birthdate, hosworksat, speciality) VALUES
('DOC001', 'Emily', 'Brown', '2010-05-15', '1980-03-22', 'HOS001', 'Cardiology'),
('DOC002', 'Michael', 'Green', '2012-08-10', '1975-11-30', 'HOS002', 'Neurology'),
('DOC003', 'Sarah', 'White', '2015-04-25', '1985-07-12', 'HOS001', 'Pediatrics');

-- Populate the patient table
INSERT INTO patient (ohipnum, firstname, lastname) VALUES
('OHIP123', 'John', 'Doe'),
('OHIP456', 'Jane', 'Smith'),
('OHIP789', 'Alice', 'Johnson');

-- Populate the looksafter table
INSERT INTO looksafter (licensenum, ohipnum) VALUES
('DOC001', 'OHIP123'),
('DOC002', 'OHIP456'),
('DOC003', 'OHIP789');
