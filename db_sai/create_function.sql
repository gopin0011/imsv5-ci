USE [SAI_Work2]
GO

/****** Object:  UserDefinedFunction [dbo].[FindMonitoring]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[FindMonitoring](@PartnerID BIGINT, @DeliveryDate DATE, @InputDate DATE, @InputTime TIME)  
RETURNS @retFindReports TABLE   
(  
  LinkID varchar(150),
  Child varchar(150),
  level integer,
  ItemID bigint,
  PartNo varchar(150),
  num varchar(max),
  PartType varchar(10),
  SupplierID bigint,
  FGLocation varchar(150),
  PartnerName varchar(max),
  ItemNo integer,
  Code varchar(50),
  CustName varchar(max),
  ProjectName varchar(150),
  MaterialType bigint,
  PartName varchar(max), 
  TotalP float,
  RegID bigint,
  PartnerID bigint,
  QtyPerCar float,
  assy float, 
  wip float, 
  spot_gun float, 
  robot float, 
  lineA float, 
  lineBC float,
  PCStock float, 
  QGate float, 
  Handwork float, 
  PressLine float, 
  RawMat float,
  TotalAll float,
  OnProcess text
)  

AS  
BEGIN  
WITH rel_tree (LinkID,Child,level,ItemID,PartNo,num,PartType,SupplierID,MaterialType,ItemNo,FGLocation,Code,CustName,ProjectName,PartName) -- CTE name and columns  
    AS (  
        SELECT a.SysID AS LinkID,CAST(a.SysID AS VARCHAR) AS Child,0 AS level,CAST(0 AS BIGINT) AS ItemID,a.PartNo
            ,CAST(a.SysID AS VARCHAR) AS num, a.PartTypeID AS PartType,CAST(0 AS BIGINT) AS SupplierID,CAST(0 AS BIGINT) AS MaterialType
            ,ROW_NUMBER() OVER(ORDER BY a.SysID ASC) as ItemNo,a.FGLocation,b.Code,b.CustName,c.ProjectName
            ,a.PartName
        FROM BOM1 a
        LEFT JOIN M_Customer b ON b.RegID = a.IDCust
        LEFT JOIN M_Project c ON c.RegID = a.IDProject
        WHERE a.IDCust = @PartnerID AND a.IsDelete = 0
        UNION ALL
        SELECT b.LinkID,CAST('0' AS VARCHAR) as Child,level+1,a.ItemID,a.PartNo
            ,CAST(CAST(p.num AS VARCHAR)+'-'+CAST(a.ItemID AS VARCHAR) AS VARCHAR) AS num
            ,a.PartType,a.SupplierID,a.MaterialType
            ,p.ItemNo,a.FGLocation,p.Code,p.CustName,p.ProjectName
            ,a.PartName
        FROM BOMBuild b
        JOIN BOM2 a ON a.ItemID = b.ItemID
        INNER JOIN rel_tree p ON p.Child = b.LinkID
        UNION ALL
        SELECT CAST(p.LinkID AS VARCHAR) AS LinkID,CAST('0' AS VARCHAR) AS Child,level+1,l.ItemID,l.PartNo
            ,CAST(CAST(p.num AS VARCHAR)+'-'+CAST(k.SysID AS VARCHAR) AS VARCHAR) AS num
            ,l.PartType,l.SupplierID,l.MaterialType
            ,p.ItemNo,l.FGLocation,p.Code,p.CustName,p.ProjectName
            ,l.PartName
        FROM BOMChild k
        JOIN BOM2 l ON l.ItemID = k.ItemChild
        INNER JOIN rel_tree p ON p.ItemID = k.ItemID
        )  
-- copy the required columns to the result of the function   
    INSERT @retFindReports  
    SELECT x.LinkID,x.Child,x.level,x.ItemID,x.PartNo,x.num,x.PartType,x.SupplierID
          ,x.FGLocation,c.PartnerName,x.ItemNo
          ,x.Code,x.CustName,x.ProjectName,x.MaterialType,x.PartName, SUM(j.Qty) as TotalP,i.RegID,@PartnerID as PartnerID
          , (CASE WHEN isnull(y.QtyPerCar,0) = 0 THEN 1 ELSE y.QtyPerCar END) AS QtyPerCar
          , SUM(k.assy) as assy, SUM(k.wip) as wip, SUM(k.spot_gun) as spot_gun, SUM(k.robot) as robot, SUM(k.lineA) as lineA, SUM(k.lineBC) as lineBC
          , SUM(k.PCStock) as PCStock, SUM(k.QGate) as QGate, SUM(k.Handwork) as Handwork, SUM(k.PressLine) as PressLine, SUM(k.RawMat) as RawMat, SUM(k.TotalAll) as TotalAll
          , CAST(z.OnProcess as varchar(max)) as OnProcess
    FROM rel_tree x
    LEFT JOIN BOM2 y ON y.ItemID = x.ItemID
    LEFT JOIN BOM3 z ON z.ItemID = x.ItemID
    LEFT JOIN M_Partner c ON c.SysID = x.SupplierID 
    INNER JOIN CMProduct_BOM h ON h.ItemID_BOM = (CASE WHEN x.ItemID = 0 THEN x.LinkID ELSE CAST(x.ItemID as varchar(50)) END) -- 
    JOIN M_Product i ON i.RegID = h.ItemID_Product AND i.IDCust = @PartnerID
    LEFT JOIN TD_Order j ON j.TrcTypeID = 423 AND j.ItemID = i.RegID AND j.IsDelete = 0 AND cast(j.DeliveryDate as date) = cast(@DeliveryDate as date)
    LEFT JOIN 
    (
      SELECT b.ItemID,a.FromAreaID
          , CASE WHEN a.FromAreaID = 1 THEN SUM(b.Qty_1) ELSE 0 END AS assy
          , CASE WHEN a.FromAreaID = 2 THEN SUM(b.Qty_1) ELSE 0 END AS wip
          , CASE WHEN a.FromAreaID = 3 THEN SUM(b.Qty_1) ELSE 0 END AS spot_gun
          , CASE WHEN a.FromAreaID = 4 THEN SUM(b.Qty_1) ELSE 0 END AS robot
          , CASE WHEN a.FromAreaID = 5 THEN SUM(b.Qty_1) ELSE 0 END AS lineA
          , CASE WHEN a.FromAreaID = 6 THEN SUM(b.Qty_1) ELSE 0 END AS lineBC
          , CASE WHEN a.FromAreaID = 7 THEN SUM(b.Qty_1) ELSE 0 END AS PCStock
          , CASE WHEN a.FromAreaID = 8 THEN SUM(b.Qty_1) ELSE 0 END AS QGate
          , CASE WHEN a.FromAreaID = 9 THEN SUM(b.Qty_1) ELSE 0 END AS Handwork
          , CASE WHEN a.FromAreaID = 10 THEN SUM(b.Qty_1) ELSE 0 END AS PressLine
          , CASE WHEN a.FromAreaID = 11 THEN SUM(b.Qty_1) ELSE 0 END AS RawMat
          , SUM(b.Qty_1) as TotalAll
      FROM
          TH_Transaction a
      JOIN 
          TD_Transaction b ON b.TrcTypeID = a.TrcTypeID AND b.MonthID = a.MonthID AND b.TrcID = a.TrcID AND b.IsDelete = 0
      WHERE a.TrcTypeID = 2017 AND (cast(a.DocDate as date) = cast(@InputDate as date) AND cast(a.DocTime as time) <= cast(@InputTime as time) AND cast(a.DocDate_Ext as date) = cast(@DeliveryDate as date))
      GROUP BY b.ItemID,a.FromAreaID
    ) k ON k.ItemID = i.RegID 
    WHERE x.PartType NOT LIKE 'RM%' 
    GROUP BY x.LinkID,x.Child,x.level,x.ItemID,x.PartNo,x.num,x.PartType,x.SupplierID
      ,x.FGLocation,c.PartnerName,x.ItemNo
      ,x.Code,x.CustName,x.ProjectName,x.MaterialType,x.PartName,i.RegID,y.QtyPerCar,CAST(z.OnProcess as varchar(max))
    ORDER BY x.num;
   RETURN  
END;

GO

/****** Object:  UserDefinedFunction [dbo].[production]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[production](@startdate DATE,@TrcTypeID BIGINT,@PartnerID BIGINT)
returns @rtTable table
(
	ItemID BIGINT,
    PartNo VARCHAR(50), 
    PartName VARCHAR(250),
    tgl1d BIGINT,
    tgl1n BIGINT,
    tgl2d BIGINT,
    tgl2n BIGINT,
    tgl3d BIGINT,
    tgl3n BIGINT,
    tgl4d BIGINT,
    tgl4n BIGINT,
    tgl5d BIGINT,
    tgl5n BIGINT,
    tgl6d BIGINT,
    tgl6n BIGINT
)
as
begin
	-- SELECT * FROM dbo.production('2017/09/19',423,745)
    insert into @rtTable
    SELECT t1.ItemID,t1.PartNo,t1.PartName,SUM(t1.tgl1d) as tgl1d,SUM(t1.tgl1n) as tgl1n,
    	SUM(t1.tgl2d) as tgl2d,SUM(t1.tgl2n) as tgl2n,SUM(t1.tgl3d) as tgl3d,SUM(t1.tgl3n) as tgl3n,SUM(t1.tgl4d) as tgl4d,
    	SUM(t1.tgl4n) as tgl4n,SUM(t1.tgl5d) as tgl5d,SUM(t1.tgl5n) as tgl5n,SUM(t1.tgl6d) as tgl6d,SUM(t1.tgl6n) as tgl6n
    FROM (
      SELECT a.ItemID,c.PartNo, c.PartName
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl1d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl1n
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 1, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl2d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 1, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl2n
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 2, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl3d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 2, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl3n
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 3, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl4d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 3, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl4n
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 4, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl5d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 4, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl5n
        ,CASE WHEN (a.Cycle = 1 OR a.Cycle = 3) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 5, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl6d
        ,CASE WHEN (a.Cycle = 5 OR a.Cycle = 7) AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) = CAST(DATEADD(Day, 5, @startdate) AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS tgl6n
      FROM TD_Order a 
      JOIN M_Vendor b ON b.RegID = a.VendorID 
      JOIN M_Product c ON c.RegID = a.ItemID 
      JOIN M_UserG5 d ON d.SysID = a.UserID 
      JOIN TH_Order e ON e.TrcTypeID = a.TrcTypeID AND e.MonthID = a.MonthID AND e.TrcID = a.TrcID 
      WHERE a.TrcTypeID = @TrcTypeID AND a.IsDelete = 0 AND a.PartnerID = @PartnerID AND CAST(DATEADD(Day, -2, a.DeliveryDate) AS DATE) BETWEEN CAST(@startdate AS DATE) AND CAST(DATEADD(Day, 5, @startdate) AS DATE)
      GROUP BY c.PartNo, c.PartName, a.ItemID, a.PONum, a.Cycle,a.DeliveryDate
      ) t1
      GROUP BY t1.ItemID,t1.PartNo,t1.PartName
      ORDER BY t1.PartName
return;
end

GO

/****** Object:  UserDefinedFunction [dbo].[production_old]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[production_old](@MonthID BIGINT,@TrcTypeID BIGINT)
returns @rtTable table
(
    PartNo VARCHAR(50), 
    PartName VARCHAR(250),
    DeliveryDate DATE,
    tgl1 BIGINT,
    tgl2 BIGINT,
    tgl3 BIGINT,
    tgl4 BIGINT,
    tgl5 BIGINT,
    tgl6 BIGINT,
    tgl7 BIGINT,
    tgl8 BIGINT,
    tgl9 BIGINT,
    tgl10 BIGINT,
    tgl11 BIGINT,
    tgl12 BIGINT,
    tgl13 BIGINT,
    tgl14 BIGINT,
    tgl15 BIGINT,
    tgl16 BIGINT,
    tgl17 BIGINT,
    tgl18 BIGINT,
    tgl19 BIGINT,
    tgl20 BIGINT,
    tgl21 BIGINT,
    tgl22 BIGINT,
    tgl23 BIGINT,
    tgl24 BIGINT,
    tgl25 BIGINT,
    tgl26 BIGINT,
    tgl27 BIGINT,
    tgl28 BIGINT,
    tgl29 BIGINT,
    tgl30 BIGINT,
    tgl31 BIGINT,
    tgl1n BIGINT,
    tgl2n BIGINT,
    tgl3n BIGINT,
    tgl4n BIGINT,
    tgl5n BIGINT,
    tgl6n BIGINT,
    tgl7n BIGINT,
    tgl8n BIGINT,
    tgl9n BIGINT,
    tgl10n BIGINT,
    tgl11n BIGINT,
    tgl12n BIGINT,
    tgl13n BIGINT,
    tgl14n BIGINT,
    tgl15n BIGINT,
    tgl16n BIGINT,
    tgl17n BIGINT,
    tgl18n BIGINT,
    tgl19n BIGINT,
    tgl20n BIGINT,
    tgl21n BIGINT,
    tgl22n BIGINT,
    tgl23n BIGINT,
    tgl24n BIGINT,
    tgl25n BIGINT,
    tgl26n BIGINT,
    tgl27n BIGINT,
    tgl28n BIGINT,
    tgl29n BIGINT,
    tgl30n BIGINT,
    tgl31n BIGINT
)
as
begin
    insert into @rtTable
    SELECT c.PartNo, c.PartName, a.DeliveryDate
      --, CONVERT(DATE,DATEADD(Day, -2, a.DeliveryDate)) as ProductionDate  
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 1 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl1
      ,CASE WHEN DAY (DATEADD(Day, -2, a.DeliveryDate) ) = 2 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl2
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 3 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl3
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 4 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl4
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 5 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl5        
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 6 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl6
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 7 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl7
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 8 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl8
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 9 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl9
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 10 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl10 
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 11 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl11         
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 12 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl12              
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 13 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl13
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 14 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl14    
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 15 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl15    
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 16 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl16
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 17 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl17
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 18 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl18
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 19 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl19
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 20 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl20
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 21 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl21
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 22 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl22
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 23 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl23
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 24 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl24 
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 25 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl25
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 26 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl26
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 27 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl27
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 28 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl28
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 29 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl29
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 30 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl30
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 31 AND a.Shift = '1' THEN SUM(a.Qty)
      ELSE 0 END AS tgl31   
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 1 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl1n
      ,CASE WHEN DAY (DATEADD(Day, -2, a.DeliveryDate) ) = 2 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl2n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 3 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl3n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 4 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl4n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 5 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl5n 
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 6 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl6n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 7 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl7n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 8 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl8n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 9 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl9n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 10 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl10n 
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 11 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl11n         
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 12 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl12n              
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 13 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl13n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 14 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl14n    
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 15 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl15n    
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 16 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl16n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 17 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl17n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 18 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl18n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 19 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl19n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 20 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl20n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 21 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl21n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 22 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl22n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 23 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl23n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 24 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl24n 
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 25 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl25n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 26 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl26n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 27 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl27n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 28 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl28n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 29 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl29n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 30 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl30n
      ,CASE WHEN DAY ( DATEADD(Day, -2, a.DeliveryDate) ) = 31 AND a.Shift = '2' THEN SUM(a.Qty)
      ELSE 0 END AS tgl31n             
    FROM TD_Order a 
    JOIN M_Vendor b ON b.RegID = a.VendorID 
    JOIN M_Product c ON c.RegID = a.ItemID 
    JOIN M_UserG5 d ON d.SysID = a.UserID 
    JOIN TH_Order e ON e.TrcTypeID = a.TrcTypeID AND e.MonthID = a.MonthID AND e.TrcID = a.TrcID 
    WHERE a.TrcTypeID = @TrcTypeID AND a.MonthID = @MonthID AND a.IsDelete = 0 
    GROUP BY c.PartNo, c.PartName, a.ItemID
    ,a.DeliveryDate,a.Shift
    ORDER BY c.PartName
return;
end
GO

/****** Object:  UserDefinedFunction [dbo].[schedule]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[schedule](@startdate DATE,@TrcTypeID BIGINT,@PartnerID BIGINT)
returns @rtTable table
(
	ItemID BIGINT,
    PartNo VARCHAR(50), 
    PartName VARCHAR(250),
    acycle1 BIGINT,
    acycle3 BIGINT,
    acycle5 BIGINT,
    acycle7 BIGINT,
    bcycle1 BIGINT,
    bcycle3 BIGINT,
    bcycle5 BIGINT,
    bcycle7 BIGINT,
    ccycle1 BIGINT,
    ccycle3 BIGINT,
    ccycle5 BIGINT,
    ccycle7 BIGINT,
    dcycle1 BIGINT,
    dcycle3 BIGINT,
    dcycle5 BIGINT,
    dcycle7 BIGINT,
    ecycle1 BIGINT,
    ecycle3 BIGINT,
    ecycle5 BIGINT,
    ecycle7 BIGINT,
    fcycle1 BIGINT,
    fcycle3 BIGINT,
    fcycle5 BIGINT,
    fcycle7 BIGINT
)
as
begin
	-- SELECT * FROM dbo.schedule('9/23/2017',423,745);
    insert into @rtTable
    SELECT t1.ItemID,t1.PartNo, t1.PartName, SUM(t1.acycle1) as acycle1, SUM(t1.acycle3) as acycle3
	    , SUM(t1.acycle5) as acycle5, SUM(t1.acycle7) as acycle7, SUM(t1.bcycle1) as bcycle1, SUM(t1.bcycle3) as bcycle3
        , SUM(t1.bcycle5) as bcycle5, SUM(t1.bcycle7) as bcycle7, SUM(t1.ccycle1) as ccycle1, SUM(t1.ccycle3) as ccycle3
        , SUM(t1.ccycle5) as ccycle5, SUM(t1.ccycle7) as ccycle7, SUM(t1.dcycle1) as dcycle1, SUM(t1.dcycle3) as dcycle3
        , SUM(t1.dcycle5) as dcycle5, SUM(t1.dcycle7) as dcycle7, SUM(t1.ecycle1) as ecycle1, SUM(t1.ecycle3) as ecycle3
        , SUM(t1.ecycle5) as ecycle5, SUM(t1.ecycle7) as ecycle7, SUM(t1.fcycle1) as fcycle1, SUM(t1.fcycle3) as fcycle3
        , SUM(t1.fcycle5) as fcycle5, SUM(t1.fcycle7) as fcycle7
    FROM
    (
      SELECT a.ItemID,c.PartNo, c.PartName, a.DeliveryDate
        ,CASE WHEN a.Cycle = 1 AND CAST(a.DeliveryDate AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS acycle1
        ,CASE WHEN a.Cycle = 3 AND CAST(a.DeliveryDate AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS acycle3
        ,CASE WHEN a.Cycle = 5 AND CAST(a.DeliveryDate AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS acycle5
        ,CASE WHEN a.Cycle = 7 AND CAST(a.DeliveryDate AS DATE) = CAST(@startdate AS DATE) THEN SUM(a.Qty)
        ELSE 0 END AS acycle7
        ,CASE WHEN a.Cycle = 1 AND a.DeliveryDate = DATEADD(Day, 1, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS bcycle1
        ,CASE WHEN a.Cycle = 3 AND a.DeliveryDate = DATEADD(Day, 1, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS bcycle3
        ,CASE WHEN a.Cycle = 5 AND a.DeliveryDate = DATEADD(Day, 1, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS bcycle5
        ,CASE WHEN a.Cycle = 7 AND a.DeliveryDate = DATEADD(Day, 1, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS bcycle7
        ,CASE WHEN a.Cycle = 1 AND a.DeliveryDate = DATEADD(Day, 2, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ccycle1
        ,CASE WHEN a.Cycle = 3 AND a.DeliveryDate = DATEADD(Day, 2, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ccycle3
        ,CASE WHEN a.Cycle = 5 AND a.DeliveryDate = DATEADD(Day, 2, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ccycle5
        ,CASE WHEN a.Cycle = 7 AND a.DeliveryDate = DATEADD(Day, 2, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ccycle7
        ,CASE WHEN a.Cycle = 1 AND a.DeliveryDate = DATEADD(Day, 3, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS dcycle1
        ,CASE WHEN a.Cycle = 3 AND a.DeliveryDate = DATEADD(Day, 3, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS dcycle3
        ,CASE WHEN a.Cycle = 5 AND a.DeliveryDate = DATEADD(Day, 3, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS dcycle5
        ,CASE WHEN a.Cycle = 7 AND a.DeliveryDate = DATEADD(Day, 3, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS dcycle7
        ,CASE WHEN a.Cycle = 1 AND a.DeliveryDate = DATEADD(Day, 4, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ecycle1
        ,CASE WHEN a.Cycle = 3 AND a.DeliveryDate = DATEADD(Day, 4, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ecycle3
        ,CASE WHEN a.Cycle = 5 AND a.DeliveryDate = DATEADD(Day, 4, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ecycle5
        ,CASE WHEN a.Cycle = 7 AND a.DeliveryDate = DATEADD(Day, 4, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS ecycle7
        ,CASE WHEN a.Cycle = 1 AND a.DeliveryDate = DATEADD(Day, 5, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS fcycle1
        ,CASE WHEN a.Cycle = 3 AND a.DeliveryDate = DATEADD(Day, 5, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS fcycle3
        ,CASE WHEN a.Cycle = 5 AND a.DeliveryDate = DATEADD(Day, 5, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS fcycle5
        ,CASE WHEN a.Cycle = 7 AND a.DeliveryDate = DATEADD(Day, 5, @startdate) THEN SUM(a.Qty)
        ELSE 0 END AS fcycle7
      FROM TD_Order a 
      JOIN M_Vendor b ON b.RegID = a.VendorID 
      JOIN M_Product c ON c.RegID = a.ItemID 
      JOIN M_UserG5 d ON d.SysID = a.UserID 
      JOIN TH_Order e ON e.TrcTypeID = a.TrcTypeID AND e.MonthID = a.MonthID AND e.TrcID = a.TrcID 
      WHERE a.TrcTypeID = @TrcTypeID AND a.IsDelete = 0 AND a.PartnerID = @PartnerID AND a.DeliveryDate BETWEEN CAST(@startdate AS DATE) AND CAST(DATEADD(Day, 5, @startdate) AS DATE)
      GROUP BY c.PartNo, c.PartName, a.ItemID, a.Cycle, a.DeliveryDate
    ) t1
    GROUP BY t1.ItemID,t1.PartNo, t1.PartName
    ORDER BY t1.PartName
return;
end

GO

/****** Object:  UserDefinedFunction [dbo].[schedule_old]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[schedule_old](@MonthID BIGINT,@TrcTypeID BIGINT)
returns @rtTable table
(
    PartNo VARCHAR(50), 
    PartName VARCHAR(250),
    DeliveryDate DATE,
    tgl1 BIGINT,
    tgl2 BIGINT,
    tgl3 BIGINT,
    tgl4 BIGINT,
    tgl5 BIGINT,
    tgl6 BIGINT,
    tgl7 BIGINT,
    tgl8 BIGINT,
    tgl9 BIGINT,
    tgl10 BIGINT,
    tgl11 BIGINT,
    tgl12 BIGINT,
    tgl13 BIGINT,
    tgl14 BIGINT,
    tgl15 BIGINT,
    tgl16 BIGINT,
    tgl17 BIGINT,
    tgl18 BIGINT,
    tgl19 BIGINT,
    tgl20 BIGINT,
    tgl21 BIGINT,
    tgl22 BIGINT,
    tgl23 BIGINT,
    tgl24 BIGINT,
    tgl25 BIGINT,
    tgl26 BIGINT,
    tgl27 BIGINT,
    tgl28 BIGINT,
    tgl29 BIGINT,
    tgl30 BIGINT,
    tgl31 BIGINT,
    tgl1n BIGINT,
    tgl2n BIGINT,
    tgl3n BIGINT,
    tgl4n BIGINT,
    tgl5n BIGINT,
    tgl6n BIGINT,
    tgl7n BIGINT,
    tgl8n BIGINT,
    tgl9n BIGINT,
    tgl10n BIGINT,
    tgl11n BIGINT,
    tgl12n BIGINT,
    tgl13n BIGINT,
    tgl14n BIGINT,
    tgl15n BIGINT,
    tgl16n BIGINT,
    tgl17n BIGINT,
    tgl18n BIGINT,
    tgl19n BIGINT,
    tgl20n BIGINT,
    tgl21n BIGINT,
    tgl22n BIGINT,
    tgl23n BIGINT,
    tgl24n BIGINT,
    tgl25n BIGINT,
    tgl26n BIGINT,
    tgl27n BIGINT,
    tgl28n BIGINT,
    tgl29n BIGINT,
    tgl30n BIGINT,
    tgl31n BIGINT
)
as
begin
    insert into @rtTable
    SELECT c.PartNo, c.PartName, a.DeliveryDate
      --, CONVERT(DATE,DATEADD(Day, -2, a.DeliveryDate)) as ProductionDate  
      ,CASE WHEN DAY ( a.DeliveryDate ) = 1 AND a.Shift = 1 THEN SUM(a.Qty)
      ELSE 0 END AS tgl1
      ,CASE WHEN DAY ( a.DeliveryDate ) = 2 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl2
      ,CASE WHEN DAY ( a.DeliveryDate ) = 3 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl3
      ,CASE WHEN DAY ( a.DeliveryDate ) = 4 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl4
      ,CASE WHEN DAY ( a.DeliveryDate ) = 5 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl5        
      ,CASE WHEN DAY ( a.DeliveryDate ) = 6 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl6
      ,CASE WHEN DAY ( a.DeliveryDate ) = 7 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl7
      ,CASE WHEN DAY ( a.DeliveryDate ) = 8 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl8
      ,CASE WHEN DAY ( a.DeliveryDate ) = 9 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl9
      ,CASE WHEN DAY ( a.DeliveryDate ) = 10 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl10 
      ,CASE WHEN DAY ( a.DeliveryDate ) = 11 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl11         
      ,CASE WHEN DAY ( a.DeliveryDate ) = 12 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl12              
      ,CASE WHEN DAY ( a.DeliveryDate ) = 13 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl13
      ,CASE WHEN DAY ( a.DeliveryDate ) = 14 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl14    
      ,CASE WHEN DAY ( a.DeliveryDate ) = 15 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl15    
      ,CASE WHEN DAY ( a.DeliveryDate ) = 16 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl16
      ,CASE WHEN DAY ( a.DeliveryDate ) = 17 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl17
      ,CASE WHEN DAY ( a.DeliveryDate ) = 18 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl18
      ,CASE WHEN DAY ( a.DeliveryDate ) = 19 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl19
      ,CASE WHEN DAY ( a.DeliveryDate ) = 20 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl20
      ,CASE WHEN DAY ( a.DeliveryDate ) = 21 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl21
      ,CASE WHEN DAY ( a.DeliveryDate ) = 22 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl22
      ,CASE WHEN DAY ( a.DeliveryDate ) = 23 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl23
      ,CASE WHEN DAY ( a.DeliveryDate ) = 24 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl24 
      ,CASE WHEN DAY ( a.DeliveryDate ) = 25 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl25
      ,CASE WHEN DAY ( a.DeliveryDate ) = 26 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl26
      ,CASE WHEN DAY ( a.DeliveryDate ) = 27 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl27
      ,CASE WHEN DAY ( a.DeliveryDate ) = 28 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl28
      ,CASE WHEN DAY ( a.DeliveryDate ) = 29 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl29
      ,CASE WHEN DAY ( a.DeliveryDate ) = 30 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl30
      ,CASE WHEN DAY ( a.DeliveryDate ) = 31 AND a.Shift = 1  THEN SUM(a.Qty)
      ELSE 0 END AS tgl31 
      ,CASE WHEN DAY ( a.DeliveryDate ) = 1 AND a.Shift = 2 THEN SUM(a.Qty)
      ELSE 0 END AS tgl1n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 2 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl2n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 3 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl3n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 4 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl4n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 5 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl5n        
      ,CASE WHEN DAY ( a.DeliveryDate ) = 6 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl6n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 7 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl7n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 8 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl8n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 9 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl9n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 10 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl10n 
      ,CASE WHEN DAY ( a.DeliveryDate ) = 11 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl11n         
      ,CASE WHEN DAY ( a.DeliveryDate ) = 12 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl12n              
      ,CASE WHEN DAY ( a.DeliveryDate ) = 13 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl13n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 14 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl14n    
      ,CASE WHEN DAY ( a.DeliveryDate ) = 15 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl15n    
      ,CASE WHEN DAY ( a.DeliveryDate ) = 16 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl16n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 17 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl17n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 18 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl18n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 19 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl19n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 20 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl20n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 21 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl21n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 22 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl22n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 23 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl23n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 24 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl24n 
      ,CASE WHEN DAY ( a.DeliveryDate ) = 25 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl25n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 26 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl26n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 27 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl27n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 28 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl28n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 29 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl29n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 30 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl30n
      ,CASE WHEN DAY ( a.DeliveryDate ) = 31 AND a.Shift = 2  THEN SUM(a.Qty)
      ELSE 0 END AS tgl31n                
    FROM TD_Order a 
    JOIN M_Vendor b ON b.RegID = a.VendorID 
    JOIN M_Product c ON c.RegID = a.ItemID 
    JOIN M_UserG5 d ON d.SysID = a.UserID 
    JOIN TH_Order e ON e.TrcTypeID = a.TrcTypeID AND e.MonthID = a.MonthID AND e.TrcID = a.TrcID 
    WHERE a.TrcTypeID = @TrcTypeID AND a.MonthID = @MonthID AND a.IsDelete = 0 
    GROUP BY c.PartNo, c.PartName, a.ItemID
    ,a.DeliveryDate,a.Shift
    ORDER BY c.PartName
return;
end
GO

/****** Object:  UserDefinedFunction [dbo].[splitstring]    Script Date: 11/27/2017 3:53:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE FUNCTION [dbo].[splitstring] ( @stringToSplit VARCHAR(MAX) )
RETURNS
 @returnList TABLE ([Name] [nvarchar] (500))
AS
BEGIN
 -- SELECT * FROM dbo.splitstring('Driver|Section')
 DECLARE @name NVARCHAR(255)
 DECLARE @pos INT

 WHILE CHARINDEX('|', @stringToSplit) > 0
 BEGIN
  SELECT @pos  = CHARINDEX('|', @stringToSplit)  
  SELECT @name = SUBSTRING(@stringToSplit, 1, @pos-1)

  INSERT INTO @returnList 
  SELECT @name

  SELECT @stringToSplit = SUBSTRING(@stringToSplit, @pos+1, LEN(@stringToSplit)-@pos)
 END

 INSERT INTO @returnList
 SELECT @stringToSplit

 RETURN
END

GO

