CREATE VIEW MemberAllInformation
AS
	SELECT m.memberID AS [Member ID], m.memberUserName AS [User Name], m.memberPassword AS [Password], m.nameSurname AS [Name Surname],
		m.emailAddress AS [E-Mail Address], m.phoneNumber AS [Phone Number], ma.city AS [City], ma.district AS [County], 
		ma.detailedAddress AS [Neighborhood], ma.postCode AS [postCode], m.birthDate AS [Birth Date], m.registerDate AS [Register Date],
		m.gender AS [Gender]
	FROM Member m
	INNER JOIN 
		Member_Address ma ON m.addressID=ma.addressID

-----------------------------------------------------------------------------------------------------------------------------------------

CREATE VIEW ProductAllInformation
AS
	SELECT p.productID AS [Product ID], p.productName AS [Product Name], c.categoryName AS [Category Name], p.productPrice AS [Product Price], 
		p.productStock AS [Amount of Stock], p.productActive AS [Active], p.productExplanation AS [Explanation], pk.kdv AS [Kdv %]
	FROM Product p
	INNER JOIN
		Category c ON p.categoryID=c.categoryID
	INNER JOIN
		Product_KDV pk ON p.productKDV_ID=pk.productKDV_ID

-----------------------------------------------------------------------------------------------------------------------------------------

CREATE VIEW OrderListAllInformation
AS
	SELECT ol.orderID AS [Order ID], ol.memberID AS [Member ID], m.memberUserName AS [User Name], m.nameSurname AS [Name Surname], ol.productID AS [Product ID], 
		p.productName AS [Product Name], p.productPrice AS [Product Price], po.paymentType AS [Payment Type], oc.orderCondition AS [Order Condition] 
	FROM OrderList ol
	INNER JOIN
		Order_Condition oc ON ol.orderConditionID=oc.orderConditionID
	INNER JOIN
		Payment_Option po ON ol.paymentOptionID=po.paymentOptionID
	INNER JOIN
		Product p ON ol.productID=p.productID
	INNER JOIN
		Member m ON ol.memberID=m.memberID

-----------------------------------------------------------------------------------------------------------------------------------------

CREATE VIEW TurkeyAllAddress
AS
	SELECT ci.CityID AS [City ID], ci.CityName AS [City Name], co.CountyName AS [County Name],a.AreaName AS [Area Name], 
		n.NeighborhoodName AS [Neighborhood Name], n.ZipCode AS [Post Code]
	FROM Cities ci
	INNER JOIN
		Counties co ON ci.CityID=co.CityID
	INNER JOIN
		Area a ON co.CountyID=a.CountyID
	INNER JOIN
		Neighborhood n ON a.AreaID=n.AreaID