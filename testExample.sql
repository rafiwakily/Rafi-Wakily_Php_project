create database TestExample;
use TestExample;

CREATE TABLE Products (
    ID INT NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL,  
    Description VARCHAR(500),
    Price INT NOT NULL,
    Picture VARCHAR(50),
    PRIMARY KEY (ID)
);

INSERT INTO Products (Name,Description,Price,Picture) VALUES("i8","2020", 1, "Audi.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("With nice color","big", 3, "volvos.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("VW Passat","2020", 4, "vw_passat.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("Mercedes Benz","2020", 10, "benz.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("bently","latest model", 1, "bently.jpg");

COMMIT;
