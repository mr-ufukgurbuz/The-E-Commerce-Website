USE ROBOTICS_PRODUCTS_TRADING
GO

CREATE TABLE _DatabaseLog (LogDate date DEFAULT (GetDate()), LogTime time DEFAULT (GetDate()), AffectedTableName sysname, Activity nvarchar(10))
GO

DECLARE @sql varchar(8000), @TABLE_NAME sysname
SET NOCOUNT ON

SELECT @TABLE_NAME = MIN(TABLE_NAME) FROM INFORMATION_SCHEMA.Tables

WHILE @TABLE_NAME IS NOT NULL
  BEGIN
 SELECT @sql = 'CREATE TRIGGER [' + @TABLE_NAME + '_Usage_TR] ON [' + @TABLE_NAME +'] '
  + 'FOR INSERT, UPDATE, DELETE AS '
  + 'IF EXISTS (SELECT * FROM inserted) AND NOT EXISTS (SELECT * FROM deleted) '
  + 'INSERT INTO _DatabaseLog (AffectedTableName,Activity) SELECT ''' + @TABLE_NAME + ''', ''INSERT''' + ' '
  + 'IF EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted) '
  + 'INSERT INTO _DatabaseLog (AffectedTableName,Activity) SELECT ''' + @TABLE_NAME + ''', ''UPDATE''' + ' '
  + 'IF NOT EXISTS (SELECT * FROM inserted) AND EXISTS (SELECT * FROM deleted) '
  + 'INSERT INTO _DatabaseLog (AffectedTableName,Activity) SELECT ''' + @TABLE_NAME + ''', ''DELETE''' + ' GO'
 SELECT @sql
 EXEC(@sql)
 SELECT @TABLE_NAME = MIN(TABLE_NAME) FROM INFORMATION_SCHEMA.Tables WHERE TABLE_NAME > @TABLE_NAME 
  END
SET NOCOUNT OFF


/*
USE [ROBOTICS_PRODUCTS_TRADING]
GO

ALTER TABLE [dbo].[_DatabaseLog] ADD  DEFAULT (FORMAT(GETDATE(), 'hh:mm:ss')) FOR [Log Time]
GO

ALTER TABLE _DatabaseLog ALTER COLUMN [Log Time] nvarchar(10)

TRUNCATE TABLE _DatabaseLog

*/