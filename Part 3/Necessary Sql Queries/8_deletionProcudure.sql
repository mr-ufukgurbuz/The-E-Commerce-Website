USE ROBOTICS_PRODUCTS_TRADING

------------------------------------------	<<< DELETION MEMBER >>> ----------------------------------------------

CREATE PROCEDURE deletionFromMember
(
	@memberID bigint
)AS
	BEGIN
		IF EXISTS(SELECT * FROM Member WHERE memberID=@memberID)		-- Silinecek uye'nin olup olmadigini kontrol ediyoruz
		  BEGIN
			DECLARE @addressID int;
			SELECT @addressID=addressID FROM Member WHERE memberID=@memberID

			DELETE FROM Member WHERE memberID=@memberID					-- Once uye'yi silebilirsin.
			DELETE FROM Member_Address WHERE addressID=@addressID		-- Sonra uye'nin adresini sil.

		   
			RETURN(0)					-- Islem basariyla gerceklestirildi
		  END
		ELSE
		  BEGIN
		    RETURN(1)					-- Silinecek boyle bir uye yok
		  END
	END

-------------------------- EXEC MEMBER ------------------------
DECLARE @hata int;
EXEC @hata=deletionFromMember 76856784672
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE deletionFromMember

------------------------------------------------------------------------------------------------------------------

------------------------------------------	<<< DELETION CATEGORY >>> ----------------------------------------------

CREATE PROCEDURE deletionFromCategory
(
	@categoryID int
)AS
	BEGIN
		IF EXISTS(SELECT * FROM Category WHERE categoryID=@categoryID)		-- Silinecek category'nin olup olmadigini kontrol ediyoruz
		  BEGIN
			DELETE FROM Category WHERE categoryID=@categoryID				-- Category'i sil 
			RETURN(0)					-- Islem basariyla gerceklestirildi
		  END
		ELSE
		  BEGIN
		    RETURN(1)					-- Silinecek boyle bir category yok
		  END
	END

-------------------------- EXEC CATEGORY ------------------------
DECLARE @hata int;
EXEC @hata=deletionFromCategory 76
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE deletionFromCategory

------------------------------------------------------------------------------------------------------------------


------------------------------------------	<<< DELETION PRODUCT >>> ----------------------------------------------

CREATE PROCEDURE deletionFromProduct
(
	@productID int
)AS
	BEGIN
		IF EXISTS(SELECT * FROM Product WHERE productID=@productID)		-- Silinecek urun'un olup olmadigini kontrol ediyoruz
		  BEGIN
			DELETE FROM Product WHERE productID=@productID				-- Urun'u sil
			RETURN(0)					-- Islem basariyla gerceklestirildi
		  END
		ELSE
		  BEGIN
		    RETURN(1)					-- Silinecek boyle bir urun yok
		  END
	END

-------------------------- EXEC PRODUCT ------------------------
DECLARE @hata int;
EXEC @hata=deletionFromProduct 1206
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE deletionFromProduct

------------------------------------------------------------------------------------------------------------------


------------------------------------------	<<< DELETION ORDER_ >>> ----------------------------------------------

CREATE PROCEDURE deletionFromOrder
(
	@orderID int
)AS
	BEGIN
		IF EXISTS(SELECT * FROM Order_ WHERE orderID=@orderID)		-- Silinecek order'in olup olmadigini kontrol ediyoruz
		  BEGIN
			DELETE FROM OrderList WHERE orderID=@orderID			-- Once OrderList'te bu order'a ait verileri sil.
			DELETE FROM Order_ WHERE orderID=@orderID				-- Sonra order'i sil.
			RETURN(0)					-- Islem basariyla gerceklestirildi
		  END
		ELSE
		  BEGIN
		    RETURN(1)					-- Silinecek boyle bir order yok
		  END
	END

-------------------------- EXEC ORDER_ ------------------------
DECLARE @hata int;
EXEC @hata=deletionFromOrder 40014
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE deletionFromOrder

------------------------------------------------------------------------------------------------------------------


------------------------------------------	<<< DELETION ORDERLIST >>> ----------------------------------------------

CREATE PROCEDURE deletionFromOrderList
(
	@orderID int,
	@productID int
)AS
	BEGIN
		IF EXISTS(SELECT * FROM Order_ WHERE orderID=@orderID) AND EXISTS(SELECT * FROM Product WHERE productID=@productID)
		  BEGIN			-- Silinecek urun'un olup olmadigini kontrol ediyoruz
			DELETE FROM OrderList WHERE orderID=@orderID AND productID=@productID	-- OrderList'te bu order'a ait urun'u sil.
			RETURN(0)					-- Islem basariyla gerceklestirildi
		  END
		ELSE
		  BEGIN
		    RETURN(1)					-- Silinecek boyle bir orderlist elemani yok
		  END
	END

-------------------------- EXEC ORDERLIST ------------------------
DECLARE @hata int;
EXEC @hata=deletionFromOrderList 40013, 1204
SELECT @hata
-----------------------------------------------------
DROP PROCEDURE deletionFromOrderList

------------------------------------------------------------------------------------------------------------------