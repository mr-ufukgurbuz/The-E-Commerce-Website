USE ROBOTICS_PRODUCTS_TRADING

------------------------------------------	<<< UPDATE MEMBER >>> ----------------------------------------------

CREATE PROCEDURE updateInformationOfMember
(
	@memberID bigint,
	@nameSurname nvarchar(60),
	@phoneNumber bigint,
	@birthDate date,
	@gender varchar(7),
	@addressID int
)AS
	BEGIN
	  IF EXISTS(SELECT * FROM Member WHERE memberID=@memberID)		-- Silinecek uye'nin olup olmadigini kontrol ediyoruz
	    BEGIN
		  UPDATE Member SET nameSurname=@nameSurname WHERE memberID=@memberID
		  UPDATE Member SET phoneNumber=@phoneNumber WHERE memberID=@memberID
		  UPDATE Member SET birthDate=@birthDate WHERE memberID=@memberID
		  UPDATE Member SET gender=@gender WHERE memberID=@memberID
		  UPDATE Member SET addressID=@addressID WHERE memberID=@memberID
		  RETURN(0)					-- Islem basariyla gerceklestirildi
		END
	  ELSE
	    BEGIN
		  RETURN(1)					-- Guncellenecek boyle bir uye yok
		END
	END

-------------------------- EXEC MEMBER ------------------------
DECLARE @hata int;
EXEC @hata=updateInformationOfMember 76856784672, 'Orhan Güneþ', '5324281793', '1992-07-18', 'M', 57
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE updateInformationOfMember

------------------------------------------------------------------------------------------------------------------


------------------------------------------	<<< UPDATE PRODUCT >>> ----------------------------------------------

CREATE PROCEDURE updateInformationOfProduct
(
	@productID int,
	@productName nvarchar(50),
	@productPrice nvarchar(10),
	@productPicture nvarchar(60),
	@productStock int,
	@productActive bit,
	@productExplanation ntext,
	@productKDV_ID int
)AS
	BEGIN
	  IF EXISTS(SELECT * FROM Product WHERE productID=@productID)		-- Silinecek urun'un olup olmadigini kontrol ediyoruz
	    BEGIN
		  UPDATE Product SET productName=@productName WHERE productID=@productID
		  UPDATE Product SET productPrice=@productPrice WHERE productID=@productID
		  UPDATE Product SET productPicture=@productPicture WHERE productID=@productID
		  UPDATE Product SET productStock=@productStock WHERE productID=@productID
		  UPDATE Product SET productActive=@productActive WHERE productID=@productID
		  UPDATE Product SET productExplanation=@productExplanation WHERE productID=@productID
		  UPDATE Product SET productKDV_ID=@productKDV_ID WHERE productID=@productID
		  RETURN(0)					-- Islem basariyla gerceklestirildi
		END
	  ELSE
	    BEGIN
		  RETURN(1)					-- Guncellenecek boyle bir urun yok
		END
	END

-------------------------- EXEC PRODUCT ------------------------
DECLARE @hata int;
EXEC @hata=updateInformationOfProduct 1205, 'Orjinal Arduino Yun Mini Pro', '287,82', NULL, 12, 1, 'Bu ürünü robotik projenizde kullanabilirsiniz.', 7
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE updateInformationOfProduct

------------------------------------------------------------------------------------------------------------------