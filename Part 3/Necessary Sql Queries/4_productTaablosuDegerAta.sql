USE ROBOTICS_PRODUCTS_TRADING


--													<<< PRODUCT >>>

DECLARE @turSayisi int = 205;
DECLARE @sayac     int = 0;


WHILE @turSayisi > @sayac
	BEGIN
		------------------   PRICE -----------------
		DECLARE @price float =(RAND()*(100-1)+1);
		SET @price = ROUND(@price, 2)
		--SELECT @price
		UPDATE Product SET productPrice=@price WHERE productID=1000+@sayac
		------------------   STOCK -----------------
		DECLARE @stock int =FLOOR(RAND()*(120-4)+4)+1;
		--SELECT @stock
		UPDATE Product SET productStock=@stock WHERE productID=1000+@sayac
		------------------   ACTIVE -----------------
		UPDATE Product SET productActive=1 WHERE productID=1000+@sayac
		------------------   DATE -----------------
		DECLARE @month int =FLOOR(RAND()*(13-1)+1);		-- 1-12 arasi ay secer
		DECLARE @day int =FLOOR(RAND()*(29-1)+1);		-- 1-28 arasi gun secer

		DECLARE @date nvarchar(20)='2016-';
		SET @date = @date + CONVERT(nvarchar(5), @month) + '-' + CONVERT(nvarchar(5), @day);
		--SELECT @date
		UPDATE Product SET ProductDate=@date WHERE productID=1000+@sayac
		------------------   KDV -----------------
		DECLARE @kdvID int =FLOOR(RAND()*(11-1)+1);
		--SELECT @kdvID
		UPDATE Product SET productKDV_ID=@kdvID WHERE productID=1000+@sayac

		SET @sayac=@sayac+1;
	END