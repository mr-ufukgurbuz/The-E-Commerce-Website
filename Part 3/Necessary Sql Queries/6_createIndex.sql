USE ROBOTICS_PRODUCTS_TRADING

---------------------	MEMBER	-------------------------
CREATE UNIQUE INDEX indexMemberID ON Member(memberID)
CREATE INDEX indexMemberUserName ON Member(memberUserName)
CREATE INDEX indexEmailAddress ON Member(emailAddress)

---------------------	MEMBER_ADDRESS	-------------------------
CREATE UNIQUE INDEX indexAddressMemberID ON Member_Address(memberID)

---------------------	ORDER_	-------------------------
CREATE UNIQUE INDEX indexOrderID ON Order_(orderID)
CREATE INDEX indexOrderMemberID ON Order_(memberID)

---------------------	ORDER_CONDITION	-------------------------
CREATE UNIQUE INDEX indexConditionID ON Order_Condition(orderConditionID)

---------------------	PAYMENT_OPTION	-------------------------
CREATE UNIQUE INDEX indexPaymentOptionID ON Payment_Option(paymentOptionID)

---------------------	ORDER_LIST	-------------------------
CREATE INDEX indexListOrderID ON OrderList(orderID)
CREATE INDEX indexListProductID ON OrderList(productID)
CREATE INDEX indexListMemberID ON OrderList(memberID)

---------------------	PRODUCT	-------------------------
CREATE UNIQUE INDEX indexProductID ON Product(productID)
CREATE INDEX indexProductName ON Product(productName)
CREATE INDEX indexProductKDV_ID ON Product(productKDV_ID)

---------------------	CATEGORY	-------------------------
CREATE UNIQUE INDEX indexCategoryID ON Category(categoryID)
CREATE INDEX indexCategoryName ON Category(categoryName)
CREATE INDEX indexParentID ON Category(parentID)
