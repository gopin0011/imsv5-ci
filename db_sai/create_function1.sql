USE [SAI_Work2]
GO

/****** Object:  UserDefinedFunction [dbo].[StatusReturn]    Script Date: 11/27/2017 3:53:43 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[StatusReturn](@partnerid bigint,@itemid bigint)
RETURNS VARCHAR(250)
AS BEGIN
    DECLARE @status VARCHAR(250)

    SET @status = @partnerid
	/*
    SET @Work = REPLACE(@Work, 'www.', '')
    SET @Work = REPLACE(@Work, '.com', '')
	*/
    RETURN @status
END

GO

