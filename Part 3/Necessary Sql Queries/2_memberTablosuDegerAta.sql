USE ROBOTICS_PRODUCTS_TRADING

--													<<< MEMBER >>>

--ALTER TABLE Sayfa1$ ADD id int IDENTITY(1,1)

DECLARE @turSayisi int = 65;
DECLARE @sayac     int = 1;

DECLARE @userName nvarchar(40);
DECLARE @isim nvarchar(60);
DECLARE @numara float;
DECLARE @mail nvarchar(50);
DECLARE @password nvarchar(30);
DECLARE @birthDate date;
DECLARE @gender nvarchar(10);

DECLARE @securityQuestion nvarchar(40);
DECLARE @securityQuestion1 nvarchar(40)='En Sevdiðin Hayvan Nedir?';
DECLARE @securityQuestion2 nvarchar(40)='Ýlkokul Hocanýn Adý Nedir?';
DECLARE @securityQuestion3 nvarchar(40)='En Sevdiðin Kitap?';
DECLARE @securityQuestion4 nvarchar(40)='En Nefret Ettiðin Arkadaþýn?';
DECLARE @securityQuestion5 nvarchar(40)='Favori Takýmýn Kimdir?';
DECLARE @securityQuestion6 nvarchar(40)='Okuldaki En Sevdiðin Hoca Kimdir?';

DECLARE @securityQuestionAnswer nvarchar(40);
DECLARE @securityQuestionAnswer11 nvarchar(40)='Balýk', @securityQuestionAnswer12 nvarchar(40)='Köpek';
DECLARE @securityQuestionAnswer21 nvarchar(40)='Ramazan', @securityQuestionAnswer22 nvarchar(40)='Arif';
DECLARE @securityQuestionAnswer31 nvarchar(40)='Harry Potter', @securityQuestionAnswer32 nvarchar(40)='Yüzüklerin Efendisi';
DECLARE @securityQuestionAnswer41 nvarchar(40)='Hakan', @securityQuestionAnswer42 nvarchar(40)='Adnan';
DECLARE @securityQuestionAnswer51 nvarchar(40)='Galatasaray', @securityQuestionAnswer52 nvarchar(40)='Beþiktaþ';
DECLARE @securityQuestionAnswer61 nvarchar(40)='Serap KORKMAZ', @securityQuestionAnswer62 nvarchar(40)='Müjdat SOYTÜRK';

DECLARE @randomNumber int;

WHILE @turSayisi > @sayac
	BEGIN
		
		SELECT @isim=[Ad Soyad], @numara=[Telefon], @mail=[Mail], @gender=[Gender] FROM Sayfa1$ WHERE id=@sayac;
		
		SELECT @userName= REPLACE(@mail,'@gmail.com','');
		SELECT @userName= REPLACE(@userName,'@hotmail.com','');
		SELECT @userName= REPLACE(@userName,'@yandex.ru','');
		SELECT @userName= REPLACE(@userName,'@yahoo.com','');
		SELECT @userName= REPLACE(@userName,'@outlook.com','');

		SELECT @password=[PasswordSalt] FROM [AdventureWorks2014].[Person].[Password] WHERE BusinessEntityID=@sayac
		SELECT @birthDate=[BirthDate] FROM [AdventureWorks2014].[HumanResources].[Employee] WHERE BusinessEntityID=@sayac
		----------------------------------------------------------------------------------------------------------------------
		IF @sayac%6 = 0
			BEGIN
				SET @securityQuestion=@securityQuestion1
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer11
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer12
					END
			END
		ELSE IF @sayac%6 = 1
			BEGIN
				SET @securityQuestion=@securityQuestion2
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer21
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer22
					END
			END
		ELSE IF @sayac%6 = 2
			BEGIN
				SET @securityQuestion=@securityQuestion3
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer31
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer32
					END
			END
		ELSE IF @sayac%6 = 3
			BEGIN
				SET @securityQuestion=@securityQuestion4
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer41
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer42
					END
			END
		ELSE IF @sayac%6 = 4
			BEGIN
				SET @securityQuestion=@securityQuestion5
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer51
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer52
					END
			END
		ELSE
			BEGIN
				SET @securityQuestion=@securityQuestion6
				SET @randomNumber=FLOOR(RAND()*(3-1)+1)
				
				IF @randomNumber=1
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer61
					END
				ELSE
					BEGIN
						SET @securityQuestionAnswer=@securityQuestionAnswer62
					END
			END
		----------------------------------------------------------------------------------------------------------------------
		INSERT INTO Member(memberUserName, memberPassword, nameSurname, emailAddress, phoneNumber, birthDate, gender, securityQuestion, securityQuestionAnswer) 
			VALUES(@userName, @password, @isim, @mail, @numara, @birthDate, @gender, @securityQuestion, @securityQuestionAnswer);
		
		SET @sayac=@sayac+1;
	END