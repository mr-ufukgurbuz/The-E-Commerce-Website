USE ROBOTICS_PRODUCTS_TRADING

CREATE TABLE Category(
	categoryID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	categoryName nvarchar(40) NOT NULL,
	parentID int DEFAULT(0) CHECK(parentID>=0) FOREIGN KEY REFERENCES Category(categoryID),
	categoryPicture nvarchar(60)		-- "Picture" path
);

CREATE TABLE Product_KDV(
	productKDV_ID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	kdv_Type nvarchar(15) UNIQUE NOT NULL,
	kdv int DEFAULT(0) NOT NULL
);

CREATE TABLE Product(
	productID int NOT NULL IDENTITY(1000,1) PRIMARY KEY,
	productName nvarchar(50),
	categoryID int FOREIGN KEY REFERENCES Category(categoryID),
	productPrice nvarchar(10),
	productPicture nvarchar(60),						-- "Picture" path
	productStock int DEFAULT(0) CHECK(productStock>=0),
	productActive bit CHECK(productActive IN (0,1)),	--> "True-False" boolean for "stockActive"
	productDate date DEFAULT(GETDATE()),						--> It takes "date of system" while there is a addition operation
	productExplanation ntext DEFAULT('Bu ürünü robotik projenizde kullanabilirsiniz.'),
	productKDV_ID int FOREIGN KEY REFERENCES Product_KDV(productKDV_ID)
);

CREATE TABLE Member(
	memberID bigint IDENTITY(12484623794, 1119678968) PRIMARY KEY,
	memberUserName nvarchar(15) UNIQUE,				--> "Unique" userName
	memberPassword nvarchar(15),
	nameSurname nvarchar(60),
	emailAddress nvarchar(50) UNIQUE,				--> "Unique" E-Mail Address
	phoneNumber float,						--> "Phone Number" without 'zero' in in the beginning <553 843 97 44>
	birthDate date,
	age AS DATEDIFF(year, birthDate, GETDATE()),
	securityQuestion nvarchar(40),
	securityQuestionAnswer nvarchar(40),
	registerDate date DEFAULT(GETDATE()),
	gender varchar(7) CHECK(gender IN ('M','F')),
	addressID int FOREIGN KEY REFERENCES Member_Address(addressID)
);

CREATE TABLE Member_Address(
	addressID int NOT NULL IDENTITY(1,1) PRIMARY KEY,										-- PK
	city nvarchar(30) DEFAULT('Ýstanbul'),
	district nvarchar(30),
	detailedAddress nvarchar(100),
	postCode nvarchar(20) DEFAULT('34000')
);

CREATE TABLE Order_Condition(
	orderConditionID int NOT NULL IDENTITY(1,1) PRIMARY KEY,								-- PK
	orderCondition nvarchar(30) UNIQUE NOT NULL
);

CREATE TABLE Payment_Option(
	paymentOptionID int NOT NULL IDENTITY(1,1) PRIMARY KEY,
	paymentType nvarchar(20) UNIQUE NOT NULL
);

CREATE TABLE Order_(
	orderID int NOT NULL IDENTITY(40000,1) PRIMARY KEY,
	memberID bigint FOREIGN KEY REFERENCES member(memberID)
);

CREATE TABLE OrderList(
	orderID int FOREIGN KEY REFERENCES Order_(orderID),							-- PK
	productID int FOREIGN KEY REFERENCES Product(productID),					-- PK
	orderListDate date DEFAULT(GETDATE()),
	orderConditionID int FOREIGN KEY REFERENCES Order_Condition(orderConditionID),
	paymentOptionID int FOREIGN KEY REFERENCES Payment_Option(paymentOptionID),
	memberID bigint FOREIGN KEY REFERENCES member(memberID),
	PRIMARY KEY(orderID,productID)
);