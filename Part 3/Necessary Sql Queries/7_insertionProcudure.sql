USE ROBOTICS_PRODUCTS_TRADING
------------------------------------------	<<< INSERTION MEMBER >>> ----------------------------------------------

CREATE PROCEDURE insertionToMember
(
	@memberID bigint,
	@memberUserName nvarchar(15),
	@memberPassword nvarchar(15),
	@nameSurname nvarchar(60),
	@emailAddress nvarchar(50),
	@phoneNumber bigint,
	@birthDate date,
	@securityQuestion nvarchar(40),
	@securityQuestionAnswer nvarchar(40),
	@gender varchar(7),
	@addressID int
)AS
	BEGIN
		DECLARE @lengthOfMemberID int = len(@memberID)
	----------------------------------------------	CONTROL STRUCTURES -------------------------------------------
		IF @lengthOfMemberID != 11
		  BEGIN
			RETURN(1);	-- 11 haneli uye numarasi girme hatasi	
		  END
		ELSE
		  BEGIN 
			IF EXISTS(SELECT * FROM Member WHERE memberID=@memberID)
			  BEGIN
				RETURN(2)		-- Ayni memberID'ya sahip kullanici var
			  END
			ELSE
			  BEGIN
				IF EXISTS(SELECT * FROM Member WHERE memberUserName=@memberUserName)
				  BEGIN
					RETURN(3)		-- Ayni memberUserName'e sahip kullanici var
				  END
				ELSE
				  BEGIN
					IF EXISTS(SELECT * FROM Member WHERE emailAddress=@emailAddress)
					  BEGIN
						RETURN(4)		-- Ayni eMailAddress'e sahip kullanici var
					  END
					ELSE
					  BEGIN
						IF @gender='M' OR @gender='F'
						  BEGIN
							IF len(@memberUserName)<=15 OR len(@memberPassword)<=15
							  BEGIN
							    IF EXISTS(SELECT * FROM Member_Address WHERE addressID=@addressID)
								  BEGIN
									SET IDENTITY_INSERT Member ON
									INSERT INTO Member(memberID, memberUserName, memberPassword, nameSurname, emailAddress, 
										phoneNumber, birthDate, securityQuestion, securityQuestionAnswer, gender, addressID) 
									 VALUES(@memberID, @memberUserName, @memberPassword, @nameSurname, @emailAddress, 
										@phoneNumber, @birthDate, @securityQuestion, @securityQuestionAnswer, @gender, @addressID)
									SET IDENTITY_INSERT Member OFF
								  END
								ELSE
								  BEGIN
									RETURN(7)	-- Bu adressID'ye ait bir kayit yok
								  END
							  END
							ELSE
							  BEGIN
							    RETURN(6)	-- memberUserName ve memberUserPassword için maksimum 15 karakter
							  END
						  END
						ELSE
						  BEGIN
							RETURN(5)	-- Yanlis gender Format ('M'-'F')
						  END
					  END
				  END
			  END
		----------------------------------------------------------------------------------------------------------
				RETURN(0)	-- Islem basariyla gerceklestirildi
		  END
	END

-------------------------- EXEC MEMBER ------------------------
DECLARE @hata int;
EXEC @hata=insertionToMember 76856784672, 'orhan.gunes', 'abcdef123', 'Orhan GÜNEÞ', 'orhangunes65@gmail.com', '5067845698', '1992-05-11', 'En Sevdiðin Kitap?', 'Java Okuyorum','M', 69
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToMember

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION MEMBER_ADDRESS >>>  ---------------------------------------

CREATE PROCEDURE insertionToMemberAddress
(
	@city nvarchar(15),
	@district nvarchar(30),
	@detailedAddress nvarchar(100),
	@postCode nvarchar(20)
)AS
  BEGIN
		INSERT INTO Member_Address(city, district, detailedAddress, postCode) 
			VALUES(@city, @district, @detailedAddress, @postCode)
		RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC MEMBER_ADDRESS ------------------------
DECLARE @hata int;
EXEC @hata=insertionToMemberAddress 'Ýstanbul', 'Maltepe', 'BAÐLARBAÞI MAH.', '34000'
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToMemberAddress

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION CATEGORY >>>  ---------------------------------------

CREATE PROCEDURE insertionToCategory
(
	@categoryName nvarchar(40),
	@parentID int,
	@categoryPicture nvarchar(60)
)AS
  BEGIN

	IF EXISTS(SELECT * FROM Category WHERE categoryID=@parentID)
	  BEGIN
	    INSERT INTO Category(categoryName, parentID, categoryPicture) 
			VALUES(@categoryName, @parentID, @categoryPicture)
	  END 
	ELSE
	  BEGIN
	    RETURN(1)		-- Category tablosunda bu categoryID'ye sahip category yok.
	  END

	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC CATEGORY ------------------------
DECLARE @hata int;
EXEC @hata=insertionToCategory 'categoryName', 75, 'picturePath'
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToCategory

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION ORDER_CONDITION >>>  -------------------------------------

CREATE PROCEDURE insertionToOrderCondition
(
	@orderCondition nvarchar(30)
)AS
  BEGIN
	INSERT INTO Order_Condition(orderCondition) 
		VALUES(@orderCondition)

	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC ORDER_CONDITION ------------------------
