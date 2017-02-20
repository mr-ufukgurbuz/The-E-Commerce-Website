USE ROBOTICS_PRODUCTS_TRADING

--													<<< MEMBER ADDRESS >>>

DECLARE @turSayisi int = 65;
DECLARE @sayac     int = 1;

DECLARE @memberID bigint = 12484623794;
DECLARE @memberIncrease bigint = 1119678968;
DECLARE @city nvarchar(30);
DECLARE @district nvarchar(30);
DECLARE @area nvarchar(30);
DECLARE @detailedAddress nvarchar(100);
DECLARE @postCode nvarchar(20);

DECLARE @randomNumberCity int;
DECLARE @randomNumberDistrict int;
DECLARE @randomNumberArea int;
DECLARE @randomNumberNeighborhood int;

DECLARE @countDistrict int;
DECLARE @countArea int;
DECLARE @countNeighborhood int;

WHILE @turSayisi > @sayac
	BEGIN

		SET @randomNumberCity=FLOOR(RAND()*(82-1)+1);

		SELECT @city=CityName FROM Cities WHERE CityID=@randomNumberCity;
		--<---------------------------------------------------------------------------------------------------->
		CREATE TABLE tempCountyTable(
			CountyID int IDENTITY(1,1), 
			CountyName nvarchar(30)
		);

		INSERT INTO tempCountyTable(CountyName) SELECT CountyName FROM Counties WHERE CityID=@randomNumberCity
		-----------------------------------------------------------------------------------------------------
		SELECT @countDistrict=COUNT(CountyName) FROM Counties WHERE CityID=@randomNumberCity
		SET @randomNumberDistrict=FLOOR(RAND()*(@countDistrict-1)+1)

		SELECT @district=CountyName FROM tempCountyTable WHERE CountyID=@randomNumberDistrict

		DROP TABLE tempCountyTable
		
		
		
		--<---------------------------------------------------------------------------------------------------->
		CREATE TABLE tempAreaTable(
			AreaID int IDENTITY(1,1), 
			AreaName nvarchar(30)
		);

		INSERT INTO tempAreaTable(AreaName) SELECT AreaName FROM Area WHERE CountyID=@randomNumberDistrict
		-----------------------------------------------------------------------------------------------------
		SELECT @countArea=COUNT(AreaName) FROM Area WHERE CountyID=@randomNumberDistrict
		SET @randomNumberArea=FLOOR(RAND()*(@countArea-1)+1)

		SELECT @area=AreaName FROM tempAreaTable WHERE AreaID=@randomNumberArea

		DROP TABLE tempAreaTable
		
		
		
		
		--<---------------------------------------------------------------------------------------------------->
		CREATE TABLE tempNeighborhoodTable(
			NeighborhoodID int IDENTITY(1,1), 
			NeighborhoodName nvarchar(30),
			ZipCode nvarchar(20)
		);

		INSERT INTO tempNeighborhoodTable(NeighborhoodName, ZipCode) SELECT NeighborhoodName, ZipCode FROM Neighborhood WHERE AreaID=@randomNumberArea
		-----------------------------------------------------------------------------------------------------
		SELECT @countNeighborhood=COUNT(NeighborhoodName) FROM Neighborhood WHERE AreaID=@randomNumberArea
		SET @randomNumberNeighborhood=FLOOR(RAND()*(@countNeighborhood-1)+1)

		SELECT @detailedAddress=NeighborhoodName, @postCode=ZipCode FROM tempNeighborhoodTable WHERE NeighborhoodID=@randomNumberNeighborhood

		DROP TABLE tempNeighborhoodTable
		
		INSERT INTO Member_Address(memberID, city, district, detailedAddress, postCode) VALUES(@memberID, @city, @district, @detailedAddress, @postCode)
		--<---------------------------------------------------------------------------------------------------->

		SET @memberID=@memberID+@memberIncrease;
		SET @sayac=@sayac+1;
	END