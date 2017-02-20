USE ROBOTICS_PRODUCTS_TRADING


--													<<< ORDERLIST >>>

DECLARE @turSayisi int = 205;
DECLARE @sayac     int = 0;


WHILE @turSayisi > @sayac
	BEGIN
		--DECLARE @randomNumber int =FLOOR(RAND()*(200-1)+1);
		--SELECT @randomNumber	

		UPDATE PRODUCT SET productExplanation='Bu ürünü robotik projenizde kullanabilirsiniz.' WHERE productID=1000+@sayac
		SET @sayac=@sayac+1;
	END