DECLARE @hata int;
EXEC @hata=insertionToOrderCondition 'orderCondition'
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToOrderCondition

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION ORDER_CONDITION >>>  -------------------------------------

CREATE PROCEDURE insertionToPaymentOption
(
	@paymentType nvarchar(20)
)AS
  BEGIN
	INSERT INTO Payment_Option(paymentType) 
		VALUES(@paymentType)

	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC PAYMENT_OPTION ------------------------
DECLARE @hata int;
EXEC @hata=insertionToPaymentOption 'Payment Option'
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToPaymentOption

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION PRODUCT_KDV >>>  -------------------------------------

CREATE PROCEDURE insertionToProductKDV
(
	@kdv_Type nvarchar(15),
	@kdv int
)AS
  BEGIN
	INSERT INTO Product_KDV(kdv_Type, kdv) 
		VALUES(@kdv_Type, @kdv)

	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC PRODUCT_KDV ------------------------
DECLARE @hata int;
EXEC @hata=insertionToProductKDV 'KDV Type', 22
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToProductKDV

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION PRODUCT >>>  ---------------------------------------

CREATE PROCEDURE insertionToProduct
(
	@productName nvarchar(50),
	@categoryID int,
	@productPrice nvarchar(10),
	@productPicture nvarchar(60),
	@productStock int,
	@productActive bit,
	@productExplanation ntext,
	@productKDV_ID int
)AS
  BEGIN

	IF EXISTS(SELECT * FROM Category WHERE categoryID=@categoryID)
	  BEGIN
	    IF EXISTS(SELECT * FROM Product_KDV WHERE productKDV_ID=@productKDV_ID)
		  BEGIN
		    IF @productStock>=0
			  BEGIN
				INSERT INTO Product(productName, categoryID, productPrice, productPicture, productStock, productActive, productExplanation, productKDV_ID) 
					VALUES(@productName, @categoryID, @productPrice, @productPicture, @productStock, @productActive, @productExplanation, @productKDV_ID)
			  END
		    ELSE
			  BEGIN
			    RETURN(3)	-- productStock için minimum deðer sifir olacak
			  END
		  END
		ELSE
		  BEGIN
			RETURN(2)		-- Product_KDV tablosunda bu productKDV_ID'ye sahip secenek yok.
		  END
	  END 
	ELSE
	  BEGIN
	    RETURN(1)		-- Category tablosunda bu categoryID'ye sahip category yok.
	  END

	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC PRODUCT ------------------------
DECLARE @hata int;
EXEC @hata=insertionToProduct 'Orjinal Arduino Yun Mini', 13, '287,67', NULL, 17, 1, 'Bu ürünü robotik projenizde kullanabilirsiniz.', 7
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToProduct

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION ORDER_ >>>  -------------------------------------

CREATE PROCEDURE insertionToOrder
(
	@memberID bigint
)AS
  BEGIN
	IF EXISTS(SELECT * FROM Member WHERE memberID=@memberID)
	  BEGIN
	    INSERT INTO Order_(memberID) VALUES(@memberID)
	  END 
    ELSE
	  BEGIN
	    RETURN(1)		-- Member tablosunda bu memberID'ye sahip kullanici yok.
	  END
	
	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC PRODUCT_KDV ------------------------
DECLARE @hata int;
EXEC @hata=insertionToOrder 45786425715
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToOrder

------------------------------------------------------------------------------------------------------------------


----------------------------------------  <<< INSERTION ORDERLIST >>>  -------------------------------------

CREATE PROCEDURE insertionToOrderList
(
	@orderID int,
	@productID int,
	@orderConditionID int,
	@paymentOptionID int,
	@memberID bigint
)AS
  BEGIN
	IF EXISTS(SELECT * FROM Order_ WHERE orderID=@orderID) AND EXISTS(SELECT * FROM Product WHERE productID=@productID)
	  BEGIN
	    RETURN(1)		-- Hem orderID'si hem de productID'si ayni olan eleman var.
	  END 
    ELSE
	  BEGIN
	    IF EXISTS(SELECT * FROM Member WHERE memberID=@memberID) OR EXISTS(SELECT * FROM Order_Condition WHERE orderConditionID=@orderConditionID) OR 
			EXISTS(SELECT * FROM Payment_Option WHERE paymentOptionID=@paymentOptionID)
		  BEGIN
	        INSERT INTO OrderList(orderID, productID, orderConditionID, paymentOptionID, memberID) 
				VALUES(@orderID, @productID, @orderConditionID, @paymentOptionID, @memberID)
	      END
		 ELSE
		   BEGIN
		     RETURN(2)	-- Member tablosunda memberID yok veya Order_Condition tablosunda orderConditionID yok veya Payment_Option tablosunda paymentOptionID yok
		   END 
	  END
	
	RETURN(0)	-- Islem basariyla gerceklestirildi
  END

-------------------------- EXEC ORDERLIST ------------------------
DECLARE @hata int;
EXEC @hata=insertionToOrderList ...., ....., .....
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE insertionToOrderList